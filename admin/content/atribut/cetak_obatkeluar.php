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
		header("Content-Disposition: attachment;Filename=Laporan-Obat-Keluar-".date('F-Y', $date).".xls");
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
?>

				<h3 align="center"><b>LAPORAN OBAT KELUAR<br/>
				PUSKESMAS TUGU KOTA DEPOK<br/>
				PERIODE <?php echo strtoupper(date('F Y', $date)); ?><br/></b></h3>
	<?php
		include "../../../include/connect.php";
		$hasil = mysql_query("SELECT * FROM obatkeluar
							JOIN pengguna ON obatkeluar.id_pengguna = pengguna.id_pengguna
							WHERE MONTH(obatkeluar.tanggal_obatkeluar) = '".substr(date('Y-m', $date), -1, 2)."'
							ORDER BY obatkeluar.tanggal_obatkeluar ASC");
	?>
		<table border="1" width="55%" align="center" class="table table-striped table-bordered table-hover">
			<thead>
				<th style="text-align:center;">NO.</th>
				<th style="text-align:center;">ID OBAT KELUAR</th>
				<th style="text-align:center;">TANGGAL KELUAR</th>
				<th style="text-align:center;">DI TANGANI OLEH</th>
				<th style="text-align:center;">TOTAL JUMLAH</th>
			</thead>
			<tbody>
		<?php
				$no = 1;
				while ($list = mysql_fetch_assoc($hasil)) {
		?>
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td align="center">
					<?php echo $list['id_obatkeluar']; ?>
				</td>
				<td align="center">
					<?php echo $list['tanggal_obatkeluar']; ?>
				</td>
				<td align="center">
					<?php echo $list['nama_pengguna']; ?>
				</td>
				<td align="center">
					<?php echo $list['total_qty']; ?>
				</td>
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
