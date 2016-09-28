<html> 
	<head>
		<title>Check Access</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<script>
			function validateForm(myForm){
				if ((myForm.state.custom.value) && (myForm.customText.value=="")){
					alert ("No text in the custom form");
					myForm.custom.focus();
					return false;
				}
				return true;
			}
		</script>
	</head>
	<body>

	<div id="Border">
	<center>
		<br><hr><br>
		Click a button to do something:test2 <br>
		<?php
			if($_SESSION['on']==1234){
			session_start();
			$login=$_POST[login];
			$password=$_POST[password];
			$conf['server'] = 'localhost';
			$conf['db'] = 'AlertDB';
			$conf['user'] = 'AlertAdmin';
			$conf['pass'] = 'PointBoroAlert';
			$dbh = mysql_connect($conf['server'], $conf['user'], $conf['pass']);
			if(!$dbh){die("Cannot Connect to DB.");}
			$db = mysql_select_db($conf['db'], $dbh);
			if(!$db){die("Cannot Select DB");}
			$sql = "SELECT * FROM logins WHERE login = '$login'";
			$res = mysql_query($sql, $dbh);
			if(!$res){die("Account not found.");}
			if(mysql_num_rows($res)>0){
				$hit = 0;
				while($myrow = mysql_fetch_array($res)){
					$l = $myrow['login'];
					$p = $myrow['password'];
					$n = $myrow['name'];
					$hit++;
					if($password==$p){
						break;
					}
				}
			}
			else {die("Password Invalid.");}
			}
			echo ("<br>Welcome back, " . $n . ".<br>");
			$_SESSION['on']="1234";
		?>
		<form name="webForm" onsubmit="return validateForm(webForm);" action="login.php" target="_top" method="post">	
			<input type="radio" name="state" value="lockOn">Turn Lockdown On </input><br>
			<input type="radio" name="state" value="lockOff">Turn Lockdown Off </input><br>
			<input type="radio" name="state" value="normie">Return to normal state </input><br>
			<input type="radio" name="state" value="custom">Custom Message </input>
			<input type="text" name="customText"></input><br><br>
			<input type="submit" name="go" value="Send Alert"> </input>
		</form>
		<br><hr><br>
	</center>
	</div>
	</body>
</html>
