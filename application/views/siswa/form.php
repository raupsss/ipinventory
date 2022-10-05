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
		$("#nim").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
			CariDataSiswa();
		});

		function CariDataSiswa() {
			var kode = $("#nim").val()
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/ref_json/InfoSiswa",
				data: "kode=" + kode,
				cache: false,
				dataType: "json",
				success: function(data) {
					$("#nama").val(data.nama);
					$("#alamat").val(data.alamat);
					$("#kode_jurusan").val(data.kode_jurusan);
					$("#ttl").val(data.ttl);

				}
			});
		}

		$("#ttl").datepicker({
			dateFormat: "dd-mm-yy"
		});

		$("#hrg_beli").keypress(function(data) {
			if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
				return false;
			}
		});
		$("#hrg_jual").keypress(function(data) {
			if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
				return false;
			}
		});
		$("#stok_awal").keypress(function(data) {
			if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
				return false;
			}
		});

		$("#simpan").click(function() {
			var nim = $("#nim").val();
			var nama = $("#nama").val();
			var alamat = $("#alamat").val();
			var jurusan = $("#jurusan").val();
			var ttl = $("#ttl").val();

			var string = $("#form").serialize();

			if (nim.length == 0) {
				$.messager.show({
					title: 'Info',
					msg: 'Maaf, NIM tidak boleh kosong',
					timeout: 2000,
					showType: 'show'
				});
				$("#nim").focus();
				return false();
			}
			if (nama.length == 0) {
				$.messager.show({
					title: 'Info',
					msg: 'Maaf, Nama Siswa tidak boleh kosong',
					timeout: 2000,
					showType: 'show'
				});
				$("#nama").focus();
				return false();
			}
			if (alamat.length == 0) {
				$.messager.show({
					title: 'Info',
					msg: 'Maaf, Alamat tidak boleh kosong',
					timeout: 2000,
					showType: 'show'
				});
				$("#alamat").focus();
				return false();
			}
			if (jurusan.length == 0) {
				$.messager.show({
					title: 'Info',
					msg: 'Maaf, Jurusan tidak boleh kosong',
					timeout: 2000,
					showType: 'show'
				});
				$("#jurusan").focus();
				return false();
			}
			if (ttl.length == 0) {
				$.messager.show({
					title: 'Info',
					msg: 'Maaf, TTL tidak boleh kosong',
					timeout: 2000,
					showType: 'show'
				});
				$("#ttl").focus();
				return false();
			}
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/siswa/simpan",
				data: string,
				cache: false,
				success: function(data) {
					$.messager.show({
						title: 'Info',
						msg: data,
						timeout: 2000,
						showType: 'slide'
					});
					CariSimpanan();
				},
				error: function(xhr, teksStatus, kesalahan) {
					$.messager.show({
						title: 'Info',
						msg: 'Server tidak merespon :' + kesalahan,
						timeout: 2000,
						showType: 'slide'
					});
				}
			});
			return false();
		});

	});
</script>
<form name="form" id="form">
	<fieldset class="atas">
		<table width="100%">
			<tr>
				<td width="150">NIM</td>
				<td width="5">:</td>
				<td><input type="text" name="nim" id="nim" size="12" maxlength="12" value="<?php echo $nim; ?>" /></td>
			</tr>
			<tr>
				<td>Nama Siswa</td>
				<td>:</td>
				<td><input type="text" name="nama" id="nama" size="25" maxlength="25" class="easyui-validatebox" value="<?php echo $nama; ?>" /></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><input type="text" name="alamat" id="alamat" size="10" maxlength="10" class="easyui-validatebox" value="<?php echo $alamat; ?>" /></td>
			</tr>
			<tr>
				<td>Jurusan</td>
				<td>:</td>
				<td><select name="jurusan" id="jurusan">
						<?php
						if (empty($jurusan)) {
						?>
							<option value="">-PILIH-</option>
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
			<tr>
				<td>TTL</td>
				<td>:</td>
				<td><input type="text" name="ttl" id="ttl" size="10" maxlength="10" value="<?php echo $ttl; ?>" /></td>
			</tr>
		</table>
	</fieldset>
	<fieldset class="bawah">
		<table width="100%">
			<tr>
				<td colspan="3" align="center">

					<button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>

					<a href="<?php echo base_url(); ?>index.php/siswa/tambah">
						<button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
					</a>
					<a href="<?php echo base_url(); ?>index.php/siswa/">
						<button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
					</a>
				</td>
			</tr>
		</table>
	</fieldset>
</form>