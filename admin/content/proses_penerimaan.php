<?php
		include "../include/connect.php";

		if(isset($_GET['id_pemesanan'])){
			$_SESSION['id_pemesanan'] = $_GET['id_pemesanan'];
			$_SESSION['tanggal'] = $_GET['tanggal'];
			$_SESSION['nama_supplier'] = $_GET['nama_supplier'];
			$_SESSION['id_supplier'] = $_GET['id_supplier'];
		} else {

		}

		$query_cek_penerimaan = mysql_query("SELECT COUNT(*) as total_cek_penerimaan FROM penerimaan
											WHERE id_penerimaan = '".$_SESSION['id_pemesanan'] ."' ");
		$value_cek_penerimaan = mysql_fetch_assoc($query_cek_penerimaan);
		if($value_cek_penerimaan['total_cek_penerimaan'] != 0){

		} else {
			$sql_penerimaan = mysql_query("INSERT INTO penerimaan (id_penerimaan, tanggal_diterima, id_pengguna, id_supplier)
							VALUES ('".$_SESSION['id_pemesanan']."', '', '', '".$_SESSION['id_supplier']."') ");
		}

		$rs = mysql_query("SELECT * FROM detail_pemesanan
							JOIN obat ON detail_pemesanan.id_obat = obat.id_obat
							WHERE id_pemesanan = '".$_SESSION['id_pemesanan']."' ") or die("Query error!");

		$query_data_1 = mysql_query("SELECT COUNT(*) AS total_data_1 FROM detail_pemesanan
							JOIN obat ON detail_pemesanan.id_obat = obat.id_obat
							WHERE id_pemesanan = '".$_SESSION['id_pemesanan']."' ") or die("Query error!");
		$total_data_1 = mysql_fetch_array($query_data_1);
		$total_data_1 = $total_data_1['total_data_1'];
?>
	<h4>ID Pemesanan : <?php echo $_SESSION['id_pemesanan'] ;?></h4>
	<h4>Tgl. Pemesanan : <?php echo $_SESSION['tanggal'];?></h4>
	<h4>Nama Supplier : <?php echo $_SESSION['nama_supplier'];?></h4>
	<table width="95%" align="center" class="table table-striped table-bordered table-hover">
		<thead>
			<th style="text-align:center;">NO.</th>
			<th style="text-align:center;">ID OBAT</th>
			<th style="text-align:center;">NAMA OBAT</th>
			<th style="text-align:center;">JUMLAH</th>
			<th style="text-align:center;">TGL EXPIRED</th>
		</thead>
		<tbody>
		<?php
			$no = 1;
			while ($list = mysql_fetch_assoc($rs)) {
		?>
		<tr class="success">
			<form action="" method="POST">
			<td align="center"><?php echo $no;?></td>
			<td align="center">
				<?php echo $list['id_obat']; ?>
				<input hidden name='id_obat' value="<?php echo $list['id_obat']?>">
				<input hidden name='stok' value="<?php echo $list['stok']?>">
				<input hidden name='id_pemesanan' value="<?php echo $_SESSION['id_pemesanan'];?>">
				<input hidden name='tanggal' value="<?php echo $_SESSION['tanggal'];?>">
			</td>
			<td align="center">
				<?php echo $list['nama_obat']; ?>
				<input hidden name='nama_obat' value="<?php echo $list['nama_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['sub_jumlah_pemesanan']; ?>
				<input hidden name='jumlah' value="<?php echo number_format($list['sub_jumlah_pemesanan'])?>">
			</td>
			<td align="center">
			<?php
				$query_cek = mysql_query("SELECT COUNT(*) as total FROM detail_penerimaan
							WHERE id_obat= '".$list['id_obat']."' AND id_penerimaan = '".$_SESSION['id_pemesanan'] ."' ");
				$value = mysql_fetch_assoc($query_cek);

				$query_cek_tgl_expired = mysql_query("SELECT tgl_expired FROM detail_penerimaan
							WHERE id_obat = '".$list['id_obat']."' AND id_penerimaan = '".$_SESSION['id_pemesanan'] ."' ");
				$value_tgl_expired = mysql_fetch_assoc($query_cek_tgl_expired);

				if($value['total'] != 0){
			?>
				<input name='tgl_expired' disabled id="popupDatepicker" type="text" value="<?php echo $value_tgl_expired['tgl_expired'];?>">
					<input name='tgl_expired' hidden id="popupDatepicker" type="text" value="<?php echo $value_tgl_expired['tgl_expired'];?>">
					<button type='submit' disabled="disabled" name='check' class='btn btn-primary'>Checklist</button>
			<?php
				} else {
			?>
				  <input name='tgl_expired' type="text" id="popupDatepicker">
					<button type='submit' name='check' class='btn btn-primary'>Checklist</button>
			<?php
				}
			?>
			</td>
			</form>
		</tr>
		<?php
			$no +=1;
			}
		?>
		</tbody>
	</table>
		<div align="right">
	<?php
		$query_data_2 = mysql_query("SELECT COUNT(*) AS total_data_2 FROM detail_penerimaan
							WHERE id_penerimaan = '".$_SESSION['id_pemesanan']."' ") or die("Query error count!");
		$total_data_2 = mysql_fetch_array($query_data_2);
		$total_data_2 = $total_data_2['total_data_2'];

		if ($total_data_1 > $total_data_2){
	?>
			<!-- <a class="btn btn-default" href="index.php?contain=penerimaan_obat">Kembali</a> -->
	<?php
		} else {
	?>
		<form action="" method="POST">
			<button type='submit' name='proses_bayar' class='btn btn-primary'>Proses</button>
			<!-- <a class="btn btn-default" href="index.php?contain=penerimaan_obat">Kembali</a> -->
		</form>
	<?php
		}
	?>
		</div>

<?php
	if(isset($_POST['check']))
	{
		$id_pemesanan = $_POST['id_pemesanan'];
		$id_obat = $_POST['id_obat'];
		$nama_obat = $_POST['nama_obat'];
		$tanggal = $_POST['tanggal'];
		$jumlah = $_POST['jumlah'];
		$tgl_expired = $_POST['tgl_expired'];

		$sql_obat = mysql_query("INSERT INTO detail_penerimaan (id_penerimaan, id_obat, tgl_expired)
							VALUES ('".$id_pemesanan."', '".$id_obat."', '".$tgl_expired."') ");

		// MENCARI STOK OBAT
		$query_stok_obat = mysql_query("SELECT stok FROM obat
							WHERE id_obat = '".$id_obat."' ") or die("Query error!");
		$stok_obat = mysql_fetch_array($query_stok_obat);
		$stok_obat = $stok_obat['stok'];


		// MENAMBAH STOK OBAT dengan PESANAN
		$total_stok_obat = $stok_obat + $jumlah;
		$ubah_stok = mysql_query("UPDATE obat
								SET stok = '".$total_stok_obat."'
								WHERE id_obat='".$id_obat."' ");


		// UPDATE NILAI tgl_expired
			$update_tgl_expired = mysql_query("UPDATE obat
											SET tgl_expired = '".$tgl_expired."'
											WHERE id_obat='".$id_obat."' ");

		if ($query_stok_obat) {
			//echo '<script languange="javascript">alert ("penerimaan Berhasil di Proses")</script>';
			echo '<script languange="javascript">window.location="index.php?page=proses_penerimaan"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal")</script>';
			echo '<script languange="javascript">window.location="index.php?page=proses_penerimaan"</script>';
		}
	}

	if(isset($_POST['proses_bayar']))
	{
		/*$rs = mysql_query("SELECT jumlah, harga FROM detail_penerimaan
							JOIN obat ON detail_penerimaan.id_obat = obat.id_obat
							JOIN detail_pemesanan ON obat.id_obat = detail_pemesanan.id_obat
							WHERE id_penerimaan = '".$_SESSION['id_pemesanan']."' AND id_pemesanan = '".$_SESSION['id_pemesanan']."' ") or die("Query error!");
		$total = 0;
		while ($list = mysql_fetch_assoc($rs)) {
			$sub_total += jumlah * harga;
		}
		*/

		$update_penerimaan = mysql_query("UPDATE penerimaan
								SET tanggal_diterima = '".date('Y-m-d')."', id_pengguna = '".$_SESSION['id']."'
								WHERE id_penerimaan='".$_SESSION['id_pemesanan']."' ");

		$update_pemesanan = mysql_query("UPDATE pemesanan
								SET status_pemesanan = 'DITERIMA'
								WHERE id_pemesanan='".$_SESSION['id_pemesanan']."' ");

		if($update_penerimaan){
			echo '<script languange="javascript">alert ("Data Obat Berhasil Di Proses")</script>';
			echo '<script languange="javascript">window.location="index.php?page=penerimaan_obat"</script>';
		}


	}
?>
