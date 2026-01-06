<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MVC User Management Demo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-color: #f8f9fa;
		}

		.navbar {
			box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
		}

		.card {
			box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
			border: 1px solid rgba(0, 0, 0, 0.125);
		}

		.table-responsive {
			border-radius: 0.375rem;
			overflow: hidden;
		}

		.btn {
			border-radius: 0.375rem;
		}

		.alert {
			border-radius: 0.375rem;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="/mvc/">
				<strong>MVC Demo</strong>
			</a>
			<div class="navbar-nav ms-auto">
				<a class="nav-link" href="/mvc/">Users List</a>
				<a class="nav-link" href="/mvc/create">Add User</a>
				<a class="nav-link" href="/mvc/login">Login</a>
			</div>
		</div>
	</nav>

	<div class="container mt-4">