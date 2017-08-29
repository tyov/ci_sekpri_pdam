<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
            <table id="dg_master_berkas_selesai"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/berkas/getBerkasSelesai"
            toolbar="#toolbar" fit="true"
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
                <th field="TGL_AMBIL_DESC" width="250" halign="center" align="center">Tanggal Ambil</th>
                <th field="PENGAMBIL_DESC" width="250" halign="center" align="center">Pengambil</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
                <script type="text/javascript">
                    function searchBerkasSelesai(value,name){
                        $('#dg_master_berkas_selesai').datagrid('load',{
                            searchKey: name,
                            searchValue: value
                        });
                    }
                </script>
                 
                <input id="ss" class="easyui-searchbox" style="width:300px;"
                        data-options="searcher:searchBerkasSelesai,prompt:'Cari...',menu:'#mm'"></input>
                        
                <div id="mm" style="width:120px;">
                    <div name="RIGHT(a.ID_BERKAS,6)">No Berkas</div>
                    <div name="b.PERIHAL">Perihal</div>
                    <div name="c.nama_bagian">Nama Bagian</div>
                    <div name="e.nama_lengkap">Nama Pengirim</div>
                </div>
    </div>
</div>
    <div id="dlg_master_berkas_selesai" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_master_berkas_selesai-buttons">
        <form id="fm_master_berkas_selesai" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>
            <div style="margin-bottom:10px">
                <input  name="ID_BERKAS" id="ID_BERKAS" class="easyui-textbox" readonly="true" value="" label="No Berkas:" style="width:100%" >
            </div>
            <div style="margin-bottom:10px">
                <input name="PERIHAL" class="easyui-textbox" label="Perihal:" readonly="true" style="width:100%; height:100px" data-options="multiline:true">
            </div>
            <div style="margin-bottom:10px">
                <input  name="TGL_AMBIL" id="TGL_AMBIL" class="easyui-textbox" readonly="true" value="" label="Tgl Ambil:" style="width:100%" >
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'nip',textField:'nama_lengkap',url:'<?php echo base_url(); ?>index.php/karyawan/getKaryawan'" name="PENGAMBIL" class="easyui-combobox" label="Pengambil:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg_master_berkas_selesai-buttons"> 
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanBerkasSelesai()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_master_berkas_selesai').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_master_berkas_selesai" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateBerkasSelesai()">Update</div>
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>
    </div>

<script type="text/javascript">
        
    var url;

    $("#dg_master_berkas_selesai").datagrid({  
        onRowContextMenu: function (e, rowIndex, rowData) { 
            e.preventDefault(); 
            $(this).datagrid("clearSelections"); 
            $(this).datagrid("selectRow", rowIndex);
            $('#mm_master_berkas_selesai').menu('show', {  
                left: e.pageX,
                top: e.pageY  
            });
            e.preventDefault();
        }  
    });

    function updateBerkasSelesai(){
            var row = $('#dg_master_berkas_selesai').datagrid('getSelected');
            if (row){
                $('#dlg_master_berkas_selesai').dialog('open').dialog('center').dialog('setTitle','Update Berkas');
                $('#fm_master_berkas_selesai').form('load',row);
                var tanggal='';
                $.ajax({
                url: "<?php echo base_url(); ?>index.php/berkas/getNomorBerkas",
                async: false,
                dataType:"json",
                success: function(result){        
                    tanggal=result.tanggal;
                    $('#fm_master_berkas_selesai #TGL_AMBIL').textbox('setValue',tanggal);
                    }
                });
                url = '<?php echo base_url(); ?>index.php/berkas/updateBerkasSelesai/'+row.ID_BERKAS;
            }
        }

    function simpanBerkasSelesai(){

        $('#fm_master_berkas_selesai').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
        success: function(result){
            
            $('#dlg_master_berkas_selesai').dialog('close'); // close the dialog
            $('#dg_master_berkas_selesai').datagrid('reload'); // reload the user data

        }
        });
    }
</script>