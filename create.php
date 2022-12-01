<?php
require_once __DIR__ . '/template/head.php';
require_once __DIR__ . '/database/connection.php';

$connection = getConnection();

if (isset($_POST['submit'])) {
    if(empty($_POST['nama']) || empty($_POST['category']) || empty($_POST['harga']) || empty($_POST['desc']) || empty($_FILES['gambar'])) {
        echo "
        <script>alert('Data Kosong!!')</script>
        ";
    } else {

        // kumpulkan data
        $nama = htmlspecialchars($_POST['nama']);
        $category = htmlspecialchars($_POST['category']);
        $harga = htmlspecialchars($_POST['harga']);
        $desc = htmlspecialchars($_POST['desc']);
        $gambar = upload();

        if (!$gambar) {
            return false;
        }

        $sql = <<<SQL
            INSERT INTO product(nama,category,harga,desc_product,gambar) VALUES (?,?,?,?,?);
        SQL;
        $statement = $connection->prepare($sql);
        $statement->execute([$nama,$category,$harga,$desc,$gambar]);

                echo "
                 <script>alert('Sukses Upload File')</script>
                ";

                header('Location: ./index.php');
    }
}

$connection = null;

?>

<div class="card bg-dark mt-4 m-auto">
    <div class="card-body">
        <div class="card-head text-white text-center">FORM CREATE</div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="text-white form-label">Nama :</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Product">
            </div>
            <div class="mb-3">
                <label for="category" class="text-white form-label">Category :</label>
                <input type="text" class="form-control" id="category" name="category" placeholder="Masukan Category">
            </div>
            <div class="mb-3">
                <label for="harga" class="text-white form-label">Harga :</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan Harga">
            </div>
            <div class="mb-3">
                <label for="desc" class="text-white form-label">Desc :</label>
                <textarea class="form-control" id="desc" placeholder="Masukan Deskripsi" name="desc" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <input type="file" class="form-control" id="gambar" name="gambar" rows="3"></input>
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