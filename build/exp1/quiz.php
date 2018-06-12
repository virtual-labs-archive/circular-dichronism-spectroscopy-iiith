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
	 How does polarized light differ from the ordinary light?

      <ol type="A">
	 <li><input type="radio" name="q1" value="A">Polarized light have vibrations in single plane where as ordinary light have vibrations in more than one plane .</li>
	 <li><input type="radio" name="q1" value="B">Polarized light have vibrations in more than one plane where as ordinary light have vibrations in single plane </li>
	 <li><input type="radio" name="q1" value="C">Polarized light and ordinary light wave have opposite vibrations in the space 
.</li>
	 <li><input type="radio" name="q1" value="D">Polarized light have vibrations at 90<sup>o</sup> to the ordinary light wave vibrations.</li>
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
	 What do you understand by polarized light and the plane of polarization?
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">Polarized light wave vibrations confined to single plane and plane of polarization is the plane in which the vector along which the light wave vibrates lies.</li>
	 <li><input type="radio" name="q2" value="B">Polarized light wave vibrations confined to more than one plane and plane of polarization is the plane in which the vector along which the light wave vibrates lies.</li>
	 <li><input type="radio" name="q2" value="C">Polarized light wave vibrations confined to more than one plane and plane of polarization is the plane at right angle to the vector along which the light wave vibrates lies.</li>
	 <li><input type="radio" name="q2" value="D">Polarized light wave vibrations confined to single plane and plane of polarization is the plane at right angle to the vector along which the light wave vibrates lies</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "A"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 What are the factors on which the optical activity of a substance depends?
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">Temperature, wavelength of light used, concentration of the substance.</li>
	 <li><input type="radio" name="q3" value="B"> Temperature, wavelength of light used, concentration of substance and length of polarimeter tube.</li>
	 <li><input type="radio" name="q3" value="C">Wavelength of light used and concentration of substance.</li>
	 <li><input type="radio" name="q3" value="D">Temperature, wavelength of light used, and length of polarimeter tube.</li>
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
	 How does the optical activity depend on the state of the substance?
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">If the compound is present in (+) form, it rotates plane polarized light in anticlockwise direction and if it is present in (-) form, it rotates plane polarized light in clockwise direction with equal magnitude.</li>
	 <li><input type="radio" name="q4" value="B">If the compound is present in (+) form it rotates plane polarized light in clockwise direction and if it is present in (-) form, it rotates plane polarized light in anticlockwise direction with different magnitude.</li>
	 <li><input type="radio" name="q4" value="C">If the compound is present in (+) form it rotates plane polarized light in clockwise direction and if it is present in (-) form, it rotates plane polarized light in anticlockwise direction with same magnitude.</li>
	 <li><input type="radio" name="q4" value="D">Both rotates the plane polarized light in same direction with equal magnitude.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q4'] == "C"){
			echo "<span style='color:green'>(".$_POST['q4'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q4'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 Given that (R)-2-bromobutane has a specific rotation of -23.1<sup>o</sup> ,what is the specific rotation of (S)-2-bromobutane?
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">+20.1<sup>o</sup>.</li>
	 <li><input type="radio" name="q5" value="B">+26.1<sup>o</sup>.</li>
	 <li><input type="radio" name="q5" value="C">+23.1<sup>o</sup>.</li>
	 <li><input type="radio" name="q5" value="D">+29.1<sup>o</sup>.</li>
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
	Which isomer is dominant in a mixture of (R)- and (S)-2-bromobutane whose specific rotation was found to be -9.2<sup>o</sup> ?
      <ol type="A">
	 <li><input type="radio" name="q6" value="A">Both R and S enantiomers are found in equal proportions.</li>
	 <li><input type="radio" name="q6" value="B">The negative sign indicates that the R enantiomer is the dominant one.</li>
	 <li><input type="radio" name="q6" value="C">The negative sign indicates that the S enantiomer is the dominant one.</li>
	 <li><input type="radio" name="q6" value="D">None of the above options are correct.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q6'] == "B"){
			echo "<span style='color:green'>(".$_POST['q6'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q6'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
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
<center><button class="boundingBox1" onclick='window.location="swf.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="./index.html";'><strong>Back To Theory<string></button></center>


</div>
</body>
</html>

