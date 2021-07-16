<?php
	
	$user = $_POST["username"];
	$pass = $_POST["password"];
	$validated = false;
	
	// the error handler
	function customError($errno, $errstr)
	{
		echo "<b>Error:</b> [$errno] $errstr<br />";
		echo "The error has been logged.";
		error_log(date (DATE_RSS)." Error: [$errno]
			$errstr".chr(13).chr(10),3, "invalidlogin.txt");
	}

	// setting the error handler
	set_error_handler("customerError",E_USER_WARNING);
	
	session_start();
	$_SESSION('login') = "";
	if($user!="" && $pass!="")
	{
		$conn = @mysql_connect ("studentnn.computing.hct.ac.uk", 	"studentnn", "password") or die ("Sorry - unable to 	connect to MySQL database.");
    $rs = @mysql_select_db ("database", $conn) or die ("error");
    $sql = "SELECT * FROM user WHERE username = '$user' AND 	password = '$pass'";
    $rs = mysql_query($sql,$conn);
    $result = mysql_num_rows($rs);
	if ($result > 0) $validated = true;
		if($validated)
		{
			$_SESSION['login'] = "OK";
			$_SESSION['username'] = $user;
			$_SESSION['password'] = $pass;
			header('Location: protected1.php');
		}
		else
		{
			$_SESSION['login'] = "";
			trigger_error("Invalid username or password\n", E_USER_WARNING);
		}
}
else $_SESSION['login'] = "";
?>
<html>
  <body>
    <h1>Logon Page</h1>
    <p>Please enter your username and password:</p>
    <form action="logon.php" method="post">
      <table>
        <tr>
          <td align="right">Username: </td>
          <td><input size=\"20\" type="text" size="20" maxlength="15" 	name="username"></td>
        </tr>
        <tr>
          <td align="right">Password: </td>
          <td><input size=\"20\" type="password" size="20" maxlength="15" name="password"></td>
        </tr>
		<tr>
          <td> </td>
          <td colspan="2" align="left"><input type="submit" value="Login"></td>
        </tr>
      </table>
    </form>
  </body>
</html>

 if ($result > 0) $validated = true;
    if($validated)
    {
      $_SESSION['login'] = "OK";
      $_SESSION['username'] = $user;
      $_SESSION['password'] = $pass;
	  $ip = $_SERVER["REMOTE_ADDR"];
	  $date = date(“d-m-Y H:i:s");
	  $file = 'login.txt';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= "$user logged in from IP Address of $ip on $date"."\r\n";
		// Write the contents back to the file
		file_put_contents($file, $current);
      header('Location: protected1.php');
    }