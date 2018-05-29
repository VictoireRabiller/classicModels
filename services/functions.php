<?php

function getDb (){
	$user = 'root';
	$password = 'troiswa';
	$db =new PDO('mysql:host=localhost;dbname=classicmodels', $user, $password);
	$db->exec('SET NAMES UTF8');
	return $db;
}


function getOrders (){
	$db = getDb();
	$sql = "SELECT orderNumber, orderDate, shippedDate, status 
	FROM orders
	ORDER BY orderNumber DESC";

	$statement = $db->prepare($sql);

	$statement->execute();
	$orders = $statement->fetchAll(\PDO::FETCH_ASSOC);
	return $orders;

}

function getAnOrder ($orderNumber){
	$db = getDb();
	$orderId = $_GET['orderNumber'];
	$sql = "SELECT *
	FROM orders
	WHERE orderNumber = $orderId";

	$statement = $db->prepare($sql);

	$statement->execute();
	$order = $statement->fetch(\PDO::FETCH_ASSOC);
	return $order;
	// pre($order);
	// exit;
}


function getCustomerbyOrderNumber($orderNumber){
	$db = getDb();
	// $sql = "SELECT customerNumber, customerName, contactLastName, contactFirstName, addressLine1, city FROM customers ";
	$orderNumber = $_GET['orderNumber'];
	$order = getAnOrder($orderNumber);
	$customerId = $order['customerNumber'];
	$sql = "SELECT * FROM customers WHERE customerNumber = $customerId";
	$statement = $db->prepare($sql);
	$statement->execute();
	$customer = $statement->fetch(\PDO::FETCH_ASSOC);
	// pre($customer);
	// exit;
	return $customer;
}



function getOrderDetails($orderNumber){
	$db = getDb();
	$orderId =$_GET['orderNumber'];
	$sql = "SELECT orderNumber,products.productName, priceEach, quantityOrdered, (quantityOrdered*priceEach) AS prixTotal 
		FROM orderdetails
		JOIN products ON products.productCode = orderdetails.productCode
		WHERE orderNumber = $orderId";

	$statement = $db->prepare($sql);

	$statement->execute();
	$orderDetails = $statement->fetchAll(\PDO::FETCH_ASSOC);
	return $orderDetails;

}


// function getMontantTotalHT($orderNumber){
// 	$db = getDb();
// 	$orderId =$_GET['orderNumber'];
// 	$sql = "SELECT SUM(quantityOrdered*priceEach) AS montantTotalHT FROM orderdetails GROUP BY orderNumber = $orderId";

// 	$statement = $db->prepare($sql);

// 	$statement->execute();
// 	$montantTotalHT = $statement->fetchAll(\PDO::FETCH_ASSOC);
	
// 	return $montantTotalHT;

// }



