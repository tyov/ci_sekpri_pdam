<div data-options="region:'center'" style="background:#eee;">
        <table id="dg_ekspedisi"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/ekspedisi/getEkspedisi"
            toolbar="#toolbar"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_EKSPEDISI" width="150" halign="center" align="center">No Ekspedisi</th>
                <th field="ID_BERKAS" width="150" halign="center" align="center">No Berkas</th>
                <th field="ID_JENIS_EKSPEDISI_DESC" width="250" halign="center" align="center">Jenis Ekspedisi</th>
                <th field="TGL_EKSPEDISI_DESC" width="200" halign="center" align="center">Tanggal Ekspedisi</th>
                <th field="TGL_SELESAI_DESC" width="200" halign="center" align="center">Tanggal Selesai</th>
                <th field="ID_STATUS_DESC" width="150" halign="center" align="center">Status</th>               
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahEkspedisi()">Tambah</a>
    </div>
</div>
    <div id="dlg_ekspedisi" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_ekspedisi-buttons">
        <form id="fm_ekspedisi" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input  name="ID_EKSPEDISI" id="ID_EKSPEDISI" class="easyui-textbox" readonly="true" value="" label="No Ekspedisi:" style="width:100%" >
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ID_BERKAS',textField:'ID_BERKAS',url:'<?php echo base_url(); ?>index.php/berkas/getBerkasDesc'" name="ID_BERKAS" class="easyui-combobox" required="true" label="No Berkas:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ID_JENIS_EKSPEDISI',textField:'JENIS_EKSPEDISI',url:'<?php echo base_url(); ?>index.php/mJenisEkspedisi/getJenisEkspedisiDesc'" name="ID_JENIS_EKSPEDISI" class="easyui-combobox" required="true" label="Jenis Ekspedisi:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="TGL_EKSPEDISI" class="easyui-datetimebox" label="Tanggal Ekspedisi:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="TGL_SELESAI" class="easyui-datetimebox" label="Tanggal Selesai:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ID_STATUS',textField:'STATUS',url:'<?php echo base_url(); ?>index.php/mStatus/getStatusDesc'" name="ID_STATUS" class="easyui-combobox" required="true" label="Status:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_ekspedisi-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanEkspedisi()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_ekspedisi').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_ekspedisi" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateEkspedisi()">Edit</div>
    <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusEkspedisi()">Hapus</div>
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahEkspedisi(){
        var nomor='';
        $.ajax({
        url: "<?php echo base_url(); ?>index.php/ekspedisi/getNomorEkspedisi",
        async: false,
        dataType:"json",
        success: function(result){        
            nomor=result.nomor;
          $('#dlg_ekspedisi').dialog('open').dialog('center').dialog('setTitle','Tambah Ekspedisi');
          $('#fm_ekspedisi').form('clear');
           $('#fm_ekspedisi #ID_EKSPEDISI').textbox('setValue',nomor);
           url = '<?php echo base_url(); ?>index.php/ekspedisi/newEkspedisi';
            }
        });
    }

    // function tambahEkspedisi(){
    //     $('#dlg_ekspedisi').dialog('open').dialog('center').dialog('setTitle','Tambah Ekspedisi');
    //     $('#fm_ekspedisi').form('clear');
    //     url = '<?php echo base_url(); ?>index.php/ekspedisi/newEkspedisi';
    // }

    $("#dg_ekspedisi").datagrid({  
        onRowContextMenu: function (e, rowIndex, rowData) { 
            e.preventDefault(); 
            $(this).datagrid("clearSelections"); 
            $(this).datagrid("selectRow", rowIndex);
            $('#mm_ekspedisi').menu('show', {  
                left: e.pageX,
                top: e.pageY  
            });
            e.preventDefault();
        }  
    });
    function updateEkspedisi(){
            var row = $('#dg_ekspedisi').datagrid('getSelected');
            if (row){
                $('#dlg_ekspedisi').dialog('open').dialog('center').dialog('setTitle','Update Ekspedisi');
                $('#fm_ekspedisi').form('load',row);
                url = '<?php echo base_url(); ?>index.php/ekspedisi/updateEkspedisi/'+row.ID_EKSPEDISI;
            }
        }
    function hapusEkspedisi() {
        var row = $('#dg_ekspedisi').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/ekspedisi/deleteEkspedisi',{ID_EKSPEDISI:row.ID_EKSPEDISI},function(result){
                    
                         $('#dg_ekspedisi').datagrid('reload');
                    },'json');
                }
            });
        }
    }
    function simpanEkspedisi(){
        $('#fm_ekspedisi').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
        success: function(result){
            
            $('#dlg_ekspedisi').dialog('close'); // close the dialog
            $('#dg_ekspedisi').datagrid('reload'); // reload the user data
        }
        });
    }
</script>