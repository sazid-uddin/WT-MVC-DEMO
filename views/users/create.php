<?php include 'views/layouts/header.php'; ?>

<div class="row justify-content-center">
	<div class="col-md-8 col-lg-6">
		<div class="card">
			<div class="card-header">
				<h2 class="card-title mb-0">
					<i class="fas fa-user-plus"></i> Create New User
				</h2>
			</div>
			<div class="card-body">
				<?php if (isset($errors['general'])): ?>
					<div class="alert alert-danger">
						<?php echo htmlspecialchars($errors['general']); ?>
					</div>
				<?php endif; ?>

				<form method="POST" action="/mvc/store" novalidate>
					<div class="mb-3">
						<label for="name" class="form-label">
							Full Name <span class="text-danger">*</span>
						</label>
						<input type="text"
							class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name"
							name="name" value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>"
							placeholder="Enter full name" required>
						<?php if (isset($errors['name'])): ?>
							<div class="invalid-feedback">
								<?php echo htmlspecialchars($errors['name']); ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="mb-3">
						<label for="email" class="form-label">
							Email Address <span class="text-danger">*</span>
						</label>
						<input type="email"
							class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email"
							name="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>"
							placeholder="Enter email address" required>
						<?php if (isset($errors['email'])): ?>
							<div class="invalid-feedback">
								<?php echo htmlspecialchars($errors['email']); ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="mb-3">
						<label for="phone" class="form-label">
							Phone Number <span class="text-muted">(Optional)</span>
						</label>
						<input type="tel"
							class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>" id="phone"
							name="phone" value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>"
							placeholder="Enter phone number">
						<?php if (isset($errors['phone'])): ?>
							<div class="invalid-feedback">
								<?php echo htmlspecialchars($errors['phone']); ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
						<a href="/mvc/" class="btn btn-secondary">
							<i class="fas fa-arrow-left"></i> Back to List
						</a>
						<button type="submit" class="btn btn-primary">
							<i class="fas fa-save"></i> Create User
						</button>
					</div>
				</form>
			</div>
		</div>

		<div class="mt-3">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title">
						<i class="fas fa-info-circle text-info"></i> Information
					</h6>
					<ul class="mb-0 small text-muted">
						<li>Fields marked with <span class="text-danger">*</span> are required</li>
						<li>Email addresses must be unique in the system</li>
						<li>Phone number is optional but will be validated if provided</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'views/layouts/footer.php'; ?>