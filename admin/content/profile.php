<?php
if(isset($_POST['ubah_password'])) {
?>
<h2 style="margin-left:20px;">Ubah Password</h2>

<div class="panel panel-default">
  <div class="panel-body">

	<form action="" method="POST">
	<ul class="nav nav-pills">
	  <li role="presentation">
		<button type='submit' name='profile' class='btn btn-default'>Profile</button>
	  </li>
	  <li role="presentation" class="active">
		<button type='submit' name='ubah_password' class='btn btn-primary'>Ubah Password</button>
	  </li>
	</ul>
	</form>

	<br/>

	<div class="row">
	  <div class="col-md-1"></div>
	  <div class="col-md-10">
		<form action="" method="POST">
			  <div class="form-group">
				<label for="id_obat">Password Lama</label>
				<input type="password" class="form-control" name="old_pass" value="" autofocus>
			  </div>
			  <div class="form-group">
				<label for="nama_obat">Password Baru</label>
				<input type="password" class="form-control" name="new_pass" value="">
			  </div>
			  <div class="form-group">
				<label for="jumlah">Konfirmasi Password</label>
				<input type="password" class="form-control" name="confirm_new_pass" value="">
			  </div>
			  <div class="form-group" align="right">
				<button type='submit' name='change_password' class='btn btn-primary btn-lg'>Ubah</button>
			  </div>
		</form>
	  </div>
	  <div class="col-md-1"></div>
	</div>
<?php
} else {
	// ============================================
?>
<h2 style="margin-left:20px;">Profile</h2>

<div class="panel panel-default">
  <div class="panel-body">

	<form action="" method="POST">
	<ul class="nav nav-pills">
	  <li role="presentation" class="active">
		<button type='submit' name='profile' class='btn btn-primary'>Profile</button>
	  </li>
	  <li role="presentation">
		<button type='submit' name='ubah_password' class='btn btn-default'>Ubah Password</button>
	  </li>
	</ul>
	</form>

	<br/>

	<div class="row">
	  <div class="col-md-1"></div>
	  <div class="col-md-10">
		<form action="" method="POST">
			<?php
				include '../include/connect.php';
				$hasil = mysql_query("SELECT * FROM pengguna WHERE id_pengguna = '".$_SESSION['id']."' ");
				$no=1;
				while($data=mysql_fetch_assoc($hasil)){
			?>
			  <div class="form-group">
				<label for="id_obat">ID Pengguna</label>
				<input type="text" class="form-control" disabled placeholder="<?php  echo $data['id_pengguna']; ?>">
				<input type="text" name="id_pengguna" hidden value="<?php  echo $data['id_pengguna']; ?>">
			  </div>
			  <div class="form-group">
				<label for="nama_obat">Nama Pengguna</label>
				<input type="text" class="form-control" name="nama_pengguna" value="<?php  echo $data['nama_pengguna']; ?>">
			  </div>
			  <div class="form-group">
				<label for="jumlah">Username</label>
				<input type="text" class="form-control" name="username" value="<?php  echo $data['username']; ?>">
        </div>
			  <div class="form-group" align="right">
				<button type='submit' name='edit' class='btn btn-primary btn-lg'>Ubah</button>
			  </div>
			  <?php
					}
			  ?>
		</form>
	  </div>
	  <div class="col-md-1"></div>
	</div>

  </div>
</div>

<?php
}
?>

<?php
	if(isset($_POST['edit']))
	{
		$id_pengguna = $_POST['id_pengguna'];
		$nama_pengguna = $_POST['nama_pengguna'];
		$username = $_POST['username'];

		$ubah_profile = mysql_query("UPDATE pengguna
								SET nama_pengguna = '$nama_pengguna', username = '$username'
								WHERE id_pengguna='$id_pengguna'");
		/*$ubah_password = mysql_query("UPDATE stok
								SET jumlah = '$jumlah'
								WHERE id_stok='".$_SESSION['id']."' ");
		*/
		if($ubah_profile){
			echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
			echo '<script languange="javascript">window.location="index.php?page=profile"</script>';
		}
	}

	if(isset($_POST['change_password']))
	{
		$old_pass = md5($_POST['old_pass']);
		$new_pass = md5($_POST['new_pass']);
		$confirm_new_pass = md5($_POST['confirm_new_pass']);

		$query_pass = mysql_query("SELECT password AS pass FROM pengguna
								WHERE id_pengguna = '".$_SESSION['id']."' ");
					$pass = mysql_fetch_array($query_pass);
					$pass = $pass['pass'];
		if ($old_pass == $pass){
			if ($new_pass == $confirm_new_pass){
				$ubah_password = mysql_query("UPDATE pengguna
									SET password = '$new_pass'
									WHERE id_pengguna='".$_SESSION['id']."' ");

				if($ubah_password){
					echo '<script languange="javascript">alert ("Password Telah di Ganti")</script>';
				}
			}
		} else {
			echo '<script languange="javascript">alert ("Password Tidak Sama")</script>';
		}

		/*
		if($ubah_profile){
			if($ubah_password){
				echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
				echo '<script languange="javascript">window.location="index.php?contain=profile"</script>';
			}
		}
		*/
	}
?>
