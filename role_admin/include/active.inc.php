<?php

if (isset($_GET['main'])) {

    $main = 'active';
}

if (isset($_GET['dashboard'])) {

    $dashboard = 'active';
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

if (isset($_GET['order_buy'])) {

    $order_buy = 'active';
}

if (isset($_GET['payment_buy'])) {

    $payment_buy = 'active';
}

if (isset($_GET['send_buy'])) {

    $send_buy = 'active';
}

if (isset($_GET['order_sell'])) {

    $order_sell = 'active';
}

if (isset($_GET['payment_sell'])) {

    $payment_sell = 'active';
}

if (isset($_GET['send_sell'])) {

    $send_sell = 'active';
}
