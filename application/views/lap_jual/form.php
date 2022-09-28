<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	$("#tgl1").focus();
	$("#kode_barang").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
	$("#tgl1").datepicker({
			dateFormat:"dd-mm-yy"
    });
	$("#tgl2").datepicker({
			dateFormat:"dd-mm-yy"
    });
	$("#cari").click(function(){
		var gudang = $("#gudang").val();
		var kode_barang = $("#kode_barang").val();
		var tgl1 = $("#tgl1").val();
		var tgl2 = $("#tgl2").val();
		
		var string = "gudang="+gudang+"&tgl1="+tgl1+"&tgl2="+tgl2+"&kode_barang="+kode_barang;
		
		 if(tgl1.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Awal");
		   $("#tgl1").focus();
		   return false();
         }
		 if(tgl2.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Akhir");
		   $("#tgl2").focus();
		   return false();
         }
		 
		 $("#tampil_data").html('');
		 $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_jual/lihat",
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
		var gudang = $("#gudang").val();
		var kode_barang = $("#kode_barang").val();
		var tgl1 = $("#tgl1").val();
		var tgl2 = $("#tgl2").val();
		
		
		 if(tgl1.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Awal");
		   $("#tgl1").focus();
		   return false();
         }
		 if(tgl2.length == 0){
           alert("Maaf, Anda belum memilih Tanggal Akhir");
		   $("#tgl2").focus();
		   return false();
         }
		
		window.open('<?php echo site_url();?>/lap_jual/cetak/'+tgl1+'/'+tgl2+'/'+gudang+'/'+kode_barang);
		 
		return false();	
	});
	
});	
</script>
<fieldset class="atas">
<table width="100%">
<tr>    
	<td width="150">Tanggal</td>
    <td width="5"></td>
    <td><input type="text" name="tgl1" id="tgl1" size="12" maxlength="12" />
    s.d <input type="text" name="tgl2" id="tgl2" size="12" maxlength="12" /></td>
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
    <a href="<?php echo base_url();?>index.php/lap_jual/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>
<fieldset>
<div id="tampil_data"></div>
</fieldset>   