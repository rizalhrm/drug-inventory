<?php
	session_start();
		//session_start(); 		//mulai session, krena kita akan menggunakan session pd file php ini
		include 'connect.php'; 		//hubungkan dengan config.php untuk berhubungan dengan database
		$username=$_POST['username']; 	//tangkap data yg di input dari form login input username
		$password=md5($_POST['password']); 	//tangkap data yg di input dari form login input password

		$query=mysql_query("select * from pengguna where username='$username' and password='$password'");	 //melakukan pengampilan data dari database untuk di cocokkan
		$xxx=mysql_num_rows($query);	 //melakukan pencocokan
		if($xxx){ 		// melakukan pemeriksaan kecocokan dengan percabangan.
			while ($row=mysql_fetch_assoc($query)) {
				$dbusername=$row['username'];
				$dbpassword=$row['password'];
				$dbid=$row['id_pengguna'];
				$dbnama=$row['nama_pengguna'];
			}

			if ($username == $dbusername && $password == $dbpassword){
				//session_start();
				$_SESSION['id'] = $dbid;
				$_SESSION['nama_pengguna'] = $dbnama;
				echo '<script languange="javascript">alert ("Login berhasil")</script>';
				echo '<script languange="javascript">window.location="../admin/"</script>';
			}
		}else{				//jika tidak tampilkan pesan gagal login
			echo '<script languange="javascript">alert ("Username atau Password Salah, Login Gagal")</script>';
			echo '<script languange="javascript">window.location="../index.php"</script>';
		}

?>
