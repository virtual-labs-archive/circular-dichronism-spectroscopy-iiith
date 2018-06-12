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
	 Different conformations of the protein differ only in:
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">distance between the bonds of backbone and amino acid side chains</li>
	 <li><input type="radio" name="q1" value="B">number of amino acid side-chains</li>
	 <li><input type="radio" name="q1" value="C">angle of rotation about the bonds of backbone and amino acid side-chains</li>
	 <li><input type="radio" name="q1" value="D">measure of dihedral angle at the peptide</li>
      </ol>
    </li>
<br>	<?php 
	if($_POST){
		echo "</td><td width=30%>";
		if($_POST['q1'] == "C"){
			echo "<span style='color:green'>(".$_POST['q1'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q1'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
    <li>
	 Chemical denaturation denotes marked change in protein structure of the native protein in response to:
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">change in temperature</li>
	 <li><input type="radio" name="q2" value="B">acid or alkali</li>
	 <li><input type="radio" name="q2" value="C">Disruption of weak interactions by boiling</li>
	 <li><input type="radio" name="q2" value="D">Exposure to detergents</li>
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
	  Which of the following chemical denaturant is not an inorganic salt?
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">Lithium bromide</li>
	 <li><input type="radio" name="q3" value="B">Potassium thiocyanate</li>
	 <li><input type="radio" name="q3" value="C">Dimethyl Formamide</li>
	 <li><input type="radio" name="q3" value="D">Sodium iodide</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q3'] == "C"){
			echo "<span style='color:green'>(".$_POST['q3'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q3'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
    <li>
	What mol/l of Urea acts as a Chaotrophic chemical denaturant?
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">7-14 mol/l</li>
	 <li><input type="radio" name="q4" value="B">6-8 mol/l</li>
	 <li><input type="radio" name="q4" value="C">10 -12 mol/l</li>
	 <li><input type="radio" name="q4" value="D">2-4 mol/l</li>
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
	 Acids and bases denature a protein by disrupting:
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">peptide bonds and ionic bonds</li>
	 <li><input type="radio" name="q5" value="B">hydrophobic interactions and peptide bonds</li>
	 <li><input type="radio" name="q5" value="C">ionic bonds and hydrogen bonds</li>
	 <li><input type="radio" name="q5" value="D">amide bonds and alkene bonds</li>
	 <li><input type="radio" name="q5" value="E">ionic bonds and hydrophobic interactions</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q5'] == "C"){
			echo "<span style='color:green'>(".$_POST['q5'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q5'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>
  
  <tr><td>
     <li>
	 What kind of interactions are not part of the protein tertiary structure ?
      <ol type="A">
	 <li><input type="radio" name="q6" value="A">disulphide bonds</li>
	 <li><input type="radio" name="q6" value="B">hydrophobic interactions</li>
	 <li><input type="radio" name="q6" value="C">salt bridges</li>
	 <li><input type="radio" name="q6" value="D">hydrophilic interactions</li>
	 <li><input type="radio" name="q6" value="E">peptide bonds</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q6'] == "E"){
			echo "<span style='color:green'>(".$_POST['q6'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q6'].") IS NOT CORRECT ! CORRECT answer is (E).</span>";
		}
	}
	?>
  </td></tr>
  
  <tr><td>
     <li>
	The most important contribution to the stability of a protein&#39;s conformation appears to be the:
      <ol type="A">
	 <li><input type="radio" name="q7" value="A">entropy increase from the decrease in ordered water molecules forming a solvent shell around it.</li>
	 <li><input type="radio" name="q7" value="B">maximum entropy increase from ionic interactions between the ionized amino acids in a protein. </li>
	 <li><input type="radio" name="q7" value="C">sum of free energies of formation of many weak interactions among the hundreds of amino acids in a protein.</li>
	 <li><input type="radio" name="q7" value="D">sum of free energies of formation of many weak interactions between its polar amino acids and surrounding water.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q7'] == "A"){
			echo "<span style='color:green'>(".$_POST['q7'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q7'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>
  
  <tr><td>
     <li>
	Which of the following chemical denaturant is a cross-linking reagent?
      <ol type="A">
	 <li><input type="radio" name="q8" value="A">Formaldehyde.</li>
	 <li><input type="radio" name="q8" value="B">Dimethyl Formamide.</li>
	 <li><input type="radio" name="q8" value="C">Formamide.</li>
	 <li><input type="radio" name="q8" value="D">Sodium dodecyl sulphate.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q8'] == "A"){
			echo "<span style='color:green'>(".$_POST['q8'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q8'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>
  
  <tr><td>
     <li>
	  An average protein will not be denatured by:
      <ol type="A">
	 <li><input type="radio" name="q9" value="A">a detergent such as sodium dodecyl sulfate.</li>
	 <li><input type="radio" name="q9" value="B">iodoacetic acid.</li>
	 <li><input type="radio" name="q9" value="C">heating to 90&deg;C.</li>
	 <li><input type="radio" name="q9" value="D">urea.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q9'] == "B"){
			echo "<span style='color:green'>(".$_POST['q9'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q9'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
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
