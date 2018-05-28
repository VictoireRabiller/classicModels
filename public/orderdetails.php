<?php
include '../bootstrap.php';

$orderNumber = $_GET['orderNumber'];
$order = getAnOrder($orderNumber);
$customerId = $order['customerNumber'];





$customer = getCustomerbyOrderNumber($orderNumber); 

// pre($customer);
// exit;


$orderDetails = getOrderDetails($order);

// pre($orderDetails);
// exit;

$totalHT = getMontantTotalHT($order);
pre($totalHT);
exit;



include '../views/orderdetails.phtml';
