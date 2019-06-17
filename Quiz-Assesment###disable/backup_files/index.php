<?php 
$con = mysqli_connect("localhost","root","","employees_info") or die(mysqli_error());
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d h:i:s');
if(isset($_POST['sub'])){
	
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	
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
		
		$query = mysqli_query($con,"INSERT into emp_basic_info set emp_name='".$emp_name."',emp_id='".$emp_id."',emp_designation='".$emp_designation."',emp_location='".$emp_location."' ");
	}
	
	if($query){
		$get_last_id = $con->insert_id;
		
	
	
		if(!empty($_POST['skills'])){
			
				for($i=0;$i<count($_POST['skills']);$i++){
					
					if(isset($_POST['skills'][$i]) && $_POST['skills'][$i]!=''){
						$skill_name = $_POST['skills'][$i];
						
						/*********** for Additional Information ******/
						
						if(isset($_POST["additional_information_$i"])){
							echo "additional_information count---".count($_POST["additional_information_$i"]);
							
							for($r=0;$r<count($_POST["additional_information_$i"]);$r++){
								
								echo "</br>additional_information_group--".$_POST["additional_information_$i"][$r];
								$additional_information_name= $_POST["additional_information_$i"][$r];
								//additional_informationvalues_0_1
								if(isset($_POST["additional_informationvalues_$i"."_$r"])){
									if(isset($_POST["additional_informationvalues_$i"."_$r"][0])){
										echo "</br>additional_informationvalues testpp----".$_POST["additional_informationvalues_$i"."_$r"][0];
										
										$additional_informationvalue=$_POST["additional_informationvalues_$i"."_$r"][0];
										
										$query_add_information = mysqli_query($con,"INSERT into emp_additional_information set id='".$get_last_id."', skill_name='".$skill_name."',add_information_name='".$additional_information_name."',add_information_value='".$_POST["additional_informationvalues_$i"."_$r"][0]."',created_date='".$date."' ");
		
												
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
  <header>
      <div class="container">
        <a href="index.html" class="logo"><img src="images/logo.png" alt=""/></a>
        </div> 
  </header>
<div class="container">
  <div class="form-wrp">
<form method="POST">
    <div class="section">
        <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Basic Information
                  </button>
                </h5>
              </div>
          
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                                <label>Name</label>
                                <input type="text" name="emp_name" class="form-control"  placeholder="">
                              </div>
                              <div class="form-group col-md-3">
                                    <label>Employee Id</label>
                                    <input type="text" name="emp_id" class="form-control"  placeholder="">
                                  </div>
                                  <div class="form-group col-md-3">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" name="emp_designation" placeholder="">
                                      </div>
                                      <div class="form-group col-md-3">
                                          <label>Location</label>
                                          <select class="form-control" name="emp_location">
                                            <option value="gurgaon">Gurgaon</option>
                                            <option value="bengaluru">Bengaluru</option>
                                            <option value="noida">Noida</option>
                                          </select>
                                        </div>
               
                </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Professional Skills
					  <input type="hidden" name="skills[]" value="Professional Skills"/>
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row skill-rating">
                              <div class="form-group col-md-12">
                                 <div> <span class="num">1. </span><label class="label">Communication</label>
								 
								 
								<input type="hidden" name="sub_skills_0[]" value="Communication"/>	
                                <p><small><em>(The rating of this parameter is based on how strong are your communication skills)</em></small></p>
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
                                    <div><span class="num">2. </span> <label class="label">Report Writing  </label>
									<input type="hidden" name="sub_skills_0[]" value="Report Writing"/>
                                    
									<p><small><em> (The rating of this parameter is based on how well can you document an activity/task)</em></small></p>
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
                                           <input type="radio" class="custom-control-input" id="customRadio03" value="demonstrating" name="subskill_value_0_1[]">
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
									  <input type="hidden" name="sub_skills_0[]" value="Planning"/>
                                        <p><small><em>(The rating of this parameter is based on how well do you plan activities/ tasks)</em></small></p>
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
                                             <input type="radio" class="custom-control-input" id="customRadio33" value="demonstrating" name="subskill_value_0_2[]">
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
										<input type="hidden" name="sub_skills_0[]" value="Making Presentation"/>
                                          <p><small><em>(The rating of this parameter is based on how strong are your presentation skills)</em></small></p>
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
                                               <input type="radio" class="custom-control-input" id="customRadio003" value="demonstrating" name="subskill_value_0_3[]">
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
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Additional Information
                        </a>
                   
                      </p>
                      <div class="collapse" id="collapseExample">
                        <div class="card-body">
                          
                                <div class="row skill-rating">
                         
                                          <div class="form-group col-md-12">
                                             <div> <span class="num">1. </span><label class="label">ISO/IEC 9001  </label>
											 <input type="hidden" name="additional_information_0[]" value="ISO/IEC 9001"/>
											 
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
                                                    <input type="radio" class="custom-control-input" id="cuscvd3" value="Demonstrating" name="additional_informationvalues_0_0">
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
                                                <div><span class="num">2. </span> <label class="label">Data Analysis</label>
												 <input type="hidden" name="additional_information_0[]" value="Data Analysis"/>
                                                <p><small><em> (The rating of this parameter is based on how well you can depict and analyse data sets)</em></small></p>
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
                                                       <input type="radio" class="custom-control-input" id="cuscvd8" value="Demonstrating" name="additional_informationvalues_0_1">
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
                                    
                            
                            </div>                                       </div>
                      </div>
                </div>
              </div>
              </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                        Basic Software Skills
						<input type="hidden" name="skills[]" value="Basic Software Skills"/>
						
                    </button>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                      <div class="row skill-rating">
               
                                <div class="form-group col-md-12">
                                   <div> <span class="num">1. </span><label class="label">MS Excel  </label>
								   <input type="hidden" name="sub_skills_1[]" value="MS Excel"/>
								   
								   
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
                                      <div><span class="num">2. </span> <label class="label">MS Word  </label>
									    <input type="hidden" name="sub_skills_1[]" value="MS Word"/>
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
										  <input type="hidden" name="sub_skills_1[]" value="MS PowerPoint"/>
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
                                              <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                                                  Additional Information
                                              </a>
                                         
                                            </p>
                                            <div class="collapse" id="collapseExample1">
                                              <div class="card-body">
                                                
                                                      <div class="row skill-rating">
                                               
                                                                <div class="form-group col-md-12">
                                                                   <div> <span class="num">1. </span><label class="label">MS Project  </label>
																    <input type="hidden" name="additional_information_1[]" value="MS Project"/>
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
                                                                          <input type="radio" class="custom-control-input" id="zzssaa3" value="Demonstrating" name="additional_informationvalues_1_0[]">
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
                                                                      <div><span class="num">2. </span> <label class="label">Sharepoint Programming</label>
																	  <input type="hidden" name="additional_information_1[]" value="Sharepoint Programming"/>
                                                                      <p><small><em> (The rating of this parameter is based on how comfortable are you with MS Sharepoint and also, designing a sharepoint space)</em></small></p>
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
                                                                           <input type="radio" class="custom-control-input" id="custom0244" value="Proficient" name="additional_informationvalues_1_1[]">
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
                                                                             <input type="radio" class="custom-control-input" id="custom0245" value="Demonstrating" name="additional_informationvalues_1_1[]">
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
                                                                        <div><span class="num">3. </span> <label class="label">MiniTab</label>
																		 <input type="hidden" name="additional_information_1[]" value="MiniTab"/>

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
                                                                             <input type="radio" class="custom-control-input" id="custom0249" value="Proficient" name="additional_informationvalues_1_2[]">
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
                                                                               <input type="radio" class="custom-control-input" id="custom0250" value="Demonstrating" name="additional_informationvalues_1_2[]">
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
                                                          
                                                  
                                                  </div>                                       </div>
                                            </div>
                                      </div>
                  </div>                </div>
                </div>
              </div>
          </div>
          <div class="card">
              <div class="card-header" id="headingTwo01">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo01" aria-expanded="false" aria-controls="collapseTwo01">
                      Finance Skills
                  </button>
				  <input type="hidden" name="skills[]" value="Finance Skills"/>
                </h5>
              </div>
              <div id="collapseTwo01" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row skill-rating">
             
                              <div class="form-group col-md-12">
                                 <div> <span class="num">1. </span><label class="label">Calculating abilities  </label>
								 <input type="hidden" name="sub_skills_2[]" value="Calculating abilities"/>
                                <p><small><em>(The rating of this paramter is based on how strong your calculation abilities are)</em></small></p>
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
									 <input type="hidden" name="sub_skills_2[]" value="Finance Basics"/>
                                    <p><small><em> (The rating of this parameter is based on knowledge of basic accounting  like ledgers, telling, suspense accounting etc.)</em></small></p>
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
									   <input type="hidden" name="sub_skills_2[]" value="Financial Reporting"/>
                                        <p><small><em>(The rating of this parameter is based on how well you can document financial insights like forecasting, break evens etc.)</em></small></p>
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
                                             <input type="radio" class="custom-control-input" id="customRadio33aaa" value="Demonstrating" name="subskill_value_2_2[]">
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
										<input type="hidden" name="sub_skills_2[]" value="Accounts Payable"/>
                                          <p><small><em>(The rating of this paramter is based on knowledge of AP tools like AS400, JD Edwards etc.)</em></small></p>
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
                        <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                           Additional Information
                        </a>
                   
                      </p>
                      <div class="collapse" id="collapseExample2">
                        <div class="card-body">
                          
                                <div class="row skill-rating">
                         
                                          <div class="form-group col-md-12">
                                             <div> <span class="num">6. </span><label class="label">SAP  </label>
											 <input type="hidden" name="additional_information_2[]" value="SAP"/>
                                            <p><small><em>(The rating of this parameter is based on knowledge & hands on experience with SAP modules including SA P FICO, HRM, SD etc)</em></small></p>
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
                                                <div><span class="num">7. </span> <label class="label">Oracle </label>
													 <input type="hidden" name="additional_information_2[]" value="Oracle"/>										
                                                <p><small><em> (The rating of this paramter is based on knowledge of Oracle suites like Advanced pricing, marketing, proposals etc)</em></small></p>
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
                                                  <div><span class="num">8. </span> <label class="label">QuickBooks </label>
												  <input type="hidden" name="additional_information_2[]" value="QuickBooks"/>
												  
                                                  <p><small><em> (The rating of this parameter is based on knowledge & hands on experience with quickbooks)</em></small></p>
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
                                                    <div><span class="num">9. </span> <label class="label">PayPal </label>
													<input type="hidden" name="additional_information_2[]" value="PayPal"/>
                                                    <p><small><em> (The rating of this parameter is based on knowledge & hands on experience with PayPal gateway)</em></small></p>
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
                                                      <div><span class="num">10. </span> <label class="label">Apple Pay </label>
													  <input type="hidden" name="additional_information_2[]" value="Apple Pay"/>
                                                      <p><small><em> (The rating of this parameter is based on knowledge & hands on experience with Apple Pay gateway)</em></small></p>
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
														<input type="hidden" name="additional_information_2[]" value="Commercial Acumen"/>
                                                        <p><small><em> (The rating of this parameter is based on keenness and quickness in understanding and dealing with a "business situation" in a manner that is likely to lead to a good outcome)</em></small></p>
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
                                    
                            
                            </div>                                       </div>
                      </div>
                </div>
              </div>
              </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo2">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                        Travel Skills
                    </button>
					<input type="hidden" name="skills[]" value="Travel Skills"/>
                  </h5>
                </div>
                <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                      <div class="row skill-rating">
               
                                <div class="form-group col-md-12">
                                   <div> <span class="num">1. </span><label class="label">Amadeus  </label>
								   <input type="hidden" name="sub_skills_3[]" value="Amadeus"/>
								   
                                  <p><small><em>(The rating of this parameter is based on knowledge and hands on experience with amadeus as a tickting and travel organising tool)</em></small></p>
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
                                      <div><span class="num">2. </span> <label class="label">Geographical Knowledge  </label>
									  <input type="hidden" name="sub_skills_3[]" value="Geographical Knowledge"/>
									  
                                      <p><small><em> (The rating of this parameter is based on knowledge about regions, locations, time zones etc)</em></small></p>
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
										 <input type="hidden" name="sub_skills_3[]" value="Routing"/>
                                          <p><small><em>(The rating of this parameter is based on skills to create travel routines & organise travel plans)</em></small></p>
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
                          <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample112" role="button" aria-expanded="false" aria-controls="collapseExample112">
                             Additional Information
                          </a>
                     
                        </p>
                        <div class="collapse" id="collapseExample112">
                          <div class="card-body">
                            
                                  <div class="row skill-rating">
                           
                                            <div class="form-group col-md-12">
                                               <div> <span class="num">4. </span><label class="label">Sabre  </label>
											    <input type="hidden" name="additional_information_3[]" value="Sabre"/>	
                                              <p><small><em>(The rating of this parameter is based on knowledge and hands on experience with sabre as a tickting and travel organising tool)</em></small></p>
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
                                                  <div><span class="num">6. </span> <label class="label">Any GDS  </label>
												  <input type="hidden" name="additional_information_3[]" value="Any GDS"/>
                                                  <p><small><em> (The rating of this paramter is based on knowledge of any travel tool excluding amadeus & Sabre)</em></small></p>
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
                                                    <div><span class="num">5. </span> <label class="label">Visa  </label>
													<input type="hidden" name="additional_information_3[]" value="Visa"/>
                                                    <p><small><em> (The rating of this parameter is based on skills related to Visa including terms, criterias, procedures etc)</em></small></p>
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
                              
                              </div>                                       </div>
                        </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="card">
                  <div class="card-header" id="headingTwo3">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo3">
                          Technology Skills
                      </button>
					  <input type="hidden" name="skills[]" value="Technology Skills"/>
                    </h5>
                  </div>
                  <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row skill-rating">
                 
                                  <div class="form-group col-md-12">
                                     <div> <span class="num">1. </span><label class="label">C/C++  </label>
									 <input type="hidden" name="sub_skills_4[]" value="C/C++"/>
									 
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
										<input type="hidden" name="sub_skills_4[]" value="Java"/>
                                        <p><small><em> (The rating of this parameter is based on software skills of Java like serverlets, applets etc)</em></small></p>
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
										  <input type="hidden" name="sub_skills_4[]" value="SQL"/>
										  
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
											<input type="hidden" name="sub_skills_4[]" value="PHP"/>
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
                            <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample01" role="button" aria-expanded="false" aria-controls="collapseExample01">
                                Additional Information
                            </a>
                       
                          </p>
                          <div class="collapse" id="collapseExample01">
                            <div class="card-body">
                              
                                    <div class="row skill-rating">
                             
                                              <div class="form-group col-md-12">
                                                 <div> <span class="num">5. </span><label class="label">C# </label>
												  <input type="hidden" name="additional_information_4[]" value="C#"/>
												  
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
                                                    <div><span class="num">6. </span> <label class="label">Scala  </label>
													 <input type="hidden" name="additional_information_4[]" value="Scala"/>
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
                                                      <div><span class="num">7. </span> <label class="label">Ruby  </label>
													  <input type="hidden" name="additional_information_4[]" value="Ruby"/>
                                                      <p><small><em> (The rating of this parameter is based on software skills of ruby on rails)</em></small></p>
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
                                                        <div><span class="num">8. </span> <label class="label">MEAN  </label>
														<input type="hidden" name="additional_information_4[]" value="MEAN"/>
                                                        <p><small><em> (The rating of this parameter is based on software skills of MongoDB, Express.js, AngularJS, and Node.js)</em></small></p>
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
                                                          <div><span class="num">9. </span> <label class="label">BlockChain  </label>
														  <input type="hidden" name="additional_information_4[]" value="BlockChain"/>
                                                          <p><small><em> (The rating of this parameter is based on cryptography skills of block chain)</em></small></p>
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
                                                            <div><span class="num">10. </span> <label class="label">Citrix  </label>
															<input type="hidden" name="additional_information_4[]" value="Citrix"/>
                                                            <p><small><em> (The rating of this parameter is based on remote server solution of citirx such as receiver, server, node moitoring etc)</em></small></p>
                                                            </div>
                                                         
                                                           <div class="custom-control custom-radio custom-control-inline">
                                                               <input type="radio" class="custom-control-input" id="tom25"  value="Expert" name="additional_informationvalues_4_5[]">
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
                                                              <div><span class="num">11. </span> <label class="label">AWS  </label>
															  <input type="hidden" name="additional_information_4[]" value="AWS"/>
															  
                                                              <p><small><em> (The rating of this parameter is based on cloud knowledge of Amazon Web Services)</em></small></p>
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
                                                                <div><span class="num">12. </span> <label class="label">.Net  </label>
																 <input type="hidden" name="additional_information_4[]" value=".Net"/>
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
                                                                  <div><span class="num">13. </span> <label class="label">Hadoop/Big data  </label>
																  <input type="hidden" name="additional_information_4[]" value="Hadoop/Big data"/>
																  
                                                                  <p><small><em> (The rating of this parameter is based on software skills of Hadoop/Big data)</em></small></p>
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
                                                                    <div><span class="num">14. </span> <label class="label">CCNA  </label>
																	<input type="hidden" name="additional_information_4[]" value="CCNA"/>
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
                                        
                                
                                </div>                                       </div>
                          </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo4">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
                            BFSI Skills
                        </button>
						<input type="hidden" name="skills[]" value="BFSI Skills"/>
                      </h5>
                    </div>
                    <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                          <div class="row skill-rating">
                   
                                    <div class="form-group col-md-12">
                                       <div> <span class="num">1. </span><label class="label">Underwriting </label>
									   <input type="hidden" name="sub_skills_5[]" value="Underwriting"/>
                                      <p><small><em>(The rating of this parameter is based on skills to perform underwriting for insurance policies)</em></small></p>
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
										  <input type="hidden" name="sub_skills_5[]" value="Investment Banking"/>
                                          <p><small><em> (The rating of this parameter is based on knowledge & hands on experience of handling/advising financial investments)</em></small></p>
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
											  <input type="hidden" name="sub_skills_5[]" value="Risk & Compliiance"/>
                                              <p><small><em>(The rating of this parameter is based on ability to assess financial risks and create complaince checks to reduce financial risks)</em></small></p>
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
                              <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample02" role="button" aria-expanded="false" aria-controls="collapseExample02">
                                 Additional Information
                              </a>
                         
                            </p>
                            <div class="collapse" id="collapseExample02">
                              <div class="card-body">
                                
                                      <div class="row skill-rating">
                               
                                                <div class="form-group col-md-12">
                                                   <div> <span class="num">4. </span><label class="label">Wealth Management  </label>
												    <input type="hidden" name="additional_information_5[]" value="Wealth Management"/>
                                                  <p><small><em>(The rating of this parameter is based on knowledge of discpline for financial planning, investment portfolio etc )</em></small></p>
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
                                                      <div><span class="num">5. </span> <label class="label">Trading  </label>
													  <input type="hidden" name="additional_information_5[]" value="Trading"/>
													  
                                                      <p><small><em> (The rating of this parameter is based on exposure to outperform traditional buy-and-hold investing)</em></small></p>
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
                                                        <div><span class="num">6. </span> <label class="label">CCP  </label>
														<input type="hidden" name="additional_information_5[]" value="CCP"/>
														
                                                        <p><small><em> (The rating of this paramter is based on Central counterparty clearing (CCP) counterparty credit risk between parties to a transaction)</em></small></p>
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
                                          
                                  
                                  </div>                                       </div>
                            </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  <div class="card">
                      <div class="card-header" id="headingTwo5">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5">
                              Utility Skills
                          </button>
						  <input type="hidden" name="skills[]" value="Utility Skills"/>
                        </h5>
                      </div>
                      <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row skill-rating">
                     
                                      <div class="form-group col-md-12">
                                         <div> <span class="num">1. </span><label class="label">Smart Grid </label>
										   <input type="hidden" name="sub_skills_6[]" value="Smart Grid"/>
                                        <p><small><em>(The rating of this paramter is based on knowledge of modern electricity supply)</em></small></p>
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
											<input type="hidden" name="sub_skills_6[]" value="Energy Management"/>
                                            <p><small><em> ( Energy management is the means to controlling and reducing a building's energy consumption)</em></small></p>
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
											  	<input type="hidden" name="sub_skills_6[]" value="Outage Management"/>
                                                <p><small><em>(An outage management system (OMS) provides the capability to efficiently identify and resolve outages and to generate and report valuable historical information)</em></small></p>
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
                        <div class="card-header" id="headingTw5">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTw5" aria-expanded="false" aria-controls="collapseTw5">
                                ITSM Skills
                            </button>
							<input type="hidden" name="skills[]" value="ITSM Skills"/>
                          </h5>
                        </div>
                        <div id="collapseTw5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                              <div class="row skill-rating">
                       
                                        <div class="form-group col-md-12">
                                           <div> <span class="num">1. </span><label class="label">Service Desk Management </label>
										   <input type="hidden" name="sub_skills_7[]" value="Service Desk Management"/>
                                          <p><small><em>(Service Desk Management/IT Service Desk Management is the process of managing the IT service desk that forms the point of contact between the IT service providers and the IT service users)</em></small></p>
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
											  <input type="hidden" name="sub_skills_7[]" value="Incident Management"/>
                                              <p><small><em> ( ncident management (IcM) is a term describing the activities of an organization to identify, analyze, and correct hazards to prevent a future re-occurrence. If not managed, an incident can escalate into an emergency, crisis or a disaster.)</em></small></p>
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
												 <input type="hidden" name="sub_skills_7[]" value="Problem Management"/>
												 
                                                  <p><small><em>(roblem management is an area of IT Service Management (ITSM) aimed at resolving incidents and problems caused by end-user errors or IT infrastructure issues and preventing recurrence of such incidents. In this context, an incident is an event that disrupts normal operation.)</em></small></p>
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
                                  <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample022" role="button" aria-expanded="false" aria-controls="collapseExample022">
                                     Additional Information
                                  </a>
                             
                                </p>
                                <div class="collapse" id="collapseExample022">
                                  <div class="card-body">
                                    
                                          <div class="row skill-rating">
                                   
                                                    <div class="form-group col-md-12">
                                                       <div> <span class="num">4. </span><label class="label">Change Management </label>
													    <input type="hidden" name="additional_information_7[]" value="Change Management"/>
                                                      <p><small><em>(The controlled identification and implementation of required changes within a computer system.)</em></small></p>
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
                                                          <div><span class="num">5. </span> <label class="label">Asset Management  </label>
														  <input type="hidden" name="additional_information_7[]" value="Asset Management"/>
														  
                                                          <p><small><em> (IT asset management (ITAM) is the set of business practices that join financial, contractual and inventory functions to support life cycle management and strategic decision making for the IT environment. Assets include all elements of software and hardware that are found in the business environment.)</em></small></p>
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
                                                            <div><span class="num">6. </span> <label class="label">Policy & Procedures Mgmt  </label>
															<input type="hidden" name="additional_information_7[]" value="Policy & Procedures Mgmt"/>
                                                            <p><small><em> (An effective policies and procedures management structure ensures that an image of a well-developed organization is promoted to the client.)</em></small></p>
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
															  <input type="hidden" name="additional_information_7[]" value="Configuration Management"/>
                                                              <p><small><em> (Configuration management (CM) is a systems engineering process for establishing and maintaining consistency of a product's performance, functional, and physical attributes with its requirements, design, and operational information throughout its life.)</em></small></p>
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
                                                                <div><span class="num">8. </span> <label class="label">Release Management  </label>
																  <input type="hidden" name="additional_information_7[]" value="Release Management"/>
																  
                                                                <p><small><em> (Release Management is the process responsible for planning, scheduling, and controlling the build, in addition to testing and deploying Releases. Release Management ensures that IS&T delivers new and enhanced IT services required by the business, while protecting the integrity of existing services.)</em></small></p>
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
																  <input type="hidden" name="additional_information_7[]" value="ISO/IEC 27001/27002"/>
																  
                                                                  <p><small><em> (ISO/IEC 27001 is the best-known standard in the family providing requirements for an information security management system)</em></small></p>
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
																	<input type="hidden" name="additional_information_7[]" value="ISO/IEC 20000-1"/>
																	
                                                                    <p><small><em> (It is a standard with clearly defined requirements that must be met in order to certify that a minimum of best practice standards are met. ISO 20000 is ITIL based, and ITIL is designed with ISO 20000 in mind; therefore, they complement each other well.)</em></small></p>
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
																	  <input type="hidden" name="additional_information_7[]" value="BMC Remedy"/>
																	  
                                                                      <p><small><em> (The rating of this parameter is based on knowledge of BMC Remedy tool in ServiceDesk)</em></small></p>
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
                                                                        <div><span class="num">12. </span> <label class="label">Service-Now  </label>
																		
																		<input type="hidden" name="additional_information_7[]" value="Service-Now"/>
                                                                        <p><small><em> (The rating of this parameter is based on knowledge of Service-now tool in ServiceDesk)</em></small></p>
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
                                      </div>                                       </div>
                                </div>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="heading5">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                  Excellence Skills
                              </button>
							  <input type="hidden" name="skills[]" value="Excellence Skills"/>
                            </h5>
                          </div>
                          <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row skill-rating">
                         
                                          <div class="form-group col-md-12">
                                             <div> <span class="num">1. </span><label class="label">Lean </label>
											 	<input type="hidden" name="sub_skills_8[]" value="Lean"/>
                                            <p><small><em>( Lean is a business methodology that promotes the flow of value to the customer through two guiding tenets: Continuous improvement and respect for people)</em></small></p>
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
												<input type="hidden" name="sub_skills_8[]" value="DFSS"/>
                                                <p><small><em> ( Design for Six Sigma (DFSS) is a business-process management method related to traditional Six Sigma. )</em></small></p>
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
												  <input type="hidden" name="sub_skills_8[]" value="RCA"/>
                                                  <p><small><em> ( Root cause analysis (RCA) is a method of problem solving used for identifying the root causes of faults or problems )</em></small></p>
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
												   <input type="hidden" name="sub_skills_8[]" value="VSM"/>
												   
                                                    <p><small><em>(Value-stream mapping is a lean-management method for analyzing the current state and designing a future state for the series of events that take a product or service from its beginning through to the customer with reduced lean wastes as compared to current map.)</em></small></p>
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
													 <input type="hidden" name="sub_skills_8[]" value="PDCA"/>
                                                      <p><small><em>(PDCA (plan–do–check–act or plan–do–check–adjust) is an iterative four-step management method used in business for the control and continual improvement of processes and products. It is also known as the Deming circle/cycle/wheel, the Shewhart cycle, the control circle/cycle, or plan–do–study–act (PDSA).)</em></small></p>
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
                                    <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapse022" role="button" aria-expanded="false" aria-controls="collapse022">
                                       Additional Information
                                    </a>
                               
                                  </p>
                                  <div class="collapse" id="collapse022">
                                    <div class="card-body">
                                      
                                            <div class="row skill-rating">
                                     
                                                      <div class="form-group col-md-12">
                                                         <div> <span class="num">6. </span><label class="label">5S </label>
                                                        <p><small><em>(5S is a system for organizing spaces so work can be performed efficiently, effectively, and safely. )</em></small></p>
                                                        </div>
                                                      
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input" id="custom1" name="example1">
                                                            <label class="custom-control-label" for="custom1">Expert 
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
                                                              <input type="radio" class="custom-control-input" id="custom2" name="example1">
                                                              <label class="custom-control-label" for="custom2">Proficient
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
                                                                <input type="radio" class="custom-control-input" id="custom3" name="example1">
                                                                <label class="custom-control-label" for="custom3">Demonstrating
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
                                                                  <input type="radio" class="custom-control-input" id="custom4" name="example1">
                                                                  <label class="custom-control-label" for="custom4">Basic
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
                                                                    <input type="radio" class="custom-control-input" id="custom5" name="example1">
                                                                    <label class="custom-control-label" for="custom5">None/Low
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
                                                            <div><span class="num">7. </span> <label class="label">TPM  </label>
                                                            <p><small><em> (Total productive maintenance (TPM) is a method of maintaining and improving the integrity of production and quality systems through the machines, equipment, employees and the supporting processes. TPM can be of great value and its target is to improve core business processes.)</em></small></p>
                                                            </div>
                                                         
                                                           <div class="custom-control custom-radio custom-control-inline">
                                                               <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                               <label class="custom-control-label" for="custom01">Expert
                        
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
                                                                 <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                 <label class="custom-control-label" for="custom02">Proficient
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
                                                                   <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                   <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                     <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                     <label class="custom-control-label" for="custom04">Basic
                        
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
                                                                       <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                       <label class="custom-control-label" for="custom05">None/Low
                        
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
                                                              <p><small><em> (A poka-yoke is any mechanism in any process that helps an equipment operator avoid (yokeru) mistakes (poka). Its purpose is to eliminate product defects by preventing, correcting, or drawing attention to human errors as they occur.)</em></small></p>
                                                              </div>
                                                           
                                                             <div class="custom-control custom-radio custom-control-inline">
                                                                 <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                 <label class="custom-control-label" for="custom01">Expert
                          
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
                                                                   <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                   <label class="custom-control-label" for="custom02">Proficient
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
                                                                     <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                     <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                       <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                       <label class="custom-control-label" for="custom04">Basic
                          
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
                                                                         <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                         <label class="custom-control-label" for="custom05">None/Low
                          
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
                                                                <p><small><em> (Jidoka highlights the causes of problems because work stops immediately when a problem first occurs. )</em></small></p>
                                                                </div>
                                                             
                                                               <div class="custom-control custom-radio custom-control-inline">
                                                                   <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                   <label class="custom-control-label" for="custom01">Expert
                            
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
                                                                     <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                     <label class="custom-control-label" for="custom02">Proficient
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
                                                                       <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                       <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                         <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                         <label class="custom-control-label" for="custom04">Basic
                            
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
                                                                           <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                           <label class="custom-control-label" for="custom05">None/Low
                            
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
                                                                  <div><span class="num">10. </span> <label class="label">JIT  </label>
                                                                  <p><small><em> (JIT is a methodology aimed primarily at reducing times within production system as well as response times from suppliers and to customers.)</em></small></p>
                                                                  </div>
                                                               
                                                                 <div class="custom-control custom-radio custom-control-inline">
                                                                     <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                     <label class="custom-control-label" for="custom01">Expert
                              
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
                                                                       <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                       <label class="custom-control-label" for="custom02">Proficient
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
                                                                         <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                         <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                           <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                           <label class="custom-control-label" for="custom04">Basic
                              
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
                                                                             <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                             <label class="custom-control-label" for="custom05">None/Low
                              
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
                                                                    <p><small><em> (According to Ishikawa, quality improvement is a continuous process, and it can always be taken one step further. With his cause and effect diagram (also called the "Ishikawa" or "fishbone" diagram) this management leader made significant and specific advancements in quality improvement.)</em></small></p>
                                                                    </div>
                                                                 
                                                                   <div class="custom-control custom-radio custom-control-inline">
                                                                       <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                       <label class="custom-control-label" for="custom01">Expert
                                
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
                                                                         <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                         <label class="custom-control-label" for="custom02">Proficient
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
                                                                           <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                           <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                             <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                             <label class="custom-control-label" for="custom04">Basic
                                
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
                                                                               <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                               <label class="custom-control-label" for="custom05">None/Low
                                
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
                                                                      <p><small><em> (Heijunka (pronounced hi-JUNE-kuh) is a Japanese word that means “leveling.” When implemented correctly, heijunka elegantly – and without haste – helps organizations meet demand while reducing wastes in production and interpersonal processes.)</em></small></p>
                                                                      </div>
                                                                   
                                                                     <div class="custom-control custom-radio custom-control-inline">
                                                                         <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                         <label class="custom-control-label" for="custom01">Expert
                                  
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
                                                                           <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                           <label class="custom-control-label" for="custom02">Proficient
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
                                                                             <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                             <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                               <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                               <label class="custom-control-label" for="custom04">Basic
                                  
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
                                                                                 <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                                 <label class="custom-control-label" for="custom05">None/Low
                                  
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
                                                                        <p><small><em> (Kanban is a visual signal that's used to trigger an action. )</em></small></p>
                                                                        </div>
                                                                     
                                                                       <div class="custom-control custom-radio custom-control-inline">
                                                                           <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                           <label class="custom-control-label" for="custom01">Expert
                                    
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
                                                                             <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                             <label class="custom-control-label" for="custom02">Proficient
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
                                                                               <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                               <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                                 <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                                 <label class="custom-control-label" for="custom04">Basic
                                    
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
                                                                                   <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                                   <label class="custom-control-label" for="custom05">None/Low
                                    
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
                                                                          <p><small><em> (A3 problem solving is a structured problem-solving and continuous-improvement approach, first employed at Toyota and typically used by lean manufacturing practitioners. It provides a simple and strict procedure that guides problem solving by workers.)</em></small></p>
                                                                          </div>
                                                                       
                                                                         <div class="custom-control custom-radio custom-control-inline">
                                                                             <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                             <label class="custom-control-label" for="custom01">Expert
                                      
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
                                                                               <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                               <label class="custom-control-label" for="custom02">Proficient
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
                                                                                 <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                                 <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                                   <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                                   <label class="custom-control-label" for="custom04">Basic
                                      
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
                                                                                     <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                                     <label class="custom-control-label" for="custom05">None/Low
                                      
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
                                                                            <p><small><em> (Quality Function Deployment (QFD) is a structured approach to defining customer needs or requirements and translating them into specific plans to produce products to meet those needs. The “voice of the customer” is the term to describe these stated and unstated customer needs or requirements.)</em></small></p>
                                                                            </div>
                                                                         
                                                                           <div class="custom-control custom-radio custom-control-inline">
                                                                               <input type="radio" class="custom-control-input" id="custom01" name="example1">
                                                                               <label class="custom-control-label" for="custom01">Expert
                                        
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
                                                                                 <input type="radio" class="custom-control-input" id="custom02" name="example1">
                                                                                 <label class="custom-control-label" for="custom02">Proficient
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
                                                                                   <input type="radio" class="custom-control-input" id="custom03" name="example1">
                                                                                   <label class="custom-control-label" for="custom03">Demonstrating
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
                                                                                     <input type="radio" class="custom-control-input" id="custom04" name="example1">
                                                                                     <label class="custom-control-label" for="custom04">Basic
                                        
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
                                                                                       <input type="radio" class="custom-control-input" id="custom05" name="example1">
                                                                                       <label class="custom-control-label" for="custom05">None/Low
                                        
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
                                        </div>                                       </div>
                                  </div>
                            </div>
                          </div>
                          </div>
                        </div>

						<p>
							<input class="btn btn-success btn-sm" type="submit" name="sub" value="Submit"	/>
						</p>
    </div>
</form>
  </div>
</div>
</div>
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
