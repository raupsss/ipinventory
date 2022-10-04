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
            CariDataMahasiswa();
        });

        function CariDataMahasiswa() {
            var kode = $("#nim").val()
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url(); ?>/ref_json/InfoMahasiswa",
                data: "kode=" + kode,
                cache: false,
                dataType: "json",
                success: function(data) {
                    $("#nama_lengkap").val(data.nama_lengkap);
                    $("#tempat_lahir").val(data.tempat_lahir);
                    $("#tanggal_lahir").val(data.tanggal_lahir);
                    $("#tempat_lahir").val(data.tempat_lahir);
                    $("#alamat").val(data.alamat);
                    $("#kode_jurusan").val(data.kode_jurusan);
                    $("#no_hp").val(data.no_hp);
                    $("#email").val(data.email);

                }
            });
        }

        $("#tanggal_lahir").datepicker({
            dateFormat: "dd-mm-yy"
        });

        $("#simpan").click(function() {
            var nim = $("#nim").val();
            var nama_lengkap = $("#nama_lengkap").val();
            // var alamat = $("#alamat").val();

            var string = $("#form").serialize();

            if (nim.length == 0) {
                $.messager.show({
                    title: 'Info',
                    msg: 'Maaf, nim tidak boleh kosong',
                    timeout: 2000,
                    showType: 'show'
                });
                $("#nim").focus();
                return false();
            }
            if (nama_lengkap.length == 0) {
                $.messager.show({
                    title: 'Info',
                    msg: 'Maaf, Nama mahasiswa tidak boleh kosong',
                    timeout: 2000,
                    showType: 'show'
                });
                $("#nama_lengkap").focus();
                return false();
            }
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url(); ?>/mahasiswa/simpan",
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
                <td><input type="text" name="nim" id="nim" size="20" maxlength="20" value="<?php echo $nim; ?>" /></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" name="nama_lengkap" id="nama_lengkap" size="50" maxlength="50" class="easyui-validatebox" data-options="required:true,validType:'length[3,10]'" value="<?php echo $nama_lengkap; ?>" /></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" name="tempat_lahir" id="tempat_lahir" size="80" maxlength="80" value="<?php echo $tempat_lahir; ?>" />
                </td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="text" name="tanggal_lahir" id="tanggal_lahir" size="80" maxlength="80" value="<?php echo $tanggal_lahir; ?>" />
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat" id="alamat" size="80" maxlength="80" value="<?php echo $alamat; ?>" />
                </td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td> <select name="jurusan" id="jurusan">
                        <?php
                        if (empty($jurusan)) {
                        ?>
                            <option value="">--PILIH--</option>
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
                    </select>
                </td>
            </tr>
            <tr>
                <td>No Handphone</td>
                <td>:</td>
                <td><input type="text" name="no_hp" id="no_hp" size="80" maxlength="80" value="<?php echo $no_hp; ?>" />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="text" name="email" id="email" size="80" maxlength="80" value="<?php echo $email; ?>" />
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset class="bawah">
        <table width="100%">
            <tr>
                <td colspan="3" align="center">

                    <a href="<?php echo base_url(); ?>index.php/mahasiswa/simpan">
                        <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-add'">SIMPAN</button>
                    </a>
                    <a href="<?php echo base_url(); ?>index.php/mahasiswa/">
                        <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
                    </a>
                </td>
            </tr>
        </table>
    </fieldset>
</form>