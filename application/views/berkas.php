<div data-options="region:'center'" style="background:#eee;">
        <table id="dg_master_berkas"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/berkas/getBerkas"
            toolbar="#toolbar"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_BERKAS" halign="center" align="center">No Berkas</th>
                <th field="TGL_TERIMA_DESC" width="150" halign="center" align="center">Tanggal Terima</th>
                <th field="PENERIMA_DESC" width="150" halign="center" align="center">Penerima</th>
                <th field="PENGIRIM_DESC" width="150" halign="center" align="center">Pengirim</th>
                <th field="BAGIAN_DESC" width="150" halign="center" align="center">Bagian</th>
                <th field="PERIHAL" width="250" halign="center" align="center">Perihal</th>
                <th field="TGL_AMBIL_DESC" width="150" halign="center" align="center">Tanggal Ambil</th>
                <th field="PENGAMBIL_DESC" width="150" halign="center" align="center">Pengambil</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahBerkas()">Tambah</a>
    </div>
</div>
    <div id="dlg_master_berkas" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_berkas-buttons">
        <form id="fm_master_berkas" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input  name="ID_BERKAS" id="ID_BERKAS" class="easyui-textbox" readonly="true" value="" label="No Berkas:" style="width:100%" >
            </div>
            <div style="margin-bottom:10px">
               <input data-options="valueField:'TANGGAL',textField:'TANGGAL',url:'<?php echo base_url(); ?>index.php/berkas/getTanggal'" id=TGL_TERIMA name="TGL_TERIMA" class="easyui-textbox" readonly="true" label="Tanggal Terima:" style="width:100%" >
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'nip',textField:'nama_lengkap',url:'<?php echo base_url(); ?>index.php/karyawan/getKaryawan'" name="PENERIMA" class="easyui-combobox" required="true" label="Penerima:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'nip',textField:'nama_lengkap',url:'<?php echo base_url(); ?>index.php/karyawan/getKaryawan'" name="PENGIRIM" class="easyui-combobox" required="true" label="Pengirim:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'kode',textField:'nama_bagian',url:'<?php echo base_url(); ?>index.php/bagian/getBagian'" name="BAGIAN" class="easyui-combobox" required="true" label="Bagian:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="PERIHAL" class="easyui-textbox" label="Perihal:" style="width:100%; height:100px" data-options="multiline:true">
            </div>
            <div style="margin-bottom:10px">
                <input name="TGL_AMBIL" class="easyui-datebox" label="Tanggal Ambil:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'nip',textField:'nama_lengkap',url:'<?php echo base_url(); ?>index.php/karyawan/getKaryawan'" name="PENGAMBIL" class="easyui-combobox" label="Pengambil:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_berkas-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanBerkas()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_berkas').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_berkas" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateBerkas()">Edit</div>
    <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusBerkas()">Hapus</div>
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahBerkas(){
        var nomor='';
        var tanggal='';
        $.ajax({
        url: "<?php echo base_url(); ?>index.php/berkas/getNomorBerkas",
        async: false,
        dataType:"json",
        success: function(result){        
            nomor=result.nomor;
            tanggal=result.tanggal;
            $('#dlg_master_berkas').dialog('open').dialog('center').dialog('setTitle','Tambah Agenda Direksi');
            $('#fm_master_berkas').form('clear');
            $('#fm_master_berkas #ID_BERKAS').textbox('setValue',nomor);
            $('#fm_master_berkas #TGL_TERIMA').textbox('setValue',tanggal);
            url = '<?php echo base_url(); ?>index.php/berkas/newBerkas';      
            }
        });
        }

    $("#dg_master_berkas").datagrid({  
        onRowContextMenu: function (e, rowIndex, rowData) { 
            e.preventDefault(); 
            $(this).datagrid("clearSelections"); 
            $(this).datagrid("selectRow", rowIndex);
            $('#mm_master_berkas').menu('show', {  
                left: e.pageX,
                top: e.pageY  
            });
            e.preventDefault();
        }  
    });

    function updateBerkas(){
            var row = $('#dg_master_berkas').datagrid('getSelected');
            if (row){
                $('#dlg_master_berkas').dialog('open').dialog('center').dialog('setTitle','Update Berkas');
                $('#fm_master_berkas').form('load',row);
                url = '<?php echo base_url(); ?>index.php/berkas/updateBerkas/'+row.ID_BERKAS;
            }
        }

    function hapusBerkas() {
        var row = $('#dg_master_berkas').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/berkas/deleteBerkas',{ID_BERKAS:row.ID_BERKAS},function(result){
                    
                         $('#dg_master_berkas').datagrid('reload');
                    },'json');
                }
            });
        }
    }

    function simpanBerkas(){

        $('#fm_master_berkas').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
        success: function(result){
            
            $('#dlg_master_berkas').dialog('close'); // close the dialog
            $('#dg_master_berkas').datagrid('reload'); // reload the user data

        }
        });
    }
</script>