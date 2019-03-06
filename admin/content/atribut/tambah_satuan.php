<?php
	date_default_timezone_set('Asia/Jakarta');
	$generate_id = date('z').date('y').date('H').date('s');
?>
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title">Tambah Satuan</h3>
	  </div>
	  <div class="panel-body">

		<form action="" method="POST">
			  <div class="form-group">
				<label for="id_karyawan">ID Satuan</label>
				<input type="text" class="form-control" disabled placeholder="<?php echo "$generate_id"; ?>">
				<input type="text" name="id_satuan" hidden value="<?php echo "$generate_id"; ?>">
			  </div>
			  <div class="form-group">
				<label for="nama_karyawan">Nama Satuan</label>
				<input type="text" class="form-control" name="nama_satuan" autofocus>
			  </div>
		<div align="right">
			<button type='submit' name='simpan_satuan' class='btn btn-primary btn-sm'>Simpan</button>
			<a href="index.php?page=master_obat" role="button" class='btn btn-default btn-sm'>Batal</a>
		</div>
		</form>

	  </div>
	</div>
  </div>
  <div class="col-md-2"></div>
</div>
