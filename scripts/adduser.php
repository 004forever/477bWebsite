<?php
    session_start();
    $error = "";
    $username = $_POST['username'];
    $pass1 = $_POST['password'];
    $pass2 = $_POST['password2'];
    
$con=mysql_connect("127.0.0.1","root","PASSWORD");
if (!$con) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
else{
	if ( !mysql_select_db("477b"))
 	{
		echo "Can't connect to 477b";
	}
    

if($pass1 != $pass2)
{
    if($error != "")
    {
        $error = $error."  ";
    }
    $error = $error."Passwords don't match.";
}
if($error == "")
{
    mysql_query("INSERT into users (token) VALUES ('".$username.$pass1."')");
}
$result = mysql_query("SELECT * FROM users ")or die(mysql_error());
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
    if($error != "")
    {
        echo "<script type='text/javascript'>alert('".$error."');history.back();</script>";
    }
    else
    {
        $check = mysql_query("SELECT id FROM users WHERE token='".$username.$pass1."'");
        mysql_close();
        if( mysql_num_rows($check)== 1)
        {
            $check = mysql_fetch_row($check);
            $_SESSION['user_id'] = $check[0];
        }
        header("location: ../index.php");
    }
}
?>


