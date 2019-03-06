<h2 style="margin-left:20px;">Obat Masuk</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation"><a href="index.php?page=pemesanan_obat">Pemesanan</a></li>
	  <li role="presentation" class="active"><a href="index.php?page=penerimaan_obat">Penerimaan</a></li>
	</ul>
	<br/>


<?php
if(isset($_POST['tambah_pemesanan']))
{
	include "submit_pemesanan.php";
} else if (isset($_POST['proses'])){
	include "proses_penerimaan.php";
} else {
		include "atribut/cari_penerimaan.php";

		include "../include/connect.php";

		$rs = mysql_query("SELECT * FROM pemesanan
							JOIN pengguna ON pemesanan.id_pengguna = pengguna.id_pengguna
							JOIN supplier ON pemesanan.id_supplier = supplier.id_supplier
							WHERE pemesanan.status_pemesanan = 'PENDING'
							ORDER BY pemesanan.tanggal DESC") or die("Query error!");

	?>
	<table align="center" class="table table-striped table-bordered table-hover data">
		<thead>
			<th style="text-align:center;">NO.</td>
			<th style="text-align:center;">ID PEMESANAN</td>
			<th style="text-align:center;">TANGGAL PEMESANAAN</td>
			<th style="text-align:center;">NAMA SUPPLIER</td>
			<th style="text-align:center;">JUMLAH</td>
			<th style="text-align:center;">DI ORDER OLEH</td>
			<th style="text-align:center;">ACTION</td>
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
				<?php echo $list['id_pemesanan']; ?>
				<input hidden name='id_pemesanan' value="<?php echo $list['id_pemesanan']?>">
			</td>
			<td align="center">
				<?php echo $list['tanggal']; ?>
				<input hidden name='tanggal' value="<?php echo $list['tanggal']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_supplier']; ?>
				<input hidden name='nama_supplier' value="<?php echo $list['nama_supplier']?>">
				<input hidden name='id_supplier' value="<?php echo $list['id_supplier']?>">
			</td>
			<td align="center">
				<?php echo $list['jumlah']; ?>
				<input hidden name='jumlah' value="<?php echo $list['jumlah']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_pengguna']; ?>
				<input hidden name='id_pengguna' value="<?php echo $list['id_pengguna']?>">
				<input hidden name='nama_pengguna' value="<?php echo $list['nama_pengguna']?>">
			</td>
			<td align="center">
				<a class="btn btn-primary btn-xs" href="index.php?page=proses_penerimaan
																	&id_pemesanan=<?php echo $list['id_pemesanan'];?>
																	&tanggal=<?php echo $list['tanggal'];?>
																	&nama_supplier=<?php echo $list['nama_supplier'];?>
																	&id_supplier=<?php echo $list['id_supplier'];?>">Proses</a>
				<!--
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
				-->
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
}
?>
  </div>
</div>

<?php
	if(isset($_POST['terima']))
	{
		$id_obat = $_POST['id_obat'];
		$nama_obat = $_POST['nama_obat'];
		$jumlah = $_POST['jumlah'];
		$id_satuan = $_POST['id_satuan'];

		$sql_obat = mysql_query("INSERT INTO obat (id_obat, nama_obat, id_satuan, stok)
							VALUES ('".$id_obat."', '".$nama_obat."', '".$id_satuan."', '".$jumlah."') ");


		if ($sql_obat) {
				echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
				echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
			}
		else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
		}
	}
?>
