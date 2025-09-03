<?php include 'views/layouts/header.php'; ?>

<div class="row justify-content-center">
	<div class="col-md-6 text-center">
		<div class="card">
			<div class="card-body py-5">
				<div class="mb-4">
					<i class="fas fa-exclamation-triangle fa-4x text-warning"></i>
				</div>
				<h1 class="display-4 text-danger">404</h1>
				<h3 class="mb-4">Page Not Found</h3>
				<p class="text-muted mb-4">
					The page you are looking for might have been removed,
					had its name changed, or is temporarily unavailable.
				</p>
				<a href="/mvc/" class="btn btn-primary">
					<i class="fas fa-home"></i> Go Home
				</a>
			</div>
		</div>
	</div>
</div>

<?php include 'views/layouts/footer.php'; ?>