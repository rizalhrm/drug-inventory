<h2 style="margin-left:20px;">Obat Masuk</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="index.php?page=pemesanan_obat">Pemesanan</a></li>
	  <li role="presentation"><a href="index.php?page=penerimaan_obat">Penerimaan</a></li>
	</ul>
	<br/>

<?php
if(isset($_POST['tambah_pemesanan']))
{
	include "submit_pemesanan.php";
} else if (isset($_POST['detail'])){
	include "atribut/detail_pemesanan.php";
} else {
		include "atribut/tambah_pemesanan.php";

		include "../include/connect.php";

		$rs = mysql_query("SELECT * FROM pemesanan
							JOIN pengguna ON pemesanan.id_pengguna = pengguna.id_pengguna
							JOIN supplier ON pemesanan.id_supplier = supplier.id_supplier
							WHERE status_pemesanan = 'PENDING'
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
				<input class="btn btn-default btn-xs" type="submit" name="detail" value="View Detail">
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
