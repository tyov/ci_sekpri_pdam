<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
    <table id="dg_laporan_direksi"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/laporanDireksi/getLaporan"
            toolbar="#toolbar" fit="true"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="TGL_ACARA" width="200" halign="center" align="center">Tgl Acara</th>
                <th field="TGL_KEMBALI" width="150" halign="center" align="center">Tgl Kembali</th>
                <th field="KEGIATAN" width="150" halign="center" align="center">Kegiatan</th>
                <th field="PENGUNDANG" width="150" halign="center" align="center">Pengundang</th>
                <th field="KETERANGAN" width="150" halign="center" align="center">Keterangan</th>
                <th field="LOKASI" width="150" halign="center" align="center">Lokasi</th>
                <th field="ID_DIREKSI_DESC" width="150" halign="center" align="center">Direksi</th>
            
            </tr>
        </thead>
    </table>    
    <div id="toolbar">
            
            Tgl Acara : <input id="TGL_ACARA" type="text" class="easyui-datebox" required="required">
            Tgl Kembali : <input id="TGL_KEMBALI" type="text" class="easyui-datebox" required="required">
            Direksi : <input id="ID_DIREKSI" data-options="valueField:'ID_DIREKSI',textField:'DIREKSI',url:'<?php echo base_url(); ?>index.php/mDireksi/getMDireksiDesc'" name="ID_DIREKSI" class="easyui-combobox" style="width: 200px">
            <a class="easyui-linkbutton" data-options="iconCls:'icon-print'" onClick="cetakLaporan()">CETAK PDF</a>
    </div>
    </div>

<script>
    $('#ID_DIREKSI').combobox({
        onChange: function(rec){
            var TGL_ACARA = $('#TGL_ACARA').datebox('getValue');
            var TGL_KEMBALI = $('#TGL_KEMBALI').datebox('getValue');
            $('#dg_laporan_direksi').datagrid('load', {
                TGL_ACARA: TGL_ACARA,
                TGL_KEMBALI: TGL_KEMBALI,
                ID_DIREKSI:rec 
            });
        }
    });

    function cetakLaporan(){
        var TGL_ACARA = $('#TGL_ACARA').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        var TGL_KEMBALI = $('#TGL_KEMBALI').datebox('getValue').replace("/","~").replace("/","~").replace("/","~").replace("/","~");
        var ID_DIREKSI = $('#ID_DIREKSI').combobox('getValue');
        PopupCenter("http://localhost:8080/PDAM/ci_sekpri_pdam/index.php/laporanDireksi/cetakLaporan/"+TGL_ACARA+"/"+TGL_KEMBALI+"/"+ID_DIREKSI,"LAPORAN DIREKSI","800","400");
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