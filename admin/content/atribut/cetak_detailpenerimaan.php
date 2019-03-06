<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['id']))
{
?>
<head>
	<style type="text/css">
		#form-header {
            font-size: 12px;
			font-family: arial;
        }
		td {
            font-size: 12px;
			text-decoration: none;
			font-family: arial;
        }
	</style>
</head>
<?php
	if(isset($_POST['cetak']))
	{
		$data_bulan = $_POST['data_bulan'];
		$date = strtotime($data_bulan);
    $id_penerimaan = $_POST['id_penerimaan'];
  	$tanggal = $_POST['tanggal'];
  	$nama_pengguna = $_POST['nama_pengguna'];
  	$nama_supplier = $_POST['nama_supplier'];
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=Laporan-Detail-Penerimaan-$id_penerimaan-".date('F-Y', $date).".xls");
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
?>
    <table width="100%">
    <tr>
        <td align="left" colspan="3">
				<h3 align="center"><b>LAPORAN DETAIL PENERIMAAN<br/>
        NO. <?php echo $id_penerimaan;?><br/>
				PUSKESMAS TUGU KOTA DEPOK<br/>
				PERIODE <?php echo strtoupper(date('F Y', $date)); ?><br/></b></h3>
			</td>
      <td></td>
      <td></td>
		</tr>
    <tr>
      <td align="left" colspan="3">
          Tanggal : <b><?php echo $tanggal;?></b>
      </td>
      <td></td>
      <td></td>
    </tr>
	</table>
	<?php
		include "../../../include/connect.php";
    $no = 1;
    $rs = mysql_query("SELECT * FROM detail_penerimaan
      JOIN obat ON detail_penerimaan.id_obat = obat.id_obat
      WHERE id_penerimaan = '".$id_penerimaan."' ") or die("Query error!");
	?>
		<table border="1" width="95%" align="center" class="table">
			<thead>
        <th style="text-align:center;">NO.</th>
        <th style="text-align:center;">NAMA OBAT</th>
        <th style="text-align:center;">TGL EXPIRED</th>
			</thead>
      <tbody>
		<?php
				while ($list = mysql_fetch_assoc($rs)) {
		?>
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td align="center">
					<?php echo $list['nama_obat']; ?>
				</td>
        <td align="center">
          <?php echo $list['tgl_expired']; ?>
        </td>
			</tr>
			<?php
				$no +=1;
				}
			?>
    </tbody>
		</table>
    <table>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td align="center" colspan="3"><b><?php echo $nama_supplier;?></b>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <b><?php echo $nama_pengguna;?></b></td>
          <td>
          </td>
          <td>
          </td>
      </tr>
    </table>

<?php
	} else {
		echo '<script languange="javascript">alert ("Masukkan Data Dengan Benar<")</script>';
		//echo '<script languange="javascript">window.location="../index.php"</script>';
	}

} else{
	echo '<script languange="javascript">alert ("Silahkan login terlebih dahulu")</script>';
	//echo '<script languange="javascript">window.location="../index.php"</script>';
}
?>
