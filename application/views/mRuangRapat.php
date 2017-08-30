<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
        <table id="dg_master_ruang_rapat"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/mRuangRapat/getRuangRapat"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_RUANG_RAPAT" width="30" >No Jenis Ruang Rapat</th>
                <th field="RUANG_RAPAT" width="150" >Jenis Ruang Rapat</th>
                <th field="KETERANGAN" width="150" >Keterangan</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahMasterRuangRapat()">Tambah</a>
    </div>
</div>
    <div id="dlg_master_ruang_rapat" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_ruang_rapat-buttons">
        <form id="fm_master_ruang_rapat" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'RUANG_RAPAT',textField:'RUANG_RAPAT'" name="RUANG_RAPAT" class="easyui-textbox" required="true" label="Jenis Ruang Rapat:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'KETERANGAN',textField:'KETERANGAN'" name="KETERANGAN" class="easyui-textbox" required="true" label="Keterangan:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_ruang_rapat-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanMasterRuangRapat()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_ruang_rapat').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_ruang_rapat" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateMasterRuangRapat()">Edit</div>
<!--     <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusMasterRuangRapat()">Hapus</div> -->
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahMasterRuangRapat(){

           $('#dlg_master_ruang_rapat').dialog('open').dialog('center').dialog('setTitle','Tambah Master Ruang Rapat');
           $('#fm_master_ruang_rapat').form('clear');
           url = '<?php echo base_url(); ?>index.php/mRuangRapat/newRuangRapat';
        }

        $('#dg_master_ruang_rapat').datagrid({
            rowStyler: function(index,row){
                if (row.status_desc=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });

        $("#dg_master_ruang_rapat").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_master_ruang_rapat').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });  
                e.preventDefault();
            }  
        });

    function updateMasterRuangRapat(){
            var row = $('#dg_master_ruang_rapat').datagrid('getSelected');
            if (row){
                $('#dlg_master_ruang_rapat').dialog('open').dialog('center').dialog('setTitle','Update Master Ruang Rapat');
                $('#fm_master_ruang_rapat').form('load',row);
                url = '<?php echo base_url(); ?>index.php/mRuangRapat/updateRuangRapat/'+row.ID_RUANG_RAPAT;
            }
        }

    function hapusMasterRuangRapat() {
        var row = $('#dg_master_ruang_rapat').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/mRuangRapat/deleteRuangRapat',{ID_RUANG_RAPAT:row.ID_RUANG_RAPAT},function(result){
                    
                         $('#dg_master_ruang_rapat').datagrid('reload');
                    },'json');
                }
            });
        }
    }

    function simpanMasterRuangRapat(){
        //console.log("test");
        //console.log(url);

        $('#fm_master_ruang_rapat').form('submit',{
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
            $('#dlg_master_ruang_rapat').dialog('close'); // close the dialog
            $('#dg_master_ruang_rapat').datagrid('reload'); // reload the user data
            //}
        }
        });
    }
</script>