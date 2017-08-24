<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
            <table id="dg_master_ekspedisi"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/mJenisEkspedisi/getJenisEkspedisi"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_JENIS_EKSPEDISI" width="20">No Jenis Ekspedisi</th>
                <th field="JENIS_EKSPEDISI" width="150" >Jenis Ekspedisi</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahMasterEkspedisi()">Tambah</a>
    </div>
</div>
    <div id="dlg_master_ekspedisi" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_ekspedisi-buttons">
        <form id="fm_master_ekspedisi" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'JENIS_EKSPEDISI',textField:'JENIS_EKSPEDISI'" name="JENIS_EKSPEDISI" class="easyui-textbox" required="true" label="Jenis Ekspedisi:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_ekspedisi-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanMasterEkspedisi()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_ekspedisi').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_ekspedisi" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateMasterEkspedisi()">Edit</div>
    <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusMasterEkspedisi()">Hapus</div>
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahMasterEkspedisi(){

           $('#dlg_master_ekspedisi').dialog('open').dialog('center').dialog('setTitle','Tambah Master Ekspedisi');
           $('#fm_master_ekspedisi').form('clear');
           url = '<?php echo base_url(); ?>index.php/mJenisEkspedisi/newJenisEkspedisi';
        }

        $('#dg_master_ekspedisi').datagrid({
            rowStyler: function(index,row){
                if (row.status_desc=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });

        $("#dg_master_ekspedisi").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_master_ekspedisi').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });  
                e.preventDefault();
            }  
        });

    function updateMasterEkspedisi(){
            var row = $('#dg_master_ekspedisi').datagrid('getSelected');
            if (row){
                $('#dlg_master_ekspedisi').dialog('open').dialog('center').dialog('setTitle','Update Master Ekspedisi');
                $('#fm_master_ekspedisi').form('load',row);
                url = '<?php echo base_url(); ?>index.php/mJenisEkspedisi/updateJenisEkspedisi/'+row.ID_JENIS_EKSPEDISI;
            }
        }

    function hapusMasterEkspedisi() {
        var row = $('#dg_master_ekspedisi').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/mJenisEkspedisi/deleteJenisEkspedisi',{ID_JENIS_EKSPEDISI:row.ID_JENIS_EKSPEDISI},function(result){
                    
                         $('#dg_master_ekspedisi').datagrid('reload');
                    },'json');
                }
            });
        }
    }

    function simpanMasterEkspedisi(){
        //console.log("test");
        //console.log(url);

        $('#fm_master_ekspedisi').form('submit',{
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
            $('#dlg_master_ekspedisi').dialog('close'); // close the dialog
            $('#dg_master_ekspedisi').datagrid('reload'); // reload the user data
            //}
        }
        });
    }
</script>