<?php
	$id_supplier = $_POST['id_supplier'];
	
	include "../include/connect.php";
	$rs = mysql_query("SELECT * FROM supplier WHERE id_supplier = '".$id_supplier."' ") or die("Query error!");
	while ($list = mysql_fetch_assoc($rs)) {
?>
	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Edit Supplier</h3>
		  </div>
		  <div class="panel-body">
			<form action="" method="POST">
				  <div class="form-group">
					<label for="id_karyawan">ID Supplier</label>
					<input type="text" class="form-control" disabled placeholder="<?php echo $list['id_supplier']; ?>">
					<input type="text" name="id_supplier" hidden value="<?php echo $list['id_supplier']; ?>">
				  </div>
				  <div class="form-group">
					<label for="nama_karyawan">Nama Supplier</label>
					<input type="text" class="form-control" name="nama_supplier" value="<?php echo $list['nama_supplier']; ?>">
				  </div>
				  <div class="form-group">
					<label for="username">Alamat</label>
					<textarea type="text" name="alamat" class="form-control" rows="3"><?php echo $list['alamat']; ?></textarea>
				  </div>
				  <div class="form-group">
					<label for="password">Nomor Telpon</label>
					<textarea type="text" name="nomor" class="form-control" rows="2"><?php echo $list['no_telp']; ?></textarea>
				  </div>
			<div align="right">
				<button type='submit' name='batal' class='btn btn-default btn-sm'>Batal</button>
				<button type='submit' name='ubah' class='btn btn-primary btn-sm'>Simpan</button>
			</div>
			</form>
		  </div>
		</div>
	  </div>
	  <div class="col-md-2"></div>
	</div>
	<?php
		}
	?>