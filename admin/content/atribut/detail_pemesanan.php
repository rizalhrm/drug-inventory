<?php
	$id_pemesanan = $_POST['id_pemesanan'];
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
							Detail Pemesanan : <b><?php echo $id_pemesanan;?></b>
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
					<th style="text-align:center;">JUMLAH</th>
				</thead>
				<tbody>
				<?php
					include "../include/connect.php";

					$no = 1;
					$rs = mysql_query("SELECT * FROM detail_pemesanan
						JOIN obat ON detail_pemesanan.id_obat = obat.id_obat
						WHERE id_pemesanan = '".$id_pemesanan."' ") or die("Query error!");
					while ($list = mysql_fetch_assoc($rs)) {
				?>
				<tr class="success">
					<form action="" method="POST">
					<td align="center"><?php echo $no;?></td>
					<td align="center">
						<?php echo $list['nama_obat']; ?>
					</td>
					<td align="center">
						<?php echo $list['sub_jumlah_pemesanan']; ?>
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
			<div class="panel-footer" align="right">
        <div align="right">
          <form action="" method="POST">
    				<input class="btn btn-default" type="submit" name="refresh" value="Kembali">
    			</form>
        </div>
		  </div>
		</div>
	  </div>
	  <div class="col-md-2"></div>
	</div>
