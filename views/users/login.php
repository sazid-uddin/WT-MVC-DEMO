<?php include 'views/layouts/header.php'; ?>

<?php
// Start session to display success messages
session_start();
if (isset($_SESSION['success'])): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?php echo htmlspecialchars($_SESSION['success']); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
	<?php unset($_SESSION['success']); ?>
<?php endif; ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h2 class="card-title mb-0">
					<i class="fas fa-users"></i> Login
				</h2>
				<a href="/mvc/" class="btn btn-primary">
					<i class="fas fa-plus"></i> View Users
				</a>
			</div>
			<div class="card-body">
				<form method="POST" action="/mvc/authenticate" novalidate>
					<div class="mb-3">
						<label for="email" class="form-label">Email address</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<div class="mb-3">
						<?php if (isset($error)): ?>
							<div class="alert alert-danger">
								<?php echo htmlspecialchars($error); ?>
							</div>
						<?php endif; ?>
					</div>
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include 'views/layouts/footer.php'; ?>