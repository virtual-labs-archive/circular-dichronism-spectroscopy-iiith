<?php
	$start = 0;
	$end = 8;
	$gap = 2;
?>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="flot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="scripts/E9dataJSON2.js"></script>
    <script language="javascript" type="text/javascript" src="scripts/E9dataJSON.js"></script>
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
	plotStartTemp(start+"M");
  });
 function changeStartTemp(temp){
	if(temp != "all"){
		curr = parseInt(temp);
		plotStartTemp(temp+"M");
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
	   for(var j = 210 ; j <= 260 ; j++){
		temp1 = i + "M";
     	  	d[i].push([j, data3[260-j][temp1]]);
	   }
	}
	var dataLabels = [];
	for(var i = start ; i <= end ; i+=gap){
		dataLabels.push({"label": "<span style='font-size:10px;'> "+i+" M </span>", "data": d[i], lines:{show:true}, points:{show:true}});
  	}
	$.plot($("#placeholder"), 
		 dataLabels ,
		{ grid: { hoverable: true, clickable: false },
		  yaxis: { min: -17500, max: 3000}
      		}
	);
	
      }
      else{
    	var d1 = [];
    	for (var i = 210; i <= 260; i++){
     	  d1.push([i, data3[260-i][temp]]);
      	}
	var plot =  $.plot($("#placeholder"), 
			[ {label: "MRE Vs &lambda;(in nm)<br> At Concentration: <span style='font-size:20px;'> "+temp+" </span>", 
			   data: d1, 
			   lines:{show:true}, 
			   points:{show:true},
			   color: "red"
			  }],
			{ grid: { hoverable: true, clickable: true },
			  yaxis: { min: -17500, max: 3000}
      			}
		    );
	for(var i = 0; i < 5; i++){
		document.getElementById("temp_"+i+"_"+curr+"M").innerHTML = data4[i][curr+'M'];
	}
		
      }

            
      var previousPoint = null;
      $("#placeholder").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(2));
        $("#y").text(pos.y.toFixed(2));
      });
 
      $("#placeholder").bind("plotclick", function (event, pos, item) {
        if (item) {
            $("#clickdata").text("You clicked point ( " + pos.x.toFixed(2) + " , " + pos.y.toFixed(2) + " )."  );
	    document.getElementById("temp"+ curr+"M").innerHTML = pos.y.toFixed(2);
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
    var next = curr+"M";
    plotStartTemp(next);
    document.getElementById("tempDropDown").options[(curr-start)/gap].selected = true;

 }
 function prevGraph(){
    if(curr-gap < start){
       return;
    }
    curr -= gap;
    var prev = curr+"M";
    plotStartTemp(prev);
    document.getElementById("tempDropDown").options[(curr-start)/gap].selected = true;
 }

 function genAnalysis(flag){
	if(flag == 'none'){
		objid = "temp";
		d1 = [[0,-14395.074666],[2,-14015.5543],[4,-10740.2517],[6,-5335.8963],[8,-3585.8617]];

	}
	else{
		objid = "temp_"+flag+"_";
	}
	d = [];
	for(var i = 0; i<=8 ; i += 2){
		var x = document.getElementById(objid + i + "M").innerHTML;	
		if(x == "?" || x == ""){
			return;
		}
		d.push([i,x]);	
	}
	var names = ["% Helix Content","% Antiparallel Content","% Parallel Content","% Beta-turn Content","% Random Coil Content"];
	if(flag == 'none'){
		var plot =  $.plot($("#placeholder"), 
			[ 
			 {label: "User selected MRE values at 222nm"+" Vs Concentration", data: d, lines:{show:true}, points:{show:true}, color:"red"}, 
			 {label: "Original MRE values at 222 nm"+" Vs Concentration:ORIGINAL", data: d1, lines:{show:true}, points:{show:true}, color: "green"} 
			],
			{ grid: { hoverable: true, clickable: true },
			}
			);
	}
	else{
		var plot =  $.plot($("#placeholder"), 
			[ 
			 {label: names[flag]+" Vs Concentration", data: d, lines:{show:true}, points:{show:true}, color:"red"}, 
			],
			{ grid: { hoverable: true, clickable: true },
			  yaxis: { min: 0 , max: 55}
			}
			);

	}
	document.getElementById("graph1_Lower").style.display =  "none";
	document.getElementById("graph2_Lower").style.display =  "";
	

 }
 
 function removeAnalysis(){
	plotStartTemp(curr+"M");
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
	width: 1200px;
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
	<h1 class="boundingBox">Data Analysis And Calculation</h1><br>
       <div id="placeholder" style="width:600px;height:400px;"></div>
       <div style="margin-left: 50px;" id="graph1_Lower">	
	<h3 class="boundingBox" style="width:110px;">CONTROLS</h3>
        <input type="button" value="Previous" onclick="prevGraph()" class="boundingBox">&nbsp;&nbsp;
        <input type="button" value="Next" onclick="nextGraph()" class="boundingBox">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	See Spectrum At Concentration:
        <select name="temperature" onchange="changeStartTemp(this.options[this.selectedIndex].value)" id="tempDropDown" class="boundingBox">
	<?php 
	  for($i = $start; $i<=$end;$i += $gap){
	?>
	   <option value="<?php echo $i;?>"><?php echo $i." M";?></option>
	<?php 
	  }
	?>
	   <option value="all">See All</option>
	</select>
        <p id="hoverdata" style="font-size:11px;"> Mouse Hover Position: 
        (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></p>
	

       </div>
       <div style="margin-left: 50px;display:none;" id="graph2_Lower">		
	<center>
	  <input type="button" value="GO BACK" onclick="removeAnalysis();" class="boundingBox">
	</center>
       </div>
      </div>

      <div style="float:left; width:550px; margin-left:50px; font-size:16px;">
	<h2 class="boundingBox">Observations</h2>
	<ul style="font-size:12px"><li>User has to fill up second column by clicking at &lambda;=222nm value on the graph.</li>
	<li>Information about the secondary structure is obtained after deconvolution of CD spectra.</ul>
	<table width=100% border="1" style="font-size:12px;">
	  <tr><th width="16%">Concentration</th><th width="14%">MRE Value at 222 nm</th><th width="14%">Helix</th><th width="14%">Antiparallel</th><th width="14%">Parallel</th><th width="14%">Beta-turn</th><th width="14%">Random Coil</th></tr>
	<?php 
	  for($i = 0; $i<=8 ;$i += 2){
	?>
	  <tr> 
	    <td  align="center"><?php echo $i." M"?></td> 
	    <td id="<?php echo 'temp'.$i.'M';?>" align="center">?</td> 
	    <td id="<?php echo 'temp_0_'.$i.'M';?>"></td>
	    <td id="<?php echo 'temp_1_'.$i.'M';?>"></td>
	    <td id="<?php echo 'temp_2_'.$i.'M';?>"></td>
	    <td id="<?php echo 'temp_3_'.$i.'M';?>"></td>
	    <td id="<?php echo 'temp_4_'.$i.'M';?>"></td>
	  </tr>
	<?php 
	  }
	?>
	<tr border="0" align="center" ><td></td><td>
	  <input type="button" value="Plot" onclick="genAnalysis('none')" class="boundingBox">
		</td>
		<td>
	  <input type="button" value="Plot" onclick="genAnalysis(0)" class="boundingBox">
		</td>
		<td>
	  <input type="button" value="Plot" onclick="genAnalysis(1)" class="boundingBox">
		</td>
		<td>
	  <input type="button" value="Plot" onclick="genAnalysis(2)" class="boundingBox">
		</td>
		<td>
	  <input type="button" value="Plot" onclick="genAnalysis(3)" class="boundingBox">
		</td>
		<td>
	  <input type="button" value="Plot" onclick="genAnalysis(4)" class="boundingBox">
		</td>
	</tr>
	
	</table>
	<center>
	</center>
	<br><br>
	<h3 class="boundingBox" style="width:100%;">INSTRUCTIONS</h3>
	<ul style="font-size:13px;">
	  <li>Click on the graph at 222nm to fill up the Observation Table.</li>
	  <li>Click on Next to see the graph at next higher concentration.</li>
	  <li>Click on the Previous to see the graph at previous lower concentration.</li>
	  <li>Click on Analysis to see the change of parameter with concentration.</li>
	</ul>

      </div>
      <input type="hidden" value="<?php echo $start; ?>" id="start">
      <input type="hidden" value="<?php echo $end; ?>" id="end">
      <input type="hidden" value="<?php echo $gap; ?>" id="gap">
	<br><br><br>
	<center><button class="boundingBox" onclick='window.location="../quiz2/quiz.php";'>Go To Analysis</button></center> 

   </div> <!-- #content -->
       
    
 </body>
</html>

