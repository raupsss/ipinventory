<div id="view">
	<div style="float:left; padding-bottom:5px;">
		<a href="<?php echo base_url(); ?>index.php/siswa/tambah">
			<button type="button" name="tambah" id="tambah" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Tambah Data</button>
		</a>
		<a href="<?php echo base_url(); ?>index.php/siswa">
			<button type="button" name="refresh" id="refresh" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">Refresh</button>
		</a>

	</div>
	<div style="float:left; padding-bottom:5px;">
		<form name="form" method="post" action="<?php echo base_url(); ?>index.php/siswa">
			Cari Kode & Nama Barang : <input type="text" name="txt_cari" id="txt_cari" size="50" />
			<button type="submit" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">Cari</button>
		</form>
	</div>
	<div id="gird" style="float:left; width:100%;">
		<table id="dataTable" width="100%">
			<tr>
				<th>No</th>
				<th>NIM</th>
				<th>NAMA</th>
				<th>ALAMAT</th>
				<th>JURUSAN</th>
				<th>TTL</th>
				<th>Aksi</th>
			</tr>
			<?php
			if ($data->num_rows() > 0) {
				$no = 1 + $hal;
				foreach ($data->result_array() as $db) {
					$jurusan = $this->app_model->Nama_Jurusan($db['kode_jurusan']);

			?>
					<tr>
						<td align="center" width="20"><?php echo $no; ?></td>
						<td align="center" width="100"><?php echo $db['nim']; ?></td>
						<td align="center"><?php echo $db['nama']; ?></td>
						<td align="center" width="100"><?php echo $db['alamat']; ?></td>
						<td align="center" width="80" nowrap="nowrap"><?php echo $jurusan; ?></td>
						<td align="center" width="80"><?php echo $db['ttl']; ?></td>

						<td align="center" width="80">
							<a href="<?php echo base_url(); ?>index.php/siswa/edit/<?php echo $db['nim']; ?>">
								<img src="<?php echo base_url(); ?>asset/images/ed.png" title='Edit'>
							</a>
							<a href="<?php echo base_url(); ?>index.php/siswa/hapus/<?php echo $db['nim']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
								<img src="<?php echo base_url(); ?>asset/images/del.png" title='Hapus'>
							</a>
						</td>
					</tr>
				<?php
					$no++;
				}
			} else {
				?>
				<tr>
					<td colspan="6" align="center">Tidak Ada Data</td>
				</tr>
			<?php
			}
			?>
		</table>
		<?php echo "<table align='center'><tr><td>" . $paginator . "</td></tr></table>"; ?>
	</div>
</div>