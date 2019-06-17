<?php 
	//error_reporting(0);
	session_start();
	date_default_timezone_set("Asia/Kolkata");
   
	$con = mysqli_connect("localhost","root","p@ssw0rd","quiz_assesment");
   
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
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
   	$correct_answers = array('False', 'True','Not Given','False','True','False','True','7.22');
		 
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
   	$correct_answers = array('Video Graphics Array','HIGH definition multimedia interface ','Digital Visual interface','Operating System','Revolutions per minute','Flip-Flops','True','True');
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
										 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" >
                                 <div class="panel">
                                       <div class="panel-heading" id="headingTwo">
                                          <h5 class="mb-0">
                                             <a class="panel-icon collapse-icon" role="button" data-toggle="collapse" data-parent="#accordion" href="#sectionOne" aria-expanded="true" aria-controls="sectionOne" class="collapsed">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                <h4 class='heading'>SECTION 1. Content Comprehension </h4>
                                             </a>
                                          </h5>
												</div>
												<div id="sectionOne" class=" panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" data-parent="#">
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
                                                   <h3>Passage</h3>
                                                </a>
                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                             </div>
                                          </div>
                                          <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="">
                                             <div class="card-block">
                                                Chronobiology might sound a little futuristic – like something from a science fiction novel, perhaps – but it’s actually a field of study that concerns one of the oldest processes life on this planet has ever known: short-term rhythms of time and their effect on flora and fauna. This can take many forms. Marine life, for example, is influenced by tidal patterns. Animals tend to be active or inactive depending on the position of the sun or moon. Numerous creatures, humans included, are largely diurnal – that is, they like to come out during the hours of sunlight. Nocturnal animals, such as bats and possums, prefer to forage by night.
                                                A third group are known as crepuscular: they thrive in the lowlight of dawn and dusk and remain inactive at other hours. When it comes to humans, chronobiologists are interested in what is known as the circadian rhythm. This is the complete cycle our bodies are naturally geared to undergo within the passage of a twenty-four hour day. Aside from sleeping at night and waking during the day, each cycle involves many other factors such as changes in blood pressure and body temperature. Not everyone has an identical circadian rhythm. ‘Night people’, for example, often describe how they find it very hard to operate during the morning, but become alert and focused by evening. This is a benign variation within circadian rhythms known as a chronotype. Scientists have limited abilities to create durable modifications of chronobiological demands. Recent therapeutic developments for humans such as artificial light machines and melatonin administration can reset our circadian rhythms, for example, but our bodies can tell the difference and health suffers when we breach these natural rhythms for extended periods of time. Plants appear no more malleable in this 3 respect; studies demonstrate that vegetables grown in season and ripened on the tree are far higher in essential nutrients than those grown in greenhouses and ripened by laser.
                                                Knowledge of chronobiological patterns can have many pragmatic implications for our day-to-day lives. While contemporary living can sometimes appear to subjugate biology – after all, who needs circadian rhythms when we have caffeine pills, energy drinks, shift work and cities that never sleep? – keeping in synch with our body clock is important. The average urban resident, for example, rouses at the eye-blearing time of 6.04 a.m., which researchers believe to be far too early. One study found that even rising at 7.00 a.m. has deleterious effects on health unless exercise is performed for 30 minutes afterward. The optimum moment has been whittled down to 7.22 a.m.; muscle aches, headaches and moodiness were reported to be lowest by participants in the study who awoke then. Once you’re up and ready to go, what then? If you’re trying to shed some extra pounds, dieticians are adamant: never skip breakfast.
                                                This disorients your circadian rhythm and puts your body in starvation mode. The recommended course of action is to follow an intense workout with a carbohydrate-rich breakfast; the other way round and weight loss results are not as pronounced. Morning is also great for breaking out the vitamins. Supplement absorption by the body is not temporal-dependent, but naturopath Pam Stone notes that the extra boost at breakfast helps us get energised for the day ahead. For improved absorption, Stone suggests pairing supplements with a food in which they are soluble and steering clear of caffeinated beverages. Finally, Stone warns to take care with storage; high potency is best for absorption, and warmth and humidity are known to deplete the potency of a supplement. After-dinner espressos are becoming more of a tradition – we have the Italians to thank for that – but to prepare for a good night’s sleep we are better off putting the brakes on caffeine consumption as early as 3 p.m. With a seven hour half-life, a cup of coffee containing 90 mg of caffeine taken at this hour could still leave 45 mg of caffeine in your nervous system at ten o’clock that evening. It is essential that, by the time you are ready to sleep, your body is rid of all traces. Evenings are important for winding down before sleep; however, dietician Geraldine Georgeou warns that an after-five carbohydrate-fast is more cultural myth than chronobiological demand. This will deprive your body of vital energy needs. Overloading your gut could lead to indigestion, though. Our digestive tracts do not shut down for the night entirely, but their work slows to a crawl as our bodies prepare for sleep. Consuming a modest snack should be entirely sufficient.
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">1. </span> <label class="label">Chronobiology is the study of how living things have evolved over time.  </label>
                                       <span id="sub_skills_label_1" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q1">
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                          <option value="Not Given">Not Given</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">2. </span> <label class="label">The rise and fall of sea levels affects how sea creatures behave. </label>
                                       <span id="sub_skills_label_1" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q2" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                          <option value="Not Given">Not Given</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div> <span class="num">3. </span><label class="label">Most animals are active during the daytime</label>
                                       <span id="sub_skills_label_2" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q3" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                          <option value="Not Given">Not Given</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">4. </span> <label class="label">Circadian rhythms identify how we do different things on different days. </label>
                                       <span id="sub_skills_label_3" style="color: #d22424; display:none"> (  )</span>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q4" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                          <option value="Not Given">Not Given</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div> <span class="num">5. </span><label class="label">A ‘night person’ can still have a healthy circadian rhythm </label>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q5" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                          <option value="Not Given">Not Given</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">6. </span> <label class="label">New therapies can permanently change circadian rhythms without causing harm</label> 
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q6" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                          <option value="Not Given">Not Given</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">7. </span> <label class="label">Naturally-produced vegetables have more nutritional value.</label>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q7" >
                                          <option value="">--Select Option--</option>
                                          <option value="True">True</option>
                                          <option value="False">False</option>
                                          <option value="Not Given">Not Given</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div><span class="num">8. </span> <label class="label">What did researchers identify as the ideal time to wake up in the morning?</label>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:10px;">
                                       <select class="form-control" name="sec1_q8" >
                                          <option value="">--Select Option--</option>
                                          <option value="6.04">6.04</option>
                                          <option value="7.00">7.00</option>
                                          <option value="7.22">7.22</option>
                                          <option value="7.30">7.30</option>
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
                         <!--   <a   data-toggle="collapse" data-target=""
                              aria-expanded="false" aria-controls="collapseTwo">
                              <h4 class="heading">  SECTION 4. Miscellaneous Questions- Technical (8 Marks)  </h4>
													 </a> -->
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
                                 <div style="margin-left:20px;"><span class="num">23. </span> <label class="label">What does VGA stand for ?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q1" >
                                       <option value="">--Select Option--</option>
                                       <option value="Video Graphics Array.">Video Graphics Array.</option>
                                       <option value="Visual Grey Array">Visual Grey Array</option>
                                       <option value="Video Grey Array ">Video Grey Array </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">24. </span> <label class="label"> What does HDMI stand for ?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q2" >
                                       <option value="">--Select Option--</option>
                                       <option value="HIGH definition multimedia interface ">HIGH definition multimedia interface </option>
                                       <option value="High Defined Media Interface">High Defined Media Interface</option>
                                       <option value="High Definition Multi Interface">High Definition Multi Interface </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">25. </span> <label class="label"> What does DVI Port stand for ?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q3" >
                                       <option value="">--Select Option--</option>
                                       <option value="Device video Interface">Device video Interface</option>
                                       <option value="Digital Visual interface">Digital Visual interface</option>
                                       <option value="Digital visual interconnection">Digital visual interconnection </option>
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
                                 <div style="margin-left:20px;"><span class="num">27. </span> <label class="label"> What is OS ?</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q5" >
                                       <option value="">--Select Option--</option>
                                       <option value="Orchid system">Orchid system</option>
                                       <option value="Operating System ">Operating System </option>
                                       <option value="Operating Software">Operating Software</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <div style="margin-left:20px;"><span class="num">28. </span> <label class="label"> Which among these is not a shoe</label>
                                 </div>
                                 <div class="form-group col-md-6" style="margin-top:10px;">
                                    <select class="form-control" name="sec4_q6" >
                                       <option value="">--Select Option--</option>
                                       <option value="Brogues">Brogues</option>
                                       <option value="Ballerina">Ballerina</option>
                                       <option value="Flip-Flop">Flip-Flop </option>
                                       <option value="Flip-Flop">Boots </option>
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
                  that;
                  jQuery.fn.extend({
                     valVal: function() {
                        return $(this).each(function() {
                           var input = $(this);
                        inputC++;
                        if(!$.trim(input.val())){
                           input.closest(".collapse").removeClass("collapse");
                        }
                        });
                     }
                  });

						$(".btn-success").on("click", function(){
							that = $(this);
                     console.log(that.parent());
                     inputC = 0;
                     $(".panel-collapse").addClass("collapse");
                     that.parent().parent().find("input").valVal();
                     var collapse = $(".collapse");
                     if(collapse.length==inputC){
                        validated = true;
                        console.log("yess");
                        //Do an AJAX request to server.
                     }else{
                        console.log("not quite correct yet..");
                        //Just for the sample, has no use (yet) in this piece of code
                     }
						});


						$(".panel-heading").on("click", function(){
                     that = $(this);
                     that.parent().find(".panel-collapse").toggleClass("collapse");
                     that.parent().find("input").focus();
                  });
					});


               
      </script>
   </body>
</html>