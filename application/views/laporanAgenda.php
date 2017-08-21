<div data-options="region:'center'" style="background:#eee;">
    <table id="dg_laporan_agenda"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/laporanAgenda/getLaporan"
            toolbar="#toolbar"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="TGL_PESAN" width="200" halign="center" align="center">Tgl Pesan</th>
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
            Jenis Kegiatan : <input data-options="valueField:'ID_JENIS_KEGIATAN',textField:'JENIS_KEGIATAN',url:'<?php echo base_url(); ?>index.php/mJenisKegiatan/getJenisKegiatanDesc'" name="ID_JENIS_KEGIATAN" class="easyui-combobox" style="width: 200px">
            Bulan : <input name="BULAN" class="easyui-combobox" style="width: 200px">
            Tahun : <input name="TAHUN" class="easyui-textbox" style="width: 200px">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="">Cetak</a>
    </div>