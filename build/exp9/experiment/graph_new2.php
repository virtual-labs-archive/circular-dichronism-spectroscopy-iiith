<?php
	$chemical = $_GET['chemical'];
	if($chemical == ""){
		$chemical = "sds";
	}
?>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="flot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="scripts/E9dataJSON.js"></script>
 <script type="text/javascript">
  var chemical;
  $(document).ready(function(){
	 chemical = document.getElementById("chemical").value;
	 plotChemical(chemical);
  });
 function plotChemical(chemical){	
    $(function() {
      if(chemical == "all"){
	var d = [];
  	for(var i = 0 ; i <= 4 ; i++){
	   d[i] = [];
	   for(var j = 0 ; j <= 50 ; j++){	
     	  	d[i].push([j+210, data1[50-j][arr[i]]]);
	   }
	}
	var dataLabels = [];
	for(var i = 0 ; i <= 4 ; i+=1){
		dataLabels.push({"label": "<span style='font-size:10px;'> "+dict[arr[i]]+"  </span>", "data": d[i], points: {show:true}, lines: {show:true}});
  	}
	$.plot($("#placeholder"), 
		 dataLabels ,
		{ grid: { hoverable: true, clickable: false}
      		}
	);
	
      }
      else{
    	var d1 = [];
    	for (var i = 0; i <= 50; i += 1){
     	  d1.push([i+210, data1[50-i][chemical]]);
      	}
	var plot =  $.plot($("#placeholder"), 
			[ {label: "MRE Vs &lambda;(in nm)<br> For " + dict[chemical], data: d1, points: {show:true}, lines: {show:true}} ],
			{ grid: { hoverable: true, clickable: true }
      			}
		    );
	document.getElementById(chemical).innerHTML = "<td>"+dict[chemical]+"</td><td>"+data2[0][chemical]+"</td><td>"+data2[1][chemical]+"</td><td>"+data2[2][chemical]+"</td><td>"+data2[3][chemical]+"</td><td>"+data2[4][chemical]+"</td>";
	if(chemical == "tfa"){
		document.getElementById(chemical).innerHTML = "<td>"+dict[chemical]+"*</td><td>"+data2[0][chemical]+"</td><td>"+data2[1][chemical]+"</td><td>"+data2[2][chemical]+"</td><td>"+data2[3][chemical]+"</td><td>"+data2[4][chemical]+"</td>";
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
	    document.getElementById("temp"+ curr+"C").innerHTML = pos.y.toFixed(2);
	    analysisData[(curr-start)/gap ] = [curr,pos.y.toFixed(2)];
	    plot.unhighlight();
            plot.highlight(item.series, item.datapoint);
        }
      });

    });
 }

 </script>
<style type="text/css">
*{
	font-family: Verdana, calibri;
}

#content{
	margin : auto;
	width: 1150px;
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
th{
	font-size : 13px;
}

</style>



 </head>
 <body>
    <div id="content">
      <div style="float:left; width:600px; text-align:left;"> 
	<h1 class="boundingBox">CD Spectrum of Rhodospin</h1><br>
       <div id="placeholder" style="width:600px;height:400px;"></div>
       <div style="margin-left: 50px;" id="graph1_Lower">	
	<h3 class="boundingBox" style="width:200px;" >Select Chemical</h3>
	<table cellspacing=10>
	<tr>
	  <td><input type="radio" name="select_chemical" value="sds" onclick='plotChemical("sds");' >30% SDS</td>
	  <td><input type="radio" name="select_chemical" value="guhcl" onclick='plotChemical("guhcl");'>8M GuHCl</td>
	  <td><input type="radio" name="select_chemical" value="none" onclick='plotChemical("without");'>No Chemical</td>
  	</tr>
	<tr>
	  <td><input type="radio" name="select_chemical" value="urea" onclick='plotChemical("urea");'>10M Urea</td>
	  <td><input type="radio" name="select_chemical" value="tfa" onclick='plotChemical("tfa");'>4M TFA</td>
	  <td><input type="radio" name="select_chemical" value="all" onclick='plotChemical("all");'>See All</td>
	</tr>
	</table>
        <p id="hoverdata" style="font-size:11px;"> Mouse Hover Position: 
        (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></p>

	
	
       </div>
      </div>

      <div style="float:left; width:500px; margin-left:50px; font-size:16px;">
	<h2 class="boundingBox">Observations</h2><br>
	<table width=100% border="1" cellpadding=5 style="font-size:12px;">
	  <tr><th width="20%">Chemical</th><th width="20%">Helix</th><th width="20%">Antiparallel</th><th width="20%">Parallel</th><th width="20%">Beta-turn</th><th width="20%">Random Coil</th></tr>
	  <tr id="sds"><td>30% SDS</td><td></td><td></td><td></td><td></td><td></td></tr>
	  <tr id="urea"><td>10M Urea</td><td></td><td></td><td></td><td></td><td></td></tr>
	  <tr id="guhcl"><td>8M GuHCl</td><td></td><td></td><td></td><td></td><td></td></tr>
	  <tr id="tfa"><td>4M TFA*</td><td>0.0</td><td>0.0</td><td>0.0</td><td>0.0</td><td>0.0</td></tr>
	  <tr id="without"><td>No Chemical</td><td></td><td></td><td></td><td></td><td></td></tr>
	</table>
	<span style="font-size:11px;">* - Cannot be determined.</span><br>
	<center><button class="boundingBox" onclick='window.location="graph2.php";'>Effect Of Concentration</button></center>
	<br>
	<h3 class="boundingBox" style="width:100%;">INSTRUCTIONS</h3>
	<ul style="font-size:13px;">
	  <li>Select any chemical to see the corresponding CD spectra.</li>
	  <li>Information about the secondary structure of the protein with that chemical in also shown in the right.</li>
	  <li>To study effect of concentration of the chemical click “Effect of Concentration” button.</li>
	</ul>

	<center>
	</center>
      </div>
      <input type="hidden" value="<?php echo $chemical; ?>" id="chemical">

   </div> <!-- #content -->
       
    
 </body>
</html>

