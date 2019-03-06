<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Apotek</title>

	<link href="../../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap.css" rel="stylesheet">
		<link href="../../../DataTables/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-color:white;">
	<!-- #################################################### -->
	<!-- #################################################### -->
	<!-- #################################################### -->
	<table width="100%">
	<tr>
		<td>
			<h3>Daftar Obat</h3>
		</td>
	</tr>
	</table>
	<hr/>

		<table width="100%" class="table table-striped table-bordered table-hover data">
      <thead>
        <tr>
  			<th align="center"><strong>ID Obat</strong></th>
  			<th align="center"><strong>Nama Obat</strong></th>
        <th align="center"><strong>Stok</strong></th>
        <th align="center"><strong>Tgl Expired</strong></th>
  			<th align="center"><strong>Aksi</strong></th>
  		  </tr>
      </thead>
		  <tbody>
		  <?php
			include '../../../include/connect.php';

			$query = mysql_query("SELECT * FROM obat WHERE stok > 0
								ORDER BY nama_obat ASC") or die("Query error!");

			while ($rs = mysql_fetch_array ($query)) {
		  ?>
		  <tr>
			<td><?php echo $rs['id_obat']; ?></td>
			<td>
			  <?php echo $rs['nama_obat']; ?>
			</td>
      <td>
			  <?php echo $rs['stok']; ?>
			</td>
      <td>
			  <?php echo $rs['tgl_expired']; ?>
			</td>
			<td align="center">
			  <a class="btn btn-info"
			  href="cart.php?act=add&amp;barang_id=<?php echo $rs['id_obat']; ?>&amp;ref=back_obatkeluar.php"
			  onclick="closeWin()" role="button">Add to List</a>
			</td>
		  </tr>
		  <?php
			}
		  ?>
      </tbody>
		</table>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../../../js/penting.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../../../js/jquery.js"></script>
	<script src="../../../js/bootstrap.min.js"></script>
	<script src="../../../DataTables/js/jquery.dataTables.min.js"></script>
	<script src="../../../DataTables/js/dataTables.bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
		$('.data').DataTable();
	});
	</script>
  </body>
</html>
