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

var exitSize = 5;

    var exits = [];
    var paths = [];

var editMode = false;
var tempPaths = [];
var tempExits = [];
var tempDot;
var drag = 0;

//image code
var imageObj = new Image();
imageObj.onload = function(){draw()};
imageObj.src = 'map.gif';

//locations

//-148.50451656072266 -23.8474406155905 is 34.025408  / -118.291640

//75.22330305798893 -119.80007524050087 is 34.055249/ -118.214152

function findPoint(lat, long)
{
    var x, y;
    
    x = 2887.25763497193*long+341389.93622679;
    
    y = lat*(-3215.46310863896)+109383.596739774;
    
    return {x:x, y:y};
}


function findLatLong(x, y)
{
    var lat, long;
    
    long = (x - 341389.93622679)/2887.25763497193;
    
    lat = (y - 109383.596739774)/(-3215.46310863896);
    
    return {lat:lat, long:long};
}

var checkinger = 54;

exits[0] = {x:-282.828403512773,y:-53.8284186398814,exit:true};//{x:-284,y:-52,exit:true};
exits[1] = {x:-235.038515138731,y:-57.8863330829918,exit:true};//{x:-237,y:-59,exit:true};
exits[2] = {x:-223.708916179079, y:-60.2271902260691, exit:true};//{x:-222,y:-59,exit:true};
exits[3] = {x:-186.443082,y:-62.4104896768549,exit:true};//{x:-190,y:-60,exit:true};
exits[4] = {x:-161.497176,y:-61.1500281382469,exit:true};//{x:-158,y:-62,exit:true};
exits[5] = {x:-97.6772331548855, y:-64.658098,exit:false};//{x:-101,y:-65,exit:false};
exits[6] = {x:-95.5204517015954,y:-76.368815031441,exit:true};//{x:-101,y:-75,exit:true};
exits[7] = {x:-88.449558,y:-87.9091121283418,exit:true};//{x:-92,y:-88,exit:true};
exits[8] = {x:-76.6637720876024,y:-95.8223668387072,exit:true};//{x:-77,y:-97,exit:true};
exits[9] = {x:-24.8288357669371, y:-143.642734190376,exit:false};//{x:-29,y:-146,exit:false};
exits[10] = {x:-7.23677499702899,y:-153.125134897768,exit:true};//{x:-6,y:-155,exit:true};
exits[11] = {x:3.28150456713047,y:-159.009432386563,exit:true};//{x:8,y:-166,exit:true};
exits[12] = {x:26.0533055341803,y:-187.839274618629,exit:true};//{x:23,y:-186,exit:true};
exits[13] = {x:-130.372539,y:-192.929352719613,exit:true};//{x:-132,y:-191,exit:true};
exits[14] = {x:-70.202090,y:-170.572237725239,exit:true};//{x:-73,y:-168,exit:true};
exits[15] = {x:-116.634966786136,y:163.475793705045,exit:true};//{x:-118,y:172,exit:true};
exits[16] = {x:-116.658065,y:125.009208536387,exit:true};//{x:-117,y:121,exit:true};
exits[17] = {x:-116.24229974777,y:96.877121798927,exit:true};//{x:-116,y:98,exit:true};
exits[18] = {x:-117.911134660768,y:59.1886787025578,exit:true};//{x:-117,y:57,exit:true};
exits[19] = {x:-117.625296154933,y:33.0501790924172,exit:true};//{x:-118,y:33,exit:true};
exits[20] = {x:-117.795644355414,y:12.448707,exit:true};//{x:-118,y:11,exit:true};
exits[21] = {x:-114.261641,y:-1.48711015745357,exit:true};//{x:-118,y:0,exit:true};
exits[22] = {x:-102.048541,y:-25.188288731224,exit:true};//{x:-104,y:-21,exit:true};
exits[23] = {x:208.545311610214,y:144.019026434675,exit:true};//{x:209,y:141,exit:true};
exits[24] = {x:182.903576554032,y:73.4621194417996,exit:true};//{x:183,y:72,exit:true};
exits[25] = {x:188.201694314193,y:56.4265958922479,exit:true};//{x:188,y:60,exit:true};
exits[26] = {x:195.047382166726,y:39.0470177900424,exit:true};//{x:194,y:39,exit:true};
exits[27] = {x:194.010857,y:5.20748403473408,exit:false};//{x:194,y:3,exit:false};
exits[28] = {x:185.060358,y:1.50970145979954,exit:true};//{x:184,y:2,exit:true};
exits[29] = {x:146.965880771517,y:-6.856933548901,exit:true};//{x:143,y:-6,exit:true};
exits[30] = {x:129.321849364205,y:-9.68332562138676,exit:true};//{x:130,y:-10,exit:true};
exits[31] = {x:102.738868319022,y:-22.5805481501302,exit:true};//{x:103,y:-24,exit:true};
exits[32] = {x:73.6670711924671,y:-36.2205426569708,exit:false};//{x:75,y:-34,exit:false};
exits[33] = {x:44.3094355601352,y:-36.6449837873079,exit:false};//{x:35,y:-34,exit:true};
exits[34] = {x:12.5582633482991,y:-25.9921545083926,exit:true};//{x:9,y:-25,exit:true};
exits[35] = {x:-41.3670475000399,y:-34.4423915578955,exit:true};//{x:-46,y:-36,exit:true};
exits[36] = {x:54.700676,y:-51.91843355335,exit:false};//{x:55,y:-52,exit:false};
exits[37] = {x:55.2001713592326,y:-87.902681202133,exit:true};//{x:55,y:-87,exit:true};
exits[38] = {x:51.5882120578899,y:-101.246853102974,exit:true};//{x:51,y:-102,exit:true};
exits[39] = {x:46.7145211700699,y:-110.732469273455,exit:false};//{x:29,y:-112,exit:true};
exits[40] = {x:18.7427692023921,y:-115.195532068261,exit:true};//{x:18,y:-114,exit:true};
exits[41] = {x:-3.02137884998228,y:-122.822610561969,exit:true};//{x:-5,y:-122,exit:true};
exits[42] = {x:75.1107000099728,y:-119.82901440782,exit:false};//{x:76,y:-119,exit:false};
exits[43] = {x:72.8066684172372,y:-136.542991646522,exit:true};//{x:72,y:-135,exit:true};
exits[44] = {x:70.176377,y:-143.343696121286,exit:true};//{x:71,y:-145,exit:true};
exits[45] = {x:68.1062129875645,y:-160.562501068052,exit:true};//{x:68,y:-162,exit:true};
exits[46] = {x:62.7792226509773,y:-171.041695339096,exit:true};//{x:61,y:-171,exit:true};
exits[47] = {x:60.405896875076,y:-183.372996,exit:true};//{x:60,y:-179,exit:true};
exits[48] = {x:265.406963473361,y:-167.44359212053,exit:true};//{x:271,y:-170,exit:true};
exits[49] = {x:259.106967313855,y:-163.163810722923,exit:true};//{x:261,y:-163,exit:true};
exits[50] = {x:232.760741394712,y:-148.388758,exit:true};//{x:233,y:-148,exit:true};
exits[51] = {x:217.542006,y:-141.356539920147,exit:false};//{x:216,y:-140,exit:false};
exits[52] = {x:183.302018107614,y:-131.697288741794,exit:true};//{x:185,y:-131,exit:true};
exits[53] = {x:176.060775959166,y:-128.349991645693,exit:true};//{x:173,y:-125,exit:true};
exits[54] = {x:160.896898860286,y:-120.793653340399,exit:true};//{x:158,y:-116,exit:true};
exits[55] = {x:119.305952628492,y:-120.430306009119,exit:true};//{x:123,y:-122,exit:true};
exits[56] = {x:267.719656838977,y:62.7835664580198,exit:true};//{x:268,y:61,exit:true};
exits[57] = {x:243.966188276012,y:36.3749679467728,exit:true};//{x:245,y:34,exit:true};
exits[58] = {x:215.139808048436,y:14.7381166887353,exit:true};//{x:220,y:17,exit:true};
exits[59] = {x:203.143252575188,y:9.34256959245249,exit:true};//{x:206,y:9,exit:true};
exits[60] = {x:202.395452847704,y:-75.5874574960471,exit:true};//{x:202,y:-75,exit:true};
exits[61] = {x:202.643757,y:-56.844523,exit:false};//{x:202,y:-56,exit:false};
exits[62] = {x:274.380560202815,y:-49.320339,exit:true};//{x:273,y:-50,exit:true};
exits[63] = {x:160.885349829739,y:-44.9183703658491,exit:true};//{x:157,y:-44,exit:true};
exits[64] = {x:143.125828117016,y:-43.7800964253984,exit:true};//{x:145,y:-44,exit:true};

