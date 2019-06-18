<?php 
// header('Location:https://hr.mattsenkumar.com/Quiz-Assesment/');
// exit;
	//error_reporting(0);
	session_start();
	date_default_timezone_set("Asia/Kolkata");
   
// 	$con = mysqli_connect("localhost","root","p@ssw0rd","quiz_assesment");
   
// 	// Check connection
// 	if (mysqli_connect_errno())
// 	{
// 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
// 	}
	
	$date = date('Y-m-d h:i:s');
   
	if(isset($_POST['sub'])){
  	$emp_name = "";
   	$phone_number = "";
   	$emp_designation = "";
   	$emp_location = "";
		 
	if(isset($_POST['emp_name']) && $_POST['emp_name']!=''){
   		$emp_name= $_POST['emp_name'];
   	}
   	
   	if(isset($_POST['phone_number']) && $_POST['phone_number']!=''){
		$phone_number= $_POST['phone_number'];
   	}
   	if(isset($_POST['emp_designation']) && $_POST['emp_designation']!=''){
   		$emp_designation= $_POST['emp_designation'];
   	}
   	if(isset($_POST['emp_location']) && $_POST['emp_location']!=''){
   		$emp_location= $_POST['emp_location'];
   	}
		$sec1_q1 = $_POST['sec1_q1'];
		$sec1_q2 = $_POST['sec1_q2'];
		$sec1_q3 = $_POST['sec1_q3'];
		$sec1_q4 = $_POST['sec1_q4'];
		$sec1_q5 = $_POST['sec1_q5'];
		$sec1_q6 = $_POST['sec1_q6'];
		$sec1_q7 = $_POST['sec1_q7'];
		$sec1_q8 = $_POST['sec1_q8'];
		$sec2_q1_a1 = $_POST['sec2_q1_a1'];
		$sec2_q1_a2 = $_POST['sec2_q1_a2'];
		$sec2_q1_a3 = $_POST['sec2_q1_a3'];
		$sec2_q1_a4 = $_POST['sec2_q1_a4'];
		$sec2_q2_a1 = $_POST['sec2_q2_a1'];
		$sec2_q2_a2 = $_POST['sec2_q2_a2'];
		$sec2_q2_a3 = $_POST['sec2_q2_a3'];
		$sec2_q2_a4 = $_POST['sec2_q2_a4'];
		$sec2_q3_a1 = $_POST['sec2_q3_a1'];
		$sec2_q3_a2 = $_POST['sec2_q3_a2'];
		$sec2_q3_a3 = $_POST['sec2_q3_a3'];
		$sec2_q3_a4 = $_POST['sec2_q3_a4'];
		$sec3_q1 = $_POST['sec3_q1'];
		$sec3_q2 = $_POST['sec3_q2'];
		$sec3_q3 = $_POST['sec3_q3'];
		$sec3_q4 = $_POST['sec3_q4'];
		$sec3_q5 = $_POST['sec3_q5'];
		$sec3_q6 = $_POST['sec3_q6'];
		$sec3_q7 = $_POST['sec3_q7'];
		$sec3_q8 = $_POST['sec3_q8'];
		$sec3_q9 = $_POST['sec3_q9'];
		$sec3_q10 = $_POST['sec3_q10'];
		$sec3_q11 = $_POST['sec3_q11'];
		$sec3_q12 = $_POST['sec3_q12'];
		$sec3_q13 = $_POST['sec3_q13'];
		$sec3_q14 = $_POST['sec3_q14'];
		$sec3_q15 = $_POST['sec3_q15'];
		$sec3_q16 = $_POST['sec3_q16'];
		$sec3_q17 = $_POST['sec3_q17'];
		$sec3_q18 = $_POST['sec3_q18'];
		$sec3_q19 = $_POST['sec3_q19'];
		$sec3_q20 = $_POST['sec3_q20'];
		$sec3_q21 = $_POST['sec3_q21'];
		$sec3_q22 = $_POST['sec3_q22'];
		$sec3_q23 = $_POST['sec3_q23'];
		$sec3_q24 = $_POST['sec3_q24'];
		$sec3_q25 = $_POST['sec3_q25'];
		$sec3_q26 = $_POST['sec3_q26'];
		$sec3_q27 = $_POST['sec3_q27'];
		$sec3_q28 = $_POST['sec3_q28'];
		$sec3_q29 = $_POST['sec3_q29'];
		$sec3_q30 = $_POST['sec3_q30'];
		$sec4_q1 = $_POST['sec4_q1'];
		$sec4_q2 = $_POST['sec4_q2'];
		$sec4_q3 = $_POST['sec4_q3'];
		$sec4_q4 = $_POST['sec1_q4'];
		$sec4_q5 = $_POST['sec4_q5'];
		$sec4_q6 = $_POST['sec4_q6'];
		$sec4_q7 = $_POST['sec4_q7'];
		$sec4_q8 = $_POST['sec4_q8'];
		$score = 0;
		$correct_answers = array('Ancient form of exercise','Approximately in 480 B.C','It is derived from the Greek words for beauty and strength','Calisthenics','by Greeks','False','is its simplicity','False');
		 
	for ($i = 1; $i <= 8; $i++)
   	{
			$ans_var = 'sec1_q'.$i;
			if (@$_POST[$ans_var] == @$correct_answers[$i-1]){
				$score++;
			}else if(empty($_POST[$ans_var])){
				$score = $score;		 
			}else{
   		 $score = $score;	 
			}
   	}
   
   	$sec1_per = ($score / 8) *100;
   	
   	//percentage for section 3
   	$score3 = 0;
   	$correct_answers = array('got burgled ','were','to','Is worse','That','Until','Were','What kind of fruit','To','consistency','admiration','admiration','tidy','Typical','changeable','Anyone','is', 'Were','Is','Although polar bears look after their cubs, they’re not animals that like living in groups out there in the Arctic','She is a big fan of planes, trains and automobiles','Have been learning','Did not work','Sent','was', 'Loved','Went','Did','Realized','reading');
   	for ($i = 1; $i <= 30; $i++)
   	{
			$ans_var = 'sec3_q'.$i;
			if (@$_POST[$ans_var] == @$correct_answers[$i-1]){
				$score3++;
			}else if(empty($_POST[$ans_var])){
   			$score3 = $score3;		  
			}else{
   		 	$score3 = $score3;		  
			}
   	}
   	
   	$sec3_per = ($score3 / 30) *100;
   	
   	//percentage for section 4
   	$score4= 0;
   	$correct_answers = array('Internet protocol','HIGH definition multimedia interface','Internet protocol System','Revolutions per minute','Megabytes per second','C-type','True','True');
   	for ($i = 1; $i <= 8; $i++)
   	{
			$ans_var = 'sec4_q'.$i;
			if (@$_POST[$ans_var] == @$correct_answers[$i-1])
			{
				$score4++;
			}else if(empty($_POST[$ans_var])){
   		  $score4 = $score4;			  
			}else {
				$score4 = $score4;	  
			}
   	}
   	
   	$sec4_per = ($score4 / 8) *100;
   	
   	$query=false;
   	
   	$query =  mysqli_query($con,"SELECT * FROM `tbl_quiz` WHERE user_name='".$emp_name."'and phone_number='".$phone_number."'and designation='".$emp_designation."' and location='".$emp_location."'");
   	if ($query->num_rows > 0) {
   		$_SESSION['msg'] = "Already Submitted the Quiz";
   	}else{
   		/* var_dump("INSERT into tbl_quiz set user_name='".$emp_name."',phone_number='".$phone_number."',designation='".$emp_designation."',location='".$emp_location."', sec1_q1='".$sec1_q1."',sec1_q2='".$sec1_q2."',sec1_q3='".$sec1_q3."',sec1_q4='".$sec1_q4."',sec1_q5='".$sec1_q5."',sec1_q6='".$sec1_q6."',sec1_q7='".$sec1_q7."',sec1_q8='".$sec1_q8."',
   		sec4_q1='".$sec4_q1."',sec4_q2='".$sec4_q2."',sec4_q3='".$sec4_q3."',sec4_q4='".$sec4_q4."',sec4_q5='".$sec4_q5."',sec4_q6='".$sec4_q6."',sec4_q7='".$sec4_q7."',sec4_q8='".$sec4_q8."',
   		sec2_q1_a1='".$sec2_q1_a1."',sec2_q1_a2='".$sec2_q1_a2."',sec2_q1_a3='".$sec2_q1_a3."',sec2_q1_a4='".$sec2_q1_a4."',sec2_q2_a1='".$sec2_q2_a1."',sec2_q2_a2='".$sec2_q2_a2."',sec2_q2_a3='".$sec2_q2_a3."',sec2_q2_a4='".$sec2_q2_a4."',sec2_q3_a1='".$sec2_q3_a1."',sec2_q3_a2='".$sec2_q3_a2."',sec2_q3_a3='".$sec2_q3_a3."',sec2_q3_a4='".$sec2_q3_a4."',
   		sec3_q1='".$sec3_q1."',sec3_q2='".$sec3_q2."',sec3_q3='".$sec3_q3."',sec3_q4='".$sec3_q4."',sec3_q5='".$sec3_q5."',sec3_q6='".$sec3_q6."',sec3_q7='".$sec3_q7."',sec3_q8='".$sec3_q8."', sec3_q9='".$sec3_q9."',sec3_q10='".$sec3_q10."',sec3_q11='".$sec3_q11."',sec3_q12='".$sec3_q12."',sec3_q13='".$sec3_q13."',sec3_q14='".$sec3_q14."',sec3_q15='".$sec3_q15."',sec3_q16='".$sec3_q16."', sec3_q17='".$sec3_q17."',sec3_q18='".$sec3_q18."',sec3_q19='".$sec3_q19."',sec3_q20='".$sec3_q20."',sec3_q21='".$sec3_q21."',
   		sec3_q22='".$sec3_q22."',sec3_q23='".$sec3_q23."',sec3_q24='".$sec3_q24."',sec3_q25='".$sec3_q25."',sec3_q26='".$sec3_q26."',sec3_q27='".$sec3_q28."',sec3_q29='".$sec3_q29."',sec3_q30='".$sec3_q30."',
   		sec1_per='".$sec1_per."',sec3_per='".$sec3_per."',sec4_per='".$sec4_per."',submit_date='".$date."' ");
   		unset($_SESSION['msg']);
   		exit; */
   		$query = mysqli_query($con,"INSERT into tbl_quiz set user_name='".$emp_name."',phone_number='".$phone_number."',designation='".$emp_designation."',location='".$emp_location."', sec1_q1='".$sec1_q1."',sec1_q2='".$sec1_q2."',sec1_q3='".$sec1_q3."',sec1_q4='".$sec1_q4."',sec1_q5='".$sec1_q5."',sec1_q6='".$sec1_q6."',sec1_q7='".$sec1_q7."',sec1_q8='".$sec1_q8."',
   		sec4_q1='".$sec4_q1."',sec4_q2='".$sec4_q2."',sec4_q3='".$sec4_q3."',sec4_q4='".$sec4_q4."',sec4_q5='".$sec4_q5."',sec4_q6='".$sec4_q6."',sec4_q7='".$sec4_q7."',sec4_q8='".$sec4_q8."',
   		sec2_q1_a1='".$sec2_q1_a1."',sec2_q1_a2='".$sec2_q1_a2."',sec2_q1_a3='".$sec2_q1_a3."',sec2_q1_a4='".$sec2_q1_a4."',sec2_q2_a1='".$sec2_q2_a1."',sec2_q2_a2='".$sec2_q2_a2."',sec2_q2_a3='".$sec2_q2_a3."',sec2_q2_a4='".$sec2_q2_a4."',sec2_q3_a1='".$sec2_q3_a1."',sec2_q3_a2='".$sec2_q3_a2."',sec2_q3_a3='".$sec2_q3_a3."',sec2_q3_a4='".$sec2_q3_a4."',
   		sec3_q1='".$sec3_q1."',sec3_q2='".$sec3_q2."',sec3_q3='".$sec3_q3."',sec3_q4='".$sec3_q4."',sec3_q5='".$sec3_q5."',sec3_q6='".$sec3_q6."',sec3_q7='".$sec3_q7."',sec3_q8='".$sec3_q8."', sec3_q9='".$sec3_q9."',sec3_q10='".$sec3_q10."',sec3_q11='".$sec3_q11."',sec3_q12='".$sec3_q12."',sec3_q13='".$sec3_q13."',sec3_q14='".$sec3_q14."',sec3_q15='".$sec3_q15."',sec3_q16='".$sec3_q16."', sec3_q17='".$sec3_q17."',sec3_q18='".$sec3_q18."',sec3_q19='".$sec3_q19."',sec3_q20='".$sec3_q20."',sec3_q21='".$sec3_q21."',
   		sec3_q22='".$sec3_q22."',sec3_q23='".$sec3_q23."',sec3_q24='".$sec3_q24."',sec3_q25='".$sec3_q25."',sec3_q26='".$sec3_q26."',sec3_q27='".$sec3_q28."',sec3_q29='".$sec3_q29."',sec3_q30='".$sec3_q30."',
   		sec1_per='".$sec1_per."',sec3_per='".$sec3_per."',sec4_per='".$sec4_per."',submit_date='".$date."' ");
   		if ($query =='true'){
   			header('location:thanku.php');
   		}
   	}
	}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="icon" href="images/logo.png" type="image/png" sizes="64x64">
   </head>
   <body>
      <div class="wrapper">
      <header>
         <div class="container">
            <a href="index.html" class="logo"><img src="images/logo.png" alt="" /></a>
         </div>
      </header>
      <div class="container">
         <div class="row">
            <div  class="col-md-12" id="display" style="float:right;color:#fff;font-size:24px;"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
            <div  class="col-md-12" id="submitted" style="float:right;color:#fff;font-size:24px;"></div>
         </div>
         <div class="form-wrp">
            <form method="POST" id="form1" autocomplete="off">
               <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){ ?>
               <div class="alert alert-success">
                  <strong>OOPs!</strong> Your already submitted Quiz.
               </div>
               <?php }?>
               <div class="alert alert-warning" style="display:none;">
                  <strong>Warning!</strong> Mandatory fields must be filled.
               </div>
               <div class="section">
								  <!--Basic section start -->
                  <div class="accordion" id="accordionExample">
                     <div class="card">
                        <div class="card-header" id="headingOne">
                           <h5 class="mb-0">
                              <a data-toggle="" data-target="" aria-expanded="" aria-controls="">
                                 <h4 class="heading"> Basic Information </h4>
                              </a>
                           </h5>
                        </div>
                        <div id="" class=" show" aria-labelledby="headingOne" data-parent="">
                           <div class="card-body">
                              <div class="row">
                                 <div class="form-group col-md-3">
                                    <label>Name<span id="basic_label_1" style="color: #d22424; display:none;"> (  )<span></label>
                                    <input type="text" name="emp_name" id="emp_name" class="form-control" placeholder="" required>
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Phone Number<span id="basic_label_2" style="color: #d22424; display:none;"> (  )<span></label>
                                    <input type="text" name="phone_number"   id="phone_number" class="form-control" maxlength="10" required>
                                    <span id="errmsg"></span>
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Designation <span id="basic_label_3" style="color: #d22424; display:none;"> (  )<span></label>
                                    <input type="text" class="form-control" id="emp_designation" name="emp_designation" placeholder="" required>
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Location</label>
                                    <select class="form-control" name="emp_location">
                                       <option value="gurgaon">Gurgaon</option>
                                       <option value="bengaluru">Bengaluru</option>
                                       <option value="jaipur">Jaipur</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
												</div>
											</div>
										</div>
										<!--Basic section end -->

					<!-- Section 1 start -->
					<div id="accordion" role="tablist" aria-multiselectable="true" >
                     <div class="card">
                        <div class="card-header" id="headingTwo">
                           <h5 class="mb-0">
								<a data-toggle="collapse" data-parent="#accordion" href="#sectionOne" aria-expanded="false" aria-controls="sectionOne" class="collapsed">
									<i class="fa fa-file-text-o" aria-hidden="true"></i>
									<h4 class='heading'>SECTION 1. Content Comprehension </h4>
								</a>
                            </h5>
						</div>
						<div id="sectionOne" class=" bb collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" data-parent="#">
                           <div class="card-body">
                              <div class="row skill-rating">
                                 <div class="form-group col-md-12">
                                    <div class="card-header" id="headingTwo">
                                       <h4 class="heading" id="headingTwo">Guidelines: </h4>
                                       <ul style="color: #fff;">
                                          <li> Please read the passages given below carefully and answer the questions given at the end of each passage</li>
                                          <li>No of Passages: 1 | Total Questions: 8 | Each Question is for 1 mark each</li>
                                       </ul>
                                    </div>
                                    <div id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:10px;">
                                       <div class="card">
                                          <div class="card-header" role="tab" id="headingOne">
                                             <div class="mb-0">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                                   <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                   <h3>PASSAGE: CALISTHENICS The world’s oldest form of resistance training</h3>
                                                </a>
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                             </div>
                                          </div>
                                          <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="">
                                             <div class="card-block">
											 	From the very first caveman to scale a tree or hang from a cliff face, to the mighty armies of the Greco-Roman empires and the gymnasiums of modern American high schools, calisthenics has endured and thrived because of its simplicity and utility. Unlike strength training which involves weights, machines or resistance bands, calisthenics uses only the body’s own weight for physical development.<br><br>

												Calisthenics enters the historical record at around 480 B.C., with Herodotus’ account of the Battle of Thermopolylae. Herodotus reported that, prior to the battle, the god-king Xerxes sent a scout party to spy on his Spartan enemies. The scouts informed Xerxes that the Spartans, under the leadership of King Leonidas, were practicing some kind of bizarre, synchronised movements akin to a tribal dance. Xerxes was greatly amused. His own army was comprised of over 120,000 men, while the Spartans had just 300. Leonidas was informed that he must retreat or face annihilation. The Spartans did not retreat, however, and in the ensuing battle they managed to hold Xerxes’ enormous army at bay for some time until reinforcements arrived. It turns out their tribal dance was not a superstitious ritual but a form of calisthenics by which they were building aweinspiring physical strength and endurance.<br><br>

												The Greeks took calisthenics seriously not only as a form of military discipline and strength, but also as an artistic expression of movement and an aesthetically ideal physique. Indeed, the term calisthenics itself is derived from the Greek words for beauty and strength. We know from historical records and images from pottery, mosaics and sculptures of the period that the ancient Olympians took calisthenics training seriously. They were greatly admired – and still are, today – for their combination of athleticism and physical beauty. You may have heard a friend whimsically sigh and mention that someone ‘has the body of a Greek god’. This expression has travelled through centuries and continents, and the source of this envy and admiration is the calisthenics method.<br><br>

												Calisthenics experienced its second golden age in the 1800s. This century saw the birth of gymnastics, an organised sport that uses a range of bars, rings, vaulting horses and balancing beams to display physical prowess. This period is also when the phenomena of strongmen developed. These were people of astounding physical strength and development who forged nomadic careers by demonstrating outlandish feats of strength to stunned populations. Most of these men trained using hand balancing and horizontal bars, as modern weight machines had not yet been invented.

                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">1. </span> <label class="label">What is ‘calisthenics’ ?</label>
                                       <span id="sub_skills_label_1" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q1">
                                          <option value="">--Select Option--</option>
                                          <option value="Ancient way of living">Ancient way of living</option>
                                          <option value="Ancient human strength">Ancient human strength</option>
                                          <option value="Ancient form of exercise">Ancient form of exercise</option>
                                          <option value="Ancient form of human civilization">Ancient form of human civilization</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">2. </span> <label class="label">When is ‘calisthenics’ enters history ?  </label>
                                       <span id="sub_skills_label_1" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q2" >
                                          <option value="">--Select Option--</option>
                                          <option value="Approximately in 408 B.C">Approximately in 408 B.C</option>
                                          <option value="Approximately in 480 B.C">Approximately in 480 B.C</option>
                                          <option value="Approximately in 481. B.C with Herodotus">Approximately in 481. B.C with Herodotus</option>
                                          <option value="Approximately in 481. B.C with Herodotus">Approximately in 481. B.C with Herodotus</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div> <span class="num">3. </span><label class="label">What is the origin of ‘calisthenics’?</label>
                                       <span id="sub_skills_label_2" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q3" >
                                          <option value="">--Select Option--</option>
                                          <option value="It is oldest form of exercise ">It is oldest form of exercise </option>
                                          <option value="It is derived from the Greek words for beauty and strength">It is derived from the Greek words for beauty and strength</option>
                                          <option value="It is combination of athleticism and physical beauty">It is combination of athleticism and physical beauty</option>
                                          <option value="It is form of tribal dance">It is form of tribal dance</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">4. </span> <label class="label">You may have heard a friend whimsically sigh and mention that someone ‘has the body of a Greek god’. This expression has travelled through centuries, and the source of this envy and admiration</label>
                                       <span id="sub_skills_label_3" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q4" >
                                          <option value="">--Select Option--</option>
                                          <option value="King Xerxes">King Xerxes</option>
                                          <option value="Calisthenics">Calisthenics</option>
                                          <option value="Greek military">Greek military</option>
                                          <option value="King Leonidas">King Leonidas</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div> <span class="num">5. </span><label class="label">Calisthenics first used as a training method</label>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q5" >
                                          <option value="">--Select Option--</option>
                                          <option value="by Xerxes">by Xerxes</option>
                                          <option value="by tribal people">by tribal people</option>
                                          <option value="by Greeks">by Greeks</option>
                                          <option value="by Greek god">by Greek god</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">6. </span> <label class="label">A multidisciplinary approach to all-round health and strength made gymnastic a better sport than ‘calisthenics’</label> 
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q6" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">7. </span> <label class="label">Reasons for the survival of calisthenics throughout the ages</label>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q7" >
                                          <option value="">--Select Option--</option>
                                          <option value="is entertainment">is entertainment</option>
                                          <option value="is its simplicity">is its simplicity</option>
                                          <option value="is tribal dance">is tribal dance</option>
                                          <option value="is Greek method">is Greek method</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">8. </span> <label class="label">In 1800 century gymnastics was born. It proved ‘calisthenics’ wrong and became most popular form of exercise </label>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q8" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
										 </div>
							 			</div>
									<!-- Section 1 end -->
									<!-- Section 2 start -->
									<div id="accordion" role="tablist" aria-multiselectable="true" >
                  <div class="card">
                     <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
													<a data-toggle="collapse" data-parent="#accordion" href="#sectionTwo" aria-expanded="false" aria-controls="sectionTwo" class="collapsed">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
														<h4 class="heading">SECTION 2: Communicative Achievement & Thought Organization  </h4>
													</a>
                          <!--  <a   data-toggle="collapse" data-target=""
                              aria-expanded="false" aria-controls="collapseTwo">
                              <h4 class="heading">  SECTION 2: Communicative Achievement & Thought Organization  </h4>
                              <input type="hidden" name="skills[]" value="Basic Software Skills" />
                           </a> -->
                        </h5>
                     </div>
                     <div id="sectionTwo" class=" bb cc collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" data-parent="#">
                        <div class="card-body">
                           <div class="row skill-rating">
                              <div class=" col-md-12">
                                 <div class="card-header" id="headingThree">
                                    <h4 class="heading"> Guidelines:</h4>
                                    <ul style="color: #fff;">
                                       <li>Select any 2 Electronics & 1 Lifestyle product</li>
                                       <li>Write 50-80 words (8-10 sentences) describing them</li>
                                       <li>Add a one line highlight & actual specification of the selected products</li>
                                       <li>Paste the URL of both the selected products</li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Product 1 Link/URL:</label>
                                    <input type="url" name="sec2_q1_a1" class="form-control" style="margin-left:20px;" >
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Highlight:</label>
                                    <textarea name="sec2_q1_a2" class="form-control" cols="50" style="margin-left:94px;" ></textarea>
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Tech Spec:</label>
                                    <textarea name="sec2_q1_a3" class="form-control" cols="50" style="margin-left:94px;" ></textarea>
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Description:</label>
                                    <textarea name="sec2_q1_a4" class="form-control" cols="50" style="margin-left:87px;" ></textarea>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Product 2 Link/URL:</label>
                                    <input type="url" name="sec2_q2_a1" class="form-control" style="margin-left:20px;" >
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Highlight:</label>
                                    <textarea name="sec2_q2_a2"class="form-control" cols="50" style="margin-left:94px;" ></textarea>
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Tech Spec:</label>
                                    <textarea name="sec2_q2_a3" class="form-control" cols="50" style="margin-left:94px;"></textarea>
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Description:</label>
                                    <textarea name="sec2_q2_a4" class="form-control" cols="50" style="margin-left:87px;" ></textarea>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Product 3 Link/URL:</label>
                                    <input type="url"name="sec2_q3_a1" class="form-control" style="margin-left:20px;" >
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Highlight:</label>
                                    <textarea name="sec2_q3_a2" class="form-control" cols="50" style="margin-left:94px;" ></textarea>
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Tech Spec:</label>
                                    <textarea name="sec2_q3_a3" class="form-control" cols="50" style="margin-left:94px;" ></textarea>
                                 </div>
                                 <div class="form-inline" style="margin-top:10px;">
                                    <label for="email" style="margin-left:10px;">Description:</label>
                                    <textarea name="sec2_q3_a4" class="form-control"  cols="50" style="margin-left:87px;" ></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
									</div>
							 </div>
									<!-- Section 2 end -->
									<!-- Section 3 start -->
									<div id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                     <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                           <!-- <a  data-toggle="collapse" data-item-id="stand-out"
                              data-target="collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <h4 class="heading">Section 3. Language Assessment </h4>
													 </a> -->
													 <a data-toggle="collapse" data-parent="#accordion" href="#sectionThree" aria-expanded="false" aria-controls="sectionThree" class="collapsed">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
														<h4 class="heading">SECTION 3. Language Assessment </h4>
													</a>
                        </h5>
                     </div>
                     <div id="sectionThree" class="bb collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" data-parent="#">
                        <div class="card-body">
                           <div class="row skill-rating">
                              <div class="form-group col-md-12">
                                 <div class="card-header" id="headingTwo">
                                    <h4 class="heading" id="headingTwo">Guidelines: </h4>
                                    <ul style="color: #fff;">
                                       <li>Following questions have multiple options. Select the correct option</li>
                                       <li>Total Marks: 30 | No Negative Marking</li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">1. </span> <label class="label">Unfortunately, their house _______ while they were at the restaurant celebrating their anniversary  </label>
                                    <span id="sub_skills_label_1" style="color: #d22424; display:none"> (  )</span>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q1" >
                                       <option value="">--Select Option--</option>
                                       <option value="got burgled ">got burgled </option>
                                       <option value="went burgled">went burgled</option>
                                       <option value="had burgled ">had burgled </option>
                                       <option value="burgled "> burgled</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">2. </span> <label class="label"> _______ you to change your mind about handing in your notice, we would be happy for you to stay with us. </label>
                                    <span id="sub_skills_label_1" style="color: #d22424; display:none" > (  )</span>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q2" >
                                       <option value="">--Select Option--</option>
                                       <option value="should">should</option>
                                       <option value="were">were</option>
                                       <option value="unless">unless</option>
                                       <option value="if">if</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div> <span class="num">3. </span><label class="label"> I take great exception _______ the implication that I was not telling the truth.</label>
                                    <span id="sub_skills_label_2" style="color: #d22424; display:none"> (  )</span>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q3" >
                                       <option value="">--Select Option--</option>
                                       <option value="A against">A against </option>
                                       <option value="to">to</option>
                                       <option value="from">from</option>
                                       <option value="with">with</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">4. </span> <label class="label">English grammar is the worst language of any language. No, it is not. German grammar ___________________. </label>
                                    <span id="sub_skills_label_3" style="color: #d22424; display:none"> (  )</span>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q4" >
                                       <option value="">--Select Option--</option>
                                       <option value="Was worse">Was worse</option>
                                       <option value="Is worse">Is worse</option>
                                       <option value="Is worst">Is worst</option>
                                       <option value="Is good">Is good</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div> <span class="num">5. </span><label class="label">We are going to party at the Shyam's house.  ______________________ house is on 5th Crossing. </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q5" >
                                       <option value="">--Select Option--</option>
                                       <option value="That">That</option>
                                       <option value="Thy">Thy</option>
                                       <option value="Their">Their</option>
                                       <option value="They">They</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">6. </span> <label class="label">You can use my car ___________ tomorrow.</label> 
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q6" >
                                       <option value="">--Select Option--</option>
                                       <option value="Yet">Yet</option>
                                       <option value="Since">Since</option>
                                       <option value="Until">Until</option>
                                       <option value="Around">Around</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">7. </span> <label class="label">What ____________ your favorite food as a child ?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q7" >
                                       <option value="">--Select Option--</option>
                                       <option value="Will">Will</option>
                                       <option value="Were">Were</option>
                                       <option value="Would be">Would be</option>
                                       <option value="Is">Is</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">8. </span> <label class="label">______________________ you like ? I like Grapes and Mangoes.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q8" >
                                       <option value="">--Select Option--</option>
                                       <option value="What kind of fruit">What kind of fruit</option>
                                       <option value="What type of fruit do">What type of fruit do</option>
                                       <option value="How many fruits do">How many fruits do</option>
                                       <option value="Types of fruits do">Types of fruits do</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">9. </span> <label class="label">. I will speak ______________ Suzy when I see her.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q9" >
                                       <option value="">--Select Option--</option>
                                       <option value="Around">Around</option>
                                       <option value="To">To</option>
                                       <option value="Towards">Towards</option>
                                       <option value="At">At</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div class="card-header" id="headingTwo">
                                    <h4 class="heading" id="headingTwo">Guidelines: </h4>
                                    <ul style="color: #fff;">
                                       <li>Q. Against each key word are given five suggested meanings. </li>
                                       <li>Choose the word or phrase which is opposite in meaning to the key word. </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">10. </span> <label class="label">Discrepancy</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q10" >
                                       <option value="">--Select Option--</option>
                                       <option value="inconsistency">inconsistency</option>
                                       <option value="consistency">consistency</option>
                                       <option value="inappropriate">inappropriate</option>
                                       <option value="variance">variance</option>
                                       <option value="vagary">vagary</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">11. </span> <label class="label">Disdain</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q11" >
                                       <option value="">--Select Option--</option>
                                       <option value="attitude">attitude</option>
                                       <option value="honesty">honesty</option>
                                       <option value="admiration">admiration</option>
                                       <option value="zeal">zeal</option>
                                       <option value="disgust">disgust</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div><span class="num">12. </span> <label class="label">Disheveled</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q12" >
                                       <option value="">--Select Option--</option>
                                       <option value="tidy">tidy</option>
                                       <option value="clumsy">clumsy</option>
                                       <option value="unkempt">unkempt</option>
                                       <option value="long">long</option>
                                       <option value="exasperated">exasperated</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="card-header" id="headingTwo">
                                    <h4 class="heading" id="headingTwo">In each of the following sentences replace the underlined word with another word that means the same. Choose your answers from the options given below.(churlish, changeable typical, clemency) </h4>
                                 </div>
                              </div>
                              <div class="form-group col-md-12" style="margin-top:10px;">
                                 <div><span class="num">13. </span> <label class="label"> Windy days are characteristic of December.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q13" >
                                       <option value="">--Select Option--</option>
                                       <option value="churlish">churlish</option>
                                       <option value="changeable ">changeable </option>
                                       <option value="typical">typical</option>
                                       <option value="clemency">clemency</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">14. </span> <label class="label">Her moods are as flighty as the weather. </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q14" >
                                       <option value="">--Select Option--</option>
                                       <option value="churlish">churlish</option>
                                       <option value="changeable ">changeable </option>
                                       <option value="typical">typical</option>
                                       <option value="clemency">clemency</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">15. </span> <label class="label">If you were depressed, why didn't to talk to ___________? </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;" >
                                    <select class="form-control" name="sec3_q15">
                                       <option value="">--Select Option--</option>
                                       <option value="Anyone">Anyone</option>
                                       <option value="Everyone ">Everyone </option>
                                       <option value="All">All</option>
                                       <option value="One">One</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">16. </span> <label class="label"> Rain or hail ______ predicted for tomorrow </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q16" >
                                       <option value="">--Select Option--</option>
                                       <option value="is">is</option>
                                       <option value="are ">are </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">17. </span> <label class="label"> Your hands and feet _________ nearly half the bones in your body. </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q17" >
                                       <option value="">--Select Option--</option>
                                       <option value="Contains">Contains</option>
                                       <option value="Contain ">Contain </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">18. </span> <label class="label">  The books and the magazine ________ placed on the table. </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q18" >
                                       <option value="">--Select Option--</option>
                                       <option value="Was">Was</option>
                                       <option value="Were ">Were </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">19. </span> <label class="label"> Most of the newspaper _______ wet</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q19" >
                                       <option value="">--Select Option--</option>
                                       <option value="Was">Was</option>
                                       <option value="Were ">Were </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">20. </span> <label class="label">Which is grammatically correct?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q20" >
                                       <option value="">--Select Option--</option>
                                       <option value="Although polar bears look after there cubs, their not animals that like living in groups out there in the Arctic.">Although polar bears look after there cubs, their not animals that like living in groups out there in the Arctic.</option>
                                       <option value="Although polar bears look after their cubs, there not animals that like living in groups out there in the Arctic">Although polar bears look after their cubs, there not animals that like living in groups out there in the Arctic </option>
                                       <option value="Although polar bears look after their cubs, they’re not animals that like living in groups out there in the Arctic.">Although polar bears look after their cubs, they’re not animals that like living in groups out there in the Arctic. </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">21. </span> <label class="label">Punctuate the sentence by putting commas in the right places</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q21" >
                                       <option value="">--Select Option--</option>
                                       <option value="She is a big fan of planes trains and automobiles.">She is a big fan of planes trains and automobiles.</option>
                                       <option value="She is a big fan of planes trains, and automobiles.">She is a big fan of planes trains, and automobiles.</option>
                                       <option value="She is a big fan of planes, trains and automobiles">She is a big fan of planes, trains and automobiles </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div><span class="num">22. </span> <label class="label">Fill in the blanks with the correct tenses (1 Marks Each)</label>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">1. </span> <label class="label">I ( learn) __________ Spanish for 10years now.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q22" >
                                       <option value="">--Select Option--</option>
                                       <option value="Have been learning">Have been learning.</option>
                                       <option value="Was learning">Was learning</option>
                                       <option value="Learn">Learn </option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">2. </span> <label class="label">But last year I ( not/work) _____________hard enough as I had to travel a lot.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q23" >
                                       <option value="">--Select Option--</option>
                                       <option value="Worked">Worked</option>
                                       <option value="Did not work">Did not work</option>
                                       <option value="Had worked">Had worked</option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">3. </span> <label class="label">During the winters, my parents (send) __________ me to Spain.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q24" >
                                       <option value="">--Select Option--</option>
                                       <option value="Send">Will send</option>
                                       <option value="Sent ">Sent </option>
                                       <option value="Send">Send </option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">4. </span> <label class="label">It (be) _____ great</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q25" >
                                       <option value="">--Select Option--</option>
                                       <option value="Will be ">Will be </option>
                                       <option value="is ">is </option>
                                       <option value="was">was </option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">5. </span> <label class="label">I (love)_______ the whole trip and experience.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q26" >
                                       <option value="">--Select Option--</option>
                                       <option value="Was loving ">Was loving </option>
                                       <option value="Love">Love </option>
                                       <option value="Loved">Loved </option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">6. </span> <label class="label">After Spain, I (go) _________ to Greece.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q27" >
                                       <option value="">--Select Option--</option>
                                       <option value="Will go">Will go</option>
                                       <option value="Was">Was</option>
                                       <option value="Went ">Went  </option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">7. </span> <label class="label">While I (do) ________the language course , I met a lot of people from around the world</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q28" >
                                       <option value="">--Select Option--</option>
                                       <option value="Did">Did</option>
                                       <option value="Will do">Will do</option>
                                       <option value="Did not do ">Did not do  </option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">8. </span> <label class="label">I (realise) _________ that it is very important to know foreign languages.</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q29" >
                                       <option value="">--Select Option--</option>
                                       <option value="Realize">Realize</option>
                                       <option value="Realized">Realized</option>
                                       <option value="May not realize ">May not realize  </option>
                                    </select>
                                 </div>
                                 <div style="margin-left:20px;"><span class="num">9. </span> <label class="label">I am (read) __________ Spanish novels these days</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec3_q30" >
                                       <option value="">--Select Option--</option>
                                       <option value="reading">reading</option>
                                       <option value="Read">Read</option>
                                       <option value="Was reading ">Was reading </option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
									</div>
							 </div>
									<!-- Section 3 end -->

					<!-- Section 4 start -->
					<div id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                     <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                        	<a data-toggle="collapse" data-parent="#accordion" href="#sectionFour" aria-expanded="false" aria-controls="sectionFour" class="collapsed">
								<i class="fa fa-file-text-o" aria-hidden="true"></i>
								<h4 class="heading">SECTION 4. Miscellaneous Questions- Technical (8 Marks) </h4>
							</a>
                        </h5>
                     </div>
                     <div id="sectionFour" class=" bb collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" data-parent="#">
                        <div class="card-body">
                           <div class="row skill-rating">
                              <div class="form-group col-md-12" style="margin-top:10px;">
                                 <div style="margin-left:20px;"><span class="num">23. </span> <label class="label">What does IP stand for?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q1" >
                                       <option value="">--Select Option--</option>
                                       <option value="Internet protocol">Internet protocol</option>
                                       <option value="Internet Process">Internet Process</option>
                                       <option value="Internet protector">Internet protector</option>
                                       <option value="Internet protect">Internet protect</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">24. </span> <label class="label"> What does HDMI stand for ?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q2" >
                                       <option value="">--Select Option--</option>
                                       <option value="HIGH definition multimedia interface">HIGH definition multimedia interface</option>
                                       <option value="High Defined Media Interface">High Defined Media Interface</option>
                                       <option value="High Definition Multi Interface">High Definition Multi Interface </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">25. </span> <label class="label"> What does IPS stand for </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q3" >
                                       <option value="">--Select Option--</option>
                                       <option value="In Place Switching">In Place Switching</option>
                                       <option value="Internet protocol System">Internet protocol System</option>
                                       <option value="Internal Process System">Internal Process System</option>
                                       <option value="In place internet">In place internet</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">26. </span> <label class="label"> What is RPM? </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q4" >
                                       <option value="">--Select Option--</option>
                                       <option value="Rotations per minute">Rotations per minute</option>
                                       <option value="Revolutions per minute">Revolutions per minute</option>
                                       <option value="Rotation per month">Rotation per month </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">27. </span> <label class="label"> What is MBPS  ?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q5" >
                                       <option value="">--Select Option--</option>
                                       <option value="Megabytes per second">Megabytes per second</option>
                                       <option value="Megabitspersecond">Megabitspersecond</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">28. </span> <label class="label">Which is not a type of Heels</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q6" >
                                       <option value="">--Select Option--</option>
                                       <option value="Block">Block</option>
                                       <option value="Platform">Platform</option>
                                       <option value="Wedges">Wedges</option>
                                       <option value="C-type">C-type</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">29. </span> <label class="label"> Is Polo a type of neck design? </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q7" >
                                       <option value="">--Select Option--</option>
                                       <option value="True">True</option>
                                       <option value="False">False</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">30. </span> <label class="label"> Is clutch a type of women’s Handbag? </label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q8" >
                                       <option value="">--Select Option--</option>
                                       <option value="True">True</option>
                                       <option value="False">False</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
									</div>
							 </div>
									<!-- Section 4 end -->
                  <div class="text-center mt-4">
                     <input type="submit" id="btn-login" name="sub" class="btn btn-success" value="Submit">
                  </div>
               </div>
            </form>
         </div>
      </div>
      <?php 
         if(isset($_SESSION['success_msg']) && $_SESSION['success_msg']!=''){ 
         	unset($_SESSION['success_msg']);
         }
         ?>
      <script src="js/jquery-3.2.1.slim.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- <script src="js/jquery-3.2.1.slim.min.js"></script> -->
      <script type="text/javascript">
         $(document).ready(function () {
         $('input,textarea,select').prop('required',true);
         //called when key is pressed in textbox
         $("#phone_number").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               //display error message
               $("#errmsg").html("Digits Only").show().fadeOut("slow");
                      return false;
           }
          });
         }); 
         
         function CountDown(duration, display) {
						if (!isNaN(duration)) {
								var timer = duration, minutes, seconds;
								
							var interVal=  setInterval(function () {
							minutes = parseInt(timer / 60, 10);
							seconds = parseInt(timer % 60, 10);
								
							minutes = minutes < 10 ? "0" + minutes : minutes;
							seconds = seconds < 10 ? "0" + seconds : seconds;
							if(timer == 300){
								alert("Kindly complete your form only 5 minute remaining");
							}
							
							$(display).html("<b>" + minutes + "m : " + seconds + "s" + "</b>");
							if (--timer < 0) {
								timer = duration;
								SubmitFunction();
								$('#display').empty();
								clearInterval(interVal)
							}
					},1000);
					
						}
				}
               
         	function SubmitFunction(){
         		$('input,textarea,select').prop('required',false);
         		$('#btn-login').click();
         		$('#submitted').html('submitted');
         	}
         
         	// seconds*minutes*hours
         	CountDown(60*60*1.5,$('#display'));
             
         
					 $(document).ready(function(){
						var validated = false,
								inputC = 0,
								selectC = 0,
								that;
						jQuery.fn.extend({
							valVal: function() {
								return $(this).each(function() {
									var input = $(this);
									var select = $(this);
									inputC++;
									selectC++;
									if(!$.trim(input.val())){
										input.closest(".collapse").removeClass("collapse");
									}
									else if(!$.trim(select.val())){
										select.closest(".collapse").removeClass("collapse");
									}
								});
							}
						});

						$(".btn-success").on("click", function(){
							that = $(this);
							inputC = 0;
							selectC = 0; 
							$(".bb").addClass("collapse");
							that.parent().parent().find("input,select").valVal();
							var collapse = $(".collapse");
							if(collapse.length==inputC || collapse.length==selectC){
								validated = true;
								console.log("yess");
							}else{
								console.log("not quite correct yet..");
								//Just for the sample, has no use (yet) in this piece of code
							}
							
						});
						/* $(".card-header").on("click", function(){
							that = $(this);
							that.parent().find(".bb").toggleClass("collapse");
							that.parent().find("input,select").focus();
						}) */
					});


               
      </script>
   </body>
</html>
