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
                      $("#b1").click(function(){
                                     setting = "b1";
                                      });
                      $("#b2").click(function(){
                                     setting = "b2";
                                     });
                      $("#b3").click(function(){
                                     setting = "b3";
                                     });
                      $("#b4").click(function(){
                                     setting = "b4";
                                     });
                      $("#b5").click(function(){
                                     setting = "b5";
                                     });
                      $("#b6").click(function(){
                                     setting = "b6";
                                     });
                      $("#save").click(function(){
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
        <div style = "overflow:scroll;width:600px;height=400px">
        <table style="color:white;font-size:125%">
        <script>
            var size = 10;
            document.write("<tr><td width='50px'>Exit</td>");
            
            for(var i = 0; i < size;i++)
            {
                document.write("<td width='50px'>"+(i+1)+"</td>");
            }
        document.write("</tr>");
        for(var i = 0;i < size;i++)
        {
            document.write("<tr><td width = '50px'>"+(i+1)+"</td>");
            for(var j = 0;j < size;j++)
            {
                document.write("<td width = '50px'>");
                if(j != i)
                {
                    document.write("<input type = 'text' size = '3' id = '"+i+"-"+j+"'>");
                }
                document.write("</td>");
            }
            document.write("</tr>");
        }
        </script>
        </table>
        </div>
      <center>
      <div id = "go">
          SAVE
      </div>
      </center>
</div>
<div id ="sidebar">
<div class ="config" id="b1">Weekday</div>
<div class ="config" id="b2">Weekend</div>
<div class ="config" id="b3">Dodgers Game</div>
<div class ="config" id="b4">Presidential Motorcade</div>
<div class ="config" id="b5">Black Friday</div>
<div class ="config" id="b6">Evacuation</div>
</div>

<br>
</div>
</body>
</html>

