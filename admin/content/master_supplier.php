<h2 style="margin-left:20px;">Data Master</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation"><a href="index.php?page=master_obat">Obat</a></li>
	  <li role="presentation"><a href="index.php?page=master_satuan">Satuan</a></li>
	  <li role="presentation" class="active"><a href="index.php?page=master_supplier">Supplier</a></li>
	</ul>

	<br/>


<?php
if(isset($_POST['edit']))
{
	include "atribut/edit_supplier.php";

}
else {
	include "atribut/tambah_supplier.php";
?>

	<?php
		include "../include/connect.php";

		$rs = mysql_query("SELECT * FROM supplier
							ORDER BY nama_supplier ASC") or die("Query error!");

	?>
	<table align="center" class="table table-striped table-bordered table-hover data">
		<thead>
			<th style="text-align:center;">NO.</th>
			<th style="text-align:center;">ID SUPPLIER</th>
			<th style="text-align:center;">NAMA SUPPLIER</th>
			<th style="text-align:center;">ALAMAT</th>
			<th style="text-align:center;">NOMOR TELEPON</th>
			<th style="text-align:center;">ACTION</th>
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
				<?php echo $list['id_supplier']; ?>
				<input hidden name='id_supplier' value="<?php echo $list['id_supplier']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_supplier']; ?>
				<input hidden name='nama_supplier' value="<?php echo $list['nama_supplier']?>">
			</td>
			<td>
				<textarea type="text" class="form-control" rows="3"><?php echo $list['alamat']; ?></textarea>
				<textarea type="text" name="alamat" hidden rows="3"><?php echo $list['alamat']; ?></textarea>
			</td>
			<td>
				<textarea type="text" class="form-control" rows="2"><?php echo $list['no_telp']; ?></textarea>
				<textarea type="text" name="nomor" hidden rows="2"><?php echo $list['no_telp']; ?></textarea>
			</td>
			<td align="center">
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' onclick="return confirm('Yakin akan menghapus data ini?');" name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
			</td>
			</form>
		</tr>
		<?php
			$no +=1;
			}
		?>
  </tbody>
	</table>

  </div>
</div>

<?php
}
?>

<!-- ###################   Modal   ###################### -->
<form class="form-horizontal" action="" method="POST">
	<div class="modal fade" id="ModalTambahSupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Tambah Supplier</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <div class="col-md-1"></div>
			  <div class="col-md-10">
				<form action="" method="POST">
					<?php
						date_default_timezone_set('Asia/Jakarta');
						date('z'); // number day in year
						date('y'); // year
						date('H'); // hour
						date('s'); // secon
						$generate_id = date('z').date('y').date('H').date('s');
					?>
					  <div class="form-group">
						<label for="id_karyawan">ID Supplier</label>
						<input type="text" class="form-control" disabled placeholder="<?php  echo "$generate_id"; ?>">
						<input type="text" name="id_supplier" hidden value="<?php  echo "$generate_id"; ?>">
					  </div>
					  <div class="form-group">
						<label for="nama_karyawan">Nama Supplier</label>
						<input type="text" class="form-control" name="nama_supplier">
					  </div>
					  <div class="form-group">
						<label for="username">Alamat</label>
						<textarea type="text" name="alamat" class="form-control" rows="3"></textarea>
					  </div>
					  <div class="form-group">
						<label for="password">Nomor Telepon</label>
						<textarea type="text" name="nomor" class="form-control" rows="2"></textarea>
					  </div>
				</form>
			  </div>
			  <div class="col-md-1"></div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		  </div>
		</div>
	  </div>
	</div>
</form>

<?php
	if(isset($_POST['tambah']))
	{
		$id_supplier = $_POST['id_supplier'];
		$nama_supplier = strtoupper($_POST['nama_supplier']);
		$alamat = $_POST['alamat'];
		$nomor = $_POST['nomor'];

		$sql = mysql_query("INSERT INTO supplier (id_supplier, nama_supplier, alamat, no_telp)
							VALUES ('".$id_supplier."', '".$nama_supplier."', '".$alamat."', '".$nomor."') ");

		if ($sql) {
			echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_supplier"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_supplier"</script>';
		}
	}

	if(isset($_POST['hapus']))
	{
		$id_supplier = $_POST['id_supplier'];

		$hasil = mysql_query("delete from supplier where id_supplier='$id_supplier'");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Hapus")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_supplier"</script>';
		}
	}

	if(isset($_POST['ubah']))
	{
		$id_supplier = $_POST['id_supplier'];
		$nama_supplier = strtoupper($_POST['nama_supplier']);
		$alamat = $_POST['alamat'];
		$nomor = $_POST['nomor'];

		$hasil = mysql_query("UPDATE supplier
								SET nama_supplier = '$nama_supplier', alamat = '$alamat', no_telp = '$nomor'
								WHERE id_supplier='$id_supplier'");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_supplier"</script>';
		}
	}
?>
