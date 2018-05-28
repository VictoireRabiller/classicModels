<?php
include '../bootstrap.php';

$ordersList = getOrders();
// pre($ordersList);

include '../views/orders.phtml';