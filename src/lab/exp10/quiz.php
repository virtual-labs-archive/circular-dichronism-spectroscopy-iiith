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

  <form name="quiz" action="quiz.php" method="POST">
  <ol>
  <table>
  <tr><td width=70%>
    <li>
	 Protein aggregation is aggregation of :
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">proteins and solvent molecules</li>
	 <li><input type="radio" name="q1" value="B">proteins and legands</li>
	 <li><input type="radio" name="q1" value="C">folded proteins</li>
	 <li><input type="radio" name="q1" value="D">misfolded proteins</li>
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
	 Prerequisite of protein aggregation is :
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">Mutation.</li>
	 <li><input type="radio" name="q2" value="B">Protein folding.</li>
	 <li><input type="radio" name="q2" value="C">Protein denaturation.</li>
	 <li><input type="radio" name="q2" value="D">None of the above.</li>
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
	 Why CD spectroscopy is a convenient technique to study protein aggregation? 
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">CD spectra of folded and random coil are similar.</li>
	 <li><input type="radio" name="q3" value="B">CD spectra of folded and random coil are quite different.</li>
	 <li><input type="radio" name="q3" value="C">In the aggregated state the spectra is absent in CD.</li>
	 <li><input type="radio" name="q3" value="D">In the folded state the spectra is absent in CD.</li>
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
	 Dynode voltage gives the indication of : 
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">Reflection of light.</li>
	 <li><input type="radio" name="q4" value="B">Absorption of light.</li>
	 <li><input type="radio" name="q4" value="C">Emmision of light.</li>
	 <li><input type="radio" name="q4" value="D">Refraction of light.</li>
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
	 What happens when the protein aggregates?
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">Its size increases and more light is scattered.</li>
	 <li><input type="radio" name="q5" value="B">Its size decreases and less amount of light is scattered.</li>
	 <li><input type="radio" name="q5" value="C">Its size increases and less amount of light is scattered.</li>
	 <li><input type="radio" name="q5" value="D">Its size decreases and more light is scattered.</li> 
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
<center><button class="boundingBox1" onclick='window.location="./experiment/index.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="./index.html";'><strong>Back To Theory<string></button></center>
</div>
</body>
</html>

