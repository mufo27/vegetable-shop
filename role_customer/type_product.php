<?php
session_start();
require_once('../database/condb.inc.php');
?>
<div id="panel-1" class="panel">
    <div class="panel-container show">
        <div class="panel-content">
            <div class="row">
                <?php
                $select = $conn->prepare("SELECT * FROM category");
                $select->execute();
                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="card border m-auto m-lg-0" style="max-width: 18rem;">
                        <img src="../upload/<?= $row['img']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name']; ?></h5>
                            <!-- <a href="?product=<?= $row['id']; ?>&c_name=<?= $row['name']; ?>" class="btn btn-primary waves-effect waves-themed">เลือก</a> -->
                            <a href="?product=<?= $row['id']; ?>&c_name=<?= $row['name']; ?>" class="btn btn-primary waves-effect waves-themed">เลือก</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include('./product.php') ?>
