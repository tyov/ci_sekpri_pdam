<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
        <table id="dg_agenda_direksi"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/agendaDireksi/getAgendaDireksi"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitColumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="ID_AGENDA_DIREKSI" width="200" >No</th>
                <th field="ID_DIREKSI_DESC" width="200" >Direksi</th>
                <th field="TGL_ACARA" width="150" >Tanggal Acara</th>
                <th field="TGL_KEMBALI" width="150" >Tanggal Kembali</th>
                <th field="KEGIATAN" width="150" >Kegiatan</th>
                <th field="PENGUNDANG" width="150" >Pengundang</th>
                <th field="KETERANGAN" width="300" >Keterangan</th>
                <th field="LOKASI" width="150" >Lokasi</th>               
                
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tambahAgendaDireksi()">Tambah</a>
    </div>
</div>
    <div id="dlg_agenda_direksi" class="easyui-dialog" style="width:400px"
            closed="true" buttons="#dlg_agenda_direksi-buttons">
                
        <form id="fm_agenda_direksi" name='fm_agenda_direksi' method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:20px;font-size:14px;border-bottom:1px solid #ccc">Data</div>

            <div style="margin-bottom:10px">
                <input  name="ID_AGENDA_DIREKSI" id="ID_AGENDA_DIREKSI" class="easyui-textbox" readonly="true" label="No Agenda Direksi:" style="width:100%" >
           
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'ID_DIREKSI',textField:'DIREKSI',url:'<?php echo base_url(); ?>index.php/mDireksi/getMDireksiDesc'" name="ID_DIREKSI" class="easyui-combobox" required="true" label="Direksi:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'TGL_ACARA',textField:'TGL_ACARA'" class="easyui-datetimebox" name="TGL_ACARA" required="true" label="Tgl Acara:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input data-options="valueField:'TGL_KEMBALI',textField:'TGL_KEMBALI'" class="easyui-datetimebox" name="TGL_KEMBALI" required="true" label="Tgl Kembali:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="KEGIATAN" class="easyui-textbox" label="Kegiatan:" style="width:100%; height:50px" data-options="multiline:true">
            </div>
            <div style="margin-bottom:10px">
                <input name="PENGUNDANG" class="easyui-textbox" label="Pengundang:" style="width:100%; height:50px" data-options="multiline:true">
            </div>
            <div style="margin-bottom:10px">
                <input name="KETERANGAN" class="easyui-textbox" label="Keterangan:" style="width:100%; height:100px" data-options="multiline:true">
            </div>
            <div style="margin-bottom:10px">
                <input name="LOKASI" class="easyui-textbox" label="Lokasi:" style="width:100%; height:50px" data-options="multiline:true">
            </div>

        </form>
    </div>
    <div id="dlg_agenda_direksi-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="simpanAgendaDireksi()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_agenda_direksi').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="mm_agenda_direksi" class="easyui-menu" style="width:120px;">
    <div data-options="iconCls:'icon-edit'" plain="true" onclick="updateAgendaDireksi()">Edit</div>
    <div data-options="iconCls:'icon-remove'" plain="true" onclick="hapusAgendaDireksi()">Hapus</div>
    <div class="menu-sep"></div>
    <div>Exit</div>
    </div>
    </div>

<script type="text/javascript">
        
    var url;
    function tambahAgendaDireksi(){
        var nomor='';
        $.ajax({
        url: "<?php echo base_url(); ?>index.php/agendaDireksi/getNomorDireksi",
        async: false,
        dataType:"json",
        success: function(result){        
            nomor=result.nomor;
          $('#dlg_agenda_direksi').dialog('open').dialog('center').dialog('setTitle','Tambah Agenda Direksi');
          $('#fm_agenda_direksi').form('clear');
           $('#fm_agenda_direksi #ID_AGENDA_DIREKSI').textbox('setValue',nomor);
           url = '<?php echo base_url(); ?>index.php/agendaDireksi/newAgendaDireksi';
      
            }
        });

        }

        $('#dg_agenda_direksi').datagrid({
            rowStyler: function(index,row){
                if (row.status_DESC=="Belum Terkirim"){
                    return 'background-color:#48A7C9;color:#fff;';
                }
            }
        });


        $("#dg_agenda_direksi").datagrid({  
            onRowContextMenu: function (e, rowIndex, rowData) { 
                e.preventDefault(); 
                $(this).datagrid("clearSelections"); 
                $(this).datagrid("selectRow", rowIndex);
                $('#mm_agenda_direksi').menu('show', {  
                    left: e.pageX,
                    top: e.pageY  
                });  
                e.preventDefault();
            }  
        });


        /*function checkTime(i) {
            return (i < 10) ? "0" + i : i;
        }*/

        // $('#tgl_terima').datetimebox('datebox')

    function updateAgendaDireksi(){
            var row = $('#dg_agenda_direksi').datagrid('getSelected');
            /*console.log(row.TGL_PEMESANAN);*/
            if (row){
                $('#dlg_agenda_direksi').dialog('open').dialog('center').dialog('setTitle','Update agenda');
                $('#fm_agenda_direksi').form('load',row);
                url = '<?php echo base_url(); ?>index.php/agendaDireksi/updateAgendaDireksi/'+row.ID_AGENDA_DIREKSI;
            }
        }

    function hapusAgendaDireksi() {
        var row = $('#dg_agenda_direksi').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Yakin hapus data ini?',function(r){
                if (r){
                    $.post('<?php echo base_url(); ?>index.php/agendaDireksi/deleteAgendaDireksi/'+row.ID_AGENDA_DIREKSI,{ID_AGENDA_DIREKSI:row.ID_AGENDA_DIREKSI},function(result){
                        //if (result.success){
                            $('#dg_agenda_direksi').datagrid('reload');    // reload the user data
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

    function simpanAgendaDireksi(){
        console.log("test");
        //console.log(url);

        $('#fm_agenda_direksi').form('submit',{
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
            $('#dlg_agenda_direksi').dialog('close'); // close the dialog
            $('#dg_agenda_direksi').datagrid('reload'); // reload the user data
            //}
        }
        });
    }

     

    /*$.ajax({
        url: "<?php echo base_url(); ?>index.php/agenda/getTanggal",
        async: false,
        dataType:"json",
        success: function(result){   
            $('#TGL_TERIMA').val(result.tanggal);
            }
    });*/

</script>