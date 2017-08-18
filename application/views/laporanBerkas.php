<div data-options="region:'center'" style="background:#eee;">
    <table id="dg_laporan_berkas"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/laporanBerkas/getLaporan"
            toolbar="#toolbar"
            rownumbers="true" pagination="true" border="false" striped="true" singleSelect="true" nowrap="false" pageSize="10" fitcolumns="true" style="width:auto; height: 545px;" 
            >
        <thead>
            <tr>
                <th field="TGL_TERIMA" width="150" halign="center" align="center">Tanggal Terima</th>
            </tr>
        </thead>
    </table>    
    <div id="toolbar">
            Direksi : <input data-options="valueField:'ID_JENIS_EKSPEDISI',textField:'JENIS_EKSPEDISI',url:'<?php echo base_url(); ?>index.php/mJenisEkspedisi/getJenisEkspedisiDesc'" name="ID_DIREKSI" class="easyui-combobox" style="width: 200px">
            Bulan : <input name="BULAN" class="easyui-combobox" style="width: 200px">
            Tahun : <input name="TAHUN" class="easyui-textbox" style="width: 200px">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="">Cetak</a>
    </div>