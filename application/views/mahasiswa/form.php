<script type="text/javascript">
    $(document).ready(function() {
        $(':input:not([type="submit"])').each(function() {
            $(this).focus(function() {
                $(this).addClass('hilite');
            }).blur(function() {
                $(this).removeClass('hilite');
            });
        });
        $("#kode").focus();

        $("#kode").keyup(function(e) {
            var isi = $(e.target).val();
            $(e.target).val(isi.toUpperCase());
            CariDatamahasiswa();
        });

        function CariDatamahasiswa() {
            var kode = $("#kode").val()
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url(); ?>/ref_json/Infomahasiswa",
                data: "kode=" + kode,
                cache: false,
                dataType: "json",
                success: function(data) {
                    $("#nama_supp").val(data.nama_mahasiswa);
                    $("#alamat").val(data.alamat);
                }
            });
        }

        $("#simpan").click(function() {
            var kode = $("#kode").val();
            var nama_supp = $("#nama_supp").val();
            var alamat = $("#alamat").val();

            var string = $("#form").serialize();

            if (kode.length == 0) {
                $.messager.show({
                    title: 'Info',
                    msg: 'Maaf, Kode tidak boleh kosong',
                    timeout: 2000,
                    showType: 'show'
                });
                $("#kode").focus();
                return false();
            }
            if (nama_supp.length == 0) {
                $.messager.show({
                    title: 'Info',
                    msg: 'Maaf, Nama mahasiswa tidak boleh kosong',
                    timeout: 2000,
                    showType: 'show'
                });
                $("#nama_supp").focus();
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
                <td><input type="text" name="jurusan" id="jurusan" size="80" maxlength="80" value="<?php echo $jurusan; ?>" />
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
                    <button type="button" name="simpan" id="simpan" class="easyui-linkbutton" data-options="iconCls:'icon-save'">SIMPAN</button>
                    <a href="<?php echo base_url(); ?>index.php/mahasiswa/tambah">
                        <button type="button" name="tambah_data" id="tambah_data" class="easyui-linkbutton" data-options="iconCls:'icon-add'">TAMBAH</button>
                    </a>
                    <a href="<?php echo base_url(); ?>index.php/mahasiswa/">
                        <button type="button" name="kembali" id="kembali" class="easyui-linkbutton" data-options="iconCls:'icon-back'">KEMBALI</button>
                    </a>
                </td>
            </tr>
        </table>
    </fieldset>
</form>