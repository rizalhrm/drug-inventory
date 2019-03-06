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
		$id_obatkeluar = $_POST['id_obatkeluar'];
    $tanggal = $_POST['tanggal'];
    $nama_pengguna = $_POST['nama_pengguna'];
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=Laporan-Detail-Obat-Keluar-$id_obatkeluar-".date('F-Y', $date).".xls");
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
?>
				<table width="100%">
				<tr>
						<td align="left" colspan="4">
				<h3 align="center"><b>LAPORAN DETAIL OBAT KELUAR<br/>
				NO. <?php echo $id_obatkeluar;?><br/>
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
		$hasil = mysql_query("SELECT * FROM detail_obatkeluar
			JOIN obat ON detail_obatkeluar.id_obat = obat.id_obat
			JOIN obatkeluar ON detail_obatkeluar.id_obatkeluar = obatkeluar.id_obatkeluar
			WHERE detail_obatkeluar.id_obatkeluar = '".$id_obatkeluar."' ") or die("Query error!");
	?>
		<table border="1" width="55%" align="center" class="table table-striped table-bordered table-hover">
			<thead>
				<th style="text-align:center;">NO.</th>
				<th style="text-align:center;">NAMA OBAT</th>
				<th style="text-align:center;">JUMLAH</th>
				<th style="text-align:center;">ALASAN</th>
			</thead>
			<tbody>
		<?php
				$no = 1;
				while ($list = mysql_fetch_assoc($hasil)) {
		?>
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td align="center">
					<?php echo $list['nama_obat']; ?>
				</td>
				<td align="center">
					<?php echo $list['sub_jumlah_obatkeluar']; ?>
				</td>
				<td align="center">
					<?php echo $list['alasan']; ?>
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
				<td align="left" colspan="3">
	        Dibuat Oleh :<b> <?php echo $nama_pengguna;?></b></td>
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
