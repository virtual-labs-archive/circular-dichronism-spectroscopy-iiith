<html>
<head>
<script class='gtm'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-W59SWTR');</script>

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
	 The passage of folded state of a protein is opposed by:
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">hydrophobic interaction</li>
	 <li><input type="radio" name="q1" value="B">formation of hydrogen bonds</li>
	 <li><input type="radio" name="q1" value="C">conformational entropy</li>
	 <li><input type="radio" name="q1" value="D">Van der Waals forces</li>
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
	 The regular alpha helix and beta sheet structures fold rapidly because they are stabilized by:
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">intermolecular hydrogen bonding</li>
	 <li><input type="radio" name="q2" value="B">Van der Waals forces</li>
	 <li><input type="radio" name="q2" value="C">inert pair effect</li>
	 <li><input type="radio" name="q2" value="D">intramolecular hydrogen bonding</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "D"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (D).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 Denaturation midpoint is defined as that temperature (Tm) or denaturant concentration (Cm) at which:
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">both the folded and unfolded states are over populated.</li>
	 <li><input type="radio" name="q3" value="B">the folded state is over populated than the unfolded state.</li>
	 <li><input type="radio" name="q3" value="C">the folded state is under populated than the unfolded state.</li>
	 <li><input type="radio" name="q3" value="D">both the folded and unfolded states are equally populated.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q3'] == "D"){
			echo "<span style='color:green'>(".$_POST['q3'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q3'].") IS NOT CORRECT ! CORRECT answer is (D).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
    <li>
	 The helix that forms in a protein chain as a result of hydrogen bonds and other weak forces is an example of
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">primary structure of protein.</li>
	 <li><input type="radio" name="q4" value="B">secondary structure of protein.</li>
	 <li><input type="radio" name="q4" value="C">tertiary structure of protein.</li>
	 <li><input type="radio" name="q4" value="D">non-linear structure of protein</li>
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
	  When an egg is fried, what happens to the protein in the egg?
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">amino acids form new proteins</li>
	 <li><input type="radio" name="q5" value="B">the protein is denatured</li>
	 <li><input type="radio" name="q5" value="C">because the heat removes water, the hydrophilic amino acids leave the pan</li>
	 <li><input type="radio" name="q5" value="D">the heat converts the protein into water</li>
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
  </td></tr>
  <tr><td>
     <li>
	  Denaturation of proteins doesn't involves the disruption of:
      <ol type="A">
	 <li><input type="radio" name="q6" value="A">Quaternary structure.</li>
	 <li><input type="radio" name="q6" value="B">Secondary structure.</li>
	 <li><input type="radio" name="q6" value="C">Primary structure.</li>
	 <li><input type="radio" name="q6" value="D">Tertiary structure.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q6'] == "C"){
			echo "<span style='color:green'>(".$_POST['q6'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q6'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
     <li>
	 Heat can be used to disrupt hydrogen bonds and non-polar hydrophobic interactions because:
      <ol type="A">
	 <li><input type="radio" name="q7" value="A">increase in ionic repulsion.</li>
	 <li><input type="radio" name="q7" value="B">increase in kinetic energy.</li>
	 <li><input type="radio" name="q7" value="C">increase in potential energy.</li>
	 <li><input type="radio" name="q7" value="D">none of the above.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q7'] == "B"){
			echo "<span style='color:green'>(".$_POST['q7'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q7'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
     <li>
	 Rhodopsin consists of the protein moiety opsin. Opsin consists of a bundle of how many transmembrane helices?
      <ol type="A">
	 <li><input type="radio" name="q8" value="A">4</li>
	 <li><input type="radio" name="q8" value="B">9</li>
	 <li><input type="radio" name="q8" value="C">7</li>
	 <li><input type="radio" name="q8" value="D">5</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q8'] == "C"){
			echo "<span style='color:green'>(".$_POST['q8'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q8'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
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
<center><button class="boundingBox1" onclick='window.location="./experiment/index.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="./index.html";'><strong>Back To Theory<string></button></center>
</div>
</body>
</html>

