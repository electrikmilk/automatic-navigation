<?php

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width">

	<title>My Website</title>

	<link rel="stylesheet" href="/style.css"/>

</head>
<body>

<header>
	<nav>
		<?php include_once 'navigation.php'; ?>
	</nav>
</header>
<section>
	<?php
	$path = "Home.php";
	$query = str_replace("-"," ",$_GET['query']);
	if (isset($_GET['query'])) {
		if (file_exists("content/$query.php")) {
			$path = "$query.php";
		} elseif (file_exists("content/$query.html")) {
			$path = "$query.html";
		}
	}
	if (file_exists("content/$path")) {
		include_once "content/$path";
	} else {
		include_once '404.php';
	}
	?>
</section>

</body>
</html>
