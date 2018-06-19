<html>
<head>
<script type="text/javascript" language="javascript">
var N = 0;
function changeMode(){
	var obj1 = document.getElementById("ord");
	var obj2 = document.getElementById("cd");
	var obj3 = document.getElementById("switch");
	var obj4 = document.getElementById("setup");
	if(obj1.style.display == "none"){
		obj2.style.display = "none";
		obj1.style.display = "";
		obj3.innerHTML = '<img src="switch.jpg" height="60px" width="150px" align="right"> </img>';
		obj4.innerHTML = '<img src="setup_ord.jpg"> </img>';
	}
	else{
		obj1.style.display = "none";
		obj2.style.display = "";
		obj3.innerHTML = '<img src="switchback.jpg" height="60px" width="150px" align="right"> </img>';
		obj4.innerHTML = '<img src="setup_cd.jpg"> </img>';
	}
	document.getElementById("graph"+N).style.display = "none";
	N = 0;
}
function showGraph(n){
	var gr = "graph"+n;
	var GR = "graph"+N;
	var obj1 = document.getElementById(gr);
	var obj2 = document.getElementById(GR);
	obj2.style.display = "none";
	obj1.style.display = "";
	N = n;
	document.getElementById("afterGraph").style.display="block";
	
}
</script>
</head>
<body>
<h3><font color="green">Switch between ORD & CD mode and measure the corresponding spectrum.</font></h3>

<div id="container" style="position:absolute;width:1000px;height:550px;" align="left">

<div id="link list" style="float:right">

<a href="#" onclick="changeMode()"><span id="switch"> <img src="switch.jpg" height="60px" width="150px" align="right"> </img> </span></a>
<br/><br/><br/><br/>
<span id="ord"><a href="#" onclick='showGraph("1");'><img src="sample2.jpg" height="60px" width="150px" align="right"> </img></a>
<br/><br/><br/><br><a href="#" onclick='showGraph("3");'>
<img src="sample3.jpg" height="60px" width="150px" align="right"> </img></a></span>
<span id="cd" style="display:none"><a href="#" onclick='showGraph("2");'>
<img src="sample1.jpg" height="60px" width="150px" align="right"> </img></a>
<br/><br/><br/><br><a href="#" onclick='showGraph("4");'>
<img src="sample4.jpg" height="60px" width="150px" align="right"> </img></a></span>
<span id="afterGraph" style = "display:none">
<br/><br/><br/><br/>

		<a href="page4.php">
		<img src="gotoanalysis.jpg" height="40px" width="100px" align="right"> </img> </a>
<br/><br/><br/><br/>

		<a href="list.php">
		<img src="reset.jpg" height="40px" width="100px" align="right"> </img> </a>


</span>

</div>

<div id = "graph0">
	<img src="observe.png" width="550" height="400">
</div>

<div id="graph1"  style = 'display:none;'>

<object width="550" height="400">
<param name="movie" value="graph1.swf">
<embed src="graph1.swf" width="550" height="400">
</embed>
</object>

</div>

<div id="graph2"  style = 'display:none;'>

<object width="550" height="400">
<param name="movie" value="graph2.swf">
<embed src="graph2.swf" width="550" height="400">
</embed>
</object>

</div>

<div id="graph3"  style = 'display:none;'>

<object width="550" height="400">
<param name="movie" value="graph3.swf">
<embed src="graph3.swf" width="550" height="400">
</embed>
</object>

</div>

<div id="graph4"  style = 'display:none;'>

<object width="550" height="400">
<param name="movie" value="graph4.swf">
<embed src="graph4.swf" width="550" height="400">
</embed>
</object>

</div>



	<div id="bottom" style="position:absolute;bottom:0;">
	
		<span id="setup"><img src="setup_ord.jpg"> </img></span>
	</div>

</div>
</body>

</html>
