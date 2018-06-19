<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<style type="text/css">
*{
	font-family: Verdana, calibri;
}

#content{
	margin : auto;
	width: 1000px;
}

.boundingBox1{	
	text-align:center;
	background:#cccfff;
	padding: 15px 2px 15px 2px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-box-shadow: 10px 10px 5px #888;
	-webkit-box-shadow: 10px 10px 5px #888;
	box-shadow: 10px 10px 5px #888;
}
.boundingBox2{	
	text-align:center;
	background:#cccccc;
	padding: 15px 2px 15px 2px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-box-shadow: 10px 10px 5px #888;
	-webkit-box-shadow: 10px 10px 5px #888;
	box-shadow: 10px 10px 5px #888;
	width:100px; 
	float:left; 
	margin-left:20px;
}
a:link {text-decoration:none;color:#000000;}
a:visited {text-decoration:none;color:#000000;}
a:hover {text-decoration:none;color:#000000;}
a:active {text-decoration:none;color:#000000;}
#start{
	clear:both;
	float:right;
	width:150px;
	color: green;
}
#start a{
	color:green;
	text-decoration: none;
}
#mainContent{
clear:both;
float:left;
margin-top:20px;
width:700px;
height:300px;

}
#instructions{
float:left;
width:280px;
margin-top:20px;
border-left:1px solid #cccccc;
height:300px;
}
#setupImage{
clear:both;
}
</style>
<script type="text/javascript">
var sampleSelected=0;
var startFlag=false;
function changeMode(){
	document.getElementById("switch").style.background="#cccccc";
	document.getElementById("setupImage").innerHTML="<img src='setup_ord.jpg'>";
	startFlag=true;
	for(var i = 1; i<=6 ; i++){
		document.getElementById("s"+i).style.background="#cccfff";
	}

}
function sampleClicked(sno){
	if(!startFlag)
		return;
	document.getElementById("measureORD").style.display="";	
	document.getElementById("mainContent").innerHTML="<img src='diagram.png'><br><a href=''>More Info</a>";	
	for(var i = 1; i<=6 ; i++){
		document.getElementById("s"+i).style.background="#cccfff";
	}
	document.getElementById("s"+sno).style.background="#aaafff";
	sampleSelected=sno;	
	
}
function measureORD(){
	if(sampleSelected==0 || !startFlag)
		return;
	
	document.getElementById("mainContent").innerHTML='<object width="600" height="300"><param name="movie" value="graph'+sampleSelected+'.swf"/><embed src="graph'+sampleSelected+'.swf" width="600" height="300"/></object>';	
	document.getElementById("analysisLink").style.display="";	
}
</script>
<title> Experiment 3 </title>
</head>
<body>
<div id="content">
<a href="#" onclick="changeMode();"><h4 class="boundingBox1" id="switch" style="width:200px;margin-left:20px;float:left; "> Switch to ORD Mode </h4></a>
<a href="#" onclick="measureORD()"><h4 class="boundingBox1" id="measureORD" style="margin-left:40px; width:150px; float:left; display:none;" > Measure ORD </h4></a>
<a href="page4.php" ><h4 class="boundingBox1" id="analysisLink" style="margin-left:40px; width:150px; float:left; display:none;" > Go To Analysis </h4></a>
<a href="#" id="s1" class="boundingBox2" style="clear:left;" onclick="sampleClicked('1');"> Sample 1 </a>
<a href="#" id="s2" class="boundingBox2"  onclick="sampleClicked('2');"> Sample 2 </a>
<a href="#" id="s3" class="boundingBox2"  onclick="sampleClicked('3');"> Sample 3 </a>
<a href="#" id="s4" class="boundingBox2"  onclick="sampleClicked('4');"> Sample 4 </a>
<a href="#" id="s5" class="boundingBox2"  onclick="sampleClicked('5');"> Sample 5 </a>
<a href="#" id="s6" class="boundingBox2"  onclick="sampleClicked('6');"> Sample 6 </a>
<div id="mainContent">
</div>

<div id="instructions" >
<center><h4>INSTRUCTIONS</h4></center>
<li>Click on the "Swicth to ORD Mode" to enable the spectrometer to operate in ORD mode.</li><br>
<li>Select any sample by clicking on the corresponding button.</li><br>
<li>Click on the "Measure ORD" button to measure the ORD spectra of the selected sample.</li><br>
<li>Click on any other sample to measure the ORD spectra of that sample.</li><br>
<li>Once you are done with the experiment click on "Go To Analysis" to analysis page.</li>

</div>
<div id="setupImage">
<img src="setup.jpg">
</div>
</div>
</body>
</html>

