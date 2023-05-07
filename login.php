<?php
	session_start();
	include "db-connection.php";

		if (isset($_POST['username']) && isset($_POST['password'])  )
		{

			$username = $_POST['username'];
			$password = $_POST['password'];

		
			// assume $conn is a MySQLi object connected to your database
			$result = $conn->query("SELECT * FROM users WHERE username='$username' and password ='$password'");

			if (mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if ($row['username'] === $username && $row['password'] === $password ) 
				{
					$_SESSION['username'] = $row['username'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['token'] = $row['code'];
					$_SESSION['role'] = $row['role'];
					header("Location: index.php");
					exit();
				}
				else
				{
					header("Location: loginForm.php?error=Incorrect User name or password");
					exit();
				}
			}
			else
			{
				header("Location: loginForm.php?error=Incorect User name or password");
				exit();
			}
		}


	
?>