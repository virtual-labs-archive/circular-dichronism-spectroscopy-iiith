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

  <form name="quiz" action="compare.php" method="POST">
  <ol>
  <table>
  <tr><td width=70%>
    <li>
	 Among Sample1 and Sample2 which one undergoes a transition from folded to unfolded state?
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">Only Sample1</li>
	 <li><input type="radio" name="q1" value="B">Only Sample2</li>
	 <li><input type="radio" name="q1" value="C">None of them</li>
	 <li><input type="radio" name="q1" value="D">Both of them</li>
      </ol>
    </li>
<br>	<?php 
	if($_POST){
		echo "</td><td width=30%>";
		if($_POST['q1'] == "D"){
			echo "<span style='color:green'>(".$_POST['q1'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q1'].") IS NOT CORRECT ! CORRECT answer is (D).</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
    <li>
	 Which of the following statement is true?
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">Dynode voltage does not change with temperature at all, for both sample1 and sample2.</li>
	 <li><input type="radio" name="q2" value="B">Dynode voltage does not change with temperature in sample2 but in sample1 it increases suddenly at transition temperature.</li>
	 <li><input type="radio" name="q2" value="C">Dynode voltage does not change with temperature in sample1 but in sample2 it increases suddenly at transition temperature.</li>
	 <li><input type="radio" name="q2" value="D">Dynode voltage increases suddenly at transition temperature for both sample1 and sample2.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "C"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 	 Which of the following statement is true?
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">At unfolded state, sample1 undergoes aggregation, sample2 does not.</li>
	 <li><input type="radio" name="q3" value="B">At unfolded state, sample2 undergoes aggregation, sample1 does not.</li>
	 <li><input type="radio" name="q3" value="C">At unfolded state, both sample1 and sample2 undergoes aggregation.</li>
	 <li><input type="radio" name="q3" value="D">At unfolded state, no one of the sample1 and sample2 undergoes aggregation.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q3'] == "B"){
			echo "<span style='color:green'>(".$_POST['q3'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q3'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>

<!--  <tr><td>
    <li>
	 At the transition temperature is there any sudden change in the dynode voltage?
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">Dynode Voltage increases suddenly.</li>
	 <li><input type="radio" name="q4" value="B">Does not increase or decrease suddenly.</li>
	 <li><input type="radio" name="q4" value="C">Dynode Voltage decreases suddenly.</li>
	 <li><input type="radio" name="q4" value="D">Dynode Voltage goes to zero at transition temperature.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q4'] == "A"){
			echo "<span style='color:green'>(".$_POST['q4'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q4'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 Can you draw any conclusion about the AGGREGATION effect from the above observations?
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">No aggregation effect takes place.</li>
	 <li><input type="radio" name="q5" value="B">Aggregation takes place at the unfolded state of teh protein.</li>
	 <li><input type="radio" name="q5" value="C"></li>
	 <li><input type="radio" name="q5" value="D">10 degree C</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q5'] == "B"){
			echo "<span style='color:green'>(".$_POST['q5'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q5'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr> -->
  </table>
  </ol>
	
	<?php	if(!$_POST){ ?>
	<input type="submit" id="go" class="boundingBox" value="SUBMIT"><br><br><Br>
	<?php }?>
	</form>
<center><button class="boundingBox1" onclick='window.location="../index.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="../../index.html";'><strong>Back To Theory<string></button></center>
</div>
</body>
</html>

