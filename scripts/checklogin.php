<?php
    session_start();
$username=$_POST['username'];
$password=$_POST['password'];
$con=mysql_connect("127.0.0.1","four","password");
if (!$con) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
else{
	if ( !mysql_select_db("477b"))
 	{
		echo "Can't connect to 477b";
	}
}
    $check = mysql_query("SELECT id FROM users WHERE token='".$username.$password."'");
if( mysql_num_rows($check)== 1)
    {
        $check = mysql_fetch_row($check);
        $_SESSION['user_id'] = $check[0];
    }
        header("location: ../index.php");
$result = mysql_query("SELECT * FROM users ")or die(mysql_error());
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
mysql_close();
?>


