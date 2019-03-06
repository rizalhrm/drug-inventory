<h2 style="margin-left:20px;">Submit Pemesanan Obat</h2>

<div class="panel panel-default">
  <div class="panel-body">

		<?php
			date_default_timezone_set('Asia/Jakarta');
			$generate_id = date('z').date('y').date('H').date('s');
			$today = date('Y-m-d');
		?>
		<p align="left" style="font-size:20px;">No. Pemesanan : <?php echo $generate_id;?></p>
		<p align="left" style="font-size:20px;">Tanggal : <?php echo $today;?></p>
		<p align="left" style="font-size:20px;">Daftar Obat : <button size="10" class="btn btn-success btn-md" onclick="Popup()">View List</button></p>
		<hr/>

		<script>
		function Popup() {
			window.open("content/atribut/popup.php", "_blank", "toolbar=no, resizable=no, top=200, left=400, width=550px, height=600px");
		}
		function Popup_Supplier() {
			window.open("content/atribut/popup_supplier.php", "_blank", "toolbar=no, scrollbars=yes, resizable=no, top=200, left=400, width=600, height=400");
		}
		</script>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr valign="top">
			<td width="100%" align="center"><h4>List Pemesanan
				<button class="btn btn-default btn-sm" onclick="window.location.reload();return false;" type="submit"> Refresh
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
				</h4><hr/>
			  <?php require("atribut/cart_view.php"); ?>
			</td>
		  </tr>
		</table>
		<p>&nbsp;</p>

  </div>
</div>
