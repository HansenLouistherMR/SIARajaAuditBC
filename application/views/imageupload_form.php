<!DOCTYPE html>
<html>
<head>
    <title>Upload Image di Codeigniter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h3>Pilih gambar dari komputer Anda dan klik UPLOAD</h3>
    <?php echo @$error; ?> 
    <?php echo form_open_multipart('admin/Upload_Perusahaan/aksi_upload');?>
    <?php echo "<input type='file' name='profile_pic' size='20' />"; ?>
    <br>
    <br>
    <?php echo "<input type='submit' name='submit' value='UPLOAD' /> ";?>
    <?php echo "</form>"?>
</body>
</body>
</html>