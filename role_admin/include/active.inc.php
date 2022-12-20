<?php

if (isset($_GET['main'])) {

    $main = 'active';
}

if (isset($_GET['dashboard'])) {

    $dashboard = 'active';
}

if (isset($_GET['order'])) {

    $order = 'active';
}

if (isset($_GET['payment'])) {

    $payment = 'active';
}

if (isset($_GET['send'])) {

    $send = 'active';
}

if (isset($_GET['account'])) {

    $account = 'active';

    if ($_GET['status'] === '0') {

        $status0 = 'active';
    } else if ($_GET['status'] === '1') {

        $status1 = 'active';
    } else if ($_GET['status'] === '2') {

        $status2 = 'active';
    } else {
        $status3 = 'active';
    }
}

if (isset($_GET['category']) || isset($_GET['product']) || isset($_GET['product_img'])) {

    $manage = 'active';

    if (isset($_GET['category'])) {

        $category = 'active';
    } 

    if (isset($_GET['product']) || isset($_GET['product_img'])) {

        $product = 'active';
    } 
}




?>