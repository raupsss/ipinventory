<script type="text/javascript">
	$(function() {
		$("#dataTable tr:even").addClass("stripe1");
		$("#dataTable tr:odd").addClass("stripe2");
		$("#dataTable tr").hover(
			function() {
				$(this).toggleClass("highlight");
			},
			function() {
				$(this).toggleClass("highlight");
			}
		);
	});
</script>
<style type="text/css">
	.stripe1 {
		background-color: #FBEC88;
	}

	.stripe2 {
		background-color: #FFF;
	}

	.highlight {
		-moz-box-shadow: 1px 1px 2px #fff inset;
		-webkit-box-shadow: 1px 1px 2px #fff inset;
		box-shadow: 1px 1px 2px #fff inset;
		border: #aaa solid 1px;
		background-color: #fece2f;
	}
</style>
<table id="dataTable" width="100%">
	<tr>
		<th>No</th>
		<th>NIM</th>
		<th>Nama</th>
		<th>Tanggal Lahir</th>
		<th>Jurusan</th>
		<th>Alamat</th>

	</tr>
	<?php
	if ($data->num_rows() > 0) {
		$g_total = 0;
		$no = 1;
		foreach ($data->result_array() as $db) {
			$jurusan = $this->app_model->Nama_Jurusan($db['kode_jurusan']);
			// $tgl = $this->app_model->tgl_indo($db['ttl']);
	?>
			<tr>
				<td align="center" width="20"><?php echo $no; ?></td>
				<td align="center" width="100"><?php echo $db['nim']; ?></td>
				<td align="center" width="80"><?php echo $db['nama']; ?></td>
				<td align="center" width="80"><?php echo $db['ttl']; ?></td>
				<td align="center" width="80"><?php echo $jurusan; ?></td>
				<td align="center" width="80"><?php echo $db['alamat']; ?></td>
			</tr>
		<?php
			$no++;
			// $g_total = $g_total + $total;
		}
	} else {
		$g_total = 0;
		?>
		<tr>
			<td colspan="9" align="center">Tidak Ada Data</td>
		</tr>
	<?php
	}
	?>

</table>