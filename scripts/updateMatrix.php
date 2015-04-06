<?php
    session_start();
    $entry = "";
    $user = $_SESSION['user_id'];
    $selection = $_SESSION['selection'];
    $name;
    for($i = 0;$i <= 66;$i++)
    {
        for($j = 0;$j <= 66;$j++)
        {
            if($i != $j)
            {
                $name = "".$i."-".$j;
                $entry="".$entry."&".$name."=".$_POST[$name];
            }
        }
    }
    
$con=mysql_connect("127.0.0.1","four","password");
if (!$con) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
else{
	if ( !mysql_select_db("477b"))
 	{
		echo "Can't connect to 477b";
	}
    $request = mysql_query("UPDATE runs SET matrix = '".$entry."' WHERE user_id = ".$user." AND name = '".$selection."';");
    
mysql_close();
            header("location: ../matrix.php");
}
?>