exits[65] = {x:26.9627916891477,y:-32.3555560003879,exit:true};//{x:35,y:-34,exit:true};
exits[66] = {x:29.4689313163399,y:-113.539568567314,exit:true};//{x:29,y:-112,exit:true};


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
paths[32] = {a:65,b:34};
paths[33] = {a:34,b:35};
paths[34] = {a:35,b:5};
paths[35] = {a:36,b:37};
paths[36] = {a:37,b:38};
paths[37] = {a:38,b:39};
paths[38] = {a:66,b:40};
paths[39] = {a:40,b:41};
paths[40] = {a:41,b:9};
paths[41] = {a:33,b:36};
paths[42] = {a:32, b:36};
paths[43] = {a:42, b:43};
paths[44] = {a:43, b:44};
paths[45] = {a:44, b:45};
paths[46] = {a:45, b:46};
paths[47] = {a:46, b:47};
paths[48] = {a:42, b:39};
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
paths[69] = {a:33, b:65};
paths[70] = {a:66, b:39};

function getDot(x, y)
{
    var result =""+x+" "+y;
    for(var i = 0; i < tempExits.length;i++)
    {
        result = result + ("\n"+tempExits[i].x+" "+tempExits[i].y);
        if((x-tempExits[i].x)*
           (x-tempExits[i].x)+
           (y-tempExits[i].y)*
           (y-tempExits[i].y) < exitSize*exitSize)
        {
            //alert(result);
            return i;
        }
    }
    //alert(result);
    return -1;
}

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
    else if(event.x-canvas.offsetLeft >= 10 &&
            event.x-canvas.offsetLeft < 70 &&
            event.y-canvas.offsetTop >=10 &&
            event.y-canvas.offsetTop <30)
    {
        if(editMode)
        {
            editMode = false;
            paths = tempPaths;
            exits = tempExits;
            //TODO add code to save changes to server
        }
        else
        {
            var pic = prompt("Map Image URL", "");
            if(pic!=null && pic != "")
            {
                imageObj.src = pic;
                editMode = true;
                tempPaths = [];
                tempExits = [];
                drag = 0;

            }
            
            
        }
        
    }
    else if(event.x-canvas.offsetLeft >= 10 &&
            event.x-canvas.offsetLeft < 70 &&
            event.y-canvas.offsetTop >=40 &&
            event.y-canvas.offsetTop <60 && editMode)
    {
        drag++;
        if(drag >= 3)
        {
            drag = 0;
        }
    }
    else
    {
        if(drag == 1 && editMode)
        {
            var scaler = (1-scale)*(1-scale)*(max-min)+min;
            tempExits[tempExits.length]={x:(event.x-canvas.offsetLeft-x)/scaler, y:(event.y-canvas.offsetTop-y)/scaler, next:exits.length+1, exit:true};
        }
        else if(drag == 2 && editMode)
        {
            var scaler = (1-scale)*(1-scale)*(max-min)+min;
            tempDot = getDot((event.x-canvas.offsetLeft-x)/scaler, (event.y-canvas.offsetTop-y)/scaler);
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
    if(editMode && drag == 2)
    {
        var scaler = (1-scale)*(1-scale)*(max-min)+min;
        var temp = getDot((event.x-canvas.offsetLeft-x)/scaler, (event.y-canvas.offsetTop-y)/scaler);
        if(tempDot != -1 && temp != -1 && tempDot != temp)
        {
            tempPaths[tempPaths.length]={a:tempDot, b:temp};
        }
    }
    draw();
}


c.addEventListener("mousedown", downClick, false);
c.addEventListener("mousemove", moveAround, false);
document.addEventListener("mouseup", upClick, false);


function mixColors(c1, c2, percent)
{
    var rA, gA, bA;
    var rB, gB, bB;
    
    var cA, mA, yA, kA;
    var cB, mB, yB, kB;
    
    var c, m, y, k;
    
    var r,g,b;
    var final;
    
    rA = Math.floor(c1/256/256);
    gA = Math.floor((c1/256)%256);
    bA = Math.floor(c1%256);
    
    rB = Math.floor(c2/256/256);
    gB = Math.floor((c2/256)%256);
    bB = Math.floor(c2%256);
    
    kA = 1-Math.max(rA/255, gA/255, bA/255);
    kB = 1-Math.max(rB/255, gB/255, bB/255);
    
    cA = (1-rA/255-kA)/(1-kA);
    mA = (1-gA/255-kA)/(1-kA);
    yA = (1-bA/255-kA)/(1-kA);
    
    cB = (1-rB/255-kB)/(1-kB);
    mB = (1-gB/255-kB)/(1-kB);
    yB = (1-bB/255-kB)/(1-kB);
    
    k = kA*percent+kB*(1-percent);
    m = mA*percent+mB*(1-percent);
    y = yA*percent+yB*(1-percent);
    c = cA*percent+cB*(1-percent);
    
    r = Math.round((c*(1-k)+k-1)*(-255));
    g = Math.round((m*(1-k)+k-1)*(-255));
    b = Math.round((y*(1-k)+k-1)*(-255));
    
    
    return r*256*256+g*256+b;
}

var speedData;
var ready = false;
var calculated = false;
var started = true;
var matrix = [];
var alerts = true;
var a, b;

function parse(response, status) {
    //alert("callback");
    if (status == google.maps.DistanceMatrixStatus.OK) {
        var origins = response.originAddresses;
        var destinations = response.destinationAddresses;
        for (var i = 0; i < origins.length; i++) {
            if(b == 0)
                matrix[a*10+i] = [];
            var results = response.rows[i].elements;
            for (var j = 0; j < results.length; j++) {
                var element = results[j];
                matrix[a*10+i][b*10+j] = element.distance.value;
            }
            
        }
        //alert(a+" "+b);
        draw();
        b++;
        if(b > exits.length/10)
        {
            b = 0;
            a++;
        }
        if(a > exits.length/10)
        {
            var string, count;
            count = 0;
            string = "";
            for(var i =0;i < paths.length;i++)
            {
                string+= i+" "+paths[i].a+" "+paths[i].b+" "+(matrix[paths[i].a][paths[i].b]/1609.344)+" "+(matrix[paths[i].b][paths[i].a]/1609.334)+"\n";
                count++;
                if(count == 10 || i == paths.length-1)
                {
                    alert(string);
                    count = 0;
                    string = "";
                }
            }
            //alert(matrix);
        }
        else
        {
            setTimeout("getMatrix()", 10000);
        }
    }
    if(status == google.maps.DistanceMatrixStatus.INVALID_REQUEST && alerts)
    {
        alert("INVALID_REQUEST");
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.MAX_ELEMENTS_EXCEEDED && alerts)
    {
        alert("MAX_ELEMENTS_EXCEEDED");
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.OVER_QUERY_LIMIT)
    {
        //alert("OVER_QUERY_LIMIT");
        //draw();
        setTimeout("getMatrix()", 10000);
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.REQUEST_DENIED && alerts)
    {
        alert("REQUEST_DENIED");
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.UNKNOWN_ERROR && alerts)
    {
        alert("UNKNOWN_ERROR");
        alerts = false;
    }
}

function getMatrix()
{
    var origin, dest;
    var origins = [];
    var dests = [];
    var start,end;
    var service = new google.maps.DistanceMatrixService();
    for(var i = a*10; i < (a+1)*10 && i < exits.length;i++)//for(var i =0; i < exits.length;i++)
    {
            start = findLatLong(exits[i].x, exits[i].y);
            origin = new google.maps.LatLng(start.lat, start.long);
            origins[origins.length] = origin;
    }
    dests = [];
    for(var j = b*10; j < (b+1)*10 && j < exits.length;j++)//for(var j = 0;j < exits.length;j++)
    {
        end = findLatLong(exits[paths[j].b].x, exits[paths[j].b].y);
        dest = new google.maps.LatLng(end.lat, end.long);
        dests[dests.length] = dest;
    }
    service.getDistanceMatrix(
                              {
                              origins: origins,
                              destinations: dests,
                              travelMode: google.maps.TravelMode.DRIVING,
                              durationInTraffic: false,
                              }, parse);
}


function callback(response, status) {
    if (status == google.maps.DistanceMatrixStatus.OK) {
        var origins = response.originAddresses;
        var destinations = response.destinationAddresses;
        for (var i = 0; i < origins.length; i++) {
            var results = response.rows[i].elements;
            for (var j = 0; j < results.length; j++) {
                var element = results[j];
                speedData[speedData.length] = element.distance.value/1000/1.61/(element.duration.value/60/60);
            }
            
        }
        calculated = true;
        drawRoads();
    }
    if(status == google.maps.DistanceMatrixStatus.INVALID_REQUEST && alerts)
    {
        alert("INVALID_REQUEST");
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.MAX_ELEMENTS_EXCEEDED && alerts)
    {
        alert("MAX_ELEMENTS_EXCEEDED");
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.OVER_QUERY_LIMIT && alerts)
    {
        alert("OVER_QUERY_LIMIT");
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.REQUEST_DENIED && alerts)
    {
        alert("REQUEST_DENIED");
        alerts = false;
    }
    if(status == google.maps.DistanceMatrixStatus.UNKNOWN_ERROR && alerts)
    {
        alert("UNKNOWN_ERROR");
        alerts = false;
    }
}

var timePoints = 1;

var lastScale = -1;

function placeRoads()
{
    var pX, pY;
    /*started = true;
    a = 0;
    b = 0;
    getMatrix();*/
    
    var scaler = (1-scale)*(1-scale)*(max-min)+min;

    $.ajax({
                async: false,
                url: "output.txt",
                dataType: "json",
                success: function(data) {
                speedData = data;
                }
                });
    /*if(!calculated)
    {
        for(var j = 0;j < paths.length;j++)
        {
        var origins = [];
        var dests = [];
        var start, end;
        start = findLatLong(exits[paths[j].a].x, exits[paths[j].a].y);
        end = findLatLong(exits[paths[j].b].x, exits[paths[j].b].y);
        var origin = new google.maps.LatLng(start.lat, start.long);
        var dest = new google.maps.LatLng(end.lat, end.long);
        origins[origins.length] = origin;
        dests[dests.length] = dest;
        //var myURL = "https://maps.googleapis.com/maps/api/distancematrix/json?origins="+end.lat+","+end.long+"&destinations="+start.lat+","+start.long+"&mode=car&language=en-EN&depature_time="+(new Date).getTime();
        var service = new google.maps.DistanceMatrixService();
            var date = new Date();
            date.setHours(23);
            date.setMinutes(0);
            date.setSeconds(0);
        service.getDistanceMatrix(
                              {
                              origins: origins,
                              destinations: dests,
                              travelMode: google.maps.TravelMode.DRIVING,
                                  durationInTraffic: true,
                                  transitOptions:{
                                    departureTime: date
                                  }
                              }, callback);
        }
        for(var j = 0;j < paths.length;j++)
        {
            var origins = [];
            var dests = [];
            var start, end;
            start = findLatLong(exits[paths[j].a].x, exits[paths[j].a].y);
            end = findLatLong(exits[paths[j].b].x, exits[paths[j].b].y);
            var origin = new google.maps.LatLng(start.lat, start.long);
            var dest = new google.maps.LatLng(end.lat, end.long);
            origins[origins.length] = origin;
            dests[dests.length] = dest;
            //var myURL = "https://maps.googleapis.com/maps/api/distancematrix/json?origins="+end.lat+","+end.long+"&destinations="+start.lat+","+start.long+"&mode=car&language=en-EN&depature_time="+(new Date).getTime();
            var service = new google.maps.DistanceMatrixService();
            var date = new Date();
            date.setHours(22);
            date.setMinutes(0);
            date.setSeconds(0);
            service.getDistanceMatrix(
                                      {
                                      origins: origins,
                                      destinations: dests,
                                      travelMode: google.maps.TravelMode.DRIVING,
                                      durationInTraffic: true,
                                      transitOptions:{
                                      departureTime: date
                                      }
                                      }, callback);
        }
    }
    else
    {
        drawRoads();
    }
}
function drawRoads()
{
    var scaler = (1-scale)*(1-scale)*(max-min)+min;*/
    timePoints = speedData.length/71;
    var upper = Math.ceil(timeScale*timePoints);
    var lower = Math.floor(timeScale*timePoints);
    var middle = (timeScale-lower/timePoints)*timePoints;
    if(lastScale != timeScale)
    {
        lastScale = timeScale;
        //alert(timeScale+" "+upper+" "+lower+" "+middle);
    }
    for(var j = 0;j < paths.length || j < tempPaths.length;j++)
    {
        var value;
        var holder1, holder2;
        var speed = ((speedData[j+71*lower])*(1-middle)+(speedData[j+71*upper])*middle)/80;
        //var speed = ((speedData[j])*timeScale+(speedData[j+71])*(1-timeScale))/80;
        
        if(speed < 1/2)
        {
            ctx.strokeStyle = mixColors(16711680, 16776960, (1-speed*2)).toString(16);
        }
        else
        {
            ctx.strokeStyle = mixColors(16776960, 32768, (1-(speed-.5)*2)).toString(16);
        }
        if(!editMode)
        {
            if(j < paths.length)
            {
                pX = exits[paths[j].a].x*scaler+x;
                pY = exits[paths[j].a].y*scaler+y;
            }
        }
        else
        {
            if(j < tempPaths.length)
            {
                pX = tempExits[tempPaths[j].a].x*scaler+x;
                pY = tempExits[tempPaths[j].a].y*scaler+y;
            }
        }
        ctx.lineWidth = 5*scaler;
        ctx.beginPath();
        ctx.moveTo(pX,pY);
        if(!editMode)
        {
            if(j < paths.length)
            {
                pX = exits[paths[j].b].x*scaler+x;
                pY = exits[paths[j].b].y*scaler+y;
            }
        }
        else
        {
            if(j < tempPaths.length)
            {
                pX = tempExits[tempPaths[j].b].x*scaler+x;
                pY = tempExits[tempPaths[j].b].y*scaler+y;
            }
        }
        ctx.lineTo(pX, pY);
        ctx.stroke();
    }
    for(var i = 0;i < exits.length || i < tempExits.length;i++)
    {
        if(!editMode)
        {
            if(i < exits.length)
            {
                pX = exits[i].x*scaler + x;
                pY = exits[i].y*scaler + y;
                if(exits[i].exit)
                {
                    ctx.beginPath();
                    ctx.fillStyle = "#000000";
                    if(i == checkinger)
                        ctx.fillStyle = "#FFFFFF";
                    ctx.arc(pX, pY, exitSize*scaler, 0, 2 * Math.PI, false);
                    ctx.fill();
                }
            }
        }
        else
        {
            if(i < tempExits.length)
            {
                pX = tempExits[i].x*scaler + x;
                pY = tempExits[i].y*scaler + y;
                if(tempExits[i].exit)
                {
                    ctx.beginPath();
                    ctx.fillStyle = "#000000";
                    ctx.arc(pX, pY, exitSize*scaler, 0, 2 * Math.PI, false);
                    ctx.fill();
                }
            }
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
    //if(!started)
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
    
    if(editMode)
    {
        ctx.fillStyle = "#FF0000";
        ctx.fillRect(10,10,60, 20);
        ctx.fillStyle = "#FFFFFF";
        ctx.font = "bold 16px Arial";
        ctx.fillText("Save?", 15, 25);
        ctx.fillStyle = "#888888";
        ctx.fillRect(10,40,60,20);
        ctx.fillStyle = "#000000";
        if(drag == 0)
        {
            ctx.fillText("None", 15, 55);
        }
        if(drag == 1)
        {
            ctx.fillText("Exit", 15, 55);
        }
        if(drag == 2)
        {
            ctx.fillText("Path", 15, 55);
        }
    }
    else
    {
        ctx.fillStyle = "#888888";
        ctx.fillRect(10,10,60, 20);
        ctx.fillStyle = "#000000";
        ctx.font = "bold 16px Arial";
        var title = a+" "+b;
        ctx.fillText("Edit", 15, 25);//Edit
    }
}


//ctx.fillStyle = "#FFFF00";
//ctx.fillRect(0,0,600,400);