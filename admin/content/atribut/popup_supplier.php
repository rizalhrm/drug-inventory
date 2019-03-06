<table width="100%">
<tr>
	<td>
		<h2>List Supplier</h2>
	</td>
	<td align="right">
	<form action="" method="POST">
		<input type="text" size="10" name="nama_supplier" placeholder="Nama Supplier" />
		<input type="submit" name="cari" value="Cari" />
	</form>
	</td>
</tr>
</table>
<hr/>
<br/>
<?php
	if(isset($_POST['cari']))
	{
?>
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
	  <tr>
		<td><strong>ID Supplier</strong></td>
		<td><strong>Nama Supplier</strong></td>
		<td></td>
	  </tr>
	  <?php
		include '../../../include/connect.php';
		$query = mysql_query ("select * from supplier where nama_supplier LIKE '%".$_POST['nama_supplier']."%' ");
		while ($rs = mysql_fetch_array ($query)) {
	  ?>
	  <tr>
		<td><?php echo $rs['id_supplier']; ?></td>
		<td>
		  <?php echo $rs['nama_supplier']; ?>
		</td>
		<td>
		  <a href="cart.php?act=add&amp;barang_id=<?php echo $rs['id_supplier']; ?>&amp;ref=back.php" onclick="closeWin()">Add to List</a>
		</td>
	  </tr>
	  <?php
		}
	  ?>
	</table>
<?php
	} else {
?>
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center"><strong>ID Supplier</strong></td>
		<td align="center"><strong>Nama Supplier</strong></td>
		<td align="center"><strong>Alamat</strong></td>
		<td align="center"><strong>Nomor Telp</strong></td>
		<td></td>
	  </tr>
	  <?php
		include '../../../include/connect.php';
		$query = mysql_query ("select * from supplier");
		while ($rs = mysql_fetch_array ($query)) {
	  ?>
	  <tr>
		<td><?php echo $rs['id_supplier']; ?></td>
		<td><?php echo $rs['nama_supplier']; ?></td>
		<td><textarea rows="3"><?php echo $rs['alamat']; ?></textarea></td>
		<td><textarea rows="3"><?php echo $rs['no_telp']; ?></textarea></td>
		<td>
		  <a href="cart.php?act=add_supplier&amp;barang_id=<?php echo $rs['id_supplier'];?>&amp;barang_name=<?php echo $rs['nama_supplier'];?>;ref=back.php" onclick="closeWin()">Pilih</a>
		</td>
	  </tr>
	  <?php
		}
	  ?>
	</table>
  <?php
	}
  ?>