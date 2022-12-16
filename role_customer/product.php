<?php
require_once('../database/condb.inc.php');

$category_id = $_GET['product'];
$c_name = $_GET['c_name'];

$select = $conn->prepare("SELECT * FROM product WHERE category_id=:category_id");
$select->bindParam(':category_id', $category_id);
$select->execute();

?>

<div id="panel-1" class="panel">
    <div class="panel-container show">
        <div class="panel-content">
            <div class="row">
                <?php
                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="card border m-auto m-lg-0" style="max-width: 18rem;">
                        <img src="../upload/<?= $row['img']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name']; ?></h5>
                            <p class="card-text text-primary">ราคารับซื้อ : <?= $row['purchase_price']; ?> บาท</p>
                            <p class="card-text text-success">ราคาขาย : <?= $row['selling_price']; ?> บาท</p>
                            <a href="#" class="btn btn-primary waves-effect waves-themed">เลือก</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>