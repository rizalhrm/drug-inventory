<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['id']))
	    {echo "<script>alert('Maaf, Anda harus login terlebih dahulu'); location.href='../index.php';</script>";}

	else {
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../image/obat.ico">

    <title>Sistem Informasi Persediaan Obat</title>

		<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../DataTables/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="../css/jquery.datepick.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-color:white;">

	<?php
		switch ((isset($_GET['page']) ? $_GET['page'] : '')) {
			case 'obat_keluar':
				include "navbar/navbar_menu.php";
				include "content/submit_obatkeluar.php";
				break;
			case 'pemesanan_obat':
				include "navbar/navbar_menu.php";
				include "content/pemesanan_obat.php";
				break;
			case 'tambah_pemesanan':
				include "navbar/navbar_menu_pemesanan.php";
				include "content/submit_pemesanan.php";
				break;
			case 'penerimaan_obat':
				include "navbar/navbar_menu.php";
				include "content/penerimaan_obat.php";
				break;
			case 'proses_penerimaan':
				include "navbar/navbar_menu_penerimaan.php";
				include "content/proses_penerimaan.php";
				break;
			case 'master_obat':
				include "navbar/navbar_menu.php";
				include "content/master_obat.php";
				break;
			case 'master_satuan':
				include "navbar/navbar_menu.php";
				include "content/master_satuan.php";
				break;
			case 'master_supplier':
				include "navbar/navbar_menu.php";
				include "content/master_supplier.php";
				break;
			case 'master_pengguna':
				include "navbar/navbar_menu.php";
				include "content/master_pengguna.php";
				break;
			case 'laporan_obatkeluar':
				include "navbar/navbar_menu.php";
				include "content/laporan_obatkeluar.php";
				break;
			case 'laporan_penerimaan':
				include "navbar/navbar_menu.php";
				include "content/laporan_penerimaan.php";
				break;
			case 'laporan_pemesanan':
				include "navbar/navbar_menu.php";
				include "content/laporan_pemesanan.php";
				break;
			case 'profile':
				include "navbar/navbar_menu.php";
				include "content/profile.php";
				break;
			default:
				include "navbar/navbar_default.php";
				include "content/home.php";
				include "footer/footer.php";
				break;
		}
	?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../js/penting.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery-latest.min.js"></script>
	<script src="../js/jquery.plugin.js"></script>
	<script src="../js/jquery.datepick.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../DataTables/js/jquery.dataTables.min.js"></script>
	<script src="../DataTables/js/dataTables.bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
		$('.data').DataTable();
	});
	</script>
	<script>
	$(function() {
		$('#popupDatepicker').datepick({dateFormat: "yyyy-mm-dd"});
		$('#inlineDatepicker').datepick({onSelect: showDate});
	});

	function showDate(date) {
		alert('The date chosen is ' + date);
	}
	</script>
  </body>
</html>
<?php } ?>
