<?php
	if($_POST){
		$start = $_POST['start'];
		$end = $_POST['end'];
		$gap = $_POST['gap'];
	}
	else{
		$start = 5;
		$end = 100;
		$gap = 5;
	}
?>
<html>
 <head>
<script class='gtm'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-W59SWTR');</script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="flot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="scripts/E8dataJSON.js"></script>
 <script type="text/javascript">
  var curr;
  var analysisData = new Array(20);
  var helicityFlag = new Array(20);
  var start,end,gap;
  $(document).ready(function(){ 
	 start = parseInt(document.getElementById("start").value);
	 end = parseInt(document.getElementById("end").value);
	 gap = parseInt(document.getElementById("gap").value);	
	 curr = start;
	plotStartTemp(start+"C");
  });
 function changeStartTemp(temp){
	if(temp != "all"){
		curr = parseInt(temp);
		plotStartTemp(temp+"C");
	}
	else{
		plotStartTemp(temp);
	}
 }
 function plotStartTemp(temp){
    $(function() {
      if(temp == "all"){
	var d = []
  	for(var i = start ; i <= end ; i+=gap){
	   d[i] = [];
	   for(var j = 190 ; j <= 260 ; j++){
		temp1 = i + "C";
     	  	d[i].push([j, dataJSON[260-j][temp1]]);
	   }
	}
	var dataLabels = [];
	for(var i = start ; i <= end ; i+=gap){
		dataLabels.push({"label": "<span style='font-size:10px;'> "+i+" C </span>", "data": d[i]});
  	}
	$.plot($("#placeholder"), 
		 dataLabels ,
		{ grid: { hoverable: true, clickable: false }
      		}
	);
	
      }
      else{
    	var d1 = [];
    	for (var i = 190; i <= 260; i += 1){
     	  d1.push([i, dataJSON[260-i][temp]]);
      	}
	var plot =  $.plot($("#placeholder"), 
			[ {label: "MRE Vs &lambda;(in nm)<br> At Temperature: <span style='font-size:20px;'> "+temp+" </span>", data: d1} ],
			{ grid: { hoverable: true, clickable: true }
      			}
		    );
	    document.getElementById("temp@"+ curr+"C").innerHTML = dataJSON2[curr][2];
	    helicityFlag[(curr-start)/gap ] = true;

      }

            
      var previousPoint = null;
      $("#placeholder").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));
 
      });
 
      $("#placeholder").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("You clicked point ( " + pos.x.toFixed(2) + " , " + pos.y.toFixed(2) + " )."  );
	    document.getElementById("temp"+ curr+"C").innerHTML = pos.y.toFixed(2);
	    analysisData[(curr-start)/gap ] = [curr,pos.y.toFixed(2)];
	    plot.unhighlight();
            plot.highlight(item.series, item.datapoint);
        }
      });

    });
 }
 function nextGraph(){
    
    if((curr+gap) > end){
       return;
    }
    curr += gap;
    var next = curr+"C";
    plotStartTemp(next);
    document.getElementById("tempDropDown").options[(curr-start)/gap].selected = true;

 }
 function prevGraph(){
    if(curr-gap < start){
       return;
    }
    curr -= gap;
    var prev = curr+"C";
    plotStartTemp(prev);
    document.getElementById("tempDropDown").options[(curr-start)/gap].selected = true;
 }

 function genAnalysis(flag){
	var st = 1;
	var st2 = 1;
	for(var i = 0 ; i <= (end-start)/gap  ; i++){
		if(!analysisData[i]){
			st = 0;	
		}	
		if(!helicityFlag[i]){
			st2 = 0;	
		}	
	}
	if(st2 == 0){
		return;
	}	
	if(st == 0 && flag == 0){
		alert("Fill all the ?'s");
		return;
	}
	d1 = [];
	d2 = [];
	d3 = [];
	for(var i = start ; i <= end ; i+=gap){
		d1.push([i,dataJSON2[i][0]]);
		d2.push([i,dataJSON2[i][1]]);
		d3.push([i,dataJSON2[i][2]]);
  	}
	if(flag == 0){
		var plot =  $.plot($("#placeholder"), 
				[ 
					{label: "Temperature Vs MRE values at 222 nm selected by you", data: analysisData}, 
					{label: "Temperature Vs MRE values at 222 nm acctually recorded", data: d1}
				],
				{ grid: { hoverable: true, clickable: true }
      				}
			    );
	}
	else{
		var plot =  $.plot($("#placeholder"), 
				[ 
					{label: "Temperature Vs %Helicity", data: d3} 
				],
				{ grid: { hoverable: true, clickable: true }
      				}
			    );
	}
	document.getElementById("graph1_Lower").style.display =  "none";
	document.getElementById("graph2_Lower").style.display =  "";
	

 }
 
 function removeAnalysis(){
	plotStartTemp(curr+"C");
	document.getElementById("graph2_Lower").style.display =  "none";
	document.getElementById("graph1_Lower").style.display =  "";
 }
 </script>
