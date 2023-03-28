var x=1;
var y=1;
var vx=10;
var vy=10;
let boolean=true;


function initialize () {
    if (boolean){
    var div = document.getElementById("photos");
    var x_position= div.getBoundingClientRect().top;
    var y_position= div.getBoundingClientRect().left;
    var w_position= div.getBoundingClientRect().width;
    var z_position= div.getBoundingClientRect().height;
    //console.log(x_position);
    //console.log(y_position);
    var qs=document.querySelector('#court');
    var x_width=qs.getBoundingClientRect().width;
    var y_height=qs.getBoundingClientRect().height;
    var z_top = qs.getBoundingClientRect().top;
    var w_left= qs.getBoundingClientRect().left;
    //console.log(x_width);
    //console.log(y_height);
    var cw = qs.clientWidth;
    var ch = qs.clientHeight;
    if(cw-w_position <=1 || y_position<=1){
        y_position=y_position*(-1);
      }
    if(ch+x_position-z_top<=1 || x_position<=z_top){
        x_position *=-1;
    }
    x=x+vx;
    y=y+vy;
   document.getElementById("photos").style.top = y+'px';
   document.getElementById("photos").style.left = x+'px';
   if ((x+vx > cw) || (x+vx <= 0) )
    vx *=-1;
    //console.log(vx);
   if ((y+vy > ch) || (y+vy <= 0) )
   vy *=-1; 
setTimeout('initialize()',70);
}
}
function resumeAction (event) {     
         boolean=!boolean;
         //console.log("Inside resume")
         document.getElementById("court").addEventListener("click", initialize);
         
    }

