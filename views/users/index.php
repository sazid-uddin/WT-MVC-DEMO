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
					<i class="fas fa-users"></i> Users Management
				</h2>
				<a href="/mvc/create" class="btn btn-primary">
					<i class="fas fa-plus"></i> Add New User
				</a>
			</div>
			<div class="card-body">
				<?php if (empty($users)): ?>
					<div class="text-center py-5">
						<div class="mb-3">
							<i class="fas fa-users fa-3x text-muted"></i>
						</div>
						<h4 class="text-muted">No users found</h4>
						<p class="text-muted">Start by adding your first user to the system.</p>
						<a href="/mvc/create" class="btn btn-primary">
							<i class="fas fa-plus"></i> Add First User
						</a>
					</div>
				<?php else: ?>
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
							<tbody>
								<?php foreach ($users as $user): ?>
									<tr>
										<td>
											<span class="badge bg-secondary"><?php echo htmlspecialchars($user['id']); ?></span>
										</td>
										<td>
											<strong><?php echo htmlspecialchars($user['name']); ?></strong>
										</td>
										<td>
											<a href="mailto:<?php echo htmlspecialchars($user['email']); ?>"
												class="text-decoration-none">
												<?php echo htmlspecialchars($user['email']); ?>
											</a>
										</td>
										<td>
											<?php if (!empty($user['phone'])): ?>
												<a href="tel:<?php echo htmlspecialchars($user['phone']); ?>"
													class="text-decoration-none">
													<?php echo htmlspecialchars($user['phone']); ?>
												</a>
											<?php else: ?>
												<span class="text-muted">Not provided</span>
											<?php endif; ?>
										</td>
										<td>
											<small class="text-muted">
												<?php echo date('M j, Y \a\t g:i A', strtotime($user['created_at'])); ?>
											</small>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

					<div class="mt-3">
						<small class="text-muted">
							Total users: <strong><?php echo count($users); ?></strong>
						</small>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php include 'views/layouts/footer.php'; ?>