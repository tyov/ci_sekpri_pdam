<div data-options="region:'center'" style="background:#eee;">
    <table id="dg_laporan_berkas"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/laporanBerkas/getLaporan"
            toolbar="#toolbar"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="TGL_TERIMA" width="200" halign="center" align="center">Tanggal Terima</th>
                <th field="Keuangan" width="150" halign="center" align="center">Keu.</th>
                <th field="Hubungan Pelanggan" width="150" halign="center" align="center">Hub.</th>
                <th field="Pengadaan" width="150" halign="center" align="center">Pengd.</th>
                <th field="Jaringan Pipa Pelanggan" width="150" halign="center" align="center">Jpp</th>
                <th field="Pusat Penelitian dan Pengemban" width="150" halign="center" align="center">Litb.</th>
                <th field="Perawatan" width="150" halign="center" align="center">Perwt.</th>
                <th field="Kehilangan Air" width="150" halign="center" align="center">Nrw</th>
                <th field="Perencanaan Teknik" width="150" halign="center" align="center">Prcn</th>
                <th field="Sistem Informasi Manajemen" width="150" halign="center" align="center">Sim</th>
                <th field="Pengawasan Pekerjaan" width="150" halign="center" align="center">Wasker</th>
                <th field="Produksi" width="150" halign="center" align="center">Prod</th>
                <th field="Satuan Pengawasan Internal" width="150" halign="center" align="center">Spi</th>
                <th field="Sumber Daya Manusia" width="150" halign="center" align="center">Sdm</th>
                <th field="Umum" width="150" halign="center" align="center">Umum</th>
            </tr>
        </thead>
    </table>    
    <div id="toolbar">
            Direksi : <input data-options="valueField:'ID_JENIS_EKSPEDISI',textField:'JENIS_EKSPEDISI',url:'<?php echo base_url(); ?>index.php/mJenisEkspedisi/getJenisEkspedisiDesc'" name="ID_DIREKSI" class="easyui-combobox" style="width: 200px">
            Bulan : <input name="BULAN" class="easyui-combobox" style="width: 200px">
            Tahun : <input name="TAHUN" class="easyui-textbox" style="width: 200px">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="">Cetak</a>
    </div>