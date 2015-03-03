var c = document.getElementById("canvas");
var ctx = c.getContext("2d");
var x = c.width/2;
var y = c.height/2;
var scale = .5;

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
var centerY = barY +(barH-barH*scale);
var radius = 20;

function downClick(event)
{
    //alert(""+((event.x-canvas.offsetLeft-centerX)*
     //     (event.x-canvas.offsetLeft-centerX)+
       //   (event.y-canvas.offsetTop-centerY)*
         // (event.y-canvas.offsetTop-centerY))+","+(radius*radius));
    if((event.x-canvas.offsetLeft-centerX)*
       (event.x-canvas.offsetLeft-centerX)+
       (event.y-canvas.offsetTop-centerY)*
       (event.y-canvas.offsetTop-centerY) <radius*radius)
    {
        scrollDown = true;
    }
    else
    {
        clickDown = true;
        startX = event.x;
        startY = event.y;
        orgX = x;
        orgY = y;
    }
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
        scale = (barH-event.y+c.offsetTop+barY)/barH;
        if(scale <= 0)
            scale = 0.01;
        if(scale > 1)
            scale = 1;
        centerX = barX+barW/2;
        centerY = barY +(barH-barH*scale);
        
        draw();
    }
}

function upClick(event)
{
    clickDown = false;
    scrollDown = false;
}


c.addEventListener("mousedown", downClick, false);
c.addEventListener("mousemove", moveAround, false);
c.addEventListener("mouseup", upClick, false);

function draw()
{
    ctx.clearRect ( 0 , 0 , canvas.width, canvas.height );
        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect ( 0 , 0 , canvas.width, canvas.height );
    ctx.drawImage(imageObj, x-canvas.width*(scale+1)/2, y-canvas.height*(scale+1)/2, canvas.width*(scale+1), canvas.height*(scale+1));
    
    ctx.fillStyle = "#888888";
    ctx.fillRect(barX,barY,barW,barH);
    
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
    ctx.fill();
}

var imageObj = new Image();
imageObj.onload = function(){draw()};
imageObj.src = 'map.png';


//ctx.fillStyle = "#FFFF00";
//ctx.fillRect(0,0,600,400);