<style type="text/css">
*{
	font-family: Verdana, calibri;
}

#content{
	margin : auto;
	width: 1000px;
	font-size: 13px;
}
.boundingBox{	
	text-align:center;
	background:#cccfff;
	padding: 5px 5px 5px 5px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-box-shadow: 5px 5px 5px #888;
	-webkit-box-shadow: 5px 5px 5px #888;
	box-shadow: 5px 5px 5px #888;
}

</style>



 </head>
 <body>
    <div id="content">
      <div style="float:left; width:600px; text-align:left;"> 
	<h1 class="boundingBox">CD Spectrum of Rhodospin</h1><br>
       <div id="placeholder" style="width:600px;height:400px;"></div>
       <div style="margin-left: 50px;" id="graph1_Lower">	
	<h3 class="boundingBox" style="width:110px;">CONTROLS</h3>
        <input type="button" value="Previous" onclick="prevGraph()" class="boundingBox">&nbsp;&nbsp;
        <input type="button" value="Next" onclick="nextGraph()" class="boundingBox">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	See Spectrum At Temperature: 
        <select name="temperature" onchange="changeStartTemp(this.options[this.selectedIndex].value)" id="tempDropDown" class="boundingBox">
	<?php 
	  for($i = $start; $i<=$end;$i += $gap){
	?>
	   <option value="<?php echo $i;?>"><?php echo $i." C";?></option>
	<?php 
	  }
	?>
	   <option value="all">See All</option>
	</select>
        <p id="hoverdata"> Mouse Hover Position: 
        (<span id="x">0</span>, <span id="y">0</span>).<br> <span id="clickdata"></span></p>
	
	<h3 class="boundingBox" style="width:150px;">INSTRUCTIONS</h3>
	<ul>
	  <li>Click on the graph at 222nm to fill up the Observation Table</li>
	  <li>Click on Next to see the graph at next higher temperature</li>
	  <li>Click on the Previous to see the graph at previous lower temperature</li>
	  <li>Click on Plot to see the change of parameter with temperature</li>
	   <li>Now click on Analysis to have a self evaluation.</li>
	</ul>

       </div>
       <div style="margin-left: 50px;display:none;" id="graph2_Lower">		
	<center>
	  <input type="button" value="GO BACK" onclick="removeAnalysis();" class="boundingBox">
	</center>
       </div>
      </div>

      <div style="float:left; width:350px; margin-left:50px; font-size:16px;">
	<h2 class="boundingBox">Observations</h2>
	Selected values at &lambda;=222nm :
	<table width=100% border="1">
	  <tr><th width="33%">Temperature</th><th width="34%">MRE Values at 222 nm</th><th width="33%">% Helicity</th></tr>
	<?php 
	  for($i = $start; $i<=$end;$i += $gap){
	?>
	  <tr> <td  align="center"><?php echo $i." C"?></td> <td id="<?php echo 'temp'.$i.'C';?>" align="center"> ? </td> <td id="<?php echo 'temp@'.$i.'C';?>"></td></tr>
	<?php 
	  }
	?>
	<tr border="0" align="center" ><td></td><td>
	  <input type="button" value="Plot" onclick="genAnalysis(0)" class="boundingBox">
		</td>
		<td>
	  <input type="button" value="Plot" onclick="genAnalysis(1)" class="boundingBox">
		</td>
	</tr>
	</table>
	<center><br><br><br>
	<tr><center><button class="boundingBox" onclick='window.location="index.html";'>Go To Analysis</button></center> 
</tr>

	</center>
      </div>
      <input type="hidden" value="<?php echo $start; ?>" id="start">
      <input type="hidden" value="<?php echo $end; ?>" id="end">
      <input type="hidden" value="<?php echo $gap; ?>" id="gap">

	

   </div> <!-- #content -->
       
    
 </body>
</html>

