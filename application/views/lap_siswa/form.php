<script type="text/javascript">
	$(document).ready(function() {
		$(':input:not([type="submit"])').each(function() {
			$(this).focus(function() {
				$(this).addClass('hilite');
			}).blur(function() {
				$(this).removeClass('hilite');
			});
		});
		$("#nim").focus();
		$("#kode_barang").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
		});

		//fungsi tanggal
		$("#tgl1").datepicker({
			dateFormat: "dd-mm-yy"
		});
		$("#tgl2").datepicker({
			dateFormat: "dd-mm-yy"
		});

		//end fungsi tanggal
		$("#cari").click(function() {
			var jurusan = $("#jurusan").val();
			var nim = $("#nim").val();
			var tgl1 = $("#tgl1").val();
			var tgl2 = $("#tgl2").val();

			// var string = "gudang=" + gudang + "&tgl1=" + tgl1 + "&tgl2=" + tgl2 + "&kode_barang=" + kode_barang;
			var string = "&jurusan=" + jurusan + "&nim=" + nim + "&jurusan=" + jurusan;

			/*
			if (tgl1.length == 0) {
				alert("Maaf, Anda belum memilih Tanggal Awal");
				$("#tgl1").focus();
				return false();
			}
			if (tgl2.length == 0) {
				alert("Maaf, Anda belum memilih Tanggal Akhir");
				$("#tgl2").focus();
				return false();
			}
			*/

			// if (nim.length == 0) {
			// 	alert("Maaf, NIM Wajib di isi");
			// 	$("#nim").focus();
			// 	return false();
			// }


			$("#tampil_data").html('');
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/lap_siswa/lihat",
				data: string,
				cache: false,
				success: function(data) {
					var win = $.messager.progress({
						title: 'Please waiting',
						msg: 'Loading data...'
					});
					setTimeout(function() {
						$.messager.progress('close');
						$("#tampil_data").html(data);
					}, 2800)
				}
			});
			return false();
		});

		$("#cetak").click(function() {
			var jurusan = $("#jurusan").val();
			var nim = $("#nim").val();
			// var tgl1 = $("#tgl1").val();
			// var tgl2 = $("#tgl2").val();

			var string = jurusan + "/" + nim;

			window.open('<?php echo site_url(); ?>/lap_siswa/cetak/' + string);
			return false();
		});
		$("#cetak_excel").click(function() {
			var jurusan = $("#jurusan").val();
			var nim = $("#nim").val();
			// var tgl1 = $("#tgl1").val();
			// var tgl2 = $("#tgl2").val();

			var string = jurusan + "/" + nim;

			window.open('<?php echo site_url(); ?>/lap_siswa/cetak_excel/' + string);
			return false();
		});

	});
</script>
<fieldset class="atas">
	<table width="100%">
		<tr>
			<td width="150">NIM</td>
			<td width="5"></td>
			<td> <input type="text" name="nim" id="nim" size="12" /></td>
		</tr>

		<!-- <tr>
			<td width="150">Tanggal Lahir</td>
			<td width="5"></td>
			<td><input type="text" name="tgl1" id="tgl1" size="12" maxlength="12" />
				s.d <input type="text" name="tgl2" id="tgl2" size="12" maxlength="12" /></td>
		</tr> -->
		<tr>
			<td>Jurusan</td>
			<td>:</td>
			<td><select name="jurusan" id="jurusan">
					<?php
					if (empty($jurusan)) {
					?>
						<option value="semua">--Semua Jurusan--</option>
						<?php
					}
					foreach ($tb_jurusan->result() as $t) {
						if ($jurusan == $t->kode_jurusan) {
						?>
							<option value="<?php echo $t->kode_jurusan; ?>" selected="selected"><?php echo $t->kode_jurusan; ?> - <?php echo $t->nama_jurusan; ?></option>
						<?php } else { ?>
							<option value="<?php echo $t->kode_jurusan; ?>"><?php echo $t->kode_jurusan; ?> - <?php echo $t->nama_jurusan; ?></option>
					<?php }
					} ?>
				</select></td>
		</tr>

	</table>
</fieldset>
<fieldset class="bawah">
	<table width="100%">
		<tr>
			<td colspan="3" align="center">
				<button type="button" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">CARI</button>
				<button type="button" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">CETAK</button>
				<button type="button" name="cetak_excel" id="cetak_excel" class="easyui-linkbutton" data-options="iconCls:'icon-print'">CETAK EXCEL</button>
				<a href="<?php echo base_url(); ?>index.php/lap_siswa/">
					<button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
				</a>
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
	<div id="tampil_data"></div>
</fieldset>