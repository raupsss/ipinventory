<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	$("#username").focus();

	
	$("#simpan").click(function(){
		var username		= $("#username").val();
		var nama_lengkap	= $("#nama_lengkap").val();
		var pwd				= $("#pwd").val();
		var level			= $("#level").val();
		
		var string = $("#form").serialize();
		
		if(username.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Username tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#username").focus();
			return false();
		}
		if(nama_lengkap.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Nama Lengkap tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#nama_lengkap").focus();
			return false();
		}
		if(level.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Level tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#level").focus();
			return false();
		}
		/*
		if(pwd.length==0){
			$.messager.show({
				title:'Info',
				msg:'Maaf, Password tidak boleh kosong', 
				timeout:2000,
				showType:'show'
			});
			$("#pwd").focus();
			return false();
		}
		*/
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/pengguna/simpan",
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
<fieldset class="atas">
<table width="100%">
<tr>    
	<td width="150">Username</td>
    <td width="5">:</td>
    <td><input type="text" name="username" id="username" size="20" maxlength="20" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $username;?>" /></td>
</tr>
<tr>    
	<td>Nama Lengkap</td>
    <td>:</td>
    <td><input type="text" name="nama_lengkap" id="nama_lengkap"  size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $nama_lengkap;?>"/></td>
</tr>
<tr>    
	<td>Password</td>
    <td>:</td>
    <td><input type="password" name="pwd" id="pwd"  size="20" maxlength="20" value="<?php echo $pwd;?>"/>
    Password kosongkan jika tidak di edit
    </td>
</tr>
<tr>    
	<td>Level</td>
    <td>:</td>
    <td>
    <select name="level" id="level">
    <?php 
	if(empty($level)){
	?>
    <option value="">-PILIH-</option>
    <?php
	}
	foreach($l_level->result() as $t){
		if($level==$t->id_level){
	?>
    	<option value="<?php echo $t->id_level;?>" selected="selected"><?php echo $t->level;?></option>
    <?php }else{ ?>
    	<option value="<?php echo $t->id_level;?>"><?php echo $t->level;?></option>
    <?php }
	} ?>
        </select>
    </td>
</tr>
</table>
</fieldset>
<fieldset class="bawah">
<table width="100%">
<tr>
	<td colspan="3" align="center">
    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
    <a href="<?php echo base_url();?>index.php/pengguna/tambah">
    <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
    </a>
    <a href="<?php echo base_url();?>index.php/pengguna/">
    <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
    </a>
    </td>
</tr>
</table>  
</fieldset>   
</form>