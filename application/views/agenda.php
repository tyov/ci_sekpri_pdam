<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
            <table id="dg_agenda"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/agenda/getAgenda"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitColumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_AGENDA_RUANG_RAPAT" width="200" >No</th>
                <th field="ID_JENIS_KEGIATAN_DESC" width="0" >Jenis Kegiatan</th>
                <th field="ID_ASAL_KEGIATAN_DESC" width="150" >Asal Kegiatan</th>
                <th field="PEMESAN_DESC" width="150" >Pemesan</th>
                <th field="TGL_PEMESANAN" width="150" >Tanggal Pesan</th>
                <th field="KETERANGAN" width="300" >Keterangan</th>
                <th field="JUMLAH" width="300" >Jumlah</th>
                <th field="TGL_MULAI" width="150" >Tanggal Mulai</th>
                <th field="TGL_SELESAI" width="150" >Tanggal Selesai</th>
                <th field="ID_RUANG_RAPAT_DESC" width="150" >Ruang Rapat</th>               

            </tr>
        </thead>
    </table>
    <div id="toolbar" style="padding: 5px;height: 36px;">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahAgenda()">Tambah</a>
        <script type="text/javascript">
                    function searchAgenda(value,name){
                        $('#dg_agenda').datagrid('load',{
                            searchKey: name,
                            searchValue: value
                        });
                    }
                </script>
                 
                <input id="ss" class="easyui-searchbox" style="width:300px;"
                        data-options="searcher:searchAgenda,prompt:'Cari...',menu:'#mm'"></input>
                        
                <div id="mm" style="width:120px;">
                    <div name="RIGHT(a.ID_AGENDA_RUANG_RAPAT,6)">No Agenda</div>
                    <div name="JENIS_KEGIATAN">Jenis Kegiatan</div>
                    <div name="b.RUANG_RAPAT">Ruang</div>
                    <div name="C.nama_lengkap">Pemesan</div>
                    <div name="TGL_MULAI">Tgl Mulai</div>
                </div>                
    </div>
