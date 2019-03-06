<?php
	$id_penerimaan = $_POST['id_penerimaan'];
	$tanggal = $_POST['tanggal'];
	$nama_pengguna = $_POST['nama_pengguna'];
	$nama_supplier = $_POST['nama_supplier'];
?>
	<div class="row">
	  <div class="col-md-2"></div>
	  <div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<table width="100%">
				<tr>
					<td align="left">
						<h3 class="panel-title">
							Detail Penerimaan : <b><?php echo $id_penerimaan;?></b>
						</h3>
					</td>
					<td align="right">
						<h3 class="panel-title">
							Dibuat Oleh : <b><?php echo $nama_pengguna;?></b>
						</h3>
					</td>
				</tr>
				<tr>
					<td align="left">
						<h3 class="panel-title">
							Dibuat Pada : <b><?php echo $tanggal;?></b>
						</h3>
					</td>
					<td align="right">
						<h3 class="panel-title">
							Ditujukan Untuk : <b><?php echo $nama_supplier;?></b>
						</h3>
					</td>
				</tr>
			</table>
		  </div>
		  <div class="panel-body">
			<table width="95%" align="center" class="table table-striped table-bordered table-hover">
				<thead>
					<th style="text-align:center;">NO.</th>
					<th style="text-align:center;">NAMA OBAT</th>
					<th style="text-align:center;">TGL EXPIRED</th>
				</thead>
				<tbody>
				<?php
					include "../include/connect.php";

					$no = 1;
					$rs = mysql_query("SELECT * FROM detail_penerimaan
						JOIN obat ON detail_penerimaan.id_obat = obat.id_obat
						WHERE id_penerimaan = '".$id_penerimaan."' ") or die("Query error!");
					while ($list = mysql_fetch_assoc($rs)) {
				?>
				<tr class="success">
					<form action="" method="POST">
					<td align="center"><?php echo $no;?></td>
					<td align="center">
						<?php echo $list['nama_obat']; ?>
					</td>
					<td align="center">
						<?php echo $list['tgl_expired']; ?>
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
			<div class="panel-footer">
        <div align="left">
          <form action="content/atribut/cetak_detailpenerimaan.php" method="POST">
            <input type="text" hidden name="data_bulan" value="<?php echo date('Y-F'); ?>" >
						<input type="text" hidden name="nama_pengguna" value="<?php echo $nama_pengguna;?>">
            <input type="text" hidden name="id_penerimaan" value="<?php echo $id_penerimaan;?>">
            <input type="text" hidden name="nama_supplier" value="<?php echo $nama_supplier;?>">
            <input type="text" hidden name="tanggal" value="<?php echo $tanggal;?>">
      			<button type="submit" name="cetak" class="btn btn-success btn-md">Cetak</button>
    			</form>
        </div>
        <div align="right" style="margin-top:-34px">
          <form action="" method="POST">
    				<input class="btn btn-default" type="submit" name="refresh" value="Kembali">
    			</form>
        </div>
		  </div>
		</div>
	  </div>
	  <div class="col-md-2"></div>
	</div>
