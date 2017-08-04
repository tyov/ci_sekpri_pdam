<div data-options="region:'center'" style="background:#eee;">
        <table id="dg_master_direksi"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/mDireksi/getDireksi"
            toolbar="#toolbar"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_DIREKSI" halign="center" align="center">No Direksi</th>
                <th field="DIREKSI" width="150" halign="center" align="center">Direksi</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahMasterDireksi()">Tambah</a>
    </div>
</div>
    <div id="dlg_master_direksi" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_direksi-buttons">
        <form id="fm_master_direksi" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'DIREKSI',textField:'DIREKSI'" name="DIREKSI" class="easyui-textbox" required="true" label="Nama Direksi:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_direksi-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanMasterDireksi()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_direksi').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_direksi" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateMasterDireksi()">Edit</div>
    <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusMasterDireksi()">Hapus</div>
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahMasterDireksi(){

           $('#dlg_master_direksi').dialog('open').dialog('center').dialog('setTitle','Tambah Master Ekspedisi');
           $('#fm_master_direksi').form('clear');
           url = '<?php echo base_url(); ?>index.php/mDireksi/newDireksi';
        }

        $('#dg_master_direksi').datagrid({
            rowStyler: function(index,row){
                if (row.status_desc=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });

        $("#dg_master_direksi").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_master_direksi').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });  
                e.preventDefault();
            }  
        });

    function updateMasterDireksi(){
            var row = $('#dg_master_direksi').datagrid('getSelected');
            if (row){
                $('#dlg_master_direksi').dialog('open').dialog('center').dialog('setTitle','Update Master Ekspedisi');
                $('#fm_master_direksi').form('load',row);
                url = '<?php echo base_url(); ?>index.php/mDireksi/updateDireksi/'+row.ID_DIREKSI;
            }
        }

    function hapusMasterDireksi() {
        var row = $('#dg_master_direksi').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/mDireksi/deleteDireksi',{ID_DIREKSI:row.ID_DIREKSI},function(result){
                    
                         $('#dg_master_direksi').datagrid('reload');
                    },'json');
                }
            });
        }
    }

    function simpanMasterDireksi(){
        //console.log("test");
        //console.log(url);

        $('#fm_master_direksi').form('submit',{
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
            $('#dlg_master_direksi').dialog('close'); // close the dialog
            $('#dg_master_direksi').datagrid('reload'); // reload the user data
            //}
        }
        });
    }
</script>