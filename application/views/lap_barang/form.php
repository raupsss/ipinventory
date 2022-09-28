<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	$("#tgl_1").focus();
	$("#kode_barang").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	$("#tgl_1").datepicker({
			dateFormat:"dd-mm-yy"
    });
	$("#tgl_2").datepicker({
			dateFormat:"dd-mm-yy"
    });
	
	$("#cari").click(function(){
		var tgl_1 = $("#tgl_1").val();
		var tgl_2 = $("#tgl_2").val();
		var gudang = $("#gudang").val();
		var kode_barang = $("#kode_barang").val();
		
		var string = "tgl_1="+tgl_1+"&tgl_2="+tgl_2+"&gudang="+gudang+"&kode_barang="+kode_barang;

		if(tgl_1.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Awal");
		   $("#tgl_1").focus();
		   return false();
         }
		 if(tgl_2.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Akhir");
		   $("#tgl_2").focus();
		   return false();
         }
		 /*
		 if(gudang.length == 0){
           alert("Maaf, Anda belum memilih Gudang");
		   $("#gudang").focus();
		   return false();
         }
		 */
		 $("#tampil_data").html('');
		 $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_barang/lihat",
			data	: string,
			cache	: false,
			success	: function(data){
				var win = $.messager.progress({
				title:'Please waiting',
				msg:'Loading data...'
				});
				setTimeout(function(){
					$.messager.progress('close');
					$("#tampil_data").html(data);
				},2800)
			}		
		});
		return false();	
	});
	
	$("#cetak").click(function(){
		var tgl_1 = $("#tgl_1").val();
		var tgl_2 = $("#tgl_2").val();
		var gudang = $("#gudang").val();
		var kode_barang = $("#kode_barang").val();

		if(tgl_1.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Awal");
		   $("#tgl_1").focus();
		   return false();
         }
		 if(tgl_2.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Akhir");
		   $("#tgl_2").focus();
		   return false();
         }
		 /*
		 if(gudang.length == 0){
           alert("Maaf, Anda belum memilih Gudang");
		   $("#gudang").focus();
		   return false();
         }
		 */
		window.open('<?php echo site_url();?>/lap_barang/cetak/'+tgl_1+'/'+tgl_2+'/'+gudang+'/'+kode_barang);
		return false();
	});
});	
</script>
<fieldset class="atas">
<table width="100%">
<tr>    
	<td width="150">Dari Tanggal</td>
    <td width="5"></td>
    <td><input type="text" name="tgl_1" id="tgl_1" size="12" maxlength="12" />
    s.d Tanggal <input type="text" name="tgl_2" id="tgl_2" size="12" maxlength="12" />
    </td>
</tr>

<tr>    
	<td width="150">Kode Barang</td>
    <td width="5"></td>
    <td> <input type="text" name="kode_barang" id="kode_barang" size="12" /></td>
</tr>
</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="cari" id="cari" class="easyui-linkbutton" data-options="iconCls:'icon-search'">CARI</button>
    <button type="button" name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">CETAK</button>
    <a href="<?php echo base_url();?>index.php/lap_barang/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>
<fieldset>
<div id="tampil_data"></div>
</fieldset>   