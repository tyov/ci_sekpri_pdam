<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
        <table id="dg_master_kegiatan"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/mJenisKegiatan/getJenisKegiatan"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_JENIS_KEGIATAN" >No Jenis Kegiatan</th>
                <th field="JENIS_KEGIATAN" width="150" >Jenis Kegiatan</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahMasterKegiatan()">Tambah</a>
    </div>
</div>
    <div id="dlg_master_kegiatan" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_kegiatan-buttons">
        <form id="fm_master_kegiatan" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'JENIS_KEGIATAN',textField:'JENIS_KEGIATAN'" name="JENIS_KEGIATAN" class="easyui-textbox" required="true" label="Jenis Kegiatan:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_kegiatan-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanMasterKegiatan()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_kegiatan').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_kegiatan" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateMasterKegiatan()">Edit</div>
<!--     <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusMasterKegiatan()">Hapus</div> -->
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahMasterKegiatan(){

           $('#dlg_master_kegiatan').dialog('open').dialog('center').dialog('setTitle','Tambah Master Kegiatan');
           $('#fm_master_kegiatan').form('clear');
           url = '<?php echo base_url(); ?>index.php/mJenisKegiatan/newJenisKegiatan';
        }

        $('#dg_master_kegiatan').datagrid({
            rowStyler: function(index,row){
                if (row.status_desc=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });

        $("#dg_master_kegiatan").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_master_kegiatan').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });  
                e.preventDefault();
            }  
        });

    function updateMasterKegiatan(){
            var row = $('#dg_master_kegiatan').datagrid('getSelected');
            if (row){
                $('#dlg_master_kegiatan').dialog('open').dialog('center').dialog('setTitle','Update Master Kegiatan');
                $('#fm_master_kegiatan').form('load',row);
                url = '<?php echo base_url(); ?>index.php/mJenisKegiatan/updateJenisKegiatan/'+row.ID_JENIS_KEGIATAN;
            }
        }

    function hapusMasterKegiatan() {
        var row = $('#dg_master_kegiatan').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/mJenisKegiatan/deleteJenisKegiatan',{ID_JENIS_KEGIATAN:row.ID_JENIS_KEGIATAN},function(result){
                    
                         $('#dg_master_kegiatan').datagrid('reload');
                    },'json');
                }
            });
        }
    }

    function simpanMasterKegiatan(){
        //console.log("test");
        //console.log(url);

        $('#fm_master_kegiatan').form('submit',{
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
            $('#dlg_master_kegiatan').dialog('close'); // close the dialog
            $('#dg_master_kegiatan').datagrid('reload'); // reload the user data
            //}
        }
        });
    }
</script>