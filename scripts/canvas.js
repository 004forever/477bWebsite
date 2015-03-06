var c = document.getElementById("canvas");
var ctx = c.getContext("2d");
var x = c.width/2;
var y = c.height/2;
var scale = 1;
var min = 1;
var max = 6;

//drag variables
var clickDown = false;
var startX = 0;
var startY = 0;
var orgX = 0;
var orgY = 0;

//scroll variables
var dim = 20;
var scrollDown = false;
var barX = canvas.width-dim*2;
var barY = dim;
var barW = dim/2;
var barH = canvas.height-2*dim;
var centerX = barX+barW/2;
var centerY = barY +barH*scale;
var radius = 20;
var timeScale = 0;

//time variables
var timeDown = false;
var timeX = dim;
var timeY = canvas.height-dim*2;
var timeW = canvas.width-4*dim;
var timeH = dim/2;
var centerTimeX = timeX+timeW*timeScale;
var centerTimeY = timeY +timeH/2;

    var exits = [];
    var paths = [];
paths[0] = {a: 0, b: 1};

exits[0] = {x:-284,y:-52,exit:true};
exits[1] = {x:-237,y:-59,exit:true};
exits[2] = {x:-222,y:-59,exit:true};
exits[3] = {x:-190,y:-60,exit:true};
exits[4] = {x:-158,y:-62,exit:true};
exits[5] = {x:-101,y:-65,exit:false};
exits[6] = {x:-101,y:-75,exit:true};
exits[7] = {x:-92,y:-88,exit:true};
exits[8] = {x:-77,y:-97,exit:true};
exits[9] = {x:-29,y:-146,exit:false};
exits[10] = {x:-6,y:-155,exit:true};
exits[11] = {x:8,y:-166,exit:true};
exits[12] = {x:23,y:-186,exit:true};
exits[13] = {x:-132,y:-191,exit:true};
exits[14] = {x:-73,y:-168,exit:true};
exits[15] = {x:-118,y:172,exit:true};
exits[16] = {x:-117,y:121,exit:true};
exits[17] = {x:-116,y:98,exit:true};
exits[18] = {x:-117,y:57,exit:true};
exits[19] = {x:-118,y:33,exit:true};
exits[20] = {x:-118,y:11,exit:true};
exits[21] = {x:-118,y:0,exit:true};
exits[22] = {x:-104,y:-21,exit:true};
exits[23] = {x:209,y:141,exit:true};
exits[24] = {x:183,y:72,exit:true};
exits[25] = {x:188,y:60,exit:true};
exits[26] = {x:194,y:39,exit:true};
exits[27] = {x:194,y:3,exit:false};
exits[28] = {x:184,y:2,exit:true};
exits[29] = {x:143,y:-6,exit:true};
exits[30] = {x:130,y:-10,exit:true};
exits[31] = {x:103,y:-24,exit:true};
exits[32] = {x:75,y:-34,exit:false};
exits[33] = {x:35,y:-34,exit:false};
exits[34] = {x:9,y:-25,exit:true};
exits[35] = {x:-46,y:-36,exit:true};
exits[36] = {x:55,y:-52,exit:false};
exits[37] = {x:55,y:-87,exit:true};
exits[38] = {x:51,y:-102,exit:true};
exits[39] = {x:29,y:-112,exit:true};
exits[40] = {x:18,y:-114,exit:true};
exits[41] = {x:-5,y:-122,exit:true};
exits[42] = {x:76,y:-119,exit:false};
exits[43] = {x:72,y:-135,exit:true};
exits[44] = {x:71,y:-145,exit:true};
exits[45] = {x:68,y:-162,exit:true};
exits[46] = {x:61,y:-171,exit:true};
exits[47] = {x:60,y:-179,exit:true};
exits[48] = {x:271,y:-170,exit:true};
exits[49] = {x:261,y:-163,exit:true};
exits[50] = {x:233,y:-148,exit:true};
exits[51] = {x:216,y:-140,exit:false};
exits[52] = {x:185,y:-131,exit:true};
exits[53] = {x:173,y:-125,exit:true};
exits[54] = {x:158,y:-116,exit:true};
exits[55] = {x:123,y:-122,exit:true};
exits[56] = {x:268,y:61,exit:true};
exits[57] = {x:245,y:34,exit:true};
exits[58] = {x:220,y:17,exit:true};
exits[59] = {x:206,y:9,exit:true};
exits[60] = {x:202,y:-75,exit:true};
exits[61] = {x:202,y:-56,exit:false};
exits[62] = {x:273,y:-50,exit:true};
exits[63] = {x:157,y:-44,exit:true};
exits[64] = {x:145,y:-44,exit:true};



