<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertCustomerBtn'])) {
	$query = insertCustomer($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact_num'], $_POST['product'], $_POST['quantity']);

	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Customer insertion failed";
	}
}


if (isset($_POST['editCustomerBtn'])) {
	$query = updateCustomer($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact_num'], $_POST['product'], $_GET['customer_id']);

	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Customer update failed";
	}
}



//if (isset($_POST['deleteCustomerBtn'])) {
//	$query = deleteCustomer($pdo, $_GET['customer_id']);
//
//	if ($query) {
//		header("Location: ../index.php");
//	} else {
//		echo "Customer deletion failed";
//	}
//}

if (isset($_POST['deleteCustomerBtn'])) {
    // First, delete the orders associated with the customer
    $customerID = $_GET['customer_id'];

    // Assuming you have a function to delete orders by customer ID
    $deleteOrders = deleteOrdersByCustomer($pdo, $customerID);

    // Now delete the customer
    $query = deleteCustomer($pdo, $customerID);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Customer deletion failed";
    }
}



//if (isset($_POST['insertOrderBtn'])) {
//	$customerID = $_GET['customer_id'];
//	$orderDate = $_POST['order_date'];
//	$productID = $_POST['product_id'];
//	$quantity = $_POST['quantity'];
//	
//	$query = insertOrder($pdo, $customerID, $orderDate, $productID, $quantity);
//
//	if ($query) {
//		header("Location: ../vieworders.php?customer_id=" . $customerID);
//	} else {
//		echo "Order insertion failed";
//	}
//}

if (isset($_POST['insertOrderBtn'])) {
	$customer_id = $_GET['customer_id'];
	$order_date = $_POST['order_date'];
	$product_id = $_POST['product'];
	$quantity = $_POST['quantity'];
	
	$query = insertOrder($pdo, $customer_id, $order_date, $product_id, $quantity);

	if ($query) {
		header("Location: ../vieworders.php?customer_id=" . $customer_id);
	} else {
		echo "Order insertion failed";
	}
}





if (isset($_POST['editOrderBtn'])) {
	$query = updateOrder($pdo, $_POST['order_date'], $_POST['quantity'], $_GET['order_id']);

	if ($query) {
		header("Location: ../vieworders.php?customer_id=" . $_GET['customer_id']);
	} else {
		echo "Order update failed";
	}
}





if (isset($_POST['deleteOrderBtn'])) {
	$query = deleteOrder($pdo, $_GET['order_id']);

	if ($query) {
		header("Location: ../vieworders.php?customer_id=" . $_GET['customer_id']);
	} else {
		echo "Order deletion failed";
	}
}




?>