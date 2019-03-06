<?php
	$id_satuan = $_POST['id_satuan'];
	
	include "../include/connect.php";
	$rs = mysql_query("SELECT * FROM satuan WHERE id_satuan = '".$id_satuan."' ") or die("Query error!");
	while ($list = mysql_fetch_assoc($rs)) {
?>
	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Edit Satuan</h3>
		  </div>
		  <div class="panel-body">
			<form action="" method="POST">
				  <div class="form-group">
					<label for="id_karyawan">ID Satuan</label>
					<input type="text" class="form-control" disabled placeholder="<?php echo $list['id_satuan']; ?>">
					<input type="text" name="id_satuan" hidden value="<?php echo $list['id_satuan']; ?>">
				  </div>
				  <div class="form-group">
					<label for="nama_karyawan">Nama Satuan</label>
					<input type="text" class="form-control" name="nama_satuan" value="<?php echo $list['nama_satuan']; ?>">
				  </div>
			<div align="right">
				<button type='submit' name='ubah' class='btn btn-primary btn-sm'>Simpan</button>
				<button type='submit' name='batal' class='btn btn-default btn-sm'>Batal</button>
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