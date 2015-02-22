<?php
    session_start();
    $error = "";
    $name = $_POST['name'];
    
$con=mysql_connect("127.0.0.1","root","PASSWORD");
if (!$con) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
else{
	if ( !mysql_select_db("477b"))
 	{
		echo "Can't connect to 477b";
	}
    mysql_query("INSERT into runs (user_id, name) VALUES (".$_SESSION['user_id'].",'".$name."')");
$result = mysql_query("SELECT * FROM runs ")or die(mysql_error());
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
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


