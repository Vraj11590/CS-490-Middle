
<?php 

	session_start();
	if(isset($_POST['code_question_submit'])){
		$desc = $_POST['Q_desc'];
		$t1 = $_POST['T1'];
		$t2 = $_POST['T2'];
		$t3 = $_POST['T3'];
		$t4 = $_POST['T4'];
		$help = $_POST['Q_help_code'];

		$_SESSION['desc'] = $desc;
		$_SESSION['t1'] = $t1;
		$_SESSION['t2'] = $t2;
		$_SESSION['t3'] = $t3;
		$_SESSION['t4'] = $t4;
		$_SESSION['help'] = $help;



		//somehow get the function name from the question

		$keywords = array( "function", "arguments", "returns",  );

		// get a valid regex
		$test = "(\b".implode( "\b)|(\b", $keywords )."\b)";

		if( preg_match( $test, "there is a dog chasing a cat down the road" ) )
		    print "keyword hit";
	}
	if(isset($_POST['submitting'])){


		$t1 = $_SESSION['t1'];
		$t2 = $_SESSION['t2'];
		$t3 = $_SESSION['t3'];
		$t4 = $_SESSION['t4'];

		$testcase1 = "double a = ".$t1.";System.out.println(a);";
		$testcase2 = "double b = ".$t2.";System.out.println(b);";
		$testcase3 = "double c = ".$t3.";System.out.println(c);";
		$testcase4 = "double d = ".$t4.";System.out.println(d);";
		$written = $_POST['answerBox'];
		$_SESSION['submitted'] = $written;


		$run = "java test '$testcase1' '$testcase2' '$testcase3' '$testcase4' '$written'";
		exec($run,$out);
		print_r($out);
	}

 
?>

<div id="container" style="width: 100px; height: 30px; display:inline;">

<!-- 	question maker  -->	
	<div style="width:600px; border-right:5px solid black; padding-right:10px;">

		<form name="OEFORM" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" value="OE" name="type"/>
			Detailed Question Description: 
			<textarea rows="8" cols="70" name="Q_desc"><?php echo $_SESSION['desc']; ?></textarea>
			<font color="red"> Use Keywords: function, returns, arguments etc. </font>
		<hr/>
		Provide four testcases to test the written code.<br/>
		<center>
			Testcase 1 :- <input type="text" name="T1" placeholder="test case 1" value="<?php echo $_SESSION['t1']; ?>"/><br/>
			Testcase 2 :- <input type="text" name="T2" placeholder="test case 2" value="<?php echo $_SESSION['t2']; ?>"/><br/>
			Testcase 3 :- <input type="text" name="T3" placeholder="test case 3" value="<?php echo $_SESSION['t3']; ?>"/><br/>
			Testcase 4 :- <input type="text" name="T4" placeholder="test case 4" value="<?php echo $_SESSION['t4']; ?>"/><br/>
		Function Name: <b>
						<?php
							$function_name = explode('(',$_SESSION['t1']); 
							echo $function_name[0];
							$_SESSION['function_name'] = $function_name;
	 					?>
	 					</b>
	 	Expecting : Not done yet. <b> 
	 					<?php 
							$pos = strrpos($_SESSION['t1'], "=");
	 						$expecting = substr($_SESSION['t1'], $pos + 1);
	 						if(is_numeric($expecting) ){
			 						echo "integer";
							}
	 						if( $expecting == "true" || $expecting == "false" ){
			 						echo "boolean";
							}
	 											

	 					?> 
	 				</b>
		</center>
		<hr/>
			<center>
				Write any javacode below that you would like to provide the user with. If not leave 
				blank.
				<textarea rows="3" cols="70" name="Q_help_code"><?php  echo $_SESSION['help']; ?></textarea>
			</center>
		<hr/>
		<input style="float:right;" type="submit" name="code_question_submit" value="Create Instance"/>
		</form>
	</div>

<!-- question viewer -->
	<?php if($_SESSION['desc'] != ""){ ?>

		<div style="width:600px;" id="question_viewer">

		 <center> <p> <b> <span style="background-color: #FFFF00;"> This is what the question will look like  </span> </b> </p> </center> 

		<p> <center>  <b> <?php if ( isset($_SESSION['desc']) )echo $_SESSION['desc']; else echo "question not set. in session."?> </b> </center> </p>

		<p> The code that you write below has to work for the provided test cases below :- </p>
		<center>

		<ul style="list-style-position: inside">
		<?php if($t1 != ""){ ?>	<li> <?php echo $_SESSION['t1']; ?> </li> <?php } ?>
		<?php if($t2 != ""){ ?>	<li> <?php echo $_SESSION['t2'];; ?> </li><?php } ?>
		<?php if($t3 != ""){ ?>	<li> <?php echo $_SESSION['t3'];; ?> </li><?php } ?>
		<?php if($t4 != ""){ ?>	<li> <?php echo $_SESSION['t4'];; ?> </li><?php } ?>
		</ul>

		</center>
		</div>
	<?php } ?>


	<div id="question_taker">
		<form name="answered" id="OE_taker" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<textarea name="answerBox" cols="70" rows="9" 
			name="Q_desc"><?php if ( $_SESSION['submitted'] != ""){echo $_SESSION['submitted'];}else{echo $_SESSION['help'];}?></textarea>
			<input  type="submit" name="submitting" value="Test Code"/>
		</form>
	</div>



</div>

