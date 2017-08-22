<div data-options="region:'center'" style="background:#eee;">
    <table id="dg_laporan_agenda"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/laporanAgenda/getLaporan"
            toolbar="#toolbar"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="TGL_PEMESANAN" width="200" halign="center" align="center">Tgl Pesan</th>
                <th field="JENIS_KEGIATAN" width="150" halign="center" align="center">Kegiatan</th>
                <th field="ASAL_KEGIATAN" width="150" halign="center" align="center">Asal Kegiatan</th>
                <th field="PEMESAN" width="150" halign="center" align="center">Pemesan</th>
                <th field="KETERANGAN" width="150" halign="center" align="center">Keterangan</th>
                <th field="JUMLAH" width="150" halign="center" align="center">Jumlah</th>
                <th field="RUANG_RAPAT" width="150" halign="center" align="center">Ruangan</th>
                <th field="TGL_MULAI" width="150" halign="center" align="center">Tgl Mulai</th>
                <th field="TGL_SELESAI" width="150" halign="center" align="center">Tgl Selesai</th>
            
            </tr>
        </thead>
    </table>    
    <div id="toolbar">
            
            Tgl Mulai : <input id="TGL_MULAI" type="text" class="easyui-datebox" required="required">
            Tgl Selesai : <input id="TGL_SELESAI" type="text" class="easyui-datebox" required="required">
            Jenis Kegiatan : <input id="JENIS_KEGIATAN" data-options="valueField:'ID_JENIS_KEGIATAN',textField:'JENIS_KEGIATAN',url:'<?php echo base_url(); ?>index.php/mJenisKegiatan/getJenisKegiatanDesc'" name="ID_JENIS_KEGIATAN" class="easyui-combobox" style="width: 200px">
            <a class="easyui-linkbutton" data-options="iconCls:'icon-print'" onClick="cetakLaporan()">CETAK PDF</a>
    </div>

<script>
    $('#JENIS_KEGIATAN').combobox({
        onSelect: function(rec){
            //alert(rec.ID_JENIS_KEGIATAN)
            var TGL_MULAI = $('#TGL_MULAI').datebox('getValue');
            var TGL_SELESAI = $('#TGL_SELESAI').datebox('getValue');
            $('#dg_laporan_agenda').datagrid('load', {
                TGL_MULAI: TGL_MULAI,
                TGL_SELESAI: TGL_SELESAI,
                JENIS_KEGIATAN:rec.ID_JENIS_KEGIATAN 
            });
        }
    });

    function cetakLaporan(){
        var TGL_MULAI = $('#TGL_MULAI').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        var TGL_SELESAI = $('#TGL_SELESAI').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        var JENIS_KEGIATAN = $('#JENIS_KEGIATAN').combobox('getValue');
        PopupCenter("http://localhost:8080/PDAM/ci_sekpri_pdam/index.php/laporanAgenda/cetakLaporan/"+TGL_MULAI+"/"+TGL_SELESAI+"/"+JENIS_KEGIATAN,"LAPORAN AGENDA","800","400");
    }

    function PopupCenter(url, title, w, h) {
        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }
</script> 