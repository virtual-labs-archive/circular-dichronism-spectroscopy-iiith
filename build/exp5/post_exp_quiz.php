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

  <form name="quiz" action="post_exp_quiz.php" method="POST">
  <ol>
  <table>
  <tr><td width=70%>
    <li>
	 Nitrogen purging should be done:
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">Before switching on the light source</li>
	 <li><input type="radio" name="q1" value="B">After switching on the light source</li>
	 <li><input type="radio" name="q1" value="C">Any time during the measurement</li>
	 <li><input type="radio" name="q1" value="D">None of the above are correct</li>
      </ol>
    </li>
<br>	<?php 
	if($_POST){
		echo "</td><td width=30%>";
		if($_POST['q1'] == "A"){
			echo "<span style='color:green'>(".$_POST['q1'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q1'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
    <li>
	 Reason for purging Nitrogen in the chamber of the CD spectrometer is:
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">Nitrogen is an inert gas.</li>
	 <li><input type="radio" name="q2" value="B">Oxygen present may be converted to ozone by far-UV light from the high intensity arc, and ozone will damage optical surfaces</li>
	 <li><input type="radio" name="q2" value="C">Nitrogen Gas(N2)makes up 78.03% of the air.</li>
	 <li><input type="radio" name="q2" value="D">None of the above are correct</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "B"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 Why it is essential to run a blank spectrum with buffer or solvent system before measuring the spectrum for sample:
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">In order to check that the absorbance and High Tension voltage is not excessive.</li>
	 <li><input type="radio" name="q3" value="B">To measure the absorbance of buffer.</li>
	 <li><input type="radio" name="q3" value="C">Selection of good buffer.</li>
	 <li><input type="radio" name="q3" value="D">All of the above are correct</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q3'] == "A"){
			echo "<span style='color:green'>(".$_POST['q3'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q3'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
    <li>
	 Why the regulation of temperature of the cell holder is important:
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">To prevent the optics from damage.</li>
	 <li><input type="radio" name="q4" value="B">To keep the sample in homogenized state and avoid sample denaturation.</li>
	 <li><input type="radio" name="q4" value="C">To maintain the temperature of the buffer or solvent used.</li>
	 <li><input type="radio" name="q4" value="D">None of the above are correct.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q4'] == "B"){
			echo "<span style='color:green'>(".$_POST['q4'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q4'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 How much time is required for the machine to warm up and achieve stability
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">1 min</li>
	 <li><input type="radio" name="q5" value="B">10 min</li>
	 <li><input type="radio" name="q5" value="C">15 min</li>
	 <li><input type="radio" name="q5" value="D">30 min </li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q5'] == "D"){
			echo "<span style='color:green'>(".$_POST['q5'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q5'].") IS NOT CORRECT ! CORRECT answer is (D).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 The optimum path length generally required for:
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">Far UV CD spectra.</li>
	 <li><input type="radio" name="q5" value="B">Near UV CD spectra.</li>
	 <li><input type="radio" name="q5" value="C">None of the above are correct.</li>
	 <li><input type="radio" name="q5" value="D">Both (A) and (B) are correct.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q5'] == "A"){
			echo "<span style='color:green'>(".$_POST['q5'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q5'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
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
<center><button class="boundingBox1" onclick='window.location="./swf.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="./index.html";'><strong>Back To Theory<string></button></center>


</div>
</body>
</html>

