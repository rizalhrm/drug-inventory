<h2 style="margin-left:20px;">Laporan</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation"><a href="index.php?page=laporan_pemesanan">Pemesanan</a></li>
	  <li role="presentation"><a href="index.php?page=laporan_penerimaan">Penerimaan</a></li>
	  <li role="presentation" class="active"><a href="index.php?page=laporan_obatkeluar">Obat Keluar</a></li>
	</ul>

	<br/>

  <?php
  if (isset($_POST['detail'])){
  	include "atribut/detail_obatkeluar.php";
  }
 else {
?>
	<div class="form-group">
	<form class="form-horizontal" action="content/atribut/cetak_obatkeluar.php" method="POST">
		<div class="col-sm-2 col-md-1 col-xs-3" style="margin-top:0px;" align="right">
			<input type="text" hidden name="data_bulan" value="<?php echo date('Y-F'); ?>" >
			<button type="submit" name="cetak" class="btn btn-success btn-md btn-block">Cetak</button>
		</div>
	  </div>
	</form>
  <br><br>
	<div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title" align="center">Laporan Obat Keluar Bulan <?php echo date('F Y'); ?></h3>
	  </div>
	  <div class="panel-body">

	<?php
		include "../include/connect.php";

		$rs = mysql_query("SELECT * FROM obatkeluar
							JOIN pengguna ON obatkeluar.id_pengguna = pengguna.id_pengguna
							WHERE MONTH(obatkeluar.tanggal_obatkeluar) = DATE_FORMAT(NOW(),'%m')
							ORDER BY obatkeluar.tanggal_obatkeluar ASC");

	?>

	<table width="95%" align="center" class="table table-striped table-bordered table-hover data">
		<thead>
			<th style="text-align:center;">NO.</th>
			<th style="text-align:center;">ID OBAT KELUAR</th>
			<th style="text-align:center;">TANGGAL KELUAR</th>
			<th style="text-align:center;">DI TANGANI OLEH</th>
			<th style="text-align:center;">TOTAL JUMLAH</th>
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
				<?php echo $list['id_obatkeluar']; ?>
				<input hidden name='id_obatkeluar' value="<?php echo $list['id_obatkeluar']?>">
			</td>
			<td align="center">
				<?php echo $list['tanggal_obatkeluar']; ?>
				<input hidden name='tanggal' value="<?php echo $list['tanggal_obatkeluar']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_pengguna']; ?>
				<input hidden name='id_pengguna' value="<?php echo $list['id_pengguna']?>">
				<input hidden name='nama_pengguna' value="<?php echo $list['nama_pengguna']?>">
			</td>
			<td align="center">
				<?php echo $list['total_qty']; ?>
				<input hidden name='total_qty' value="<?php echo $list['total_qty']?>">
			</td>
      <td align="center">
				<input class="btn btn-default btn-xs" type="submit" name="detail" value="View Detail">
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

  </div>
</div>
<?php
}
?>
