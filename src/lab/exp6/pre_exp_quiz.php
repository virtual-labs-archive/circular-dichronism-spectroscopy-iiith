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

  <form name="quiz" action="pre_exp_quiz.php" method="POST">
  <ol>
  <table>
  <tr><td width=70%>
    <li>
	In biological reactions proteins play a role of a ______________ ?
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">Reactant.</li>
	 <li><input type="radio" name="q1" value="B">Product.</li>
	 <li><input type="radio" name="q1" value="C">Catalyst.</li>
	 <li><input type="radio" name="q1" value="D">Does not play any role.</li>
      </ol>
    </li>
<br>	<?php 
	if($_POST){
		echo "</td><td width=30%>";
		if($_POST['q1'] == "C"){
			echo "<span style='color:green'>(".$_POST['q1'].") IS CORRECT</span>";
		}
		else if($_POST['q1'] == "B" || $_POST['q1'] == "A" || $_POST['q1'] == "D"){
			echo "<span style='color:red'>(".$_POST['q1'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q1'].") DIDN'T ATTEMPT.</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
    <li>
	 Protein is a polymer. Monomeric unit of which is amino acid. Each amino acid has a chiral center. So is it possible to apply CD spectrum to study the structure of a protein?
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">Yes.</li>
	 <li><input type="radio" name="q2" value="B">No.</li>
	 <li><input type="radio" name="q2" value="C">The given information is not enough. Can not conclude.</li>
	 <li><input type="radio" name="q2" value="D">CD spectroscopy may be used for some protein not all.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "A"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else if($_POST['q2'] == "B" || $_POST['q2'] == "C" || $_POST['q2'] == "D"){
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") DIDN'T ATTEMPT.</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 Having known the primary structure of a protein the main interest of biologists is to know the secondary structure of a protein. How a spectroscopic method can help it?
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">Response only for a particular secondary structure, for others structures remain silent.</li>
	 <li><input type="radio" name="q3" value="B">Give signature spectra for each different secondary structure.</li>
	 <li><input type="radio" name="q3" value="C">Spectroscoppic methods can not help.</li>
	 <li><input type="radio" name="q3" value="D">can not say.</li>
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

