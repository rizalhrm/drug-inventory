<h2 style="margin-left:20px;">Data Master</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="index.php?page=master_obat">Obat</a></li>
	  <li role="presentation"><a href="index.php?page=master_satuan">Satuan</a></li>
	  <li role="presentation"><a href="index.php?page=master_supplier">Supplier</a></li>
	</ul>

	<br/>


<?php

if(isset($_POST['edit']))
{
	include "atribut/edit_obat.php";
} else if (isset($_POST['tambah_satuan'])){
	include "atribut/tambah_satuan.php";
}  else {

	include "atribut/tambah_obat.php";
	?>
	<table align="center" class="table table-striped table-bordered table-hover data">
    <thead>
			<th style="text-align:center;">NO.</th>
			<th style="text-align:center;">ID OBAT</th>
			<th style="text-align:center;">NAMA OBAT</th>
			<th style="text-align:center;">STOK SAAT INI</th>
			<th style="text-align:center;">SATUAN</th>
      <th style="text-align:center;">TGL EXPIRED</th>
			<th style="text-align:center;">ACTION</th>
		</thead>
    <tfoot>
      <th style="text-align:center;">NO.</th>
      <th style="text-align:center;">ID OBAT</th>
      <th style="text-align:center;">NAMA OBAT</th>
      <th style="text-align:center;">STOK SAAT INI</th>
      <th style="text-align:center;">SATUAN</th>
      <th style="text-align:center;">TGL EXPIRED</th>
      <th style="text-align:center;">ACTION</th>
    </tfoot>

    <tbody>
      <?php
      include "../include/connect.php";
      $rs = mysql_query("SELECT * FROM obat
                JOIN satuan ON obat.id_satuan = satuan.id_satuan") or die("Query error!");
        $no = 1;
        while ($list = mysql_fetch_assoc($rs)) {
      ?>
		<tr>

			<form action="" method="POST">
			<td align="center"><?php echo $no;?></td>
			<td align="center">
				<?php echo $list['id_obat']; ?>
				<input hidden name='id_obat' value="<?php echo $list['id_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_obat']; ?>
				<input hidden name='nama_obat' value="<?php echo $list['nama_obat']?>">
			</td>
			<td align="center">
				<?php echo $list['stok']; ?>
				<input hidden name='stok' value="<?php echo $list['stok']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_satuan']; ?>
				<input hidden name='id_satuan' value="<?php echo $list['id_satuan']?>">
				<input hidden name='nama_satuan' value="<?php echo $list['nama_satuan']?>">
			</td>
      <td align="center">
				<?php echo $list['tgl_expired']; ?>
				<input hidden name='tgl_expired' value="<?php echo $list['tgl_expired']?>">
			</td>
			<td align="center">
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' onclick="return confirm('Yakin akan menghapus data ini?');" name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
			</td>
			</form>

		</tr>
    <?php
      $no +=1;
    };
    ?>
    </tbody>

	</table>

  </div>
</div>

<?php
}
?>

<form class="form-horizontal" action="" method="POST">
  <div class="modal fade" id="ModalTambahobat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Tambah Obat</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <div class="col-md-1"></div>
			  <div class="col-md-10">
				<form action="" method="POST" class="form-inline">
					<?php
						date_default_timezone_set('Asia/Jakarta');
						date('z'); // number day in year
						date('y'); // year
						date('H'); // hour
						date('s'); // secon
						$generate_id = date('z').date('y').date('H').date('s');
					?>
					  <div class="form-group">
						<label for="id_obat">ID Obat</label>
						<input type="text" class="form-control" disabled placeholder="<?php  echo "$generate_id"; ?>">
						<input type="text" name="id_obat" hidden value="<?php  echo "$generate_id"; ?>">
					  </div>
					  <div class="form-group">
						<label for="nama_obat">Nama Obat</label>
						<input type="text" class="form-control" name="nama_obat">
					  </div>
					  <div class="form-group">
						<label for="username">Satuan</label>
						<button type="submit" name="tambah_satuan" class="btn btn-primary btn-xs">Tambah Satuan</button>
						<select class="form-control" name="id_satuan">
							<option disabled>-- Pilih Satuan --</option>
					  <?php
							include "../include/connect.php";
							$hasil = mysql_query("SELECT * FROM satuan");
							$no=1;
							while($data=mysql_fetch_assoc($hasil)){
					  ?>
							<option value="<?php echo $data['id_satuan']?>"><?php echo $data['nama_satuan']?></option>
					  <?php
							}
					  ?>
						</select>
					  </div>
				</form>
			  </div>
			  <div class="col-md-1"></div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
			<button type="submit" name="batal" class="btn btn-default" data-dismiss="modal">Batal</button>
		  </div>
		</div>
	  </div>
  </div>
</form>

<?php
	if(isset($_POST['tambah']))
	{
		$id_obat = $_POST['id_obat'];
		$nama_obat = strtoupper($_POST['nama_obat']);
		$id_satuan = $_POST['id_satuan'];

		$sql_obat = mysql_query("INSERT INTO obat (id_obat, nama_obat, id_satuan)
							VALUES ('".$id_obat."', '".$nama_obat."', '".$id_satuan."') ");

		if ($sql_obat) {
				echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
				echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
			}
		else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
		}
	}

	if(isset($_POST['simpan_satuan']))
	{
		$id_satuan = $_POST['id_satuan'];
		$nama_satuan = strtoupper($_POST['nama_satuan']);

		$sql = mysql_query("INSERT INTO satuan (id_satuan, nama_satuan)
							VALUES ('".$id_satuan."', '".$nama_satuan."') ");

		if ($sql) {
			echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
		}
	}

	if(isset($_POST['hapus']))
	{
		$id_obat = $_POST['id_obat'];

		$hasil_obat = mysql_query("delete from obat where id_obat='$id_obat'");
		if($hasil_obat){
				echo '<script languange="javascript">alert ("Data Berhasil Di Hapus")</script>';
				echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
			}

	}

	if(isset($_POST['ubah']))
	{
		$id_obat = $_POST['id_obat'];
		$nama_obat = strtoupper($_POST['nama_obat']);
		$id_satuan = $_POST['id_satuan'];
	  $tgl_expired = $_POST['tgl_expired'];


			$ubah_obat = mysql_query("UPDATE obat
								SET nama_obat = '$nama_obat', id_satuan = '$id_satuan', tgl_expired ='$tgl_expired'
								WHERE id_obat='$id_obat'");

				if($ubah_obat){
					echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
					echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
				}

		else {
			echo '<script languange="javascript">alert ("Data Tidak Berhasil Di Ubah")</script>';
      echo '<script languange="javascript">window.location="index.php?page=master_obat"</script>';
		}

}
?>
