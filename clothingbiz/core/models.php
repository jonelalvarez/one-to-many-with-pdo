<?php

//function insertCustomer($pdo, $first_name, $last_name, $email, $contact_num, $product, $quantity) {
//    $sql = "INSERT INTO customers (first_name, last_name, email, contact_num, product, quantity) VALUES (?, ?, ?, ?, ?, ?)";
//    $stmt = $pdo->prepare($sql);
//    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $contact_num, $product, $quantity]);

//    if ($executeQuery) {
//		return true;
//	}
//}
function insertCustomer($pdo, $first_name, $last_name, $email, $contact_num, $product, $quantity) {
  // Insert the customer record
  $sql = "INSERT INTO customers (first_name, last_name, email, contact_num, product, quantity) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$first_name, $last_name, $email, $contact_num, $product, $quantity]);

  if ($executeQuery) {
      // Get the new customer's ID
      $customer_id = $pdo->lastInsertId();
      
      // Create the first order entry for the new customer
      insertOrder($pdo, $customer_id, date("Y-m-d"), $product, $quantity);
      return true;
  }
  return false;
}



function updateCustomer($pdo, $first_name, $last_name, $email, $contact_num, $product, $customer_id) {
    $sql = "UPDATE customers
            SET first_name = ?, last_name = ?, email = ?, contact_num = ?, product = ?
            WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $contact_num, $product, $customer_id]);

    if ($executeQuery) {
		return true;
	}}

function deleteCustomer($pdo, $customer_id) {
    $sql = "DELETE FROM customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);

    if ($executeQuery) {
		return true;
	}}
function deleteOrdersByCustomer($pdo, $customer_id) {
    $sql = "DELETE FROM orders WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$customer_id]);
}

function getAllCustomers($pdo) {
    $sql = "SELECT * FROM customers";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    
    if ($executeQuery) {
		return $stmt->fetchAll();
	}}

function getCustomerByID($pdo, $customer_id) {
    $sql = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);

    if ($executeQuery) {
		return $stmt->fetch();
	}
}




//function insertOrder($pdo, $customer_id, $order_date, $product, $quantity) {
//  $sql = "INSERT INTO orders (customer_id, order_date, product, quantity) VALUES (?, ?, ?, ?)";
//  $stmt = $pdo->prepare($sql);
//  $executeQuery = $stmt->execute([$customer_id, $order_date, $product, $quantity]);
//  if ($executeQuery) {
//		return true;
//	}
// }
function insertOrder($pdo, $customer_id, $order_date, $product, $quantity) {
  $sql = "INSERT INTO orders (customer_id, order_date, product, quantity) VALUES (?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute([$customer_id, $order_date, $product, $quantity]);

  return $executeQuery;
}


function getOrdersByCustomer($pdo, $customer_id) {
    $sql = "SELECT * FROM orders WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);

    if ($executeQuery) {
		return $stmt->fetchAll();
	}}

function getOrderByID($pdo, $order_id) {
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$order_id]);

    if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateOrder($pdo, $order_date, $quantity, $order_id) {
    $sql = "UPDATE orders
            SET order_date = ?, quantity = ?
            WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$order_date, $quantity, $order_id]);

    return $executeQuery;
}


function deleteOrder($pdo, $order_id) {
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$order_id]);

    if ($executeQuery) {
		return true;
	}
}

function getProductNameById($product) {
  $productNames = [
      1 => 'Plain White Shirt',
      2 => 'Black Polo Shirt',
      3 => 'White Shirt with G! Logo'
  ];
  
  return isset($productNames[$product]) ? $productNames[$product] : 'Unknown Product';
}


?>


