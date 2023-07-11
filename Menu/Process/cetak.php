<?php
 // Define relative path from this script to mPDF
 //Beri nama file PDF hasil. 
$nama_dokumen= 'Hasil Cetak';
//define('_MPDF_PATH','../../Scripts/mpdf/');
//include(_MPDF_PATH . "mpdf.php");

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
<div style="text-align: center;"><strong><br />LEMBAR DISPOSISI</strong></div>
<hr />
<table width="100%">
	<tr>
		<td width="12%" align="left"><strong>Surat Dari</strong></td>
		<td width="45%" align="left"><strong>: <?php echo $dataTampil['srt_dari'];?></strong></td>
		<td width="20%" align="left"><strong>Diterima Tanggal</strong></td>
		<td width="22%" align="left"><strong>: <?php echo $dataTampil['tgl_terima'];?></strong></td>		
	</tr>
</table>
<hr />
<table width="100%">
	<tr>
		<td width="12%" align="left"><strong>Tanggal</strong></td>
		<td width="45%" align="left"><strong>: <?php echo $dataTampil['srt_tgl'];?></strong></td>
		<td width="20%" align="left"><strong>No. Berkas</strong></td>
		<td width="22%" align="left"><strong>: <?php echo $dataTampil['no_urut'];?></strong></td>
	</tr>
</table>
<hr />
<table width="100%">
	<tr>
		<td width="12%" align="left"><strong>No. Surat</strong></td>
		<td width="45%" align="left"><strong>: <?php echo $dataTampil['srt_no'];?></strong></td>
		<td width="20%" align="left"><strong></strong></td>
		<td width="22%" align="left"><strong></strong></td>
	</tr>
</table>
<hr />
<table width="100%">
	<tr>
		<td width="12%" align="left"><strong>Perihal<strong></strong></td>
		<td width="45%" align="left"><strong>: <?php echo $dataTampil['srt_perihal'];?></strong></td>
		<td width="41%" align="left"></td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<hr />


<hr />
<div style="text-align: center;"><strong>ISI DISPOSISI</strong></div>
<div style="text-align: left;">&nbsp;<?php echo $dataTampil['isi_disposisi'];?></div>
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