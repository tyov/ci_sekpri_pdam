<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
        <table id="dg_master_kegiatan_asal"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/mAsalKegiatan/getAsalKegiatan"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_ASAL_KEGIATAN" width="25" >No Asal Kegiatan</th>
                <th field="ASAL_KEGIATAN" width="150" >Asal Kegiatan</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahMasterKegiatanAsal()">Tambah</a>
    </div>
</div>
    <div id="dlg_master_kegiatan_asal" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_kegiatan_asal-buttons">
        <form id="fm_master_kegiatan_asal" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ASAL_KEGIATAN',textField:'ASAL_KEGIATAN'" name="ASAL_KEGIATAN" class="easyui-textbox" required="true" label="Asal Kegiatan:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_kegiatan_asal-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanMasterKegiatanAsal()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_kegiatan_asal').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_kegiatan_asal" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateMasterKegiatanAsal()">Edit</div>
<!--     <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusMasterKegiatanAsal()">Hapus</div> -->
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>
</div>

<script type="text/javascript">
        
    var url;
    function tambahMasterKegiatanAsal(){

           $('#dlg_master_kegiatan_asal').dialog('open').dialog('center').dialog('setTitle','Tambah Master Kegiatan');
           $('#fm_master_kegiatan_asal').form('clear');
           url = '<?php echo base_url(); ?>index.php/mAsalKegiatan/newAsalKegiatan';
        }

        $('#dg_master_kegiatan_asal').datagrid({
            rowStyler: function(index,row){
                if (row.status_desc=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });

        $("#dg_master_kegiatan_asal").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_master_kegiatan_asal').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });
                e.preventDefault();
            }  
        });

    function updateMasterKegiatanAsal(){
            var row = $('#dg_master_kegiatan_asal').datagrid('getSelected');
            if (row){
                $('#dlg_master_kegiatan_asal').dialog('open').dialog('center').dialog('setTitle','Update Master Kegiatan');
                $('#fm_master_kegiatan_asal').form('load',row);
                url = '<?php echo base_url(); ?>index.php/mAsalKegiatan/updateAsalKegiatan/'+row.ID_ASAL_KEGIATAN;
            }
        }

    function hapusMasterKegiatanAsal() {
        var row = $('#dg_master_kegiatan_asal').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/mAsalKegiatan/deleteAsalKegiatan',{ID_ASAL_KEGIATAN:row.ID_ASAL_KEGIATAN},function(result){
                    
                         $('#dg_master_kegiatan_asal').datagrid('reload');
                    },'json');
                }
            });
        }
    }

    function simpanMasterKegiatanAsal(){

        $('#fm_master_kegiatan_asal').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
        success: function(result){
        	
            $('#dlg_master_kegiatan_asal').dialog('close'); // close the dialog
            $('#dg_master_kegiatan_asal').datagrid('reload'); // reload the user data

        }
        });
    }
</script>