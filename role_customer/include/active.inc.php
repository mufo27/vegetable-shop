<?php

if (isset($_GET['main'])) {

    $main = 'active';
}

if (isset($_GET['profile'])) {

    $profile = 'active';
}


if (isset($_GET['category']) || isset($_GET['product']) || isset($_GET['product_detail'])) {

    $category = 'active';
}

if (isset($_GET['cart'])) {

    $cart = 'active';
}

if (isset($_GET['order']) || isset($_GET['order_detail'])) {

    $order = 'active';
}

if (isset($_GET['payment'])) {

    $payment = 'active';
}

if (isset($_GET['send'])) {

    $send = 'active';
}

if (isset($_GET['history'])) {

    $history = 'active';
}
