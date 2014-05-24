<?php 
function checkLogin($u, $p)
{
	return  ($u==$p);
}

if (isset($_POST['username']) && isset($_POST['password']))
{
	if (checkLogin($_POST['username'], $_POST['password']))
	{
		$_SESSION['user'] = $_POST['username'];
		header("Location: /hackathon/index.php");
	}
	else {
		//login ko
	}
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Facebook Integration WorkFlow</title>
<link href="css/footable.core.css" rel="stylesheet" type="text/css" />
<link href="css/footable.metro.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="js/footable.js" type="text/javascript"></script>
<script src="js/footable.paginate.js" type="text/javascript"></script></head>
</head>
<body><h2 class="fiwf">Facebook Realtime Integration Workflow</h2>
<form action="" method="POST">
<table class="footable" style="width: 200px">
	<thead>
		<tr>
			<th>Username</th>
			<th>Password</th>
			<th></th>
			</tr>
	</thead>
	<tbody>
		<tr>
			<th><input type="text" name="username" value="" /></th>
			<th><input type="password" name="password" value="" /></th>
			<th><input type="submit" name="login" value="login" /></th>
			</tr>
	
	</tbody>
</table>
	
</form>
</body>
</html>