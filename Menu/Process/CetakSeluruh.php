<?php

$nama_dokumen= 'Hasil Surat';


include('../../Scripts/mPDF/mpdf.php');
$mpdf=new mPDF('utf-8'); // Create new mPDF Document //Beginning Buffer to save PHP variables and HTML tags 
ob_start();
?> 
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak masalah.--> 
<!--CONTOH Code START--> 
<html>
<?php
	include('../../Scripts/connect.php');
	$nu = mysql_real_escape_string($_GET['no_urutm']);
$sqlTampil="select * from s_masuk WHERE `no_urut`='".$nu."'";  
$qryTampil=mysql_query($sqlTampil);  
$dataTampil=mysql_fetch_array($qryTampil);  
?>
<head>
<style>
img {
    float: left;
    margin: -10 -55 -10px 85px;
}
<style type="text/css">
tr {
    padding-left: 30px;
}
</style>
</head>

<div style="text-align: center;"><img src="../../Images/logo31.jpg" alt="Logo" width="100" height="90">
<strong><font size="5" color="black">SMP NEGERI 31</font></strong><br />
<strong><font size="5" color="black">BANDAR LAMPUNG</font></strong><br />
<font size="2" color="black">Jl. Drs.Alimudin no.108 Campang Raya, Kecamatan Sukabumi Bandar Lampung</font><br />
<font size="2" color="black"></font><br />
<strong><font size="5" color="black"></font></strong>
<hr/>
</div>
<div class="table-responsive">
    <table class="table table-bordered" bordercolor="#000000" width="100%;" border="-1" style="font-size: 12px;">

        <thead>

            <tr bgcolor="#428bca" height="40" align="center" >
                <th width="20"><strong>No</strong></th>
                <th width="80"><strong>No. Urut</strong></th> 				             
                <th width="100"><strong>Tgl Terima</th>
                <th width="170"><strong>Isi Disposisi </th>
                <th width="110"><strong>No. Surat </th>
				<th width="100"><strong>Tgl </th>
				<th width="170"><strong>Surat Dari </th>
				<th width="190"><strong>Perihal </th>
            </tr>
        </thead>
        <tbody>
          <?php
          $nu=$_GET['no_urutm'];
          $no=0;
          $query_rs_datatables = "SELECT *from s_masuk";
          $rs_datatables = mysql_query($query_rs_datatables) or die(mysql_error());
          while ($row_rs_datatables = mysql_fetch_array($rs_datatables)) { 
              $no++; 
              //$a=$row_rs_datatables['kode_barang'];
              //$brgmasuk=$row_rs_datatables['jumlah'];
              //$stok_awal=$row_rs_datatables['stok_awal'];
              ?>
              <tr bgcolor="#999999" class="odd gradeX" >
                <td><strong><?php echo $no; ?></strong></td>
                <td><strong><?php echo $row_rs_datatables['no_urut']; ?></strong></td>				
                <td><strong><?php echo $row_rs_datatables['tgl_terima']; ?></strong></td>
                <td><strong><?php echo $row_rs_datatables['isi_disposisi']; ?></strong></td>
                <td><strong><?php echo $row_rs_datatables['srt_no']; ?></strong></td>
				<td><strong><?php echo $row_rs_datatables['srt_tgl']; ?></strong></td>
				<td><strong><?php echo $row_rs_datatables['srt_dari']; ?></strong></td>
				<td><strong><?php echo $row_rs_datatables['srt_perihal']; ?></strong></td>
                <td align="center">               
            </td>
			</tr>
			<?php } ?>
            
</tbody>
</table><br>
</div><!-- table-responsive -->
</html>

<!--CONTOH Code END--> 
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>