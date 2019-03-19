<html>
<head>
<style type="text/css">
*{
	font-family: Verdana, calibri;
}

#content{
	margin : auto;
	width: 900px;
}
.boundingBox{	
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
tr .boundingBox {
	width:100px;
}
.boundingBox1{	
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
#go{
	clear:both;
	float:right;
	width:200px;
	font-weight:bold;
	color: green;
	-moz-box-shadow: 5px 5px 5px #888;
	-webkit-box-shadow: 5px 5px 5px #888;
	box-shadow: 5px 5px 5px #888;	
}
</style>
<script type="text/javascript">
function getOptions(opt){
	var options = "";
	for(var i = parseInt(opt) ; i <= 100 ; i += 5){
		if(i == 100){	
			options =  options + "<option value='"+i+"' selected='true'>"+i+" C</option>\n";
		}
		else{
			options =  options + "<option value='"+i+"'>"+i+" C</option>\n";
		}
	}
	document.getElementById("end").innerHTML = options;
}
</script>
</head>
<body>
<div id="content">
  <h1 class="boundingBox">Answer The Following Questions</h1><br>

  <form name="quiz" action="quiz.php" method="POST">
  <ol>
  <table>
  <tr><td width=70%>
    <li>
	 Molecular weight of a R enantiomer is __________ than that of S enantiomer.

      <ol type="A">
	 <li><input type="radio" name="q1" value="A">Higher</li>
	 <li><input type="radio" name="q1" value="B">Equal</li>
	 <li><input type="radio" name="q1" value="C">Lower</li>
	 <li><input type="radio" name="q1" value="D">can not say</li>
      </ol>
    </li>
<br>	<?php 
	if($_POST){
		echo "</td><td width=30%>";
		if($_POST['q1'] == "B"){
			echo "<span style='color:green'>(".$_POST['q1'].") IS CORRECT</span>";
		}
		else if($_POST['q1'] == "A" || $_POST['q1'] == "C" || $_POST['q1'] == "D"){
			echo "<span style='color:red'>(".$_POST['q1'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q1'].") DIDN'T ATTEMPT.</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
    <li>
	 In normal ORD spectra there are ___ maxima and __ minima.
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">1,2</li>
	 <li><input type="radio" name="q2" value="B">1,1</li>
	 <li><input type="radio" name="q2" value="C">0,0</li>
	 <li><input type="radio" name="q2" value="D">0,1</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "C"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else if($_POST['q2'] == "B" || $_POST['q2'] == "A" || $_POST['q2'] == "D"){
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") DIDN'T ATTEMPT.</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 Octant rule determines __________ of Cotton effect in ketones.
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">magnitude</li>
	 <li><input type="radio" name="q3" value="B">sign</li>
	 <li><input type="radio" name="q3" value="C">probability</li>
	 <li><input type="radio" name="q3" value="D">frequency</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q3'] == "B"){
			echo "<span style='color:green'>(".$_POST['q3'].") IS CORRECT</span>";
		}
		else if($_POST['q3'] == "A" || $_POST['q3'] == "C" || $_POST['q3'] == "D"){
			echo "<span style='color:red'>(".$_POST['q3'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q3'].") DIDN'T ATTEMPT.</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
    <li>
	 Abnormal ORD is observed when _________ is present in a chiral environment.
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">chromophore</li>
	 <li><input type="radio" name="q4" value="B">asymmetry center</li>
	 <li><input type="radio" name="q4" value="C">chiral center</li>
	 <li><input type="radio" name="q4" value="D">none of the above</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q4'] == "A"){
			echo "<span style='color:green'>(".$_POST['q4'].") IS CORRECT</span>";
		}
		else if($_POST['q4'] == "B" || $_POST['q4'] == "C" || $_POST['q4'] == "D"){
			echo "<span style='color:red'>(".$_POST['q4'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q4'].") DIDN'T ATTEMPT.</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 At the absorption peak an anomalous ORD curve _____________.
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">reaches minimum</li>
	 <li><input type="radio" name="q5" value="B">crosses the base line</li>
	 <li><input type="radio" name="q5" value="C">reaches maximum</li>
	 <li><input type="radio" name="q5" value="D">none of the above</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q5'] == "B"){
			echo "<span style='color:green'>(".$_POST['q5'].") IS CORRECT</span>";
		}
		else if($_POST['q5'] == "A" || $_POST['q5'] == "C" || $_POST['q5'] == "D"){
			echo "<span style='color:red'>(".$_POST['q5'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q5'].") DIDN'T ATTEMPT.</span>";
		}
	}
	?>
  </td></tr>

   
</table>
  </ol>
	
	<?php	if(!$_POST){ ?>
	<input type="submit" id="go" class="boundingBox" value="SUBMIT"><br><br><Br>
	<?php }?>
	</form>
<center><button class="boundingBox1" onclick='window.location="./jmol/index.php";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="./index.html";'><strong>Back To Theory<string></button></center>


</div>
</body>
</html>

