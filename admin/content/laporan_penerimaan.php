<h2 style="margin-left:20px;">Laporan</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation"><a href="index.php?page=laporan_pemesanan">Pemesanan</a></li>
	  <li role="presentation" class="active"><a href="index.php?page=laporan_penerimaan">Penerimaan</a></li>
	  <li role="presentation"><a href="index.php?page=laporan_obatkeluar">Obat Keluar</a></li>
	</ul>

	<br/>
<?php
 if (isset($_POST['detail'])){
	include "atribut/detail_penerimaan.php";
}
else {
?>
	  <div class="form-group">
      <form class="form-horizontal" action="content/atribut/cetak_penerimaan.php" method="POST">
    		<div class="col-sm-2 col-md-1 col-xs-3" style="margin-top:0px;" align="right">
    			<input type="text" hidden name="data_bulan" value="<?php echo date('Y-F'); ?>">
    			<button type="submit" name="cetak" class="btn btn-success btn-md btn-block">Cetak</button>
    		</div>
    	  </div>
    	</form>
      <br><br>
      <div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title" align="center">Laporan Penerimaan Bulan <?php echo date('F Y'); ?></h3>
	  </div>
	  <div class="panel-body">

	<?php
		include "../include/connect.php";
		$rs = mysql_query("SELECT * FROM penerimaan
							JOIN pengguna ON penerimaan.id_pengguna = pengguna.id_pengguna
							JOIN supplier ON penerimaan.id_supplier = supplier.id_supplier
							WHERE MONTH(penerimaan.tanggal_diterima) = DATE_FORMAT(NOW(),'%m')
							ORDER BY penerimaan.tanggal_diterima ASC");
	?>
	<table width="95%" align="center" class="table table-striped table-bordered table-hover data">
		<thead>
			<th style="text-align:center;">NO.</th>
			<th style="text-align:center;">ID PENERIMAAN</th>
			<th style="text-align:center;">TANGGAL DITERIMA</th>
			<th style="text-align:center;">NAMA SUPPLIER</th>
			<th style="text-align:center;">DI ORDER OLEH</th>
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
				<?php echo $list['id_penerimaan']; ?>
				<input hidden name='id_penerimaan' value="<?php echo $list['id_penerimaan']?>">
			</td>
			<td align="center">
				<?php echo $list['tanggal_diterima']; ?>
				<input hidden name='tanggal' value="<?php echo $list['tanggal_diterima']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_supplier']; ?>
				<input hidden name='nama_supplier' value="<?php echo $list['nama_supplier']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_pengguna']; ?>
				<input hidden name='id_pengguna' value="<?php echo $list['id_pengguna']?>">
				<input hidden name='nama_pengguna' value="<?php echo $list['nama_pengguna']?>">
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