paths[0] = {a:0,b:1};
paths[1] = {a:1,b:2};
paths[2] = {a:2,b:3};
paths[3] = {a:3,b:4};
paths[4] = {a:4,b:5};
paths[5] = {a:5,b:6};
paths[6] = {a:6,b:7};
paths[7] = {a:7,b:8};
paths[8] = {a:8,b:9};
paths[9] = {a:9,b:10};
paths[10] = {a:10,b:11};
paths[11] = {a:11,b:12};
paths[12] = {a:13,b:14};
paths[13] = {a:14,b:9};
paths[14] = {a:15,b:16};
paths[15] = {a:16,b:17};
paths[16] = {a:17,b:18};
paths[17] = {a:18,b:19};
paths[18] = {a:19,b:20};
paths[19] = {a:20,b:21};
paths[20] = {a:21,b:22};
paths[21] = {a:22,b:5};
paths[22] = {a:23,b:24};
paths[23] = {a:24,b:25};
paths[24] = {a:25,b:26};
paths[25] = {a:26,b:27};
paths[26] = {a:27,b:28};
paths[27] = {a:28,b:29};
paths[28] = {a:29,b:30};
paths[29] = {a:30,b:31};
paths[30] = {a:31,b:32};
paths[31] = {a:32,b:33};
paths[32] = {a:33,b:34};
paths[33] = {a:34,b:35};
paths[34] = {a:35,b:5};
paths[35] = {a:36,b:37};
paths[36] = {a:37,b:38};
paths[37] = {a:38,b:39};
paths[38] = {a:39,b:40};
paths[39] = {a:40,b:41};
paths[40] = {a:41,b:9};
paths[41] = {a:33,b:36};
paths[42] = {a:32, b:36};
paths[43] = {a:42, b:43};
paths[44] = {a:43, b:44};
paths[45] = {a:44, b:45};
paths[46] = {a:45, b:46};
paths[47] = {a:46, b:47};
paths[48] = {a:42, b:40};
paths[49] = {a:36, b:42};
paths[50] = {a:48, b:49};
paths[51] = {a:49, b:50};
paths[52] = {a:50, b:51};
paths[53] = {a:51, b:52};
paths[54] = {a:52, b:53};
paths[55] = {a:53, b:54};
paths[56] = {a:54, b:55};
paths[57] = {a:55, b:42};
paths[58] = {a:56, b:57};
paths[59] = {a:57, b:58};
paths[60] = {a:58, b:59};
paths[61] = {a:59, b:27};
paths[62] = {a:60, b:61};
paths[63] = {a:61, b:62};
paths[64] = {a:60, b:51};
paths[65] = {a:61, b:27};
paths[66] = {a:63, b:61};
paths[67] = {a:63, b:64};
paths[68] = {a:64, b:32};


