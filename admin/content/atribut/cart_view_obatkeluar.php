<form action="" method="POST" class="form-horizontal">
<table width="100%" class="viewer table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th style="text-align:center;" scope="col">KODE OBAT</th>
      <th style="text-align:center;" scope="col">NAMA OBAT</th>
      <th style="text-align:center;" scope="col">SATUAN</th>
      <th style="text-align:center;" scope="col">STOK</th>
      <th style="text-align:center;" scope="col">TGL EXPIRED</th>
      <th style="text-align:center;" scope="col">ALASAN</th>
      <th style="text-align:center;" scope="col">KUANTITAS</th>
      <th style="text-align:center;" scope="col">AKSI</th>
    </tr>
  </thead>
  <tbody>
  <?php

  if (isset($_SESSION['itemproduk'])) {
		include '../include/connect.php';
		$total_obatkeluar = 0;
        foreach ($_SESSION['itemproduk'] as $key => $val){
            $query = mysql_query ("SELECT id_obat, nama_obat, nama_satuan, stok, tgl_expired FROM obat
									JOIN satuan ON obat.id_satuan = satuan.id_satuan WHERE id_obat = '$key'");
			$rs = mysql_fetch_array ($query);
  ?>
  <tr>
    <td align="center"><?php echo $rs['id_obat']; ?></td>
    <td align="center"><?php echo $rs['nama_obat']; ?></td>
    <td align="center"><?php echo $rs['nama_satuan']; ?></td>
    <td align="center"><input type="hidden" name="stok" value="<?php echo $rs['stok']; ?>"><?php echo $rs['stok']; ?></td>
    <td align="center"><?php echo $rs['tgl_expired']; ?></td>
    <td align="center" width="50px">
      <select name="alasan[<?php echo $key; ?>]" style="border: 1px solid rgba(0, 0, 0, 0.5);
                                                        border-radius: 5px;
                                                        padding: 3px;">
      <option disabled>-- Pilih Alasan Pengurangan --</option>
      <option value="PASIEN">PASIEN</option>
      <option value="KADALUARSA">KADALUARSA</option>
      <option value="RUSAK">RUSAK</option>
      <option value="LAIN-LAIN">LAIN-LAIN</option>
    </select></td>
    <td align="center"><?php echo number_format($val); ?></td>
    <td align="center">
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=plus&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=obat_keluar"><b>+</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=plussepuluh&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=obat_keluar"><b>+10</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=min&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=obat_keluar"><b>-</b></a>
		<a class="btn btn-default btn-sm" style="font-size:px;" href="content/atribut/cart.php?act=minsepuluh&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=obat_keluar"><b>-10</b></a>
		<a class="btn btn-danger btn-sm" href="content/atribut/cart.php?act=del&amp;barang_id=<?php echo $key; ?>&amp;ref=../../index.php?page=obat_keluar">Hapus</a>
	</td>
  </tr>
<?php 	$total_obatkeluar+= $val;
            mysql_free_result($query);
          }}
   ?>
  <tr>
	<td colspan="8" style="">&nbsp;</td>
  </tr>
  <tr>

    <td colspan="5">&nbsp;</td>
	   <td align="center">
		     <b>TOTAL : </b>
	   </td>
  	<td align="center">
  		<?php
  			if (!isset($_SESSION['itemproduk'])) {
  				$total_obatkeluar = 0;
  				echo number_format($total_obatkeluar);
  			} else {
  				echo number_format($total_obatkeluar);
  			}
  		?>
    </td>
    <td align="center">
			<input class="btn btn-primary btn-sm" name="simpan" type="submit" value="Simpan">
			<a class="btn btn-danger btn-sm" href="content/atribut/cart.php?act=clear&amp;ref=../../index.php?page=obat_keluar">Batal</a>
	</td>

  </tr>
  </tbody>
</table>
</form>

<?php
	if(isset($_POST['simpan'])){
		include '../include/connect.php';
    if ($val>$_POST['stok']) {
      echo "<label style=color:red;><b>Gagal Disimpan Karena Melebihi Stok</b></label>";
    }
    else {
      $no = 1;
      $alasan = $_POST['alasan'];
  		date_default_timezone_set('Asia/Jakarta');
  		$today = date('Y-m-d');
  		$generate_id = date('z').date('y').date('H').date('s');
  		$generate_id_fix = $generate_id;

  	
  		$query2 = mysql_query ("INSERT INTO obatkeluar
  								VALUES ('".$generate_id_fix."', '".$today."', '".$_SESSION['id']."','".$total_obatkeluar."') ");

  		if ($query2 == 1)
  		{
  			echo '<script languange="javascript">alert ("Obat Keluar Berhasil Di Inputkan")</script>';

  			foreach ($_SESSION['itemproduk'] as $key => $val){
  				$sub_total = 0;
  				$stok = 0;
  				$query = mysql_query ("SELECT id_obat, nama_obat FROM obat WHERE id_obat = '$key'");
  				$rs = mysql_fetch_array ($query);

  				// MENCATAT KEDALAM TABEL DETAIL_obatkeluar
  				$query3 = mysql_query ("INSERT INTO detail_obatkeluar
  										VALUES ('".$generate_id_fix."','".$rs['id_obat']."', ".$val.", '".$alasan[$key]."') ");

  				// MENGHITUNG TOTAL obatkeluar
  				$query_stok_obat = mysql_query("SELECT SUM(detail_obatkeluar.sub_jumlah_obatkeluar) AS sub_jumlah FROM obatkeluar
  													JOIN detail_obatkeluar ON obatkeluar.id_obatkeluar = detail_obatkeluar.id_obatkeluar
  												WHERE id_obat = '".$rs['id_obat']."' AND MONTH(tanggal_obatkeluar) = MONTH(CURDATE()) AND YEAR(tanggal_obatkeluar) = YEAR(CURDATE())") or die("Query error!");

  				$sub_jumlah = mysql_fetch_array($query_stok_obat);
  				$sub_jumlah = $sub_jumlah['sub_jumlah'];

  				// MENGURANGI TOTAL obatkeluar dengan STOK
  				$query_used = mysql_query("SELECT stok FROM obat
  								WHERE id_obat = '".$rs['id_obat']."' ") or die("Query used eror!");
  					$total_jumlah = mysql_fetch_array($query_used);
  					$total_jumlah = $total_jumlah['stok'];

  				$current_jumlah = $total_jumlah - $val;

  				// UPDATE DATA pada Jumlah - STOK
  				$update_leadtime = mysql_query("UPDATE obat
  								SET stok = '".$current_jumlah."'
  								WHERE id_obat='".$rs['id_obat']."' ");
  			}





  			// HAPUS LIST CART
  			if (isset($_SESSION['itemproduk'])) {
  				foreach ($_SESSION['itemproduk'] as $key => $val) {
  					unset($_SESSION['itemproduk'][$key]);
  				}
  				unset($_SESSION['itemproduk']);
  			}

  		// PERHITUNGAN ROP

  		// END ####### PERHITUNGAN ROP

  		} else {
  			echo '<script languange="javascript">alert ("Obat Keluar Gagal di Proses")</script>';
  		}
  		echo '<script languange="javascript">window.location="index.php?page=obat_keluar"</script>';
  	}
    }
?>
