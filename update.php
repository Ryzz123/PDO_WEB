<?php
require_once __DIR__ . '/template/head.php';
require_once  __DIR__ . '/database/connection.php';

$id = $_GET['id'];

$connection = getConnection();

$sql = <<<SQL
    SELECT * FROM product WHERE id = ?;
SQL;
$statement = $connection->prepare($sql);
$statement->execute([$id]);
$data = $statement->fetch();

if (isset($_POST['submit'])) {
    if(empty($_POST['nama']) || empty($_POST['category']) || empty($_POST['harga']) || empty($_POST['desc']) || empty($_FILES['gambar'])) {
        echo "
        <script>alert('Data Kosong!!')</script>
        ";
    } else {
        // kumpulkan data
        $id = $_POST['id'];
        $nama = htmlspecialchars($_POST['nama']);
        $category = htmlspecialchars($_POST['category']);
        $harga = htmlspecialchars($_POST['harga']);
        $desc = htmlspecialchars($_POST['desc']);
        $gambarLama = $_POST['gambarLama'];

        // cek user pilih gambar baru apa tidak
        if ($_FILES['gambar']['error'] == 4) {
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }

        $sql = <<<SQL
                UPDATE product SET id = ?, nama = ?, category = ?, harga = ?, desc_product = ?, gambar = ? WHERE id = ?;
            SQL;
        $statement = $connection->prepare($sql);
        $statement->execute([
                $id,
                $nama,
                $category,
                $harga,
                $desc,
                $gambar,
                $id
        ]);

        echo "
        <script>alert('Data Berhasil Di perbarui')</script>
        ";

        header("Location: ./index.php");
    }
}

$connection = null;
?>


<div class="card bg-dark mt-4 m-auto">
    <div class="card-body">
        <div class="card-head text-white text-center">FORM CREATE</div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <input type="hidden" name="gambarLama" value="<?= $data['gambar'] ?>">
            <div class="mb-3">
                <label for="nama" class="text-white form-label">Nama :</label>
                <input type="text" class="form-control" id="nama"  value="<?= $data['nama'] ?>" name="nama" placeholder="Nama Product">
            </div>
            <div class="mb-3">
                <label for="category" class="text-white form-label">Category :</label>
                <input type="text" class="form-control" id="category" value="<?= $data['category'] ?>" name="category" placeholder="Masukan Category">
            </div>
            <div class="mb-3">
                <label for="harga" class="text-white form-label">Harga :</label>
                <input type="number" class="form-control" id="harga" value="<?= $data['harga'] ?>" name="harga" placeholder="Masukan Harga">
            </div>
            <div class="mb-3">
                <label for="desc" class="text-white form-label">Desc :</label>
                <textarea class="form-control" id="desc" placeholder="Masukan Deskripsi" name="desc" rows="3"><?= $data['desc_product'] ?></textarea>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" id="gambar"  name="gambar" rows="3"></input>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary bg-dark" name="submit">CREATE</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/template/footer.php';
?>
