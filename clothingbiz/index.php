<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gnarly! Clothing Shop</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

	<div class="container mt-5">
		<h1 class="text-center">
			Welcome To <span style="color: yellow;">Gnarly!</span> Clothing Shop!
		</h1>

		<div class="card col-md-8 mx-auto mt-4" style="border-color:yellow">
			<div class="card-header" style="background-color: black; color: yellow;">
				<h5>Add New Customer</h5>
			</div>
			<div class="card-body">
				<form action="core/handleForms.php" method="POST">
					<div class="mb-3">
						<label for="firstName" class="form-label">First Name</label> 
						<input type="text" class="form-control" name="first_name" required>
					</div>
					<div class="mb-3">
						<label for="lastName" class="form-label">Last Name</label> 
						<input type="text" class="form-control" name="last_name" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label> 
						<input type="email" class="form-control" name="email">
					</div>
					<div class="mb-3">
						<label for="contactNum" class="form-label">Contact Number</label> 
						<input type="text" class="form-control" name="contact_num">
					</div>
					<div class="mb-3">
						<label for="product" class="form-label">Product</label> 											
						<select class="form-control select2" name="product" required>
							<option value="--">--</option>
							<option value="1">Plain White Shirt</option>
							<option value="2">Black Polo Shirt</option>
							<option value="3">White Shirt with G! Logo</option>
						</select>
					</div>

					<div class="mb-3">
						<label for="quantity" class="form-label">Quantity</label> 
						<input type="number" class="form-control" name="quantity" min="1" required>
					</div>
					<div class="mt-4 d-grid">
						<input type="submit" class="btn" style="background-color:black; color: yellow" name="insertCustomerBtn" value="Add Customer">
					</div>
				</form>
			</div>
		</div>

		<?php
		$productNames = [
			1 => 'Plain White Shirt',
			2 => 'Black Polo Shirt',
			3 => 'White Shirt with G! Logo'
		];
		?>

		<?php $getAllCustomers = getAllCustomers($pdo); ?>
		<?php foreach ($getAllCustomers as $row) { ?>
		<div class="card mt-4 mx-auto mb-3" style="width: 100%; border-color:yellow">
			<div class="card-body">
				<h5 class="card-title">First Name: <?php echo ($row['first_name']); ?></h5>
				<h5 class="card-title">Last Name: <?php echo ($row['last_name']); ?></h5>
				<h5 class="card-title">Email: <?php echo ($row['email']); ?></h5>
				<h5 class="card-title">Contact Number: <?php echo ($row['contact_num']); ?></h5>
				<h5 class="card-title">Product: <?php echo $productNames[$row['product']]; ?></h5>
				<h5 class="card-title">Quantity: <?php echo ($row['quantity']); ?></h5>
				<h5 class="card-title">Date Added: <?php echo ($row['date_added']); ?></h5>
				<div class="d-flex justify-content-end">
					<a href="vieworders.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-sm me-2" style="background-color:black; color: yellow">View Orders</a>
					<a href="editcustomer.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-sm me-2" style="background-color:black; color: yellow">Edit</a>
					<a href="deletecustomer.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-sm" style="background-color:black; color: yellow">Delete</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>


	

</body>
</html>
