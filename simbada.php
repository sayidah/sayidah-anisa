<?php
$koneksi=mysqli_connect("localhost","root","","registrasi")
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body background="candy.jpg">
    <h3>registrasi pembelian di apotek kimia farma salangga</h3>

    <?php
        $dataEdit[1]="";
        $dataEdit[2]="";
        $dataEdit[3]="";

       
        $tombol="registrasi";
        if(isset($_GET['aksi'])) {
            if($_GET['aksi']=='edit') {
                $edit="SELECT * FROM regis_apotek WHERE id='$_GET[id]'";
                $cekEdit= mysqli_query($koneksi,$edit);
                $dataEdit=mysqli_fetch_array($cekEdit);

                $tombol="edit";
            }
        }
    ?>
    <form action="" method="post">
        <table>
           
            <tr>
                <td>nama_pelanggan</td>
                <td>:</td> 
                <td><input type="text" name="nama_pelanggan" value="<?=$dataEdit[1]?>"></td>
            </tr>
            <tr>
                <td>nama_obat</td>
                <td>:</td> 
                <td><input type="text" name="nama_obat" value="<?=$dataEdit[2]?>"></td>
            </tr>
            <tr>
                <td>jumlah</td>
                <td>:</td> 
                <td><input type="text" name="jumlah" value="<?=$dataEdit[3]?>"></td>
            </tr>

        </table>
         <tr><input type="submit" value="<?=$tombol?>" name="<?=$tombol?>"></tr>
    </form>

    <table border="1" >
    <thead>
        <th>nomor</th>
        <th>nama_pelanggan</th>
        <th>nama_obat</th>
        <th>jumlah</th>
        <th>aksi</th>
    </thead>
    <tbody>

    <?php
        $sqlView = "SELECT * FROM `regis_apotek`";
        $cekView = mysqli_query($koneksi, $sqlView);
            
        $nomor = 1;
        while ($data = mysqli_fetch_array($cekView)) {
    ?>
        <tr>
            <td><?=$nomor?></td>
            <td><?=$data[1]?></td>
            <td><?=$data[2]?></td>
            <td><?=$data[3]?></td>
           
            <td>
                <a href="simbada.php?id=<?=$data[0]?>&aksi=edit">Edit</a>
            </td>
        </tr>

    <?php
        $nomor=$nomor+1;
        }
    ?>

    </tbody>
    </table>
</body>
</html>
<?php
    if(isset($_POST['registrasi'])) 
    {
        $sql = "INSERT INTO `regis_apotek` (`nama_pelanggan`,`nama_obat`,`jumlah`) VALUES ('$_POST[nama_pelanggan]', '$_POST[nama_obat]', '$_POST[jumlah]')";
        $cekInput = mysqli_query($koneksi, $sql);
        // var_dump($sql);
        // die;
        if($cekInput) {
            echo "<script> window.location = 'simbada.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
    else if (isset($_POST['edit']))
    {
        $edit = "UPDATE `regis_apotek` SET  `nama_pelanggan` = '$_POST[nama_pelanggan]', `nama_obat` = '$_POST[nama_obat]', `jumlah` = '$_POST[jumlah]'  WHERE `regis_apotek`.`id` = '$_GET[id]';";
        $cekEdit = mysqli_query($koneksi, $edit);  

        if($cekEdit) {
            echo "<script> window.location = 'simbada.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
?>