function downClick(event)
{
    if((event.x-canvas.offsetLeft-centerX)*
       (event.x-canvas.offsetLeft-centerX)+
       (event.y-canvas.offsetTop-centerY)*
       (event.y-canvas.offsetTop-centerY) <radius*radius)
    {
        scrollDown = true;
    }
    else if((event.x-canvas.offsetLeft-centerTimeX)*
       (event.x-canvas.offsetLeft-centerTimeX)+
       (event.y-canvas.offsetTop-centerTimeY)*
       (event.y-canvas.offsetTop-centerTimeY) <radius*radius)
    {
        timeDown = true;
    }
    else
    {
        //var scaler = (1-scale)*(1-scale)*(max-min)+min;
        //exits[exits.length]={x:(event.x-canvas.offsetLeft-x)/scaler, y:(event.y-canvas.offsetTop-y)/scaler, next:exits.length+1, exit:true};
        clickDown = true;
        startX = event.x;
        startY = event.y;
        orgX = x;
        orgY = y;
    }
    draw();
}
function moveAround(event)
{
    if(clickDown)
    {
        x = (event.x-startX)+orgX;
        y = (event.y-startY)+orgY;
        draw();
    }
    if(scrollDown)
    {
        scale = (event.y-c.offsetTop-barY)/barH;
        if(scale < 0)
            scale = 0;
        if(scale > 1)
            scale = 1;
        centerX = barX+barW/2;
        centerY = barY + barH*scale;
        
        draw();
    }
    if(timeDown)
    {
        timeScale = (event.x-c.offsetLeft-timeX)/timeW;
        if(timeScale < 0)
            timeScale = 0;
        if(timeScale > 1)
            timeScale = 1;
        centerTimeX = timeX+timeW*timeScale;
        centerTimeY = timeY +timeH/2;
        draw();
    }
}

function upClick(event)
{
    clickDown = false;
    scrollDown = false;
    timeDown = false;
}


c.addEventListener("mousedown", downClick, false);
c.addEventListener("mousemove", moveAround, false);
document.addEventListener("mouseup", upClick, false);

function placeRoads()
{
    
    var pX, pY;
    var scaler = (1-scale)*(1-scale)*(max-min)+min;
    for(var j = 0;j < paths.length;j++)
    {
        var value;
        var holder1, holder2;
        if(timeScale < .33)
        {
            ctx.strokeStyle = "red";
        }
        if(timeScale >=.33 && timeScale <.66)
        {
            ctx.strokeStyle = "yellow";
        }
        if(timeScale >= .66)
        {
            ctx.strokeStyle = "green";
        }
        pX = exits[paths[j].a].x*scaler+x;
        pY = exits[paths[j].a].y*scaler+y;
        ctx.lineWidth = 5;
        ctx.beginPath();
        ctx.moveTo(pX,pY);
        pX = exits[paths[j].b].x*scaler+x;
        pY = exits[paths[j].b].y*scaler+y;
        ctx.lineTo(pX, pY);
        ctx.stroke();
    }
    for(var i = 0;i < exits.length;i++)
    {
        pX = exits[i].x*scaler + x;
        pY = exits[i].y*scaler + y;
        if(exits[i].exit)
        {
            ctx.beginPath();
            ctx.fillStyle = "#000000";
            ctx.arc(pX, pY, 7, 0, 2 * Math.PI, false);
            ctx.fill();
        }
    }
}

function draw()
{
    var scaler = (1-scale)*(1-scale)*(max-min)+min;
    ctx.clearRect ( 0 , 0 , canvas.width, canvas.height );
        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect ( 0 , 0 , canvas.width, canvas.height );
    ctx.drawImage(imageObj, x-canvas.width*scaler/2, y-canvas.height*scaler/2, canvas.width*scaler, canvas.height*scaler);
        placeRoads();
    ctx.fillStyle = "#888888";
    ctx.fillRect(barX,barY,barW,barH);
    
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
    ctx.fill();
    
    ctx.fillRect(timeX,timeY,timeW,timeH);
    
    ctx.beginPath();
    ctx.arc(centerTimeX, centerTimeY, radius, 0, 2 * Math.PI, false);
    ctx.fill();
}

var imageObj = new Image();
imageObj.onload = function(){draw()};
imageObj.src = 'map.gif';


//ctx.fillStyle = "#FFFF00";
//ctx.fillRect(0,0,600,400);