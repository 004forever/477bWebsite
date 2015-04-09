<?php
    session_start();
    if(!isset($_SESSION['user_id']))
                        header("location: login.php");
    if(!isset($_SESSION['selection']))
        $_SESSION['selection'] = 'Weekend';
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
<script src = "https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<title>TraffX - Map</title>
<meta charset="utf-8">
<link href = style.css rel = "stylesheet">
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    var setting = "b1";
    $(document).ready(function(){
                      $("#map").click(function(){
                                      window.open ('index.php','_self',false)
                                      });
                      $("#settings").click(function(){
                                           window.open ('settings.php','_self',false)
                                           });
                      $("#matrix").click(function(){
                                         window.open ('matrix.php','_self',false)
                                         });
                      $("#logout").click(function(){
                                         window.open ('scripts/logout.php','_self',false)
                                         });
                      <?php
                      $check = mysql_query("SELECT name FROM runs WHERE user_id='".$_SESSION['user_id']."'");
                      while($row = mysql_fetch_row($check))
                      {
                      echo("$(\"#".$row[0]."\").click(function(){setting = \"".$row[0]."\";window.open (\"scripts/switch.php?selection=".$row[0]."&last=index\",'_self',false);});");
                      }
                      ?>
                      $("#go").click(function(){
                                     document.adjust.submit();
                        });
                      $("#add").click(function(){
                                     document.adder.submit();
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
        
        <script src = "scripts/canvas.js">
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
        if($row[0] != $_SESSION['selection'])
            echo("<div class =\"config\" id=\"".$row[0]."\">".$row[0]."</div>");
        else
            echo("<div class =\"config\" id=\"".$row[0]."\"style = \"background-color:orange\">".$row[0]."</div>");
    }
    ?>
</div>
<form action = "scripts/addRun.php" method = "post" name = "adder" id="adder">
<input type = text style="width:290px;height:30px;background-color:black;color:white;font-size:75%" name = "name">
<div id = "add">
ADD
</div>
</form>
    <form action = "analyzer/losangeles.php" method = "post" name = "adjust">
    <table id ="times">
    <tr>
    <td>Start Time</td>
    <td>
    <select name = "start">
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
    </td></tr>
    <tr>
    <td>End Time</td>
    <td>
    <select name = "end">
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
    </td></tr>
    </table>
    </form>
<br>
</div>
</body>
</html>

