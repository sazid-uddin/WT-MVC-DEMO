<?php include 'views/layouts/header.php'; ?>

<div class="row justify-content-center">
	<div class="col-md-6 text-center">
		<div class="card">
			<div class="card-body py-5">
				<div class="mb-4">
					<i class="fas fa-server fa-4x text-danger"></i>
				</div>
				<h1 class="display-4 text-danger">500</h1>
				<h3 class="mb-4">Internal Server Error</h3>
				<p class="text-muted mb-4">
					Something went wrong on our servers. We're working to fix this issue.
					Please try again later.
				</p>
				<a href="/mvc/" class="btn btn-primary">
					<i class="fas fa-home"></i> Go Home
				</a>
			</div>
		</div>
	</div>
</div>

<?php include 'views/layouts/footer.php'; ?>