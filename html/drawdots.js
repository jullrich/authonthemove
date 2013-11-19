var drawdotson=0;
var lastdotx;
var lastdoty;
var context;
var dotnum;
var dotsize;
var dotspace;
var pattern=new Array();

function toggledots() {
    if (drawdotson==0 ) {
	drawdotson=1;
    } else {
	drawdotson=0;
    }
}

function circle(x,y,radius,color) {
	context.beginPath();
	context.arc(x,y,radius,0,2*Math.PI,false);
	context.fillStyle = color;
      context.fill();
	context.lineWidth=1;
	context.strokeStyle=color;
	context.stroke();	
}

function rectangle(xmin,ymin,xmax,ymax,color) {
	context.beginPath();
    context.rect(xmin, ymin, xmax, ymax);
      // context.fillStyle = 'yellow';
      // context.fill();
      context.lineWidth = 1;
      context.strokeStyle = color;
      context.stroke();
}

function drawdots() {
	var dots=document.getElementById('dots');
	var width=parseInt(window.innerWidth);
	var height=parseInt(window.innerHeight);
	var dotspos=dots.getBoundingClientRect();
	var yspace=height-parseInt(dotspos.top);
	dotnum=document.getElementById('numdots').value;
	var dotgrid='';
	dotnum=parseInt(dotnum);
	if ( yspace<width) {
		width=yspace;
	}
	width=Math.floor(width*0.9);
	dots.width=width;
	dots.height=width;
	swidth=width.toString();

	swidth=width+'px';

	dots.style.width=swidth;
	dots.style.height=swidth;

    context = dots.getContext('2d');    
	
	// width=Math.floor(width*0.9);
	context.clearRect(0,0,width,width);
	dotsize=Math.floor(width/100);
	if (dotsize<2) {
		dotsize=2;
	}	
	dotspace=(width-dotsize*4)/(dotnum);
	for (var x=0; x<dotnum;x++){
		for (var y=0; y<dotnum; y++) {
			circle(x*dotspace+dotsize, y*dotspace+dotsize, dotsize, 'green');
			
		}	
	}	
	dots.addEventListener('mousemove', function(evt) {
        var mousePos = getMousePos(dots, evt);
        connectdot(mousePos.x,mousePos.y);
      }, false);
	
	
	
}


function writeMessage(canvas, message) {
        var context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.font = '10pt Calibri';
        context.fillStyle = 'black';
        context.fillText(message, 10, 25);
      }
      function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
          x: evt.clientX - rect.left,
          y: evt.clientY - rect.top
        };
      }


function handleStart() {
    connectdot(this);
}

function handleMove() {
    connectdot(this);
}



function connectdot(x,y) {
  var dotx=coordn(x);
  var doty=coordn(y);
  
  var dotxn=Math.round(dotx);
  var dotyn=Math.round(doty);
  
  if ( Math.sqrt((dotxn-dotx)^2+(dotyn-doty)^2) > 0.5 ) {
	  
	  dotxn=lastdotx;
	  dotyn=lastdoty;
  }
  
  if ( dotxn>=0 && dotxn<dotnum && dotyn>=0 && dotyn<dotnum) {
    if ( lastdotx!=dotxn || lastdoty!=dotyn) {
      if ( lastdoty>=0 && lastdotx>=0 ) {
	    circle(lastdotx*dotspace+dotsize*2, lastdoty*dotspace+dotsize*2 , dotspace-dotsize*4 , 'white');
	    circle(lastdotx*dotspace+dotsize*2, lastdoty*dotspace+dotsize*2, dotsize, 'green');	   
	  }
	  circle(dotxn*dotspace+dotsize*2, dotyn*dotspace+dotsize*2 , dotspace/4 , 'orange');  
	  circle(dotxn*dotspace+dotsize*2, dotyn*dotspace+dotsize*2 , dotsize , 'red');
	  
	  
	  if ( pattern[pattern.length-4]==dotxn && pattern[pattern.length-3]==dotyn) {
		  pattern.pop();
		  pattern.pop();
	  }  else {
	    	
	  	pattern.push(dotxn);
	  	pattern.push(dotyn);
	  }
	  drawlines();
	  lastdotx=dotxn;
	  lastdoty=dotyn;
	  start=0;
	  
    }
  }
  
   circle(x,y,1,'red',context); 
}

function ncoord(x) {
	return x*dotspace+dotsize*2;
}

function coordn(x) {
	return (x-dotsize*2)/dotspace;
}

function dotline(x1, y1, x2, y2) {
	x1=ncoord(x1);
	y1=ncoord(y1);
	x2=ncoord(x2);
	y2=ncoord(y2);
	context.moveTo(x1,y1);
	context.lineTo(x2,y2);
	context.stroke();
}

function drawlines() {
	if (pattern.length<4) {
		return;
	}
	var xold=pattern[0];
	var yold=pattern[1];
	for (var i = 2; i < pattern.length; i+=2) {
    	var x = pattern[i];
		var y = pattern[i+1];
		dotline(xold,yold,x,y);
		xold=x;
		yold=y;
	} 
}


function leavedot(dot) {

}