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
<script src="views/users/user-api.js"></script>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h2 class="card-title mb-0">
					<i class="fas fa-users"></i> Users Management
				</h2>
				<a href="/mvc/create" class="btn btn-primary">
					<i class="fas fa-plus"></i> Add New User
				</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead class="table-dark">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Created At</th>
							</tr>
						</thead>
						<tbody id="users-table-body">
							<tr>
								<td colspan="5" class="text-center">
									<div class="spinner-border spinner-border-sm" role="status">
										<span class="visually-hidden">Loading...</span>
									</div>
									<span class="ms-2">Loading users...</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="mt-3">
					<small class="text-muted" id="users-count">
						Total users: <strong>0</strong>
					</small>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'views/layouts/footer.php'; ?>