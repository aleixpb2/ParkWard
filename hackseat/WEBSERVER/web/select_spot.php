<html>
<div style="display:none;">
<?php 
	$img = glob("../images/".$_GET['camera_id'] . "_*");
	echo "<img id=\"myphoto\" src=" . $img[0] . ">" ;
	

	
?> 
</div>

<canvas id="myCanvas" width="600" height="600" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.
</canvas>

<script>
	window.onload = function() {
		var c = document.getElementById("myCanvas");
		var ctx = c.getContext("2d");
		var img = document.getElementById("myphoto");
		ctx.drawImage(img,0,0, 600, 600 * img.height / img.width);
	}
</script>
<script>
		var times = 0;
		var points = [];
		for(var i=0; i<4; ++i) points.push({x:0, y: 0});
      function writeMessage(canvas, message) {
        var context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.font = '18pt Calibri';
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
      var canvas = document.getElementById('myCanvas');
      var context = canvas.getContext('2d');

      canvas.addEventListener('click', function(evt) {
        var mousePos = getMousePos(canvas, evt);
		if (times < 4){
		points[times].x = mousePos.x;
		points[times].y = mousePos.y;
		context.arc(mousePos.x, mousePos.y, 5, 0, 2 * Math.PI);
		context.stroke();
		++times;

		
		if (times == 4){
		var img = document.getElementById("myphoto");
			for(var i=0; i<4; ++i){
				points[i].x = img.width * points[i].x / 600;
				points[i].y = img.width * points[i].y / 600;
			}
			//?camera_id=&lat=&lng=&x1=&y1=&x2=&y2=&x3=&y3=&x4=&y4
			var xmlHttp = new XMLHttpRequest();
			var str1 = "http://bestbarcelona.org/externalprojects/hackseat/web/submit_spot.php?camera_id=";
			var aux =  str1.concat(<?php echo $_GET['camera_id'];?>,"&lat=",<?php echo $_GET['lat'] ;?>, "&lng=",<?php echo $_GET['lng'];?>,"&x1=", points[0].x,
				"&y1=", points[0].y,"&x2=", points[1].x,"&y2=", points[1].y,"&x3=", points[2].x,"&y3=", points[2].y,
				"&x4=", points[3].x,"&y4=", points[3].y);
				//alert(aux);
			xmlHttp.open( "GET", aux , false ); // false for synchronous request
			xmlHttp.send( null );
			alert("Spot registered correctly");
			window.location="http://bestbarcelona.org/externalprojects/hackseat/web/index.php/about/";
		}
			
			
		}
      }, false);
    </script>
</html>