<?php
    session_start();
    /*if(!isset($_SESSION['user_id']))
     header("location: login.php");
     if(!isset($_SESSION['selection']))
     $_SESSION['selection'] = 'Weekend';*/
    $_SESSION['user_id'] = 0;
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
<title>TraffX - Settings</title>
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
      <form action = "scripts/update.php" method = "post" id = "adjust" name = "adjust">
<?php
    $check = mysql_query("SELECT routing_type, max_freeway_speed, vehicle_is_truck_percent, vehicle_is_rideshare_percent, vehicle_use_mapping_software_percent FROM runs WHERE user_id='".$_SESSION['user_id']."' AND name = '".$_SESSION['selection']."'");
    $row = mysql_fetch_row($check)
    ?>
          <div width = "300px" style = "float:left;">
              <table>
                <tr>
              <td>Algorithm Type:</td>
<td><select name="algorithm">
                <?php
                    $lines = mysql_query("SELECT id, name FROM routing_types WHERE 1=1");
                    while($line = mysql_fetch_row($lines))
                    {
                        if($line[0] != $row[0])
                            echo("<option value=".$line[0].">".$line[1]."</option>");
                        else
                            echo("<option selected value=".$line[0].">".$line[1]."</option>");
                    }
                    ?>
              </select></td></tr>
                <tr>
                <td>Max Freeway Speed:</td>
    <td><input type="text" size="3" name = "max_speed" value = <?php echo("'".$row[1]."'"); ?> </input>MPH</td></tr>
<tr>
<td>Using Map Percentage:<br></td>
<td><input type="text" size="3" name = "map" value = <?php echo("'".$row[4]."'");?>></input>%</td></tr>
                </table>
              </div>
            <div width = "300px" style = "float:right;">
                <table>
                    <tr>
              <td>Truck Percentage:<br></td>
              <td><input type="text" size="3" name = "truck" value = <?php echo("'".$row[2]."'");?>></input>%</td></tr>
              <tr>
              <td>Rideshare Percentage:<br></td>
              <td><input type="text" size="3" name = "share" value = <?php echo("'".$row[3]."'");?>></input>%</td></tr>
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

