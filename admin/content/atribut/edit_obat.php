<?php
	$id_obat = $_POST['id_obat'];
	$id_satuan = $_POST['id_satuan'];
	$nama_satuan = $_POST['nama_satuan'];

	include "../include/connect.php";
	$rs = mysql_query("SELECT * FROM obat
							WHERE id_obat = '".$id_obat."' ") or die("Query error!");
	while ($list = mysql_fetch_assoc($rs)) {
?>
	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Edit Obat</h3>
		  </div>
		  <div class="panel-body">
			<form action="" method="POST">
				  <div class="form-group">
					<label for="id_karyawan">ID Obat</label>
					<input type="text" class="form-control" disabled placeholder="<?php echo $list['id_obat']; ?>">
					<input type="text" name="id_obat" hidden value="<?php echo $list['id_obat']; ?>">
				  </div>
				  <div class="form-group">
					<label for="nama_karyawan">Nama Obat</label>
					<input type="text" class="form-control" name="nama_obat" value="<?php echo $list['nama_obat']; ?>">
				  </div>
				  <div class="form-group">
					<label for="username">Satuan</label>
					<select class="form-control" name="id_satuan">
						<option value="<?php echo $id_satuan;?>"><?php echo $nama_satuan;?></option>
						<option disabled>-- Pilih Satuan --</option>
				  <?php
						$hasil = mysql_query("SELECT * FROM satuan");
						$no=1;
						while($data=mysql_fetch_assoc($hasil)){
				  ?>
						<option value="<?php echo $data['id_satuan']?>"><?php echo $data['nama_satuan']?></option>
				  <?php
						}
				  ?>
					</select>
				  </div>
					<div class="form-group">
					<label for="tgl_expired">Tanggal Expired</label>
					<input type="text" class="form-control" name="tgl_expired" value="<?php echo $list['tgl_expired']; ?>" id="popupDatepicker">
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
