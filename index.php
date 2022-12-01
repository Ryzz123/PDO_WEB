<?php
require_once __DIR__ . '/template/head.php';
require_once __DIR__ . '/database/connection.php';

$connection = getConnection();

$sql = <<<SQL
    SELECT * FROM product;
SQL;
$statement = $connection->query($sql);

$connection = null;
?>

    <div class="row">
        <?php foreach ($statement as $data) : ?>

            <div class="col-sm-12 mb-3 mt-3 col-md-6 col-lg-4">
                <div class="card m-auto bg-dark" style="width: 18rem;">
                    <img src="./image/<?= $data['gambar'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                       <div class="product">
                           <h5 class="card-title text-white"><?= $data['nama'] ?></h5>
                           <span class="category"><?= $data['category'] ?></span>
                       </div>
                        <span class="text-white"><?= $data['harga'] ?></span>
                        <p class="card-text text-white"><?= $data['desc_product'] ?></p>
                       <div class="button-me">
                           <a href="#" class="btn btn-primary bg-dark">BELI</a>
                           <a href="./update.php?id=<?= $data['id'] ?>" class="btn text-white btn-outlined bg-dark"><i class="bi bi-pencil-square"></i></a>
                           <a href="./delete.php?id=<?= $data['id'] ?>" class="btn text-white btn-outlined bg-dark"><i class="bi bi-trash"></i></a>
                       </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

<?php
require_once __DIR__ . '/template/footer.php';
?>
