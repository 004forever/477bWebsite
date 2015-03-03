<?php
    session_start();
    $_SESSION['user_id'] = 0;
    $con=mysql_connect("localhost","four","password");
    if (!$con) {
        die('Could not connect to MySQL: ' . mysql_error());
    }
    else{
        if ( !mysql_select_db("477b"))
        {
            echo "Can't connect to 477b";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>TraffX - Matrix</title>
<meta charset="utf-8">
<link href = style.css rel = "stylesheet">
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    var setting = "b1";
    $(document).ready(function(){
                          $("#map").click(function(){
                                          window.open ('index.php','_self',false);
                                       });
                          $("#settings").click(function(){
                                               window.open ('settings.php','_self',false);
                                          });
                            $("#matrix").click(function(){
                                               window.open ('matrix.php','_self',false);
                                      });
                      $("#logout").click(function(){
                                         window.open ('scripts/logout.php','_self',false)
                                         });
                      <?php
                      $check = mysql_query("SELECT name FROM runs WHERE user_id='".$_SESSION['user_id']."'");
                      while($row = mysql_fetch_row($check))
                      {
                      echo("$(\"#".$row[0]."\").click(function(){setting = \"".$row[0]."\";window.open (\"scripts/switch.php?selection=".$row[0]."&last=settings\",'_self',false);});");
                      }
                      ?>
                      $("#go").click(function(){
                                       document.adjust.submit();
                                     });
    });
                                          
</script>
    
    
</head>
<body>
 <div id="nav">
      <img src = "logo.gif" width = "250px" style="margin-left:50px;float:right;"/>
      <div id ="buttons">
          <div class="tabs" id="map">Map</div>
<div class="tabs" id = "settings">Settings</div>
<div class="tabs" id = "matrix">Matrix</div>
<div class="tabs" id = "logout">Log Out</div>
</div>
</div>
 <div id="master">
<div id="content">
        <div style = "overflow:scroll;width:600px;height=400px">
          <form action = "scripts/updateMatrix.php" method = "post" name = "adjust">
        <table style="color:white;font-size:125%">


        <?php
            echo ("SELECT matrix FROM runs WHERE user_id='".$_SESSION['user_id']."' AND name = '".$_SESSION['selection']."'");
            $check = mysql_query("SELECT matrix FROM runs WHERE user_id='".$_SESSION['user_id']."' AND name = '".$_SESSION['selection']."'");
            $row = mysql_fetch_row($check);
            parse_str($row[0], $elements);
            $size = 10;
            echo("<tr><td width='50px'>Exit</td>");
            for($i = 0; $i < $size;$i++)
            {
                echo("<td width='50px'>".($i+1)."</td>");
            }
            echo("</tr>");
            for($i = 1;$i <= 10;$i++)
            {
                echo ("<tr><td width = '50px'>".($i+1)."</td>");
                for($j = 1;$j <= 10;$j++)
                {
                     echo("<td width = '50px'>");
                    if($j != $i)
                    {
                        echo("<input type = 'text' size = '3' name = '".$i."-".$j."' value = ".$elements["".$i."-".$j].">");
                    }
                    echo("</td>");
                }
                echo("</tr>");
            }
            ?>

        </table>
</form>
        </div>
      <center>
      <div id = "go">
          SAVE
      </div>
      </center>
</div>
<div id ="sidebar">
<?php
    $check = mysql_query("SELECT name FROM runs WHERE user_id='".$_SESSION['user_id']."'");
    while($row = mysql_fetch_row($check))
    {
        if($row[0] != $_SESSION['selection'])
            echo("<div class =\"config\" id=\"".$row[0]."\">".$row[0]."</div>");
        else
            echo("<div class =\"config\" id=\"".$row[0]."\"style = \"background-color:orange\">".$row[0]."</div>");
    }
    ?>
</div>

<br>
</div>
</body>
</html>

