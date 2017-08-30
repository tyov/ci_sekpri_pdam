<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
        <table id="dg_master_status"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/mStatus/getStatus"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_STATUS" >No Status</th>
                <th field="STATUS" width="150">Status</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahMasterStatus()">Tambah</a>
    </div>
</div>
    <div id="dlg_master_status" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_status-buttons">
        <form id="fm_master_status" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'STATUS',textField:'STATUS'" name="STATUS" class="easyui-textbox" required="true" label="Status:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_status-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanMasterStatus()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_status').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_status" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateMasterStatus()">Edit</div>
<!--     <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusMasterStatus()">Hapus</div> -->
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahMasterStatus(){

           $('#dlg_master_status').dialog('open').dialog('center').dialog('setTitle','Tambah Master Status');
           $('#fm_master_status').form('clear');
           url = '<?php echo base_url(); ?>index.php/mStatus/newStatus';
        }

        $('#dg_master_status').datagrid({
            rowStyler: function(index,row){
                if (row.status_desc=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });

        $("#dg_master_status").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_master_status').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });  
                e.preventDefault();
            }  
        });

    function updateMasterStatus(){
            var row = $('#dg_master_status').datagrid('getSelected');
            if (row){
                $('#dlg_master_status').dialog('open').dialog('center').dialog('setTitle','Update Master Status');
                $('#fm_master_status').form('load',row);
                url = '<?php echo base_url(); ?>index.php/mStatus/updateStatus/'+row.ID_STATUS;
            }
        }

    function hapusMasterStatus() {
        var row = $('#dg_master_status').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/mStatus/deleteStatus',{ID_STATUS:row.ID_STATUS},function(result){
                    
                         $('#dg_master_status').datagrid('reload');
                    },'json');
                }
            });
        }
    }

    function simpanMasterStatus(){
        //console.log("test");
        //console.log(url);

        $('#fm_master_status').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
        success: function(result){
        	
            // var result = eval('('+result+')');
            // if (result.errorMsg){
            //     $.messager.show({
            //         title: 'Error',
            //         msg: result.errorMsg
            //     });
            // } else {
            $('#dlg_master_status').dialog('close'); // close the dialog
            $('#dg_master_status').datagrid('reload'); // reload the user data
            //}
        }
        });
    }
</script>