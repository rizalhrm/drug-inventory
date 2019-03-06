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

		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=Laporan-Penerimaan-".date('F-Y', $date).".xls");
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
?>

			<h3 align="center"><b>LAPORAN PENERIMAAN<br/>
				PUSKESMAS TUGU KOTA DEPOK<br/>
				PERIODE <?php echo strtoupper(date('F Y', $date)); ?><br/></b></h3>
	<?php
		include "../../../include/connect.php";
		$rs = mysql_query("SELECT * FROM penerimaan
							JOIN pengguna ON penerimaan.id_pengguna = pengguna.id_pengguna
							JOIN supplier ON penerimaan.id_supplier = supplier.id_supplier
							WHERE MONTH(penerimaan.tanggal_diterima) = DATE_FORMAT(NOW(),'%m')
							ORDER BY penerimaan.tanggal_diterima ASC");
	?>
		<table border="1" width="55%" align="center">
			<thead>
				<th style="text-align:center;">NO.</th>
				<th style="text-align:center;">ID PENERIMAAN</th>
				<th style="text-align:center;">TANGGAL DITERIMA</th>
				<th style="text-align:center;">NAMA SUPPLIER</th>
				<th style="text-align:center;">DI ORDER OLEH</th>
			</thead>
			<tbody>
		<?php
		$no = 1;
		while ($list = mysql_fetch_assoc($rs)) {
		?>
			<tr>
				<form action="" method="POST">
				<td align="center"><?php echo $no;?></td>
				<td align="center">
					<?php echo $list['id_penerimaan']; ?>
				</td>
				<td align="center">
					<?php echo $list['tanggal_diterima']; ?>
				</td>
				<td align="center">
					<?php echo $list['nama_supplier']; ?>
				</td>
				<td align="center">
					<?php echo $list['nama_pengguna']; ?>
				</td>
				</form>
			</tr>
			<?php
				$no +=1;
				}
			?>
			</tbody>
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
