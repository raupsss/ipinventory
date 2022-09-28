<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	$("#gudang").focus();

	
	$("#simpan").click(function(){
		var gudang		= $("#gudang").val();
		
		var string = $("#form").serialize();
		
		if(gudang.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Gudang tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#gudang").focus();
			return false();
		}

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/gudang/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.messager.show({
					title:'Info',
					msg:data, 
					timeout:2000,
					showType:'slide'
				});
			},
			error : function(xhr, teksStatus, kesalahan) {
				$.messager.show({
					title:'Info',
					msg: 'Server tidak merespon :'+kesalahan,
					timeout:2000,
					showType:'slide'
				});
			}
		});
		return false();		
	});
	
});	
</script>
<form name="form" id="form">
<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
<fieldset class="atas">
<table width="100%">
<tr>    
	<td width="150">Gudang</td>
    <td width="5">:</td>
    <td><input type="text" name="gudang" id="gudang" size="20" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $gudang;?>" /></td>
</tr>
</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <a href="<?php echo base_url();?>index.php/gudang/tambah">
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    </a>
    <a href="<?php echo base_url();?>index.php/gudang/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>