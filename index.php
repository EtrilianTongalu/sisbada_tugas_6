<?php
    $koneksi = mysqli_connect("localhost","root","","toko")
?>

<h1>Daftar Pelanggan</h1>
<?php
    $dataEdit[1]="";
    $dataEdit[2]="";
    $dataEdit[3]="";
    $dataEdit[4]="";
    $tombol="registrasi";
    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='edit') {
            $sqlEdit="SELECT * FROM pelanggan WHERE nomor='$_GET[nomor]'";
            $cekEdit= mysqli_query($koneksi,$sqlEdit);
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
            <td><input type="text" name="nama" value="<?=$dataEdit[1]?>"><br><br></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><input type="text" name="alamat" value="<?=$dataEdit[2]?>"><br><br></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><input type="text" name="jenis_kelamin" value="<?=$dataEdit[3]?>"><br><br></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td><input type="text" name="pekerjaan" value="<?=$dataEdit[4]?>"><br><br></td>
        </tr>
        <tr>
            <td><input type="submit" value="<?=$tombol?>" name="<?=$tombol?>" ></td>
        </tr>
    </table>
</form>
</form>

<table border="1">
    <thead>
        <th>Nomor</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Pekerjaan</th>
        <th>Aksi</th>
    </thead>
    <tbody>
    <?php
            $sqlView = "SELECT * FROM `pelanggan`";
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
            <td>>
                <a href="index.php?nomor=<?=$data[0]?>&aksi=edit">Edit</a>
                <a href="index.php?nomor=<?=$data[0]?>&aksi=delete">Delete</a>
            </td>
        </tr>

        <?php
            $nomor=$nomor+1;
            }
        ?>

    </tbody>
    <tfoot>
        
    </tfoot>
</table>

<?php
    if(isset($_POST['registrasi'])) {
        $sql = "INSERT INTO `pelanggan` (`nama`, `alamat`, `jenis_kelamin`, `pekerjaan`) VALUES ('$_POST[nama]', '$_POST[alamat]', '$_POST[jenis_kelamin]', '$_POST[pekerjaan]')";
        $cekInput = mysqli_query($koneksi, $sql);
        if($cekInput) {
            echo "<script> window.location = 'index.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
    else if(isset($_POST['edit'])) {
        $sqlEdit = "UPDATE `pelanggan` SET `nama` = '$_POST[nama]', `alamat` = '$_POST[alamat]', `jenis_kelamin` = '$_POST[jenis_kelamin]', `pekerjaan` = '$_POST[pekerjaan]' WHERE `pelanggan`.`nomor` = '$_GET[nomor]';";
        $cekEdit = mysqli_query($koneksi, $sqlEdit);

        if($cekEdit) {
            echo "<script> window.location = 'index.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }

    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='delete') {
            $sqlDelete = "DELETE FROM `pelanggan` WHERE `pelanggan`.`nomor` = '$_GET[nomor]'  ";
            $cekDelete = mysqli_query($koneksi, $sqlDelete);

            if($cekDelete) {
                echo "<script> window.location = 'index.php'</script>";
            } else {    
                echo "Data belum terhapus";
            }
        }
    }

    
?>