</div>
    <div id="dlg_agenda" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_agenda-buttons">
                
        <form id="fm_agenda" name='fm_agenda' method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>

            <div style="margin-bottom:10px">
                <input  name="ID_AGENDA_RUANG_RAPAT" id="ID_AGENDA_RUANG_RAPAT" class="easyui-textbox" readonly="true" label="No Agenda:" style="width:100%" >
           
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ID_JENIS_KEGIATAN',textField:'JENIS_KEGIATAN',url:'<?php echo base_url(); ?>index.php/mJenisKegiatan/getJenisKegiatanDesc'" name="ID_JENIS_KEGIATAN" class="easyui-combobox" id="ID_JENIS_KEGIATAN" required="true" label="Jenis Kegiatan:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ID_ASAL_KEGIATAN',textField:'ASAL_KEGIATAN',url:'<?php echo base_url(); ?>index.php/mAsalKegiatan/getAsalKegiatanDesc'" class="easyui-combobox" name="ID_ASAL_KEGIATAN" id='ID_ASAL_KEGIATAN' required="true" label="Asal Kegiatan:" style="width:100%">
            </div>

            <div style="margin-bottom:10px">
                <input data-options="valueField:'nip',textField:'nama_lengkap',url:'<?php echo base_url(); ?>index.php/karyawan/getKaryawan'" class="easyui-combobox" name="PEMESAN" required="true" label="Pemesan:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="KETERANGAN" class="easyui-textbox" label="Keterangan:" style="width:100%; height:100px" data-options="multiline:true">
            </div>
            <div style="margin-bottom:10px">
                <input name="JUMLAH" class="easyui-textbox" label="Jumlah Peserta:" style="width:100%">
            </div>

            <div style="margin-bottom:10px">
                <input data-options="valueField:'TGL_MULAI',textField:'TGL_MULAI'" class="easyui-datetimebox" name="TGL_MULAI" required="true" label="Tgl Mulai:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'TGL_SELESAI',textField:'TGL_SELESAI'" class="easyui-datetimebox" name="TGL_SELESAI" required="true" label="Tgl Selesai:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ID_RUANG_RAPAT',textField:'RUANG_RAPAT',url:'<?php echo base_url(); ?>index.php/mRuangRapat/getRuangRapatDesc'" class="easyui-combobox" name="ID_RUANG_RAPAT" required="true" id="ID_RUANG_RAPAT" label="Ruang Rapat:" style="width:100%">
            </div>

        </form>
    </div>
    <div id="dlg_agenda-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanAgenda()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_agenda').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_agenda" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateAgenda()">Edit</div>
    <div data-options="iconCls:'icon-cancel'" plain="true" onclick="batalAgenda()">Batal</div>
    <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusAgenda()">Hapus</div>
    <div class="menu-sep"></div>
    <div data-options="iconCls:'icon-print'" plain="true" onclick="hapusAgenda()">Cetak</div>
    </div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahAgenda(){
        var nomor='';
        $.ajax({
        url: "<?php echo base_url(); ?>index.php/agenda/getNomorRapat",
        async: false,
        dataType:"json",
        success: function(result){        
                nomor=result.nomor;
                $('#dlg_agenda').dialog('open').dialog('center').dialog('setTitle','Tambah Agenda');
                $('#fm_agenda').form('clear');
                $('#fm_agenda #ID_AGENDA_RUANG_RAPAT').textbox('setValue',nomor);
                url = '<?php echo base_url(); ?>index.php/agenda/newAgenda';
                $('#ID_ASAL_KEGIATAN').combobox('reload');
                $('#ID_JENIS_KEGIATAN').combobox('reload');
                $('#ID_RUANG_RAPAT').combobox('reload');
            }
        });

        }

        $('#dg_agenda').datagrid({
            rowStyler: function(index,row){
                if (row.status_DESC=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });


        $("#dg_agenda").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_agenda').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });  
                e.preventDefault();
            }  
        });

    function updateAgenda(){
            var row = $('#dg_agenda').datagrid('getSelected');
            row.STATUS=1;
            console.log(row.STATUS);
            if (row){
                $('#dlg_agenda').dialog('open').dialog('center').dialog('setTitle','Update agenda');
                $('#fm_agenda').form('load',row);
                url = '<?php echo base_url(); ?>index.php/agenda/updateAgenda/'+row.ID_AGENDA_RUANG_RAPAT;
            }
        }

    function hapusAgenda() {
        var row = $('#dg_agenda').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/agenda/deleteAgenda/'+row.ID_AGENDA_RUANG_RAPAT,{ID_AGENDA_RUANG_RAPAT:row.ID_AGENDA_RUANG_RAPAT},function(result){
                        //if (result.success){
                            $('#dg_agenda').datagrid('reload');    // reload the user data
                        //} else {
                        //     $.messager.show({    // show error message
                        //         title: 'Error',
                        //         msg: result.errorMsg
                        //     });
                        // }
                    },'json');
                }
            });
        }
    }

    function simpanAgenda(){
        console.log("test");

        $('#fm_agenda').form('submit',{
            url: url,
            onSubmit: function(){
            return $(this).form('validate');
            },
        success: function(result){
            console.log(result);
            var message = "";
            if(result=="sukses"){
                message = "Sukses menambahkan agenda";                
                $('#dlg_agenda').dialog('close');
                $('#dg_agenda').datagrid('reload');
            }else if(result=="gagal"){
                message = "Maaf terjadi kesalahan mohon ulangi kembali";
            }else{
                message = "Ruang rapat pada jam tersebut telah di pakai. mohon di jadwal ulang";
            }
            $.messager.alert('Konfirmasi',message);
            //}
        }
        });
    }
     
    function batalAgenda(){
        S
        }
</script>