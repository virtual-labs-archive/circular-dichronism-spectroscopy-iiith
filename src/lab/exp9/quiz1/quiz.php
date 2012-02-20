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
	 From the animation determine at which concentration of Urea the protein unfolds to the maximum extent?
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">4M</li>
	 <li><input type="radio" name="q1" value="B">6M</li>
	 <li><input type="radio" name="q1" value="C">8M</li>
	 <li><input type="radio" name="q1" value="D">10M</li>
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
	 Among the following chemicals which causes the maximum amount of unfolding of alpha helix of the protein?
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">30% SDS</li>
	 <li><input type="radio" name="q2" value="B">10M Urea</li>
	 <li><input type="radio" name="q2" value="C">8M GuCl</li>
	 <li><input type="radio" name="q2" value="D">No unfolding takes place.</li>
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
	 In Rhodopsin, among the following secondary structures, which one increases the most in the presence of chemical denaturants?
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">Helix</li>
	 <li><input type="radio" name="q3" value="B">Random Coil</li>
	 <li><input type="radio" name="q3" value="C">Beta Turn</li>
	 <li><input type="radio" name="q3" value="D">Parallel Sheet</li>
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

  <tr><td>
    <li>
	 Information about secondary structure content can not be determined from Cd spectra of 4M TFA. Why it is so?
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">It reacts with Rhodopsin.</li>
	 <li><input type="radio" name="q4" value="B">The curve is flat.</li>
	 <li><input type="radio" name="q4" value="C">No denaturation takes place.</li>
	 <li><input type="radio" name="q4" value="D">TFA has a very low melting point.</li>
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
	 What is the full name of SDS?
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">Sodium Dodecyl Sulphate.</li>
	 <li><input type="radio" name="q5" value="B">Sodium Di Sulphate.</li>
	 <li><input type="radio" name="q5" value="C">Sodium Di Sulphite.</li>
	 <li><input type="radio" name="q5" value="D">None of this.</li>
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
<center><button class="boundingBox1" onclick='window.location="../experiment/index.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="../index.html";'><strong>Back To Theory<string></button></center>


</div>
</body>
</html>

