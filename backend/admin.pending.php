<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Brandpools</title>
		<link href="vendors/css/bootstrap.min.css" rel="stylesheet">
		<style>
			body {
				background : #f2fafb;
			}

			.logo {
				display:block;
				margin: 50px auto 100px auto;
			}

			input[type="submit"] {
				background : #f7941e;
				border-color : #f7941e;
			}

			div.links {
				text-align : center;
			}

			button { 
				color : #36363b;
				background : transparent;
				border : none;
				font-size : 20px;
			}

			h2 {
				text-align : center;
			}
		</style>
	</head>
	<body>
		<?php UX_ProceedErrors(); ?>
		
		<img class="logo" src="images/logo.png" />

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4" style="padding:15px">
					<h2>Your account is waiting for validation</h2>
					<div class="links">
						<a href="admin.logout.php" class="signup">Try again</a>
					</div>
				</div>
			</div>
		</div>
		<script src="vendors/js/jquery-2.1.1.min.js"></script>
		<script src="vendors/js/bootstrap.min.js"></script>
	</body>
</html>

<?php shutdown(); ?>