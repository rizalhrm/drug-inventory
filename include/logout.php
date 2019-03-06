<?php
	session_start(); //perintah agar file ini membaca/mengenal/memulai session
	unset($_SESSION['id']);
	session_destroy();
	if(isset($_SESSION));//menghapus sessions
	{
	echo '<script languange="javascript">alert ("Anda berhasil Logout")</script>';
	echo '<script languange="javascript">window.location="../index.php"</script>';
	}
?>
