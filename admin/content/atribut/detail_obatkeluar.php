<?php
	$id_obatkeluar = $_POST['id_obatkeluar'];
	$tanggal = $_POST['tanggal'];
	$nama_pengguna = $_POST['nama_pengguna'];
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
							Detail Obat Keluar : <b><?php echo $id_obatkeluar;?></b>
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
				</tr>
			</table>
		  </div>
		  <div class="panel-body">
			<table width="95%" align="center" class="table table-striped table-bordered table-hover">
				<thead>
					<th style="text-align:center;">NO.</th>
					<th style="text-align:center;">NAMA OBAT</th>
					<th style="text-align:center;">JUMLAH</th>
					<th style="text-align:center;">ALASAN</th>
				</thead>
        <tbody>
				<?php
					include "../include/connect.php";

					$no = 1;
					$rs = mysql_query("SELECT * FROM detail_obatkeluar
						JOIN obat ON detail_obatkeluar.id_obat = obat.id_obat
						JOIN obatkeluar ON detail_obatkeluar.id_obatkeluar = obatkeluar.id_obatkeluar
						WHERE detail_obatkeluar.id_obatkeluar = '".$id_obatkeluar."' ") or die("Query error!");
					while ($list = mysql_fetch_assoc($rs)) {
				?>
				<tr class="success">
					<td align="center"><?php echo $no;?></td>
					<td align="center">
						<?php echo $list['nama_obat']; ?>
					</td>
					<td align="center">
						<?php echo number_format($list['sub_jumlah_obatkeluar']); ?>
					</td>
					<td align="center">
						<?php echo $list['alasan']; ?>
					</td>
				</tr>
				<?php
					$no +=1;
					}
				?>
      </tbody>
			</table>
		  </div>
      <div class="panel-footer">
        <div align="right">
          <form action="" method="POST">
    				<input class="btn btn-default" type="submit" name="refresh" value="Kembali">
    			</form>
        </div>
        <div align="left" style="margin-top:-34px">
          <form action="content/atribut/cetak_detailobatkeluar.php" method="POST">
            <input type="text" hidden name="data_bulan" value="<?php echo date('Y-F'); ?>" >
						<input type="text" hidden name="nama_pengguna" value="<?php echo $nama_pengguna;?>">
						<input type="text" hidden name="id_obatkeluar" value="<?php echo $id_obatkeluar;?>">
						<input type="text" hidden name="tanggal" value="<?php echo $tanggal;?>">
      			<button type="submit" name="cetak" class="btn btn-success btn-md">Cetak</button>
    			</form>
        </div>
		  </div>
		</div>
	  </div>
	  <div class="col-md-2"></div>
	</div>
