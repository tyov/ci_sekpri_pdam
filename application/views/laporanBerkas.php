<div class="easyui-layout" data-options="fit:true" style="background:#eee;">
    <div data-options="region:'center',border:false">
    <table id="dg_laporan_berkas"  class="easyui-datagrid" 
            url="<?php echo base_url();?>index.php/laporanBerkas/getLaporan/<?php echo date('Y')?><?php echo date('m')?>"
            toolbar="#toolbar" rownumbers="true" showFooter="true"
            border="false" striped="true" singleSelect="true" nowrap="false" pageSize="30" fitcolumns="true" fit="true" style="width:auto; height: 545px;" >
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
                <th field="Total" width="150" halign="center" align="center">Total</th>
            </tr>
        </thead>
    </table>    
    <div id="toolbar">
            Bulan : <select class="easyui-combobox" name="BULAN" id="BULAN" labelPosition="top" style="width:100px;">
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08" selected>Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            Tahun : <select data-options="" id="TAHUN" name="TAHUN" class="easyui-combobox" style="width: 75px">
                <?php
                    $year=date('Y');
                    for($i=0;$i<=10;$i++){
                        ?>
                             <option value="<?php echo $year-$i?>"><?php echo $year-$i?></option>
                        <?php
                    }
                ?>
                </select>
            Direksi : <input data-options="valueField:'ID_JENIS_EKSPEDISI',textField:'JENIS_EKSPEDISI',url:'<?php echo base_url(); ?>index.php/mJenisEkspedisi/getJenisEkspedisiDesc'" name="NAMA_DIREKSI" class="easyui-combobox" style="width:150px">
            <a class="easyui-linkbutton" data-options="iconCls:'icon-print'" onClick="printLaporan()" style="color: #fff">CETAK PDF</a>
</div>
    <script>

        $('#BULAN').combobox({
            onChange: function(rec){
                var tahun = $('#TAHUN').val();
                var url = '<?php echo base_url();?>index.php/laporanBerkas/getLaporan/'+tahun+rec;
                $.ajax({
                    url: url,
                    dataType:"json",
                    success: function(result){
                        $('#dg_laporan_berkas').datagrid('loadData',result);     
                        }
                    });
      
            }
        });

        $('#TAHUN').combobox({
            onChange: function(rec){
                var bulan = $('#BULAN').val();
                var url = '<?php echo base_url();?>index.php/laporanBerkas/getLaporan/'+rec+bulan;
                $.ajax({
                    url: url,
                    dataType:"json",
                    success: function(result){
                        $('#dg_laporan_berkas').datagrid('loadData',result);     
                        }
                    });
      
            }
        });
        
        function printLaporan() {
            var bulan = $('#BULAN').val();
            var tahun = $('#TAHUN').val();

            PopupCenter('<?php echo base_url("index.php/LaporanBerkas/cetakLaporan");?>/'+tahun+''+bulan, 'LAPORAN BERKAS',"800","400");
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
</div>