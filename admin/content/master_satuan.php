<h2 style="margin-left:20px;">Data Master</h2>

<div class="panel panel-default">
  <div class="panel-body">
	<ul class="nav nav-tabs">
	  <li role="presentation"><a href="index.php?page=master_obat">Obat</a></li>
	  <li role="presentation" class="active"><a href="index.php?page=master_satuan">Satuan</a></li>
	  <li role="presentation"><a href="index.php?page=master_supplier">Supplier</a></li>
	</ul>

	<br/>


<?php
if(isset($_POST['edit']))
{
	include "atribut/edit_satuan.php";
} else {
	include "atribut/cari_satuan.php";

		include "../include/connect.php";

		$rs = mysql_query("SELECT * FROM satuan
							ORDER BY nama_satuan ASC") or die("Query error!");
	?>
  <table align="center" class="table table-striped table-bordered table-hover data">
		<thead>
			<th style="text-align:center;">NO.</th>
			<th style="text-align:center;">ID SATUAN</th>
			<th style="text-align:center;">NAMA SATUAN</th>
			<th style="text-align:center;">ACTION</th>
		</thead>
    <tfoot>
      <th style="text-align:center;">NO.</th>
			<th style="text-align:center;">ID SATUAN</th>
			<th style="text-align:center;">NAMA SATUAN</th>
			<th style="text-align:center;">ACTION</th>
    </tfoot>
    <tbody>
		<?php
			$no = 1;
			while ($list = mysql_fetch_assoc($rs)) {
		?>
		<tr>
			<form action="" method="POST">
			<td align="center"><?php echo $no;?></td>
			<td align="center">
				<?php echo $list['id_satuan']; ?>
				<input hidden name='id_satuan' value="<?php echo $list['id_satuan']?>">
			</td>
			<td align="center">
				<?php echo $list['nama_satuan']; ?>
				<input hidden name='nama_satuan' value="<?php echo $list['nama_satuan']?>">
			</td>
			<td align="center">
				<button type='submit' name='edit' class='btn btn-default btn-sm'>Edit</button>
				<button type='submit' onclick="return confirm('Yakin akan menghapus data ini?');" name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
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

<?php
}
?>

<form class="form-horizontal" action="" method="POST">
  <div class="modal fade" id="ModalTambahsatuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Tambah Satuan</h4>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <div class="col-md-1"></div>
			  <div class="col-md-10">
				<form action="" method="POST" class="form-inline">
          <?php
          	date_default_timezone_set('Asia/Jakarta');
          	$generate_id = date('z').date('y').date('H').date('s');
          ?>
            <div class="form-group">
            <label for="id_karyawan">ID Satuan</label>
            <input type="text" class="form-control" disabled placeholder="<?php echo "$generate_id"; ?>">
            <input type="text" name="id_satuan" hidden value="<?php echo "$generate_id"; ?>">
            </div>
            <div class="form-group">
            <label for="nama_karyawan">Nama Satuan</label>
            <input type="text" class="form-control" name="nama_satuan" autofocus>
            </div>
				</form>
			  </div>
			  <div class="col-md-1"></div>
			</div>
		  </div>
		  <div class="modal-footer">
      <button type='submit' name='simpan_satuan' class='btn btn-primary'>Simpan</button>
			<button type="submit" name="batal" class="btn btn-default" data-dismiss="modal">Batal</button>
		  </div>
		</div>
	  </div>
  </div>
</form>


<?php
	if(isset($_POST['simpan_satuan']))
	{
		$id_satuan = $_POST['id_satuan'];
		$nama_satuan = strtoupper($_POST['nama_satuan']);

		$sql = mysql_query("INSERT INTO satuan (id_satuan, nama_satuan)
							VALUES ('".$id_satuan."', '".$nama_satuan."') ");

		if ($sql) {
			echo '<script languange="javascript">alert ("Data Sukses Di Tambahkan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_satuan"</script>';
		} else {
			echo '<script languange="javascript">alert ("Gagal Di Simpan")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_satuan"</script>';
		}
	}

	if(isset($_POST['hapus']))
	{
		$id_satuan = $_POST['id_satuan'];

		$hasil = mysql_query("delete from satuan where id_satuan='$id_satuan'");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Hapus")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_satuan"</script>';
		}
	}

	if(isset($_POST['ubah']))
	{
		$id_satuan = $_POST['id_satuan'];
		$nama_satuan = $_POST['nama_satuan'];

		$hasil = mysql_query("UPDATE satuan
								SET nama_satuan = '$nama_satuan'
								WHERE id_satuan='$id_satuan'");
		if($hasil){
			echo '<script languange="javascript">alert ("Data Berhasil Di Ubah")</script>';
			echo '<script languange="javascript">window.location="index.php?page=master_satuan"</script>';
		}
	}
?>
