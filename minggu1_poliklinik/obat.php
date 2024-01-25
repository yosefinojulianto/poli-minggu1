<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit;
}

$nama_obat = '';
$kemasan = '';
$harga = '';
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM obat 
            WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $nama_obat = $row['nama_obat'];
        $kemasan = $row['kemasan'];
        $harga = $row['harga'];
    }
}

if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE obat SET 
                                            nama_obat = '" . $_POST['nama_obat'] . "',
                                            kemasan = '" . $_POST['kemasan'] . "',
                                            harga = '" . $_POST['harga'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO obat (nama_obat, kemasan, harga) 
                                            VALUES (
                                                '" . $_POST['nama_obat'] . "',
                                                '" . $_POST['kemasan'] . "',
                                                '" . $_POST['harga'] . "'
                                            )");
    }
    echo "<script> 
                document.location='index.php?page=obat';
                </script>";
}
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
                document.location='index.php?page=obat';
                </script>";
}
?>
<h2>Obat</h2>
<br>
<div class="container">
    <!--Form Input Data-->

    <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <div class="col">
        <label for="inputNama" class="form-label fw-bold">
            Nama Obat
        </label>
        <input type="varchar" class="form-control" name="nama_obat" id="inputNama_obat" placeholder="Nama Obat" value="<?php echo $nama_obat ?>">
        </div>
        <div class="col">
            <label for="inputAlamat" class="form-label fw-bold">
                Kemasan
            </label>
            <input type="varchar" class="form-control" name="kemasan" id="inputKemasan" placeholder="Kemasan" value="<?php echo $kemasan ?>">
        </div>
        <div class="col">
            <label for="inputNo_hp" class="form-label fw-bold">
            Harga
            </label>
            <input type="varchar" class="form-control" name="harga" id="inputHarga" placeholder="Harga" value="<?php echo $harga ?>">
        </div>
        <div class="col mt-4 mb-3">
            <button type="submit" class="btn btn-primary rounded-pill " name="simpan">Simpan</button>
        </div>
    </form>
    <br>
    <br>
    <!-- Table-->
    <table class="table table-hover">
        <!--thead atau baris judul-->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Kemasan</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
        <tbody>
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM obat");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $data['nama_obat'] ?></td>
                    <td><?php echo $data['kemasan'] ?></td>
                    <td><?php echo $data['harga'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>