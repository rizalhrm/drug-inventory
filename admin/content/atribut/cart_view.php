<table width="100%" class="viewer table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th style="text-align:center;" scope="col">ID OBAT</th>
      <th style="text-align:center;" scope="col">NAMA OBAT</th>
      <th style="text-align:center;" scope="col">SATUAN</th>
      <th style="text-align:center;" scope="col">KUANTITAS</th>
      <th style="text-align:center;" scope="col">AKSI</th>
    </tr>
  </thead>
  <tbody>
  <?php

  if (isset($_SESSION['itemproduk'])) {
		include '../include/connect.php';
        foreach ($_SESSION['itemproduk'] as $key => $val){
            $query = mysql_query ("SELECT id_obat, nama_obat, nama_satuan FROM obat
									JOIN satuan ON obat.id_satuan = satuan.id_satuan WHERE id_obat = '$key'");
			$rs = mysql_fetch_array ($query);
  ?>
  <tr>
    <td align="center"><?php echo $rs['id_obat']; ?></td>
    <td align="center"><?php echo $rs['nama_obat']; ?></td>
    <td align="center"><?php echo $rs['nama_satuan']; ?></td>
    <td align="center"><?php echo number_format($val); ?></td>
    <td align="center">
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=plus&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=tambah_pemesanan"><b>+</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=plussepuluh&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=tambah_pemesanan"><b>+10</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=min&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=tambah_pemesanan"><b>-</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=minsepuluh&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=tambah_pemesanan"><b>-10</b></a>
		<a class="btn btn-danger btn-sm" href="content/atribut/cart.php?act=del&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=tambah_pemesanan">Hapus</a>
	</td>
  </tr>
  <?php
            mysql_free_result($query);
        }
  }
  ?>
  <tr>
	<td colspan="5" style="">&nbsp</td>
  </tr>
  <!--
  <tr>
	<td align="right" colspan="3"><strong>TOTAL :
		<?php
			if (!isset($_SESSION['itemproduk'])) {
				$total = 0;
			} else {
				$total = 0;
				foreach ($_SESSION['itemproduk'] as $key2 => $val){
					$query = mysql_query ("select * from obat where id_obat = '$key2'");
					$rs = mysql_fetch_array ($query);
					$total += $val;
				}
			}
		?>
		</strong>
	</td>
	<td align="center"><?php echo $total; ?></td>
	<td></td>
  </tr>
  -->
  <tr>

	<form action="" method="POST" class="form-horizontal">
    <td colspan="2">
	  <div class="form-group">
		<label for="suppp" class="col-sm-4 control-label" style="margin-top:5px;">Pemesanan untuk Supplier : </label>
		<div class="col-sm-8">
			<select class="form-control" name="id_supplier">
				<option disabled>-- Pilih Satuan --</option>
		  <?php
				$hasil = mysql_query("SELECT * FROM supplier");
				$no=1;
				while($data=mysql_fetch_assoc($hasil)){
		  ?>
				<option value="<?php echo $data['id_supplier']?>"><?php echo $data['nama_supplier']?></option>
		  <?php
				}
		  ?>
			</select>
		</div>
	  </div>
	</td>
  <td align="center">
    <b>TOTAL :</b>
  </td>
  <td align="center">
    <?php
      if (!isset($_SESSION['itemproduk'])) {
        $total = 0;
      } else {
        $total = 0;
        foreach ($_SESSION['itemproduk'] as $key2 => $val){
          $query = mysql_query ("select * from obat where id_obat = '$key2'");
          $rs = mysql_fetch_array ($query);
          $total += $val;
        }
      }
  echo $total; ?>
  </td>
    <td align="center" colspan="2">
			<input class="btn btn-primary btn-sm" name="simpan" type="submit" value="Simpan">
			<a class="btn btn-danger btn-sm" href="content/atribut/cart.php?act=clear&amp;ref=../../index.php?page=tambah_pemesanan">Batal</a>
	</td>
	</form>
  </tr>
  </tbody>
</table>

<?php
	if(isset($_POST['simpan'])){
		include '../include/connect.php';
		$no = 1;
		date_default_timezone_set('Asia/Jakarta');
		$today = date('Y-m-d');
		$generate_id = date('z').date('y').date('H').date('s');
		$generate_id_fix = $generate_id;

		// MENCATAT KEDALAM TABEL PEMESANAN
		$query2 = mysql_query ("INSERT INTO pemesanan
								VALUES ('".$generate_id_fix."', '".$today."', ".$total.", '".$_SESSION['id']."', ".$_POST['id_supplier'].", 'PENDING') ");

		if ($query2 == 1)
		{
			echo '<script languange="javascript">alert ("Pemesanan Berhasil Di Tambahkan")</script>';

			foreach ($_SESSION['itemproduk'] as $key => $val){
				$sub_total = 0;
				$stok = 0;
				$query = mysql_query ("SELECT id_obat, nama_obat FROM obat WHERE id_obat = '$key'");
				$rs = mysql_fetch_array ($query);

				// MENCATAT KEDALAM TABEL DETAIL_PEMESANAN
				$query3 = mysql_query ("INSERT INTO detail_pemesanan
										VALUES ('".$generate_id_fix."','".$rs['id_obat']."', ".$val.") ");

			}

			// HAPUS LIST CART
			if (isset($_SESSION['itemproduk'])) {
				foreach ($_SESSION['itemproduk'] as $key => $val) {
					unset($_SESSION['itemproduk'][$key]);
				}
				unset($_SESSION['itemproduk']);
			}
		} else {
			echo '<script languange="javascript">alert ("Permintaan Gagal di Proses")</script>';
		}
		echo '<script languange="javascript">window.location="index.php?page=tambah_pemesanan"</script>';
	}
?>
