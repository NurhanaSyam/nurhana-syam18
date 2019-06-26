<?php
$koneksi=mysqli_connect("localhost","root","","diamond_hotel")
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body bgcolor="#E9967A">
<center>
<h3>Diamond Hotel</h3>

<?php
    $dataEdit[1]="";
    $dataEdit[2]="";
    $dataEdit[3]="";
    $dataEdit[4]="";
    $tombol="registrasi";
    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='edit') {
            $edit="SELECT * FROM pengunjung WHERE id='$_GET[id]'";
            $cekEdit= mysqli_query($koneksi,$edit);
            $dataEdit=mysqli_fetch_array($cekEdit);

            $tombol="edit";
        }
    }
?>
<form action="" method="post">
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td> 
            <td><input type="text" name="Nama" value="<?=$dataEdit[1]?>"></td>
        </tr>
        <tr>
            <td>No_kamar</td>
            <td>:</td> 
            <td><input type="text" name="No_kamar" value="<?=$dataEdit[2]?>"></td>
        </tr>
        <tr>
            <td>Tanggal_masuk</td>
            <td>:</td> 
            <td><input type="text" name="Tanggal_masuk" value="<?=$dataEdit[3]?>"></td>
        </tr>
        <tr>
            <td>Tanggal_keluar</td>
            <td>:</td> 
            <td><input type="text" name="Tanggal_keluar" value="<?=$dataEdit[4]?>"></td>
        </tr>
    </table>
    <tr><input type="submit" value="<?=$tombol?>" name="<?=$tombol?>"></tr>
</form>

<table border="1" >
<thead>
    <th>nomor</th>
    <th>Nama</th>
    <th>No_kamar</th>
    <th>Tanggal_masuk</th>
    <th>Tanggal_keluar</th>
    <th>aksi</th>
</thead>
<tbody>
</center>
</body>
</html>
<?php
    $sqlView = "SELECT * FROM `pengunjung`";
    $cekView = mysqli_query($koneksi, $sqlView);
        
    $nomor = 1;
    while ($data = mysqli_fetch_array($cekView)) {
?>
    <tr>
        <td><?=$nomor?></td>
        <td><?=$data[1]?></td>
        <td><?=$data[2]?></td>
        <td><?=$data[3]?></td>
        <td><?=$data[4]?></td>
        <td>
            <a href="pemrograman.php?id=<?=$data[0]?>&aksi=edit">Edit</a>
        </td>
    </tr>

<?php
    $nomor=$nomor+1;
    }
?>

</tbody>
</table>

<?php
    if(isset($_POST['registrasi'])) 
    {
        $sql = "INSERT INTO `pengunjung` (`Nama`,`No_kamar`,`Tanggal_masuk`,`Tanggal_keluar`) VALUES ('$_POST[Nama]', '$_POST[No_kamar]', '$_POST[Tanggal_masuk]', '$_POST[Tanggal_keluar]')";
        $cekInput = mysqli_query($koneksi, $sql);
        if($cekInput) {
            echo "<script> window.location = 'pemrograman.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
    else if (isset($_POST['edit']))
    {
        $edit = "UPDATE `pengunjung` SET `Nama` = '$_POST[Nama]', `No_kamar` = '$_POST[No_kamar]', `Tanggal_masuk` = '$_POST[Tanggal_masuk]', `Tanggal_keluar` = '$_POST[Tanggal_keluar]'  WHERE `pengunjung`.`id` = '$_GET[id]';";
        $cekEdit = mysqli_query($koneksi, $edit);  

        if($cekEdit) {
            echo "<script> window.location = 'pemrograman.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
?>