<?php
    session_start();
    $_SESSION['user_id'] = 0;
    $con=mysql_connect("localhost","root","PASSWORD");
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
<title>TraffX - Map</title>
<meta charset="utf-8">
<link href = style.css rel = "stylesheet">
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    var setting = "b1";
    $(document).ready(function(){
                      $("#map").click(function(){
                                      window.open ('index.html','_self',false)
                                      });
                      $("#settings").click(function(){
                                           window.open ('settings.html','_self',false)
                                           });
                      $("#matrix").click(function(){
                                         window.open ('matrix.html','_self',false)
                                         });
                      $("#logout").click(function(){
                                         window.open ('login.html','_self',false)
                                         });
                      <?php
                      $check = mysql_query("SELECT name FROM runs WHERE user_id='".$_SESSION['user_id']."'");
                      while($row = mysql_fetch_row($check))
                      {
                      echo("$(\"#".$row[0]."\").click(function(){setting = \"".$row[0]."\";alert('".$row[0]."');});");
                      }
                      ?>
                      $("#go").click(function(){
                                     alert("go");
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
        <canvas id = "canvas" width="600px" height="400px"></canvas>
        
        <script>
            var c = document.getElementById("canvas");
            var ctx = c.getContext("2d");
            ctx.fillStyle = "#FF0000";
            ctx.fillRect(0,0,600,400);
        </script>
      
      <center>
      <div id = "go">
          GO
      </div>
      </center>
</div>
<div id ="sidebar">
<?php
    $check = mysql_query("SELECT name FROM runs WHERE user_id='".$_SESSION['user_id']."'");
    while($row = mysql_fetch_row($check))
    {
        echo("<div class =\"config\" id=\"".$row[0]."\">".$row[0]."</div>");
    }
    ?>
</div>
<div id ="times">
    Start Time
    <br>
    <select>
        <script>
            for(test = 0;test < 24;test++)
            {
                if(test ==0)
                document.write("<option value='"+test+"'>"+12+":00AM</option>");
                else if(test < 12)
                document.write("<option value='"+test+"'>"+test+":00AM</option>");
                else if(test ==12)
                document.write("<option value='"+test+"'>"+12+":00PM</option>");
                else
                document.write("<option value='"+test+"'>"+(test-12)+":00PM</option>");
            }
        </script>
    </select>
    <br>
    End Time
    <br>
    <select>
        <script>
            for(test = 0;test < 24;test++)
            {
                if(test ==0)
                document.write("<option value='"+test+"'>"+12+":00AM</option>");
                else if(test < 12)
                    document.write("<option value='"+test+"'>"+test+":00AM</option>");
                    else if(test ==12)
                    document.write("<option value='"+test+"'>"+12+":00PM</option>");
                else
                    document.write("<option value='"+test+"'>"+(test-12)+":00PM</option>");
            }
        </script>
    </select>
</div>
<br>
</div>
</body>
</html>

