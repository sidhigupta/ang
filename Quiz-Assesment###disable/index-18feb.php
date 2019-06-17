<?php 
session_start();
$con = mysqli_connect("localhost","root","p@ssw0rd","skill_register") or die(mysqli_error());
date_default_timezone_set("Asia/Kolkata");

$date = date('Y-m-d h:i:s');

if(isset($_POST['sub'])){
	
	/* echo "<pre>";
	print_r($_POST);
	echo "</pre>"; */
	$certification_data='';
	if(isset($_POST['certification']) && !empty($_POST['certification'])){
		
		$certification_data = implode("|",$_POST['certification']);
	}
	
	
	$emp_name = "";
	$emp_id = "";
	$emp_designation = "";
	$emp_location = "";
	
	if(isset($_POST['emp_name']) && $_POST['emp_name']!=''){
		
		$emp_name= $_POST['emp_name'];
	}
	
	if(isset($_POST['emp_id']) && $_POST['emp_id']!=''){
		
		$emp_id= $_POST['emp_id'];
	}	
	if(isset($_POST['emp_designation']) && $_POST['emp_designation']!=''){
		
		$emp_designation= $_POST['emp_designation'];
	}
	if(isset($_POST['emp_location']) && $_POST['emp_location']!=''){
		
		$emp_location= $_POST['emp_location'];
	}	
	
	$query=false;
	if($emp_name!='' && $emp_id!='' && $emp_designation!='' && $emp_location!=''){
		
		$query = mysqli_query($con,"INSERT into emp_basic_info set emp_name='".$emp_name."',emp_id='".$emp_id."',emp_designation='".$emp_designation."',emp_location='".$emp_location."',created_date='".$date."',emp_certifications='".$certification_data."' ");  
	}
	
	if($query){
		$_SESSION['success_msg'] = "success";
		
		$get_last_id = $con->insert_id;
		
	
	
		if(!empty($_POST['skills'])){
			
				for($i=0;$i<count($_POST['skills']);$i++){
					
					if(isset($_POST['skills'][$i]) && $_POST['skills'][$i]!=''){
						$skill_name = $_POST['skills'][$i];
						
						/*********** for Additional Information ******/
						
						if(isset($_POST["additional_information_$i"])){
							
							for($r=0;$r<count($_POST["additional_information_$i"]);$r++){
								
								$additional_information_name= $_POST["additional_information_$i"][$r];
								
								if(isset($_POST["additional_informationvalues_$i"."_$r"])){
									if(isset($_POST["additional_informationvalues_$i"."_$r"][0])){
										
										if($i==0){
											$additional_informationvalue=$_POST["additional_informationvalues_$i"."_$r"];
											
										}else{
											$additional_informationvalue=$_POST["additional_informationvalues_$i"."_$r"][0];
										}
									//$query_add_information = mysqli_query($con,"INSERT into emp_additional_information set id='".$get_last_id."', skill_name='".$skill_name."',add_information_name='".$additional_information_name."',add_information_value='".$_POST["additional_informationvalues_$i"."_$r"][0]."',created_date='".$date."' ");
									
                  $query_add_information = mysqli_query($con,"INSERT into emp_additional_information set id='".$get_last_id."', skill_name='".$skill_name."',add_information_name='".$additional_information_name."',add_information_value='".$additional_informationvalue."',created_date='".$date."' ");
                  			
									}
								}	
								
							}
						}
						/*********** for Additional Information closed ******/
						if(isset($_POST["sub_skills_$i"])){
							
							
							for($j=0;$j<count($_POST["sub_skills_$i"]);$j++){
									$sub_skill_name  =$_POST["sub_skills_$i"][$j];
									
									
									if(isset($_POST["subskill_value_$i"."_$j"])){
											if(isset($_POST["subskill_value_$i"."_$j"][0])){
												
														
												$last_id =$get_last_id;
												$query_skill = mysqli_query($con,"INSERT into emp_skills set id='".$last_id."', skill_name='".$skill_name."',subskill_name='".$sub_skill_name."',skill_value='".$_POST["subskill_value_$i"."_$j"][0]."' ");
												
												if($query_skill){
												
												}
											}
								}	
							}
						}
					}   
						
				}	
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
</head>
<body>
  <div class="wrapper">
    <header>
      <div class="container">
        <a href="index.html" class="logo"><img src="images/logo.png" alt="" /></a>
      </div>
    </header>
    <div class="container">
      <div class="form-wrp">
        <form method="POST" id="form1">
          <?php if(isset($_SESSION['success_msg']) && $_SESSION['success_msg']!=''){ ?>
          <div class="alert alert-success">
            <strong>Success!</strong> Your form has been successfully submitted.
          </div>
          <?php }?>
          <div class="alert alert-warning" style="display:none;">
            <strong>Warning!</strong> Mandatory fields must be filled.
          </div>
          <div class="section">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <a data-toggle="" data-target="
                    "
                      aria-expanded="" aria-controls="">
                     <h4 class="heading"> Basic Information </h4>
          </a>
                  </h5>
                </div>
                <div id="" class=" show" aria-labelledby="headingOne" data-parent="">

                  <!-- <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample"> -->

                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Name<span id="basic_label_1" style="color: #d22424; display:none;"> ( Required )<span></label>


                        <input type="text" name="emp_name" id="emp_name" class="form-control" placeholder="" required>
                      </div>
                      <div class="form-group col-md-3">
                        <label>Employee ID<span id="basic_label_2" style="color: #d22424; display:none;"> ( Required )<span></label>
                        <input type="text" name="emp_id" id="emp_id" class="form-control" placeholder="Enter Your MK ID i.e MK12345"  required>
                      </div>
                      <div class="form-group col-md-3">
                        <label>Designation <span id="basic_label_3" style="color: #d22424; display:none;"> ( Required )<span></label>
                        <input type="text" class="form-control" id="emp_designation" name="emp_designation" placeholder=""
                          required>
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
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                    <a  data-toggle="collapse" data-item-id="stand-out"
                      data-target="collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      
                      <h4 class="heading">Professional Skills  </h4>

                      <input type="hidden" name="skills[]" value="Professional Skills" />
          </a>
                  </h5>
                </div>
                <div id="" class=" bb show" aria-labelledby="headingTwo" data-parent="#">
                  <div class="card-body">
                    <div class="row skill-rating">
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">Communication</label>
                          <span id="sub_skills_label_0" style="color: #d22424; display:none"> ( Required )</span>


                              <input type="hidden" name="sub_skills_0[]" value="Communication" />
                              <p><small><em>(The rating of this parameter is based on how strong are your communication
                                    skills)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio1" value="expert" name="subskill_value_0_0[]">
                          <label class="custom-control-label" for="customRadio1">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio2" value="proficient" name="subskill_value_0_0[]">
                          <label class="custom-control-label" for="customRadio2">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio3" value="demonstrating" name="subskill_value_0_0[]">
                          <label class="custom-control-label" for="customRadio3">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio4" value='basic' name="subskill_value_0_0[]">
                          <label class="custom-control-label" for="customRadio4">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio5" value='None/Low' name="subskill_value_0_0[]">
                          <label class="custom-control-label" for="customRadio5">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">Report Writing </label>
                          <span id="sub_skills_label_1" style="color: #d22424; display:none"> ( Required )</span>

                              <input type="hidden" name="sub_skills_0[]" value="Report Writing" />

                              <p><small><em> (The rating of this parameter is based on how well can you document an
                                    activity/task)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio01" value="expert" name="subskill_value_0_1[]">
                          <label class="custom-control-label" for="customRadio01">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio02" value="proficient" name="subskill_value_0_1[]">
                          <label class="custom-control-label" for="customRadio02">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio03" value="demonstrating"
                            name="subskill_value_0_1[]">
                          <label class="custom-control-label" for="customRadio03">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio04" value="Basic" name="subskill_value_0_1[]">
                          <label class="custom-control-label" for="customRadio04">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio05" value="None/Low" name="subskill_value_0_1[]">
                          <label class="custom-control-label" for="customRadio05">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">Planning</label>
                          <span id="sub_skills_label_2" style="color: #d22424; display:none"> ( Required )</span>
                              <input type="hidden" name="sub_skills_0[]" value="Planning" />
                              <p><small><em>(The rating of this parameter is based on how well do you plan activities/
                                    tasks)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio11" value="expert" name="subskill_value_0_2[]">
                          <label class="custom-control-label" for="customRadio11">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio22" value="proficient" name="subskill_value_0_2[]">
                          <label class="custom-control-label" for="customRadio22">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio33" value="demonstrating"
                            name="subskill_value_0_2[]">
                          <label class="custom-control-label" for="customRadio33">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio44" value="basic" name="subskill_value_0_2[]">
                          <label class="custom-control-label" for="customRadio44">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio55" value="None/Low" name="subskill_value_0_2[]">
                          <label class="custom-control-label" for="customRadio55">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">4. </span> <label class="label">Making Presentation</label>
                          <span id="sub_skills_label_3" style="color: #d22424; display:none"> ( Required )</span>
                              <input type="hidden" name="sub_skills_0[]" value="Making Presentation" />
                              <p><small><em>(The rating of this parameter is based on how strong are your presentation
                                    skills)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio001" value="Expert" name="subskill_value_0_3[]">
                          <label class="custom-control-label" for="customRadio001">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio002" value="proficient" name="subskill_value_0_3[]">
                          <label class="custom-control-label" for="customRadio002">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio003" value="demonstrating"
                            name="subskill_value_0_3[]">
                          <label class="custom-control-label" for="customRadio003">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio004" value="Basic" name="subskill_value_0_3[]">
                          <label class="custom-control-label" for="customRadio004">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio005" value="None/Low" name="subskill_value_0_3[]">
                          <label class="custom-control-label" for="customRadio005">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>


                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample" role="button"
                          aria-expanded="false" aria-controls="collapseExample">
                          Additional Information
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">5. </span><label class="label">ISO/IEC 9001 </label>
                                <input type="hidden" name="additional_information_0[]" value="ISO/IEC 9001" />

                                <p><small><em>(The rating of this parameter is based on knowledge of ISO standard 9001)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd1" value="Expert" name="additional_informationvalues_0_0">
                                <label class="custom-control-label" for="cuscvd1">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd2" value="Proficient" name="additional_informationvalues_0_0">
                                <label class="custom-control-label" for="cuscvd2">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd3" value="Demonstrating"
                                  name="additional_informationvalues_0_0">
                                <label class="custom-control-label" for="cuscvd3">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd4" value="Basic" name="additional_informationvalues_0_0">
                                <label class="custom-control-label" for="cuscvd4">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd5" value="None/Low" name="additional_informationvalues_0_0">
                                <label class="custom-control-label" for="cuscvd5">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">6. </span> <label class="label">Data Analysis</label>
                                <input type="hidden" name="additional_information_0[]" value="Data Analysis" />
                                <p><small><em> (The rating of this parameter is based on how well you can depict and
                                      analyse data sets)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd6" value="Expert" name="additional_informationvalues_0_1">
                                <label class="custom-control-label" for="cuscvd6">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd7" value="Proficient" name="additional_informationvalues_0_1">
                                <label class="custom-control-label" for="cuscvd7">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd8" value="Demonstrating"
                                  name="additional_informationvalues_0_1">
                                <label class="custom-control-label" for="cuscvd8">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd9" value="Basic" name="additional_informationvalues_0_1">
                                <label class="custom-control-label" for="cuscvd9">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cuscvd10" value="None/Low" name="additional_informationvalues_0_1">
                                <label class="custom-control-label" for="cuscvd10">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <a   data-toggle="collapse" data-target=""
                      aria-expanded="false" aria-controls="collapseTwo">
                    
                      <h4 class="heading">  Basic Software Skills  </h4>
                      <input type="hidden" name="skills[]" value="Basic Software Skills" />

                    </a>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse cc show" aria-labelledby="headingTwo" data-parent="">
                  <div class="card-body">
                    <div class="row skill-rating">

                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">MS Excel </label>
                          <span id="sub_skills_label_4" style="color: #d22424; display:none"> ( Required )</span>
                              <input type="hidden" name="sub_skills_1[]" value="MS Excel" />


                              <p><small><em>(The rating of this parameter is based on knowledge about MS Excel)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom122" value="Expert" name="subskill_value_1_0[]">
                          <label class="custom-control-label" for="custom122">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom23" value="Proficient" name="subskill_value_1_0[]">
                          <label class="custom-control-label" for="custom23">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom34" value="Demonstrating" name="subskill_value_1_0[]">
                          <label class="custom-control-label" for="custom34">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom55" value="Basic" name="subskill_value_1_0[]">
                          <label class="custom-control-label" for="custom55">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom56" value="None/Low" name="subskill_value_1_0[]">
                          <label class="custom-control-label" for="custom56">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">MS Word </label>
                          <span id="sub_skills_label_5" style="color: #d22424; display:none"> ( Required )</span>

                              <input type="hidden" name="sub_skills_1[]" value="MS Word" />
                              <p><small><em> (The rating of this parameter is based on knowledge about MS Word)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom011" value="Expert" name="subskill_value_1_1[]">
                          <label class="custom-control-label" for="custom011">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom022" value="Proficient" name="subskill_value_1_1[]">
                          <label class="custom-control-label" for="custom022">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c6" value="Demonstrating" name="subskill_value_1_1[]">
                          <label class="custom-control-label" for="c6">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom045" value="Basic" name="subskill_value_1_1[]">
                          <label class="custom-control-label" for="custom045">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom056" value="None/Low" name="subskill_value_1_1[]">
                          <label class="custom-control-label" for="custom056">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">MS PowerPoint</label>
                          <span id="sub_skills_label_6" style="color: #d22424; display:none"> ( Required )</span>
                              <input type="hidden" name="sub_skills_1[]" value="MS PowerPoint" />
                              <p><small><em>(The rating of this parameter is based on knowledge about MS Powerpoint)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom11a" value="Expert" name="subskill_value_1_2[]">
                          <label class="custom-control-label" for="custom11a">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom22ac" value="Proficient" name="subskill_value_1_2[]">
                          <label class="custom-control-label" for="custom22ac">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom33aq" value="Demonstrating" name="subskill_value_1_2[]">
                          <label class="custom-control-label" for="custom33aq">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom44dc" value="Basic" name="subskill_value_1_2[]">
                          <label class="custom-control-label" for="custom44dc">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom55bb" value="None/Low" name="subskill_value_1_2[]">
                          <label class="custom-control-label" for="custom55bb">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample1" role="button"
                          aria-expanded="false" aria-controls="collapseExample1">
                          Additional Information
                        </a>

                      </p>
					    <p Style="margin: 0px;     color: #52567a;
    text-transform: capitalize;"><b>Please click on relevant check box for capturing skill set</b></p>
					
                      <div class="collapse" id="collapseExample1">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">4. </span><label class="label">MS Project </label>
                                <input type="hidden" name="additional_information_1[]" value="MS Project" />
                                <p><small><em>(The rating of this parameter is based on knowledge about MS Project)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="zzssaa1" value="Expert" name="additional_informationvalues_1_0[]">
                                <label class="custom-control-label" for="zzssaa1">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="zzssaa2" value="Proficient" name="additional_informationvalues_1_0[]">
                                <label class="custom-control-label" for="zzssaa2">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="zzssaa3" value="Demonstrating"
                                  name="additional_informationvalues_1_0[]">
                                <label class="custom-control-label" for="zzssaa3">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="zzssaa4" value="Basic" name="additional_informationvalues_1_0[]">
                                <label class="custom-control-label" for="zzssaa4">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="zzssaa5" value="None/Low" name="additional_informationvalues_1_0[]">
                                <label class="custom-control-label" for="zzssaa5">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">5. </span> <label class="label">Sharepoint Programming</label>
                                <input type="hidden" name="additional_information_1[]" value="Sharepoint Programming" />
                                <p><small><em> (The rating of this parameter is based on how comfortable are you with
                                      MS Sharepoint and also, designing a sharepoint space)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="zzssaa6" value="Expert" name="additional_informationvalues_1_1[]">
                                <label class="custom-control-label" for="zzssaa6">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0244" value="Proficient"
                                  name="additional_informationvalues_1_1[]">
                                <label class="custom-control-label" for="custom0244">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0245" value="Demonstrating"
                                  name="additional_informationvalues_1_1[]">
                                <label class="custom-control-label" for="custom0245">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0246" value="Basic" name="additional_informationvalues_1_1[]">
                                <label class="custom-control-label" for="custom0246">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0247" value="None/Low" name="additional_informationvalues_1_1[]">
                                <label class="custom-control-label" for="custom0247">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">6. </span> <label class="label">MiniTab</label>
                                <input type="hidden" name="additional_information_1[]" value="MiniTab" />

                                <p><small><em> (The rating of this parameter is based on knowledge about Minitab)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0248" value="Expert" name="additional_informationvalues_1_2[]">
                                <label class="custom-control-label" for="custom0248">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0249" value="Proficient"
                                  name="additional_informationvalues_1_2[]">
                                <label class="custom-control-label" for="custom0249">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0250" value="Demonstrating"
                                  name="additional_informationvalues_1_2[]">
                                <label class="custom-control-label" for="custom0250">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0251" value="Basic" name="additional_informationvalues_1_2[]">
                                <label class="custom-control-label" for="custom0251">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="custom0252" value="None/Low" name="additional_informationvalues_1_2[]">
                                <label class="custom-control-label" for="custom0252">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
							  
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				
              </div>

<style>
.heading label{
  padding:5px 10px;
  color:#fff;
}
.card-body h6{
  margin-left: 18px;
    font-size: 17px;
    color: #52567a;
    display:inline-block;
}

</style>	
              <div class="card">
                <div class="card-header" id="headingTwo01">
				
                <h4 class="heading">   
<label><input type="checkbox" class="finance_skills" name="finance_skills_name" value="collapseTwo01"> Finance Skills</label>
<label><input type="checkbox" class="travel_Skills" name="travel_Skills_name" value="collapseTwo2"> Travel Skills</label>
<label><input type="checkbox" class="technology_skills" name="technology_skills_name" value="collapseTwo3"> Technology Skills</label>
<label><input type="checkbox" class="bfsi_skills" name="bfsi_skills_name" value="collapseTwo4"> BFSI Skills</label>
<label><input type="checkbox" class="utility_skills" name="utility_skills_name" value="collapseTwo5"> Utility Skills</label>
<label><input type="checkbox" class="itms_skills" name="itms_skills_name" value="collapseTw5"> ITSM Skills</label>
<label><input type="checkbox" class="excellence_skills" name="excellence_skills_name" value="collapse5"> Excellence Skills</label>
 <input type="hidden" name="skills[]" value="Finance Skills"/>
 <input type="hidden" name="skills[]" value="Travel Skills"/>
 <input type="hidden" name="skills[]" value="Technology Skills"/>
 <input type="hidden" name="skills[]" value="BFSI Skills"/>
 <input type="hidden" name="skills[]" value="Utility Skills"/>
 <input type="hidden" name="skills[]" value="ITSM Skills"/>
 <input type="hidden" name="skills[]" value="Excellence Skills"/>
 
 
                 </h4>
				 
                </div>
				
                <div id="collapseTwo01" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                  <div class="card-header mb-3" id="headingTwo01">  <h4 class="heading">Finance Skills</h4></div>
                    <div class="row skill-rating">
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">Calculating abilities </label>
						<span id="subskill_label_value_2_0" style="color: #d22424; display:none"> ( Required )</span>
						
                          <input type="hidden" name="sub_skills_2[]" value="Calculating abilities" />
                          <p><small><em>(The rating of this paramter is based on how strong your calculation abilities
                                are)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio1a1" value="Expert" name="subskill_value_2_0[]">
                          <label class="custom-control-label" for="customRadio1a1">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio2a1" value="Proficient" name="subskill_value_2_0[]">
                          <label class="custom-control-label" for="customRadio2a1">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="cz22" value="Demonstrating" name="subskill_value_2_0[]">
                          <label class="custom-control-label" for="cz22">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio4as1" value="Basic" name="subskill_value_2_0[]">
                          <label class="custom-control-label" for="customRadio4as1">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio5as2" value="None/Low" name="subskill_value_2_0[]">
                          <label class="custom-control-label" for="customRadio5as2">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">Finance Basics </label>
						<span id="subskill_label_value_2_1" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_2[]" value="Finance Basics" />
                          <p><small><em> (The rating of this parameter is based on knowledge of basic accounting like
                                ledgers, telling, suspense accounting etc.)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio01as" value="Expert" name="subskill_value_2_1[]">
                          <label class="custom-control-label" for="customRadio01as">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio02we" value="Proficient" name="subskill_value_2_1[]">
                          <label class="custom-control-label" for="customRadio02we">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c2" value="Demonstrating" name="subskill_value_2_1[]">
                          <label class="custom-control-label" for="c2">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c4" value="Basic" name="subskill_value_2_1[]">
                          <label class="custom-control-label" for="c4">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio05s" value="None/Low" name="subskill_value_2_1[]">
                          <label class="custom-control-label" for="customRadio05s">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">Financial Reporting</label>
							<span id="subskill_label_value_2_2" style="color: #d22424; display:none"> ( Required )</span>	
                          <input type="hidden" name="sub_skills_2[]" value="Financial Reporting" />
                          <p><small><em>(The rating of this parameter is based on how well you can document financial
                                insights like forecasting, break evens etc.)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio11az" value="Expert" name="subskill_value_2_2[]">
                          <label class="custom-control-label" for="customRadio11az">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio22zz" value="Proficient" name="subskill_value_2_2[]">
                          <label class="custom-control-label" for="customRadio22zz">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio33aaa" value="Demonstrating"
                            name="subskill_value_2_2[]">
                          <label class="custom-control-label" for="customRadio33aaa">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio44vv" value="Basic" name="subskill_value_2_2[]">
                          <label class="custom-control-label" for="customRadio44vv">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customww" value="None/Low" name="subskill_value_2_2[]">
                          <label class="custom-control-label" for="customww">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">4. </span> <label class="label">Accounts Payable</label>
						<span id="subskill_label_value_2_3" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_2[]" value="Accounts Payable" />
                          <p><small><em>(The rating of this paramter is based on knowledge of AP tools like AS400, JD
                                Edwards etc.)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c41" value="Expert" name="subskill_value_2_3[]">
                          <label class="custom-control-label" for="c41">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c56" value="Proficient" name="subskill_value_2_3[]">
                          <label class="custom-control-label" for="c56">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c57" value="Proficient" name="subskill_value_2_3[]">
                          <label class="custom-control-label" for="c57">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c21" value="Basic" name="subskill_value_2_3[]">
                          <label class="custom-control-label" for="c21">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="c22" value="None/Low" name="subskill_value_2_3[]">
                          <label class="custom-control-label" for="c22">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>


                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample2" role="button"
                          aria-expanded="false" aria-controls="collapseExample2">
                          Additional Information
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample2">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">5. </span><label class="label">SAP </label>
                                <input type="hidden" name="additional_information_2[]" value="SAP" />
                                <p><small><em>(The rating of this parameter is based on knowledge & hands on experience
                                      with SAP modules including SA P FICO, HRM, SD etc)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd1" value="Expert" name="additional_informationvalues_2_0[]">
                                <label class="custom-control-label" for="gbfd1">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd2" value="Proficient" name="additional_informationvalues_2_0[]">
                                <label class="custom-control-label" for="gbfd2">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd3" value="Demonstrating" name="additional_informationvalues_2_0[]">
                                <label class="custom-control-label" for="gbfd3">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd4" value="Basic" name="additional_informationvalues_2_0[]">
                                <label class="custom-control-label" for="gbfd4">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd6" value="None/Low" name="additional_informationvalues_2_0[]">
                                <label class="custom-control-label" for="gbfd6">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">6. </span> <label class="label">Oracle </label>
                                <input type="hidden" name="additional_information_2[]" value="Oracle" />
                                <p><small><em> (The rating of this paramter is based on knowledge of Oracle suites like
                                      Advanced pricing, marketing, proposals etc)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd7" value="Expert" name="additional_informationvalues_2_1[]">
                                <label class="custom-control-label" for="gbfd7">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd8" value="Proficient" name="additional_informationvalues_2_1[]">
                                <label class="custom-control-label" for="gbfd8">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd9" value="Demonstrating" name="additional_informationvalues_2_1[]">
                                <label class="custom-control-label" for="gbfd9">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd10" value="Basic" name="additional_informationvalues_2_1[]">
                                <label class="custom-control-label" for="gbfd10">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd11" value="None/Low" name="additional_informationvalues_2_1[]">
                                <label class="custom-control-label" for="gbfd11">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">7. </span> <label class="label">QuickBooks </label>
                                <input type="hidden" name="additional_information_2[]" value="QuickBooks" />

                                <p><small><em> (The rating of this parameter is based on knowledge & hands on
                                      experience with quickbooks)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd12" value="Expert" name="additional_informationvalues_2_2[]">
                                <label class="custom-control-label" for="gbfd12">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd13" value="Proficient" name="additional_informationvalues_2_2[]">
                                <label class="custom-control-label" for="gbfd13">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd14" value="Demonstrating" name="additional_informationvalues_2_2[]">
                                <label class="custom-control-label" for="gbfd14">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd15" value="Basic" name="additional_informationvalues_2_2[]">
                                <label class="custom-control-label" for="gbfd15">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd16" value="None/Low" name="additional_informationvalues_2_2[]">
                                <label class="custom-control-label" for="gbfd16">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">8. </span> <label class="label">PayPal </label>
                                <input type="hidden" name="additional_information_2[]" value="PayPal" />
                                <p><small><em> (The rating of this parameter is based on knowledge & hands on
                                      experience with PayPal gateway)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd17" value="Expert" name="additional_informationvalues_2_3[]">
                                <label class="custom-control-label" for="gbfd17">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd18" value="Proficient" name="additional_informationvalues_2_3[]">
                                <label class="custom-control-label" for="gbfd18">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd19" value="Demonstrating" name="additional_informationvalues_2_3[]">
                                <label class="custom-control-label" for="gbfd19">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd20" value="Basic" name="additional_informationvalues_2_3[]">
                                <label class="custom-control-label" for="gbfd20">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd21" value="None/Low" name="additional_informationvalues_2_3[]">
                                <label class="custom-control-label" for="gbfd21">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">9. </span> <label class="label">Apple Pay </label>
                                <input type="hidden" name="additional_information_2[]" value="Apple Pay" />
                                <p><small><em> (The rating of this parameter is based on knowledge & hands on
                                      experience with Apple Pay gateway)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd22" value="Expert" name="additional_informationvalues_2_4[]">
                                <label class="custom-control-label" for="gbfd22">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd23" value="Proficient" name="additional_informationvalues_2_4[]">
                                <label class="custom-control-label" for="gbfd23">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd24" value="Demonstrating" name="additional_informationvalues_2_4[]">
                                <label class="custom-control-label" for="gbfd24">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd25" value="Basic" name="additional_informationvalues_2_4[]">
                                <label class="custom-control-label" for="gbfd25">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd26" value="None/Low" name="additional_informationvalues_2_4[]">
                                <label class="custom-control-label" for="gbfd26">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">11. </span> <label class="label">Commercial Acumen </label>
                                <input type="hidden" name="additional_information_2[]" value="Commercial Acumen" />
                                <p><small><em> (The rating of this parameter is based on keenness and quickness in
                                      understanding and dealing with a "business situation" in a manner that is likely
                                      to lead to a good outcome)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd27" value="Expert" name="additional_informationvalues_2_5[]">
                                <label class="custom-control-label" for="gbfd27">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd28" value="Proficient" name="additional_informationvalues_2_5[]">
                                <label class="custom-control-label" for="gbfd28">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd29" value="Demonstrating" name="additional_informationvalues_2_5[]">
                                <label class="custom-control-label" for="gbfd29">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd30" value="Basic" name="additional_informationvalues_2_5[]">
                                <label class="custom-control-label" for="gbfd30">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="gbfd31" value="None/Low" name="additional_informationvalues_2_5[]">
                                <label class="custom-control-label" for="gbfd31">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                  <div class="card-header mb-3" id="headingTwo01">  <h4 class="heading">Travel Skills</h4></div>	
                    <div class="row skill-rating">
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">Amadeus </label>
						<span id="subskill_label_value_3_0" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_3[]" value="Amadeus" />

                          <p><small><em>(The rating of this parameter is based on knowledge and hands on experience
                                with amadeus as a tickting and travel organising tool)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="cvaa" value="Expert" name="subskill_value_3_0[]">
                          <label class="custom-control-label" for="cvaa">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customRadio2as1" value="Proficient" name="subskill_value_3_0[]">
                          <label class="custom-control-label" for="customRadio2as1">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom222" value="Demonstrating" name="subskill_value_3_0[]">
                          <label class="custom-control-label" for="custom222">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom221" value="Basic" name="subskill_value_3_0[]">
                          <label class="custom-control-label" for="custom221">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2224" value="None/Low" name="subskill_value_3_0[]">
                          <label class="custom-control-label" for="custom2224">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">Geographical Knowledge </label>
						<span id="subskill_label_value_3_1" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_3[]" value="Geographical Knowledge" />

                          <p><small><em> (The rating of this parameter is based on knowledge about regions, locations,
                                time zones etc)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customr11" value="Expert" name="subskill_value_3_1[]">
                          <label class="custom-control-label" for="customr11">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customr112" value="Proficient" name="subskill_value_3_1[]">
                          <label class="custom-control-label" for="customr112">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customr113" value="Demonstrating" name="subskill_value_3_1[]">
                          <label class="custom-control-label" for="customr113">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customr114" value="Basic" name="subskill_value_3_1[]">
                          <label class="custom-control-label" for="customr114">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customr115" value="None/Low" name="subskill_value_3_1[]">
                          <label class="custom-control-label" for="customr115">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">Routing</label>
						<span id="subskill_label_value_3_2" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_3[]" value="Routing" />
                          <p><small><em>(The rating of this parameter is based on skills to create travel routines &
                                organise travel plans)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom432" value="Expert" name="subskill_value_3_2[]">
                          <label class="custom-control-label" for="custom432">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom433" value="Proficient" name="subskill_value_3_2[]">
                          <label class="custom-control-label" for="custom433">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom434" value="Demonstrating" name="subskill_value_3_2[]">
                          <label class="custom-control-label" for="custom434">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom435" value="Basic" name="subskill_value_3_2[]">
                          <label class="custom-control-label" for="custom435">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom436" value="None/Low" name="subskill_value_3_2[]">
                          <label class="custom-control-label" for="custom436">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample112" role="button"
                          aria-expanded="false" aria-controls="collapseExample112">
                          Additional Information
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample112">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">4. </span><label class="label">Sabre </label>
                                <input type="hidden" name="additional_information_3[]" value="Sabre" />
                                <p><small><em>(The rating of this parameter is based on knowledge and hands on
                                      experience with sabre as a tickting and travel organising tool)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs123" value="Expert" name="additional_informationvalues_3_0[]">
                                <label class="custom-control-label" for="cs123">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs124" value="Proficient" name="additional_informationvalues_3_0[]">
                                <label class="custom-control-label" for="cs124">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs125" value="Demonstrating" name="additional_informationvalues_3_0[]">
                                <label class="custom-control-label" for="cs125">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs126" value="Basic" name="additional_informationvalues_3_0[]">
                                <label class="custom-control-label" for="cs126">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs127" value="None/Low" name="additional_informationvalues_3_0[]">
                                <label class="custom-control-label" for="cs127">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">6. </span> <label class="label">Any GDS </label>
                                <input type="hidden" name="additional_information_3[]" value="Any GDS" />
                                <p><small><em> (The rating of this paramter is based on knowledge of any travel tool
                                      excluding amadeus & Sabre)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs128" value="Expert" name="additional_informationvalues_3_1[]">
                                <label class="custom-control-label" for="cs128">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs129" value="Proficient" name="additional_informationvalues_3_1[]">
                                <label class="custom-control-label" for="cs129">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs130" value="Demonstrating" name="additional_informationvalues_3_1[]">
                                <label class="custom-control-label" for="cs130">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs131" value="Basic" name="additional_informationvalues_3_1[]">
                                <label class="custom-control-label" for="cs131">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs132" value="None/Low" name="additional_informationvalues_3_1[]">
                                <label class="custom-control-label" for="cs132">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">5. </span> <label class="label">Visa </label>
                                <input type="hidden" name="additional_information_3[]" value="Visa" />
                                <p><small><em> (The rating of this parameter is based on skills related to Visa
                                      including terms, criterias, procedures etc)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs133" value="Expert" name="additional_informationvalues_3_2[]">
                                <label class="custom-control-label" for="cs133">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs134" value="Proficient" name="additional_informationvalues_3_2[]">
                                <label class="custom-control-label" for="cs134">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs135" value="Demonstrating" name="additional_informationvalues_3_2[]">
                                <label class="custom-control-label" for="cs135">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs136" value="Basic" name="additional_informationvalues_3_2[]">
                                <label class="custom-control-label" for="cs136">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="cs137" value="None/Low" name="additional_informationvalues_3_2[]">
                                <label class="custom-control-label" for="cs137">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                  <div class="card-header mb-3" id="headingTwo01">  <h4 class="heading"> Technology Skills</h4>	</div>
                    <div class="row skill-rating">
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">C/C++ </label>
						<span id="subskill_label_value_4_0" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_4[]" value="C/C++" />

                          <p><small><em>(The rating of this parameter is based on software skills of C/C++)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2231" value="Expert" name="subskill_value_4_0[]">
                          <label class="custom-control-label" for="custom2231">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2232" value="Proficient" name="subskill_value_4_0[]">
                          <label class="custom-control-label" for="custom2232">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2233" value="Demonstrating" name="subskill_value_4_0[]">
                          <label class="custom-control-label" for="custom2233">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2234" value="Basic" name="subskill_value_4_0[]">
                          <label class="custom-control-label" for="custom2234">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2235" value="None/Low" name="subskill_value_4_0[]">
                          <label class="custom-control-label" for="custom2235">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">Java </label>
						<span id="subskill_label_value_4_1" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_4[]" value="Java" />
                          <p><small><em> (The rating of this parameter is based on software skills of Java like
                                serverlets, applets etc)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2236" value="Expert" name="subskill_value_4_1[]">
                          <label class="custom-control-label" for="custom2236">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2237" value="Proficient" name="subskill_value_4_1[]">
                          <label class="custom-control-label" for="custom2237">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2238" value="Demonstrating" name="subskill_value_4_1[]">
                          <label class="custom-control-label" for="custom2238">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2239" value="Basic" name="subskill_value_4_1[]">
                          <label class="custom-control-label" for="custom2239">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2241" value="None/Low" name="subskill_value_4_1[]">
                          <label class="custom-control-label" for="custom2241">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">SQL</label>
						<span id="subskill_label_value_4_2" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_4[]" value="SQL" />

                          <p><small><em>(The rating of this parameter is based on database skills of SQL)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2242" value="Expert" name="subskill_value_4_2[]">
                          <label class="custom-control-label" for="custom2242">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2243" value="Proficient" name="subskill_value_4_2[]">
                          <label class="custom-control-label" for="custom2243">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2244" value="Demonstrating" name="subskill_value_4_2[]">
                          <label class="custom-control-label" for="custom2244">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2245" value="Basic" name="subskill_value_4_2[]">
                          <label class="custom-control-label" for="custom2245">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="custom2246" value="None/Low" name="subskill_value_4_2[]">
                          <label class="custom-control-label" for="custom2246">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">4. </span> <label class="label">PHP</label>
						<span id="subskill_label_value_4_3" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_4[]" value="PHP" />
                          <p><small><em>(The rating of this parameter is based on software skills of Python)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="cus551" value="Expert" name="subskill_value_4_3[]">
                          <label class="custom-control-label" for="cus551">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="cus552" value="Proficient" name="subskill_value_4_3[]">
                          <label class="custom-control-label" for="cus552">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="cus553" value="Demonstrating" name="subskill_value_4_3[]">
                          <label class="custom-control-label" for="cus553">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="cus554" value="Basic" name="subskill_value_4_3[]">
                          <label class="custom-control-label" for="cus554">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="cus555" value="None/Low" name="subskill_value_4_3[]">
                          <label class="custom-control-label" for="cus555">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>


                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample01" role="button"
                          aria-expanded="false" aria-controls="collapseExample01">
                          Additional Information
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample01">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">5. </span><label class="label">C# </label>
                                <input type="hidden" name="additional_information_4[]" value="C#" />

                                <p><small><em>(The rating of this parameter is based on software skills of C#)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom1" value="Expert" name="additional_informationvalues_4_0[]">
                                <label class="custom-control-label" for="tom1">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom2" value="Proficient" name="additional_informationvalues_4_0[]">
                                <label class="custom-control-label" for="tom2">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom3" value="Demonstrating" name="additional_informationvalues_4_0[]">
                                <label class="custom-control-label" for="tom3">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom3" value="Basic" name="additional_informationvalues_4_0[]">
                                <label class="custom-control-label" for="tom3">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom4" value="None/Low" name="additional_informationvalues_4_0[]">
                                <label class="custom-control-label" for="tom4">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">6. </span> <label class="label">Scala </label>
                                <input type="hidden" name="additional_information_4[]" value="Scala" />
                                <p><small><em> (The rating of this parameter is based on software skills of Scala)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom5" value="Expert" name="additional_informationvalues_4_1[]">
                                <label class="custom-control-label" for="tom5">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom6" value="Proficient" name="additional_informationvalues_4_1[]">
                                <label class="custom-control-label" for="tom6">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom7" value="Demonstrating" name="additional_informationvalues_4_1[]">
                                <label class="custom-control-label" for="tom7">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom8" value="Basic" name="additional_informationvalues_4_1[]">
                                <label class="custom-control-label" for="tom8">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom9" value="None/Low" name="additional_informationvalues_4_1[]">
                                <label class="custom-control-label" for="tom9">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">7. </span> <label class="label">Ruby </label>
                                <input type="hidden" name="additional_information_4[]" value="Ruby" />
                                <p><small><em> (The rating of this parameter is based on software skills of ruby on
                                      rails)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom10" value="Expert" name="additional_informationvalues_4_2[]">
                                <label class="custom-control-label" for="tom10">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom11" value="Proficient" name="additional_informationvalues_4_2[]">
                                <label class="custom-control-label" for="tom11">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom12" value="Demonstrating" name="additional_informationvalues_4_2[]">
                                <label class="custom-control-label" for="tom12">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom13" value="Basic" name="additional_informationvalues_4_2[]">
                                <label class="custom-control-label" for="tom13">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom14" value="None/Low" name="additional_informationvalues_4_2[]">
                                <label class="custom-control-label" for="tom14">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">8. </span> <label class="label">MEAN </label>
                                <input type="hidden" name="additional_information_4[]" value="MEAN" />
                                <p><small><em> (The rating of this parameter is based on software skills of MongoDB,
                                      Express.js, AngularJS, and Node.js)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom15" value="Expert" name="additional_informationvalues_4_3[]">
                                <label class="custom-control-label" for="tom15">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom16" value="Proficient" name="additional_informationvalues_4_3[]">
                                <label class="custom-control-label" for="tom16">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom17" value="Demonstrating" name="additional_informationvalues_4_3[]">
                                <label class="custom-control-label" for="tom17">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom18" value="Basic" name="additional_informationvalues_4_3[]">
                                <label class="custom-control-label" for="tom18">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom19" value="None/Low" name="additional_informationvalues_4_3[]">
                                <label class="custom-control-label" for="tom19">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">9. </span> <label class="label">BlockChain </label>
                                <input type="hidden" name="additional_information_4[]" value="BlockChain" />
                                <p><small><em> (The rating of this parameter is based on cryptography skills of block
                                      chain)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom20" value="Expert" name="additional_informationvalues_4_4[]">
                                <label class="custom-control-label" for="tom20">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom21" value="Proficient" name="additional_informationvalues_4_4[]">
                                <label class="custom-control-label" for="tom21">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom22" value="Demonstrating" name="additional_informationvalues_4_4[]">
                                <label class="custom-control-label" for="tom22">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom23" value="Basic" name="additional_informationvalues_4_4[]">
                                <label class="custom-control-label" for="tom23">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom24" value="None/Low" name="additional_informationvalues_4_4[]">
                                <label class="custom-control-label" for="tom24">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">10. </span> <label class="label">Citrix </label>
                                <input type="hidden" name="additional_information_4[]" value="Citrix" />
                                <p><small><em> (The rating of this parameter is based on remote server solution of
                                      citirx such as receiver, server, node moitoring etc)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom25" value="Expert" name="additional_informationvalues_4_5[]">
                                <label class="custom-control-label" for="tom25">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom26" value="Proficient" name="additional_informationvalues_4_5[]">
                                <label class="custom-control-label" for="tom26">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom27" value="Demonstrating" name="additional_informationvalues_4_5[]">
                                <label class="custom-control-label" for="tom27">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom28" value="Basic" name="additional_informationvalues_4_5[]">
                                <label class="custom-control-label" for="tom28">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom29" value="None/Low" name="additional_informationvalues_4_5[]">
                                <label class="custom-control-label" for="tom29">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">11. </span> <label class="label">AWS </label>
                                <input type="hidden" name="additional_information_4[]" value="AWS" />

                                <p><small><em> (The rating of this parameter is based on cloud knowledge of Amazon Web
                                      Services)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom30" value="Expert" name="additional_informationvalues_4_6[]">
                                <label class="custom-control-label" for="tom30">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom31" value="Proficient" name="additional_informationvalues_4_6[]">
                                <label class="custom-control-label" for="tom31">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom32" value="Demonstrating" name="additional_informationvalues_4_6[]">
                                <label class="custom-control-label" for="tom32">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom33" value="Basic" name="additional_informationvalues_4_6[]">
                                <label class="custom-control-label" for="tom33">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom34" value="None/Low" name="additional_informationvalues_4_6[]">
                                <label class="custom-control-label" for="tom34">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">12. </span> <label class="label">.Net </label>
                                <input type="hidden" name="additional_information_4[]" value=".Net" />
                                <p><small><em> (The rating of this parameter is based on development skills of .Net)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom35" value="Expert" name="additional_informationvalues_4_7[]">
                                <label class="custom-control-label" for="tom35">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom36" value="Proficient" name="additional_informationvalues_4_7[]">
                                <label class="custom-control-label" for="tom36">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom37" value="Demonstrating" name="additional_informationvalues_4_7[]">
                                <label class="custom-control-label" for="tom37">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom38" value="Basic" name="additional_informationvalues_4_7[]">
                                <label class="custom-control-label" for="tom38">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom39" value="None/Low" name="additional_informationvalues_4_7[]">
                                <label class="custom-control-label" for="tom39">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">13. </span> <label class="label">Hadoop/Big data </label>
                                <input type="hidden" name="additional_information_4[]" value="Hadoop/Big data" />

                                <p><small><em> (The rating of this parameter is based on software skills of Hadoop/Big
                                      data)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom40" value="Expert" name="additional_informationvalues_4_8[]">
                                <label class="custom-control-label" for="tom40">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom41" value="Proficient" name="additional_informationvalues_4_8[]">
                                <label class="custom-control-label" for="tom41">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom42" value="Demonstrating" name="additional_informationvalues_4_8[]">
                                <label class="custom-control-label" for="tom42">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom43" value="Basic" name="additional_informationvalues_4_8[]">
                                <label class="custom-control-label" for="tom43">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom44" value="None/Low" name="additional_informationvalues_4_8[]">
                                <label class="custom-control-label" for="tom44">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">14. </span> <label class="label">CCNA </label>
                                <input type="hidden" name="additional_information_4[]" value="CCNA" />
                                <p><small><em> (The rating of this parameter is based on networking skills of CCNA)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom45" value="Expert" name="additional_informationvalues_4_9[]">
                                <label class="custom-control-label" for="tom45">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom46" value="Proficient" name="additional_informationvalues_4_9[]">
                                <label class="custom-control-label" for="tom46">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom47" value="Demonstrating" name="additional_informationvalues_4_9[]">
                                <label class="custom-control-label" for="tom47">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom48" value="Basic" name="additional_informationvalues_4_9[]">
                                <label class="custom-control-label" for="tom48">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom49" value="Basic" name="additional_informationvalues_4_9[]">
                                <label class="custom-control-label" for="tom49">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                  <div class="card-header mb-3" id="headingTwo01">  <h4 class="heading">BFSI Skills</h4></div>
                    <div class="row skill-rating">
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">Underwriting </label>
						<span id="subskill_label_value_5_0" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_5[]" value="Underwriting" />
                          <p><small><em>(The rating of this parameter is based on skills to perform underwriting for
                                insurance policies)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="ww11" value="Expert" name="subskill_value_5_0[]">
                          <label class="custom-control-label" for="ww11">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="ww12" value="Proficient" name="subskill_value_5_0[]">
                          <label class="custom-control-label" for="ww12">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="ww13" value="Demonstrating" name="subskill_value_5_0[]">
                          <label class="custom-control-label" for="ww13">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="ww14" value="Basic" name="subskill_value_5_0[]">
                          <label class="custom-control-label" for="ww14">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="ww15" value="None/Low" name="subskill_value_5_0[]">
                          <label class="custom-control-label" for="ww15">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">Investment Banking </label>
						<span id="subskill_label_value_5_1" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_5[]" value="Investment Banking" />
                          <p><small><em> (The rating of this parameter is based on knowledge & hands on experience of
                                handling/advising financial investments)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas1" value="Expert" name="subskill_value_5_1[]">
                          <label class="custom-control-label" for="zas1">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas2" value="Proficient" name="subskill_value_5_1[]">
                          <label class="custom-control-label" for="zas2">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas3" value="Demonstrating" name="subskill_value_5_1[]">
                          <label class="custom-control-label" for="zas3">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas4" value="Basic" name="subskill_value_5_1[]">
                          <label class="custom-control-label" for="zas4">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas5" value="None/Low" name="subskill_value_5_1[]">
                          <label class="custom-control-label" for="zas5">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">Risk & Compliiance</label>
						<span id="subskill_label_value_5_2" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_5[]" value="Risk & Compliiance" />
                          <p><small><em>(The rating of this parameter is based on ability to assess financial risks and
                                create complaince checks to reduce financial risks)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas6" value="Expert" name="subskill_value_5_2[]">
                          <label class="custom-control-label" for="zas6">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas7" value="Proficient" name="subskill_value_5_2[]">
                          <label class="custom-control-label" for="zas7">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas8" value="Demonstrating" name="subskill_value_5_2[]">
                          <label class="custom-control-label" for="zas8">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas9" value="Basic" name="subskill_value_5_2[]">
                          <label class="custom-control-label" for="zas9">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="zas10" value="None/Low" name="subskill_value_5_2[]">
                          <label class="custom-control-label" for="zas10">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample02" role="button"
                          aria-expanded="false" aria-controls="collapseExample02">
                          Additional Information
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample02">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">4. </span><label class="label">Wealth Management </label>
                                <input type="hidden" name="additional_information_5[]" value="Wealth Management" />
                                <p><small><em>(The rating of this parameter is based on knowledge of discpline for
                                      financial planning, investment portfolio etc )</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom100" value="Expert" name="additional_informationvalues_5_0[]">
                                <label class="custom-control-label" for="tom100">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom101" value="Proficient" name="additional_informationvalues_5_0[]">
                                <label class="custom-control-label" for="tom101">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom102" value="Demonstrating" name="additional_informationvalues_5_0[]">
                                <label class="custom-control-label" for="tom102">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom103" value="Basic" name="additional_informationvalues_5_0[]">
                                <label class="custom-control-label" for="tom103">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom104" value="None/Low" name="additional_informationvalues_5_0[]">
                                <label class="custom-control-label" for="tom104">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">5. </span> <label class="label">Trading </label>
                                <input type="hidden" name="additional_information_5[]" value="Trading" />

                                <p><small><em> (The rating of this parameter is based on exposure to outperform
                                      traditional buy-and-hold investing)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom105" value="Expert" name="additional_informationvalues_5_1[]">
                                <label class="custom-control-label" for="tom105">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom106" value="Proficient" name="additional_informationvalues_5_1[]">
                                <label class="custom-control-label" for="tom106">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom107" value="Demonstrating" name="additional_informationvalues_5_1[]">
                                <label class="custom-control-label" for="tom107">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom108" value="Basic" name="additional_informationvalues_5_1[]">
                                <label class="custom-control-label" for="tom108">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="tom109" value="None/Low" name="additional_informationvalues_5_1[]">
                                <label class="custom-control-label" for="tom109">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">6. </span> <label class="label">CCP </label>
                                <input type="hidden" name="additional_information_5[]" value="CCP" />

                                <p><small><em> (The rating of this paramter is based on Central counterparty clearing
                                      (CCP) counterparty credit risk between parties to a transaction)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="top10" value="Expert" name="additional_informationvalues_5_2[]">
                                <label class="custom-control-label" for="top10">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="top11" value="Proficient" name="additional_informationvalues_5_2[]">
                                <label class="custom-control-label" for="top11">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="top12" value="Demonstrating" name="additional_informationvalues_5_2[]">
                                <label class="custom-control-label" for="top12">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="top13" value="Basic" name="additional_informationvalues_5_2[]">
                                <label class="custom-control-label" for="top13">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="top14" value="None/Low" name="additional_informationvalues_5_2[]">
                                <label class="custom-control-label" for="top14">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                  <div class="card-header mb-3" id="headingTwo01">  <h4 class="heading">Utility Skills</h4></div>
                    <div class="row skill-rating">
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">Smart Grid </label>
						<span id="subskill_label_value_6_0" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_6[]" value="Smart Grid" />
                          <p><small><em>(The rating of this paramter is based on knowledge of modern electricity
                                supply)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq1" value="Expert" name="subskill_value_6_0[]">
                          <label class="custom-control-label" for="czzaq1">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq2" value="Proficient" name="subskill_value_6_0[]">
                          <label class="custom-control-label" for="czzaq2">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq3" value="Demonstrating" name="subskill_value_6_0[]">
                          <label class="custom-control-label" for="czzaq3">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq4" value="Basic" name="subskill_value_6_0[]">
                          <label class="custom-control-label" for="czzaq4">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq5" value="None/Low" name="subskill_value_6_0[]">
                          <label class="custom-control-label" for="czzaq5">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">Energy Management </label>
						<span id="subskill_label_value_6_1" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_6[]" value="Energy Management" />
                          <p><small><em> ( Energy management is the means to controlling and reducing a building's
                                energy consumption)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq6" value="Expert" name="subskill_value_6_1[]">
                          <label class="custom-control-label" for="czzaq6">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq7" value="Proficient" name="subskill_value_6_1[]">
                          <label class="custom-control-label" for="czzaq7">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq8" value="Demonstrating" name="subskill_value_6_1[]">
                          <label class="custom-control-label" for="czzaq8">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq9" value="Basic" name="subskill_value_6_1[]">
                          <label class="custom-control-label" for="czzaq9">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="czzaq10" value="None/Low" name="subskill_value_6_1[]">
                          <label class="custom-control-label" for="czzaq10">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">Outage Management</label>
						<span id="subskill_label_value_6_2" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_6[]" value="Outage Management" />
                          <p><small><em>(An outage management system (OMS) provides the capability to efficiently
                                identify and resolve outages and to generate and report valuable historical
                                information)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="qwasas22" value="Expert" name="subskill_value_6_2[]">
                          <label class="custom-control-label" for="qwasas22">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="qwasas23" value="Proficient" name="subskill_value_6_2[]">
                          <label class="custom-control-label" for="qwasas23">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="qwasas24" value="Demonstrating" name="subskill_value_6_2[]">
                          <label class="custom-control-label" for="qwasas24">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="qwasas25" value="Basic" name="subskill_value_6_2[]">
                          <label class="custom-control-label" for="qwasas25">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="qwasas26" value="None/Low" name="subskill_value_6_2[]">
                          <label class="custom-control-label" for="qwasas26">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="collapseTw5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                  <div class="card-header mb-3" id="headingTwo01">  <h4 class="heading">ITSM Skills</h4></div>
                    <div class="row skill-rating">
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">Service Desk Management </label>
						<span id="subskill_label_value_7_0" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_7[]" value="Service Desk Management" />
                          <p><small><em>(Service Desk Management/IT Service Desk Management is the process of managing
                                the IT service desk that forms the point of contact between the IT service providers
                                and the IT service users)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc10" value="Expert" name="subskill_value_7_0[]">
                          <label class="custom-control-label" for="customc10">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc12" value="Proficient" name="subskill_value_7_0[]">
                          <label class="custom-control-label" for="customc12">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc13" value="Demonstrating" name="subskill_value_7_0[]">
                          <label class="custom-control-label" for="customc13">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc14" value="Basic" name="subskill_value_7_0[]">
                          <label class="custom-control-label" for="customc14">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc15" value="None/Low" name="subskill_value_7_0[]">
                          <label class="custom-control-label" for="customc15">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">Incident Management</label>
						<span id="subskill_label_value_7_1" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_7[]" value="Incident Management" />
                          <p><small><em> ( ncident management (IcM) is a term describing the activities of an
                                organization to identify, analyze, and correct hazards to prevent a future
                                re-occurrence. If not managed, an incident can escalate into an emergency, crisis or a
                                disaster.)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc16" value="Expert" name="subskill_value_7_1[]">
                          <label class="custom-control-label" for="customc16">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc17" value="Proficient" name="subskill_value_7_1[]">
                          <label class="custom-control-label" for="customc17">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc18" value="Demonstrating" name="subskill_value_7_1[]">
                          <label class="custom-control-label" for="customc18">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc19" value="Basic" name="subskill_value_7_1[]">
                          <label class="custom-control-label" for="customc19">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc20" value="None/Low" name="subskill_value_7_1[]">
                          <label class="custom-control-label" for="customc20">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <div> <span class="num">3. </span><label class="label">Problem Management</label>
						<span id="subskill_label_value_7_2" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_7[]" value="Problem Management" />

                          <p><small><em>(roblem management is an area of IT Service Management (ITSM) aimed at
                                resolving incidents and problems caused by end-user errors or IT infrastructure issues
                                and preventing recurrence of such incidents. In this context, an incident is an event
                                that disrupts normal operation.)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc21" value="Expert" name="subskill_value_7_2[]">
                          <label class="custom-control-label" for="customc21">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc22" value="Proficient" name="subskill_value_7_2[]">
                          <label class="custom-control-label" for="customc22">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc23" value="Demonstrating" name="subskill_value_7_2[]">
                          <label class="custom-control-label" for="customc23">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc24" value="Basic" name="subskill_value_7_2[]">
                          <label class="custom-control-label" for="customc24">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="customc25" value="None/Low" name="subskill_value_7_2[]">
                          <label class="custom-control-label" for="customc25">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample022" role="button"
                          aria-expanded="false" aria-controls="collapseExample022">
                          Additional Information
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample022">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">4. </span><label class="label">Change Management </label>
                                <input type="hidden" name="additional_information_7[]" value="Change Management" />
                                <p><small><em>(The controlled identification and implementation of required changes
                                      within a computer system.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp1" value="Expert" name="additional_informationvalues_7_0[]">
                                <label class="custom-control-label" for="ppp1">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp2" value="Proficient" name="additional_informationvalues_7_0[]">
                                <label class="custom-control-label" for="ppp2">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp3" value="Demonstrating" name="additional_informationvalues_7_0[]">
                                <label class="custom-control-label" for="ppp3">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp4" value="Basic" name="additional_informationvalues_7_0[]">
                                <label class="custom-control-label" for="ppp4">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp5" value="None/Low" name="additional_informationvalues_7_0[]">
                                <label class="custom-control-label" for="ppp5">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">5. </span> <label class="label">Asset Management </label>
                                <input type="hidden" name="additional_information_7[]" value="Asset Management" />

                                <p><small><em> (IT asset management (ITAM) is the set of business practices that join
                                      financial, contractual and inventory functions to support life cycle management
                                      and strategic decision making for the IT environment. Assets include all elements
                                      of software and hardware that are found in the business environment.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp6" value="Expert" name="additional_informationvalues_7_1[]">
                                <label class="custom-control-label" for="ppp6">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp7" value="Proficient" name="additional_informationvalues_7_1[]">
                                <label class="custom-control-label" for="ppp7">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp8" value="Demonstrating" name="additional_informationvalues_7_1[]">
                                <label class="custom-control-label" for="ppp8">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp9" value="Basic" name="additional_informationvalues_7_1[]">
                                <label class="custom-control-label" for="ppp9">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp10" value="None/Low" name="additional_informationvalues_7_1[]">
                                <label class="custom-control-label" for="ppp10">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">6. </span> <label class="label">Policy & Procedures Mgmt </label>
                                <input type="hidden" name="additional_information_7[]" value="Policy & Procedures Mgmt" />
                                <p><small><em> (An effective policies and procedures management structure ensures that
                                      an image of a well-developed organization is promoted to the client.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp11" value="Expert" name="additional_informationvalues_7_2[]">
                                <label class="custom-control-label" for="ppp11">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp12" value="Proficient" name="additional_informationvalues_7_2[]">
                                <label class="custom-control-label" for="ppp12">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp13" value="Demonstrating" name="additional_informationvalues_7_2[]">
                                <label class="custom-control-label" for="ppp13">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp14" value="Basic" name="additional_informationvalues_7_2[]">
                                <label class="custom-control-label" for="ppp14">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp15" value="None/Low" name="additional_informationvalues_7_2[]">
                                <label class="custom-control-label" for="ppp15">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>

                            <div class="form-group col-md-12">
                              <div><span class="num">7. </span> <label class="label">Configuration Management </label>
                                <input type="hidden" name="additional_information_7[]" value="Configuration Management" />
                                <p><small><em> (Configuration management (CM) is a systems engineering process for
                                      establishing and maintaining consistency of a product's performance, functional,
                                      and physical attributes with its requirements, design, and operational
                                      information throughout its life.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp16" value="Expert" name="additional_informationvalues_7_3[]">
                                <label class="custom-control-label" for="ppp16">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp17" value="Proficient" name="additional_informationvalues_7_3[]">
                                <label class="custom-control-label" for="ppp17">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp18" value="Demonstrating" name="additional_informationvalues_7_3[]">
                                <label class="custom-control-label" for="ppp18">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp19" value="Basic" name="additional_informationvalues_7_3[]">
                                <label class="custom-control-label" for="ppp19">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp20" value="None/Low" name="additional_informationvalues_7_3[]">
                                <label class="custom-control-label" for="ppp20">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">8. </span> <label class="label">Release Management </label>
                                <input type="hidden" name="additional_information_7[]" value="Release Management" />

                                <p><small><em> (Release Management is the process responsible for planning, scheduling,
                                      and controlling the build, in addition to testing and deploying Releases. Release
                                      Management ensures that IS&T delivers new and enhanced IT services required by
                                      the business, while protecting the integrity of existing services.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp21" value="Expert" name="additional_informationvalues_7_4[]">
                                <label class="custom-control-label" for="ppp21">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp22" value="Proficient" name="additional_informationvalues_7_4[]">
                                <label class="custom-control-label" for="ppp22">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp23" value="Demonstrating" name="additional_informationvalues_7_4[]">
                                <label class="custom-control-label" for="ppp23">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp24" value="Basic" name="additional_informationvalues_7_4[]">
                                <label class="custom-control-label" for="ppp24">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp25" value="None/Low" name="additional_informationvalues_7_4[]">
                                <label class="custom-control-label" for="ppp25">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">9. </span> <label class="label">ISO/IEC 27001/27002 </label>
                                <input type="hidden" name="additional_information_7[]" value="ISO/IEC 27001/27002" />

                                <p><small><em> (ISO/IEC 27001 is the best-known standard in the family providing
                                      requirements for an information security management system)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp26" value="Expert" name="additional_informationvalues_7_5[]">
                                <label class="custom-control-label" for="ppp26">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp27" value="Proficient" name="additional_informationvalues_7_5[]">
                                <label class="custom-control-label" for="ppp27">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp28" value="Demonstrating" name="additional_informationvalues_7_5[]">
                                <label class="custom-control-label" for="ppp28">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp29" value="Basic" name="additional_informationvalues_7_5[]">
                                <label class="custom-control-label" for="ppp29">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp30" value="None/Low" name="additional_informationvalues_7_5[]">
                                <label class="custom-control-label" for="ppp30">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">10. </span> <label class="label">ISO/IEC 20000-1 </label>
                                <input type="hidden" name="additional_information_7[]" value="ISO/IEC 20000-1" />

                                <p><small><em> (It is a standard with clearly defined requirements that must be met in
                                      order to certify that a minimum of best practice standards are met. ISO 20000 is
                                      ITIL based, and ITIL is designed with ISO 20000 in mind; therefore, they
                                      complement each other well.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp31" value="Expert" name="additional_informationvalues_7_6[]">
                                <label class="custom-control-label" for="ppp31">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp32" value="Proficient" name="additional_informationvalues_7_6[]">
                                <label class="custom-control-label" for="ppp32">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp33" value="Demonstrating" name="additional_informationvalues_7_6[]">
                                <label class="custom-control-label" for="ppp33">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp34" value="Basic" name="additional_informationvalues_7_6[]">
                                <label class="custom-control-label" for="ppp34">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp35" value="None/Low" name="additional_informationvalues_7_6[]">
                                <label class="custom-control-label" for="ppp35">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">11. </span> <label class="label">BMC Remedy </label>
                                <input type="hidden" name="additional_information_7[]" value="BMC Remedy" />

                                <p><small><em> (The rating of this parameter is based on knowledge of BMC Remedy tool
                                      in ServiceDesk)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp36" value="Expert" name="additional_informationvalues_7_7[]">
                                <label class="custom-control-label" for="ppp36">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp37" value="Proficient" name="additional_informationvalues_7_7[]">
                                <label class="custom-control-label" for="ppp37">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp38" value="Demonstrating" name="additional_informationvalues_7_7[]">
                                <label class="custom-control-label" for="ppp38">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp39" value="Basic" name="additional_informationvalues_7_7[]">
                                <label class="custom-control-label" for="ppp39">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp40" value="None/Low" name="additional_informationvalues_7_7[]">
                                <label class="custom-control-label" for="ppp40">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">12. </span> <label class="label">Service-Now </label>

                                <input type="hidden" name="additional_information_7[]" value="Service-Now" />
                                <p><small><em> (The rating of this parameter is based on knowledge of Service-now tool
                                      in ServiceDesk)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp41" value="Expert" name="additional_informationvalues_7_8[]">
                                <label class="custom-control-label" for="ppp41">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp42" value="Proficient" name="additional_informationvalues_7_8[]">
                                <label class="custom-control-label" for="ppp42">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp43" value="Demonstrating" name="additional_informationvalues_7_8[]">
                                <label class="custom-control-label" for="ppp43">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp44" value="Basic" name="additional_informationvalues_7_8[]">
                                <label class="custom-control-label" for="ppp44">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="ppp45" value="None/Low" name="additional_informationvalues_7_8[]">
                                <label class="custom-control-label" for="ppp45">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                  <div class="card-header mb-3" id="headingTwo01">  <h4 class="heading">Excellence Skills</h4></div>
                    <div class="row skill-rating">
          
                      <div class="form-group col-md-12">
                        <div> <span class="num">1. </span><label class="label">Lean </label>
						<span id="subskill_label_value_8_0" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_8[]" value="Lean" />
                          <p><small><em>( Lean is a business methodology that promotes the flow of value to the
                                customer through two guiding tenets: Continuous improvement and respect for people)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio11" value="Expert" name="subskill_value_8_0[]">
                          <label class="custom-control-label" for="Radio11">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio12" value="Proficient" name="subskill_value_8_0[]">
                          <label class="custom-control-label" for="Radio12">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio13" value="Demonstrating" name="subskill_value_8_0[]">
                          <label class="custom-control-label" for="Radio13">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio14" value="Basic" name="subskill_value_8_0[]">
                          <label class="custom-control-label" for="Radio14">Basic
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio15" value="None/Low" name="subskill_value_8_0[]">
                          <label class="custom-control-label" for="Radio15">None/Low
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">2. </span> <label class="label">DFSS</label>
						<span id="subskill_label_value_8_1" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_8[]" value="DFSS" />
                          <p><small><em> ( Design for Six Sigma (DFSS) is a business-process management method related
                                to traditional Six Sigma. )</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio16" value="Expert" name="subskill_value_8_1[]">
                          <label class="custom-control-label" for="Radio16">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio17" value="Proficient" name="subskill_value_8_1[]">
                          <label class="custom-control-label" for="Radio17">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio18" value="Demonstrating" name="subskill_value_8_1[]">
                          <label class="custom-control-label" for="Radio18">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio19" value="Basic" name="subskill_value_8_1[]">
                          <label class="custom-control-label" for="Radio19">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio20" value="None/Low" name="subskill_value_8_1[]">
                          <label class="custom-control-label" for="Radio20">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div><span class="num">3. </span> <label class="label">RCA</label>
						<span id="subskill_label_value_8_2" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_8[]" value="RCA" />
                          <p><small><em> ( Root cause analysis (RCA) is a method of problem solving used for
                                identifying the root causes of faults or problems )</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio21" value="Expert" name="subskill_value_8_2[]">
                          <label class="custom-control-label" for="Radio21">Expert

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio22" value="Proficient" name="subskill_value_8_2[]">
                          <label class="custom-control-label" for="Radio22">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio23" value="Demonstrating" name="subskill_value_8_2[]">
                          <label class="custom-control-label" for="Radio23">Demonstrating
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>

                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio24" value="Basic" name="subskill_value_8_2[]">
                          <label class="custom-control-label" for="Radio24">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio25" value="None/Low" name="subskill_value_8_2[]">
                          <label class="custom-control-label" for="Radio25">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div> <span class="num">4. </span><label class="label">VSM</label>
						<span id="subskill_label_value_8_3" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_8[]" value="VSM" />

                          <p><small><em>(Value-stream mapping is a lean-management method for analyzing the current
                                state and designing a future state for the series of events that take a product or
                                service from its beginning through to the customer with reduced lean wastes as compared
                                to current map.)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio26" value="Expert" name="subskill_value_8_3[]">
                          <label class="custom-control-label" for="Radio26">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio27" value="Proficient" name="subskill_value_8_3[]">
                          <label class="custom-control-label" for="Radio27">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio27" value="Demonstrating" name="subskill_value_8_3[]">
                          <label class="custom-control-label" for="Radio27">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio28" value="Basic" name="subskill_value_8_3[]">
                          <label class="custom-control-label" for="Radio28">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio29" value="None/Low" name="subskill_value_8_3[]">
                          <label class="custom-control-label" for="Radio29">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-12">
                        <div> <span class="num">5. </span><label class="label">PDCA</label>
						<span id="subskill_label_value_8_4" style="color: #d22424; display:none"> ( Required )</span>
                          <input type="hidden" name="sub_skills_8[]" value="PDCA" />
                          <p><small><em>(PDCA (planâ€“doâ€“checkâ€“act or planâ€“doâ€“checkâ€“adjust) is an iterative
                                four-step management method used in business for the control and continual improvement
                                of processes and products. It is also known as the Deming circle/cycle/wheel, the
                                Shewhart cycle, the control circle/cycle, or planâ€“doâ€“studyâ€“act (PDSA).)</em></small></p>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio30" value="Expert" name="subskill_value_8_4[]">
                          <label class="custom-control-label" for="Radio30">Expert
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Fully capable and experienced</li>
                                  <li>Sought for help by other departments</li>
                                  <li> Needs no assistance to complete tasks</li>
                                  <li>Demonstrated ability to lead and train others</li>
                                  <li> Seen as a Subject Matter Expert</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>


                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio31" value="Proficient" name="subskill_value_8_4[]">
                          <label class="custom-control-label" for="Radio31">Proficient
                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Capable and experienced</li>
                                  <li>Demonstrated proficiency</li>
                                  <li> Able to work independently with little help</li>
                                  <li>Will be Expert with more time</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio32" value="Demonstrating" name="subskill_value_8_4[]">
                          <label class="custom-control-label" for="Radio32">Demonstrating

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Able to perform at a basic level</li>
                                  <li>Has some direct experience</li>
                                  <li> Needs help from time to time</li>

                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio33" value="Basic" name="subskill_value_8_4[]">
                          <label class="custom-control-label" for="Radio33">Basic

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>

                                  <li>Limited in ability or knowledge</li>
                                  <li>Cannot perform for critical tasks</li>
                                  <li> Needs significant help from others</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="Radio34" value="None/Low" name="subskill_value_8_4[]">
                          <label class="custom-control-label" for="Radio34">None/Low

                            <div class="card expert-info" style="display:none;">
                              <div class="card-body">
                                <ul>
                                  <li>Unable to perform</li>
                                  <li>Little to no experience</li>
                                </ul>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                    </div>
                    <div class="extra-info">
                      <p>
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapse022" role="button"
                          aria-expanded="false" aria-controls="collapse022">
                          Additional Information
                        </a>

                      </p>
                      <div class="collapse" id="collapse022">
                        <div class="card-body">

                          <div class="row skill-rating">

                            <div class="form-group col-md-12">
                              <div> <span class="num">6. </span><label class="label">5S </label>
                                <input type="hidden" name="additional_information_8[]" value="5S" />

                                <p><small><em>(5S is a system for organizing spaces so work can be performed
                                      efficiently, effectively, and safely. )</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp1" value="Expert" name="additional_informationvalues_8_0[]">
                                <label class="custom-control-label" for="yp1">Expert
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp2" value="Proficient" name="additional_informationvalues_8_0[]">
                                <label class="custom-control-label" for="yp2">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp3" value="Demonstrating" name="additional_informationvalues_8_0[]">
                                <label class="custom-control-label" for="yp3">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp4" value="Basic" name="additional_informationvalues_8_0[]">
                                <label class="custom-control-label" for="yp4">Basic
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp5" value="None/Low" name="additional_informationvalues_8_0[]">
                                <label class="custom-control-label" for="yp5">None/Low
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">7. </span> <label class="label">TPM </label>
                                <input type="hidden" name="additional_information_8[]" value="TPM" />

                                <p><small><em> (Total productive maintenance (TPM) is a method of maintaining and
                                      improving the integrity of production and quality systems through the machines,
                                      equipment, employees and the supporting processes. TPM can be of great value and
                                      its target is to improve core business processes.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp6" value="Expert" name="additional_informationvalues_8_1[]">
                                <label class="custom-control-label" for="yp6">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp7" value="Proficient" name="additional_informationvalues_8_1[]">
                                <label class="custom-control-label" for="yp7">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp8" value="Demonstrating" name="additional_informationvalues_8_1[]">
                                <label class="custom-control-label" for="yp8">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp9" value="Basic" name="additional_informationvalues_8_1[]">
                                <label class="custom-control-label" for="yp9">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp10" value="None/Low" name="additional_informationvalues_8_1[]">
                                <label class="custom-control-label" for="yp10">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">8. </span> <label class="label">Poke Yoke</label>
                                <input type="hidden" name="additional_information_8[]" value="Poke Yoke" />

                                <p><small><em> (A poka-yoke is any mechanism in any process that helps an equipment
                                      operator avoid (yokeru) mistakes (poka). Its purpose is to eliminate product
                                      defects by preventing, correcting, or drawing attention to human errors as they
                                      occur.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp11" value="Expert" name="additional_informationvalues_8_2[]">
                                <label class="custom-control-label" for="yp11">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp12" value="Proficient" name="additional_informationvalues_8_2[]">
                                <label class="custom-control-label" for="yp12">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp13" value="Demonstrating" name="additional_informationvalues_8_2[]">
                                <label class="custom-control-label" for="yp13">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp14" value="Basic" name="additional_informationvalues_8_2[]">
                                <label class="custom-control-label" for="yp14">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp15" value="None/Low" name="additional_informationvalues_8_2[]">
                                <label class="custom-control-label" for="yp15">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>

                            <div class="form-group col-md-12">
                              <div><span class="num">9. </span> <label class="label">Jidoka </label>
                                <input type="hidden" name="additional_information_8[]" value="Jidoka" />

                                <p><small><em> (Jidoka highlights the causes of problems because work stops immediately
                                      when a problem first occurs. )</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp16" value="Expert" name="additional_informationvalues_8_3[]">
                                <label class="custom-control-label" for="yp16">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp17" value="Proficient" name="additional_informationvalues_8_3[]">
                                <label class="custom-control-label" for="yp17">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp18" value="Demonstrating" name="additional_informationvalues_8_3[]">
                                <label class="custom-control-label" for="yp18">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp19" value="Basic" name="additional_informationvalues_8_3[]">
                                <label class="custom-control-label" for="yp19">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp20" value="None/Low" name="additional_informationvalues_8_3[]">
                                <label class="custom-control-label" for="yp20">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">10. </span> <label class="label">JIT </label>

                                <input type="hidden" name="additional_information_8[]" value="JIT" />

                                <p><small><em> (JIT is a methodology aimed primarily at reducing times within
                                      production system as well as response times from suppliers and to customers.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp21" value="Expert" name="additional_informationvalues_8_4[]">
                                <label class="custom-control-label" for="yp21">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp22" value="Proficient" name="additional_informationvalues_8_4[]">
                                <label class="custom-control-label" for="yp22">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp23" value="Demonstrating" name="additional_informationvalues_8_4[]">
                                <label class="custom-control-label" for="yp23">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp24" value="Basic" name="additional_informationvalues_8_4[]">
                                <label class="custom-control-label" for="yp24">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp25" value="None/Low" name="additional_informationvalues_8_4[]">
                                <label class="custom-control-label" for="yp25">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">11. </span> <label class="label">Ishikawa</label>
                                <input type="hidden" name="additional_information_8[]" value="Ishikawa" />

                                <p><small><em> (According to Ishikawa, quality improvement is a continuous process, and
                                      it can always be taken one step further. With his cause and effect diagram (also
                                      called the "Ishikawa" or "fishbone" diagram) this management leader made
                                      significant and specific advancements in quality improvement.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp26" value="Expert" name="additional_informationvalues_8_5[]">
                                <label class="custom-control-label" for="yp26">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp27" value="Proficient" name="additional_informationvalues_8_5[]">
                                <label class="custom-control-label" for="yp27">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp28" value="Demonstrating" name="additional_informationvalues_8_5[]">
                                <label class="custom-control-label" for="yp28">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp29" value="Basic" name="additional_informationvalues_8_5[]">
                                <label class="custom-control-label" for="yp29">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp30" value="None/Low" name="additional_informationvalues_8_5[]">
                                <label class="custom-control-label" for="yp30">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">12. </span> <label class="label">Heijunka </label>
                                <input type="hidden" name="additional_information_8[]" value="Heijunka" />

                                <p><small><em> (Heijunka (pronounced hi-JUNE-kuh) is a Japanese word that means
                                      â€œleveling.â€ When implemented correctly, heijunka elegantly â€“ and without
                                      haste â€“ helps organizations meet demand while reducing wastes in production and
                                      interpersonal processes.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp31" value="Expert" name="additional_informationvalues_8_6[]">
                                <label class="custom-control-label" for="yp31">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp32" value="Proficient" name="additional_informationvalues_8_6[]">
                                <label class="custom-control-label" for="yp32">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp33" value="Demonstrating" name="additional_informationvalues_8_6[]">
                                <label class="custom-control-label" for="yp33">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp33" value="Basic" name="additional_informationvalues_8_6[]">
                                <label class="custom-control-label" for="yp33">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp34" value="None/Low" name="additional_informationvalues_8_6[]">
                                <label class="custom-control-label" for="yp34">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">13. </span> <label class="label">Kanban</label>
                                <input type="hidden" name="additional_information_8[]" value="Kanban" />
                                <p><small><em> (Kanban is a visual signal that's used to trigger an action. )</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp35" value="Expert" name="additional_informationvalues_8_7[]">
                                <label class="custom-control-label" for="yp35">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp36" value="Proficient" name="additional_informationvalues_8_7[]">
                                <label class="custom-control-label" for="yp36">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp37" value="Demonstrating" name="additional_informationvalues_8_7[]">
                                <label class="custom-control-label" for="yp37">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp38" value="Basic" name="additional_informationvalues_8_7[]">
                                <label class="custom-control-label" for="yp38">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp39" value="None/Low" name="additional_informationvalues_8_7[]">
                                <label class="custom-control-label" for="yp39">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">14. </span> <label class="label">A3 </label>
                                <input type="hidden" name="additional_information_8[]" value="A3" />
                                <p><small><em> (A3 problem solving is a structured problem-solving and
                                      continuous-improvement approach, first employed at Toyota and typically used by
                                      lean manufacturing practitioners. It provides a simple and strict procedure that
                                      guides problem solving by workers.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp40" value="Expert" name="additional_informationvalues_8_8[]">
                                <label class="custom-control-label" for="yp40">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp41" value="Proficient" name="additional_informationvalues_8_8[]">
                                <label class="custom-control-label" for="yp41">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp42" value="Demonstrating" name="additional_informationvalues_8_8[]">
                                <label class="custom-control-label" for="yp42">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp44" value="Basic" name="additional_informationvalues_8_8[]">
                                <label class="custom-control-label" for="yp44">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp45" value="None/Low" name="additional_informationvalues_8_8[]">
                                <label class="custom-control-label" for="yp45">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <div><span class="num">15. </span> <label class="label">QFD </label>

                                <input type="hidden" name="additional_information_8[]" value="QFD" />

                                <p><small><em> (Quality Function Deployment (QFD) is a structured approach to defining
                                      customer needs or requirements and translating them into specific plans to
                                      produce products to meet those needs. The â€œvoice of the customerâ€ is the term
                                      to describe these stated and unstated customer needs or requirements.)</em></small></p>
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp46" value="Expert" name="additional_informationvalues_8_9[]">
                                <label class="custom-control-label" for="yp46">Expert

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Fully capable and experienced</li>
                                        <li>Sought for help by other departments</li>
                                        <li> Needs no assistance to complete tasks</li>
                                        <li>Demonstrated ability to lead and train others</li>
                                        <li> Seen as a Subject Matter Expert</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>


                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp47" value="Proficient" name="additional_informationvalues_8_9[]">
                                <label class="custom-control-label" for="yp47">Proficient
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Capable and experienced</li>
                                        <li>Demonstrated proficiency</li>
                                        <li> Able to work independently with little help</li>
                                        <li>Will be Expert with more time</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp48" value="Demonstrating" name="additional_informationvalues_8_9[]">
                                <label class="custom-control-label" for="yp48">Demonstrating
                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Able to perform at a basic level</li>
                                        <li>Has some direct experience</li>
                                        <li> Needs help from time to time</li>

                                      </ul>
                                    </div>
                                  </div>

                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp49" value="Basic" name="additional_informationvalues_8_9[]">
                                <label class="custom-control-label" for="yp49">Basic

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>

                                        <li>Limited in ability or knowledge</li>
                                        <li>Cannot perform for critical tasks</li>
                                        <li> Needs significant help from others</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="yp50" value="None/Low" name="additional_informationvalues_8_9[]">
                                <label class="custom-control-label" for="yp50">None/Low

                                  <div class="card expert-info" style="display:none;">
                                    <div class="card-body">
                                      <ul>
                                        <li>Unable to perform</li>
                                        <li>Little to no experience</li>
                                      </ul>
                                    </div>
                                  </div>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
                  </div>
				  
                </div>
						<!-- dummy test -->
				<div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <a   data-toggle="collapse" data-target=""
                      aria-expanded="false" aria-controls="collapseTwo">
                    
                      <h4 class="heading">  Certifications  </h4>


                    </a>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse cc show" aria-labelledby="headingTwo" data-parent="">
                  <div class="card-body">
                  
					
					<!-- for single container-->	
					 <div class="row">
					  <div class="col-md-2">
                      <div class="form-group">
                       

                         <input type="checkbox" name="certification[]" value="ITIL"> ITIL<br>
                         <input type="checkbox" name="certification[]" value="RESELIA"> RESELIA<br>
                         <input type="checkbox" name="certification[]" value="Prince2"> Prince2<br>
                         <input type="checkbox" name="certification[]" value="AgileSHIFT"> AgileSHIFT<br>
                        </div>
                      </div>
					  	  <div class="col-md-2">
                      <div class="form-group">
                       

                         <input type="checkbox" name="certification[]" value="MSP"> MSP<br>
                         <input type="checkbox" name="certification[]" value="M_o_R"> M_o_R<br>
                         <input type="checkbox" name="certification[]" value="P30"> P30<br>
                         <input type="checkbox" name="certification[]" value="MoP"> MoP<br>
                        </div>
                      </div>	  <div class="col-md-2">
                      <div class="form-group">
                       

                         <input type="checkbox" name="certification[]" value="MoV"> MoV<br>
                         <input type="checkbox" name="certification[]" value="PMP"> PMP<br>
                         <input type="checkbox" name="certification[]" value="PgMP"> PgMP<br>
                         <input type="checkbox" name="certification[]" value="PfMP"> PfMP<br>
                        </div>
                      </div>
					  	  <div class="col-md-2">
                      <div class="form-group">
                       

                         <input type="checkbox" name="certification[]" value="CAPM"> CAPM<br>
                         <input type="checkbox" name="certification[]" value="Six Sigma"> Six Sigma<br>
                         <input type="checkbox" name="certification[]" value="CQPA"> CQPA<br>
                         <input type="checkbox" name="certification[]" value="CMQ"> CMQ<br>
                        </div>
                      </div>
					  	    	  <div class="col-md-2">
                      <div class="form-group">
                       

                         <input type="checkbox" name="certification[]" value="CMOE"> CMOE<br>
                         <input type="checkbox" name="certification[]" value="Cisco"> Cisco<br>
                         <input type="checkbox" name="certification[]" value="Red Hat"> Red Hat<br>
                         <input type="checkbox" name="certification[]" value="AWS"> AWS<br>
                        </div>
                      </div>
					    	  <div class="col-md-2">
                      <div class="form-group">
                       

                         <input type="checkbox" name="certification[]" value="Microsoft"> Microsoft<br>
                         <input type="checkbox" name="certification[]" value="SAP"> SAP<br>
                         <input type="checkbox" name="certification[]" value="Others"> Others<br>

                        </div>
                      </div>
					  </div>
					<!-- for single container closed-->			
                     

                      
                 
                 
                  </div>
                </div>
				
              </div>
						<!-- dummy test closed-->
              </div>

              <div class="text-center mt-4">

                <input type="hidden" name="sub" value="submit" />
                <button class="btn btn-success" id="sub" onclick="test()" type="button">Submit</button>

              </div>
            </div>
        </form>
      </div>
    </div>
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
    /* if(jQuery){
console.log('yes');
} */




	 $('.finance_skills').on('change', function(){ // on change of state
		if(this.checked) // if changed state is "CHECKED"
			{
				$("#collapseTwo01").addClass("show");
			}else{
				$("#collapseTwo01").removeClass("show");
			}	
	})
	$('.travel_Skills').on('change', function(){ // on change of state
		if(this.checked) // if changed state is "CHECKED"
			{
				$("#collapseTwo2").addClass("show");
			}else{
				$("#collapseTwo2").removeClass("show");
			}	
	})
	
	$('.technology_skills').on('change', function(){ // on change of state
		if(this.checked) // if changed state is "CHECKED"
			{
				$("#collapseTwo3").addClass("show");
			}else{
				$("#collapseTwo3").removeClass("show");
			}	
	})
	$('.bfsi_skills').on('change', function(){ // on change of state
		if(this.checked) // if changed state is "CHECKED"
			{
				$("#collapseTwo4").addClass("show");
			}else{
				$("#collapseTwo4").removeClass("show");
			}	
	})
	$('.utility_skills').on('change', function(){ // on change of state
		if(this.checked) // if changed state is "CHECKED"
			{
				$("#collapseTwo5").addClass("show");
			}else{
				$("#collapseTwo5").removeClass("show");
			}	
	})
	$('.itms_skills').on('change', function(){ // on change of state
		if(this.checked) // if changed state is "CHECKED"
			{
				$("#collapseTw5").addClass("show");
			}else{
				$("#collapseTw5").removeClass("show");
			}	
	})
	$('.excellence_skills').on('change', function(){ // on change of state
		if(this.checked) // if changed state is "CHECKED"
			{
				$("#collapse5").addClass("show");
			}else{
				$("#collapse5").removeClass("show");
			}	
	})
	
	
    function test() {
      var formsubmit = false;
	  
	 
	  
      var emp_name = $("#emp_name").val();
      var len = emp_name.length;
      if (len > 0) {
        $('#basic_label_1').hide();
      } else {
        $('#basic_label_1').show();
        return false;
      }

      var emp_id = $("#emp_id").val();

	  var input = emp_id;
		var regex = new RegExp(/^[a-z]{2}[0-9]{5}$/i);
		//console.log(regex.test(input));
		emp_id_required = regex.test(input);
		if(emp_id_required){
			$('#basic_label_2').hide();
		}else{
			$('#basic_label_2').show();
			return false;
		}
/* 	emp id required closed */

     /*  var lenemp = emp_id.length;
      if (lenemp > 0) {
        $('#basic_label_2').hide();
      } else {
        $('#basic_label_2').show();
        return false;
      } */

      var emp_designation = $("#emp_designation").val();
      var lendes = emp_designation.length;
      if (lendes > 0) {
        $('#basic_label_3').hide();
      } else {
        $('#basic_label_3').show();
        return false;
      }
		
		
		
		
      var professional_skills = [];

      $.each($("input[name='subskill_value_0_0[]']:checked"), function () {
        professional_skills.push($(this).val());
      });
      var checklen = professional_skills.join(", ");

      var prof_lng = checklen.length;

      if (prof_lng > 0) {

        formsubmit = true;




        $('#sub_skills_label_0').hide();

      } else {
        formsubmit = false;


        $('#sub_skills_label_0').show();
      }

      //Report Writing

      var rwriting = [];

      $.each($("input[name='subskill_value_0_1[]']:checked"), function () {
        rwriting.push($(this).val());
      });
      var checklen = rwriting.join(", ");

      var rwriting_lng = checklen.length;

      if (rwriting_lng > 0) {

        $('#sub_skills_label_1').hide();
      } else {

        $('#sub_skills_label_1').show();
      }

      //planning
      var planning = [];

      $.each($("input[name='subskill_value_0_2[]']:checked"), function () {
        planning.push($(this).val());
      });
      var checklen = planning.join(", ");

      var planning_lng = checklen.length;

      if (planning_lng > 0) {

        $('#sub_skills_label_2').hide();
      } else {

        $('#sub_skills_label_2').show();
      }

      // MAking Presentation
      var making_p = [];

      $.each($("input[name='subskill_value_0_3[]']:checked"), function () {
        making_p.push($(this).val());
      });
      var checklen = making_p.join(", ");

      var making_p_lng = checklen.length;

      if (making_p_lng > 0) {

        $('#sub_skills_label_3').hide();
      } else {

        $('#sub_skills_label_3').show();
      }


      // for common functions

      if (prof_lng > 0 && rwriting_lng > 0 && planning_lng > 0 && making_p_lng > 0) {
		formsubmit = true;
	   /*  
        $(".bb").removeClass("show");
        $("#headingTwo").css("background-color", "#bb2222"); */
        $('.alert-warning').hide();
      } else {
		formsubmit = false;
	   /*  
        $(".bb").addClass("show");
        $("#headingTwo").css("background-color", "#bb2222"); */
        $('.alert-warning').show();
        return false;
      }

      //For MS EXCEl

      var ms_excel = [];

      $.each($("input[name='subskill_value_1_0[]']:checked"), function () {
        ms_excel.push($(this).val());
      });
      var checklen = ms_excel.join(", ");

      var ms_excel_lng = checklen.length;

      if (ms_excel_lng > 0) {

        $('#sub_skills_label_4').hide();
      } else {

        $('#sub_skills_label_4').show();
      }

      // MS WORD
      var ms_word = [];

      $.each($("input[name='subskill_value_1_1[]']:checked"), function () {
        ms_word.push($(this).val());
      });
      var checklen = ms_word.join(", ");

      var ms_word_lng = checklen.length;

      if (ms_word_lng > 0) {

        $('#sub_skills_label_5').hide();
      } else {

        $('#sub_skills_label_5').show();
      }

      //MS PowerPoint
      var ms_powerpoint = [];

      $.each($("input[name='subskill_value_1_2[]']:checked"), function () {
        ms_powerpoint.push($(this).val());
      });
      var checklen = ms_powerpoint.join(", ");

      var ms_powerpoint_lng = checklen.length;

      if (ms_powerpoint_lng > 0) {

        $('#sub_skills_label_6').hide();
      } else {

        $('#sub_skills_label_6').show();
      }

      // common funtions
      if (ms_excel_lng > 0 && ms_word_lng > 0 && ms_powerpoint_lng > 0) {
		formsubmit = true;
       /*  
        $(".cc").removeClass("show");
        $("#headingThree").css("background-color", "#bb2222"); */
        $('.alert-warning').hide();

      } else {
        formsubmit = false;
		/* 
        $(".cc").addClass("show");
        $("#headingThree").css("background-color", "#bb2222"); */
        $('.alert-warning').show();
        return false;
      }
	
		 /* 	Travel Skill start */		
		travel_skills_required = 0;
	if($('input[name="travel_Skills_name"]').is(':checked'))
	{
			//alert("yes travel_Skills_name");
			travel_skills_arr =['subskill_value_3_0[]','subskill_value_3_1[]','subskill_value_3_2[]'];
			
			$.each(travel_skills_arr, function(index, value) { 
			
			var travelskills_labelval = value.replace("subskill", "subskill_label");
			travelskills_labelval = travelskills_labelval.toString();
			travelskills_labelval = travelskills_labelval.slice(0,-2);

				if($("input[name='"+value+"']").is(':checked'))
				{
					// make it required hide
					$("#"+travelskills_labelval).hide();

				}else{
					++travel_skills_required;
					// make it required show
					$("#"+travelskills_labelval).show();
				
				} 			
			}); 
	}else{
		// make it unchecked
		// $('input[name="subskill_value_3_0[]"]').prop("checked", false); 
		travel_skills_arr =['subskill_value_3_0[]','subskill_value_3_1[]','subskill_value_3_2[]'];
			
			$.each(travel_skills_arr, function(index, value) { 
				$("input[name='"+value+"']").prop("checked", false);
				// remove required label
				var travelskills_labelval = value.replace("subskill", "subskill_label");
				travelskills_labelval = travelskills_labelval.toString();
				travelskills_labelval = travelskills_labelval.slice(0,-2);
				$("#"+travelskills_labelval).hide();
				
			}); 
	}
	

	// now check all required fields , if any required filed false then make it return false
/* 	Travel Skill start closed*/	
	
	/* 	Finance Skills start */		
	finance_skills_required = 0;
	if($('input[name="finance_skills_name"]').is(':checked'))
	{
			finance_skills_arr =['subskill_value_2_0[]','subskill_value_2_1[]','subskill_value_2_2[]','subskill_value_2_3[]'];
			$.each(finance_skills_arr, function(index, value) { 
			
			var financeskills_labelval = value.replace("subskill", "subskill_label");
			financeskills_labelval = financeskills_labelval.toString();
			financeskills_labelval = financeskills_labelval.slice(0,-2);

				if($("input[name='"+value+"']").is(':checked'))
				{
					// make it required hide
					$("#"+financeskills_labelval).hide();

				}else{
					++finance_skills_required;
					// make it required show
					$("#"+financeskills_labelval).show();
				
				} 			
			}); 
	}else{
		// make it unchecked
		// $('input[name="subskill_value_3_0[]"]').prop("checked", false); 
		finance_skills_arr =['subskill_value_2_0[]','subskill_value_2_1[]','subskill_value_2_2[]','subskill_value_2_3[]'];
			$.each(finance_skills_arr, function(index, value) { 
				$("input[name='"+value+"']").prop("checked", false);
				// remove required label
				var financeskills_labelval = value.replace("subskill", "subskill_label");
				financeskills_labelval = financeskills_labelval.toString();
				financeskills_labelval = financeskills_labelval.slice(0,-2);
				$("#"+financeskills_labelval).hide();
			}); 
	}

/* 	Finance Skills start closed*/
	/* 	Technology Skills start */		
		technology_skills_required = 0;
	if($('input[name="technology_skills_name"]').is(':checked'))
	{
			technology_skills_arr =['subskill_value_4_0[]','subskill_value_4_1[]','subskill_value_4_2[]','subskill_value_4_3[]'];
			
			$.each(technology_skills_arr, function(index, value) { 
			
			var technologyskills_labelval = value.replace("subskill", "subskill_label");
			technologyskills_labelval = technologyskills_labelval.toString();
			technologyskills_labelval = technologyskills_labelval.slice(0,-2);

				if($("input[name='"+value+"']").is(':checked'))
				{
					// make it required hide
					$("#"+technologyskills_labelval).hide();

				}else{
					++technology_skills_required;
					// make it required show
					$("#"+technologyskills_labelval).show();
				
				} 			
			}); 
	}else{
		// make it unchecked
		technology_skills_arr =['subskill_value_4_0[]','subskill_value_4_1[]','subskill_value_4_2[]','subskill_value_4_3[]'];
			
			$.each(technology_skills_arr, function(index, value) { 
				$("input[name='"+value+"']").prop("checked", false);
				// remove required label
				var technologyskills_labelval = value.replace("subskill", "subskill_label");
				technologyskills_labelval = technologyskills_labelval.toString();
				technologyskills_labelval = technologyskills_labelval.slice(0,-2);
				$("#"+technologyskills_labelval).hide();
				
			}); 
	}
/* 	Technology Skills  closed*/	

	/* 	BFSI Skills start */		
		bfsi_skills_required = 0;
	if($('input[name="bfsi_skills_name"]').is(':checked'))
	{
			bfsi_skills_arr =['subskill_value_5_0[]','subskill_value_5_1[]','subskill_value_5_2[]'];
			
			$.each(bfsi_skills_arr, function(index, value) { 
			
			var bfsiskills_labelval = value.replace("subskill", "subskill_label");
			bfsiskills_labelval = bfsiskills_labelval.toString();
			bfsiskills_labelval = bfsiskills_labelval.slice(0,-2);

				if($("input[name='"+value+"']").is(':checked'))
				{
					// make it required hide
					$("#"+bfsiskills_labelval).hide();

				}else{
					++bfsi_skills_required;
					// make it required show
					$("#"+bfsiskills_labelval).show();
				
				} 			
			}); 
	}else{
		// make it unchecked
		bfsi_skills_arr =['subskill_value_5_0[]','subskill_value_5_1[]','subskill_value_5_2[]'];
			
			$.each(bfsi_skills_arr, function(index, value) { 
				$("input[name='"+value+"']").prop("checked", false);
				// remove required label
				var bfsiskills_labelval = value.replace("subskill", "subskill_label");
				bfsiskills_labelval = bfsiskills_labelval.toString();
				bfsiskills_labelval = bfsiskills_labelval.slice(0,-2);
				$("#"+bfsiskills_labelval).hide();
				
			}); 
	}
/* 	BFSI Skills  closed*/	
		/* 	Utility Skills start */		
		utility_skills_required = 0;
	if($('input[name="utility_skills_name"]').is(':checked'))
	{
			utility_skills_arr =['subskill_value_6_0[]','subskill_value_6_1[]','subskill_value_6_2[]'];
			
			$.each(utility_skills_arr, function(index, value) { 
			
			var utilityskills_labelval = value.replace("subskill", "subskill_label");
			utilityskills_labelval = utilityskills_labelval.toString();
			utilityskills_labelval = utilityskills_labelval.slice(0,-2);

				if($("input[name='"+value+"']").is(':checked'))
				{
					// make it required hide
					$("#"+utilityskills_labelval).hide();

				}else{
					++utility_skills_required;
					// make it required show
					$("#"+utilityskills_labelval).show();
				
				} 			
			}); 
	}else{
		// make it unchecked
		utility_skills_arr =['subskill_value_6_0[]','subskill_value_6_1[]','subskill_value_6_2[]'];
			
			$.each(utility_skills_arr, function(index, value) { 
				$("input[name='"+value+"']").prop("checked", false);
				// remove required label
				var utilityskills_labelval = value.replace("subskill", "subskill_label");
				utilityskills_labelval = utilityskills_labelval.toString();
				utilityskills_labelval = utilityskills_labelval.slice(0,-2);
				$("#"+utilityskills_labelval).hide();
				
			}); 
	}
/* 	Utility Skills  closed*/	
	/* 	ITSM Skills start */		
		itms_skills_required = 0;
	if($('input[name="itms_skills_name"]').is(':checked'))
	{
			itms_skills_arr =['subskill_value_7_0[]','subskill_value_7_1[]','subskill_value_7_2[]'];
			
			$.each(itms_skills_arr, function(index, value) { 
			
			var itmsskills_labelval = value.replace("subskill", "subskill_label");
			itmsskills_labelval = itmsskills_labelval.toString();
			itmsskills_labelval = itmsskills_labelval.slice(0,-2);

				if($("input[name='"+value+"']").is(':checked'))
				{
					// make it required hide
					$("#"+itmsskills_labelval).hide();

				}else{
					++itms_skills_required;
					// make it required show
					$("#"+itmsskills_labelval).show();
				
				} 			
			}); 
	}else{
		// make it unchecked
			itms_skills_arr =['subskill_value_7_0[]','subskill_value_7_1[]','subskill_value_7_2[]'];
			
			$.each(itms_skills_arr, function(index, value) { 
				$("input[name='"+value+"']").prop("checked", false);
				// remove required label
				var itmsskills_labelval = value.replace("subskill", "subskill_label");
				itmsskills_labelval = itmsskills_labelval.toString();
				itmsskills_labelval = itmsskills_labelval.slice(0,-2);
				$("#"+itmsskills_labelval).hide();
				
			}); 
	}
/* 	ITSM Skills  closed*/

	/* 	Excellence Skills start */		
		excellence_skills_required = 0;
	if($('input[name="excellence_skills_name"]').is(':checked'))
	{
			excellence_skills_arr =['subskill_value_8_0[]','subskill_value_8_1[]','subskill_value_8_2[]','subskill_value_8_3[]','subskill_value_8_4[]'];
			
			$.each(excellence_skills_arr, function(index, value) { 
			
			var excellenceskills_labelval = value.replace("subskill", "subskill_label");
			excellenceskills_labelval = excellenceskills_labelval.toString();
			excellenceskills_labelval = excellenceskills_labelval.slice(0,-2);

				if($("input[name='"+value+"']").is(':checked'))
				{
					// make it required hide
					$("#"+excellenceskills_labelval).hide();

				}else{
					++excellence_skills_required;
					// make it required show
					$("#"+excellenceskills_labelval).show();
				
				} 			
			}); 
	}else{
		// make it unchecked
			excellence_skills_arr =['subskill_value_8_0[]','subskill_value_8_1[]','subskill_value_8_2[]','subskill_value_8_3[]','subskill_value_8_4[]'];
			
			$.each(excellence_skills_arr, function(index, value) { 
				$("input[name='"+value+"']").prop("checked", false);
				// remove required label
				var excellenceskills_labelval = value.replace("subskill", "subskill_label");
				excellenceskills_labelval = excellenceskills_labelval.toString();
				excellenceskills_labelval = excellenceskills_labelval.slice(0,-2);
				$("#"+excellenceskills_labelval).hide();
				
			}); 
	}
/* 	Excellence Skills  closed*/	

	 if(travel_skills_required!=0 || finance_skills_required!=0 || technology_skills_required!=0 || bfsi_skills_required!=0 || itms_skills_required!=0 || excellence_skills_required!=0){
				return false;
			} 
	
      //return false;  // for test only , remove it for further execution
/* 	Skill required start closed*/	

      if (formsubmit) {
        // form submit
        $("#form1").submit();
      }



    }
  </script>



</body>

</html>