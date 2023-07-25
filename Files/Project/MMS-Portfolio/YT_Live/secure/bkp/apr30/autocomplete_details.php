<?php
 
$q = strtolower($_GET["q"]);
if (!$q) return;
require_once("includes.php");

    $route_obj->school_id=$_SESSION['SchoolId'];
	
if($_REQUEST['search_type']=="bus_route") {
	$route_obj = new Transportation(); 
	$route_obj->route_search=$q;
	$search_rs = $route_obj->getBusRouteDtls();
	if(count($search_rs)>0)
		 foreach($search_rs as $k=>$v)
  			echo $v->route_name."|".$v->id."\n";
 }
 if($_REQUEST['search_type']=="vehicle") {
	$route_obj = new Transportation(); 
	$route_obj->vehicle_search=$q;
	$search_rs = $route_obj->getVehicleDtls();
	if(count($search_rs)>0)
		 foreach($search_rs as $k=>$v)
  			echo $v->vehicle_number."|".$v->id."\n";
 }
 if($_REQUEST['search_type']=="subject") {
	$subject_obj = new Subject();  
	$subject_obj->subject_search=$q;
	$search_rs = $subject_obj->getAllSubjectDtls();
	if(count($search_rs)>0)
		 foreach($search_rs as $k=>$v)
  			echo $v->subject_name."|".$v->id."\n";
 }
  if($_REQUEST['search_type']=="student") {
	$student_obj = new Student();  
	$student_obj->student_search=$q;
	$student_obj->school_id=$_SESSION['SchoolId'];
	$search_rs = $student_obj->getAllStudentDtls();
	if(count($search_rs)>0)
		 foreach($search_rs as $k=>$v)
  			echo $v->first_name."|".$v->id."\n";
 }
 if($_REQUEST['search_type']=="parent_name") {
	$student_obj = new EventRegistration();  
	$student_obj->reg_name=$q;
	$search_rs = $student_obj->getEventRegDtls();
	if(count($search_rs)>0)
		 foreach($search_rs as $k=>$v)
  			echo $v->reg_name."|".$v->id."\n";
 }
 if($_REQUEST['search_type']=="email_address") {
	$student_obj = new EventRegistration();  
	$student_obj->email_address=$q;
	$search_rs = $student_obj->getEventRegDtls();
	if(count($search_rs)>0)
		 foreach($search_rs as $k=>$v)
  			echo $v->reg_email_address."|".$v->id."\n";
 }
 if($_REQUEST['search_type']=="session") {
	$student_obj = new EventSession();  
	$student_obj->session=$q;
	$search_rs = $student_obj->getSessionDtls();
	if(count($search_rs)>0)
		 foreach($search_rs as $k=>$v)
  			echo $v->event_session_name."|".$v->id."\n";
 }
 if($_REQUEST['search_type']=="circular_parent") {
	
	$circular_obj= new Circular();
	$circular_obj->Id=$_REQUEST['circular_id'];
	$rs_selectcircular = $circular_obj->getCircularDtl();
	
	
	if(count($rs_selectcircular)>0){ 
		
		$circular_group = unserialize($rs_selectcircular->apply_to);

		$UpdNL = false; $emailArr=array(); $teacheremail=array();
		if(count($circular_group)>0){
			foreach($circular_group as $K1=>$V1){ 
				//echo "<pre>"; print_r($V1); echo "</pre>";
				if(count($V1)>0 && $V1!="NS") { 
					foreach($V1 as $K2=>$V2) {
						$school_id = explode(':',$K2); 
						if(count($V2)>0) { 
							foreach($V2 as $K3=>$V3) {
								$rs_tt = explode(':',$V3); 
								$rs_tt = explode(':',$V3); 
								if($rs_tt[0]=='TSG' && $_REQUEST['type']=="teacher"){ 
									$table_name = "grade_teachers";
									$qry="select b.id, b.first_name, b.middle_name, b.last_name, b.email_address, b.mobile from `grade_teachers` a, teachers b where a.school_id=".$school_id[1]."
and a.grade_id=".$rs_tt[1]." and a.teacher_id=b.id and b.first_name LIKE '%".$q."%' group by a.teacher_id";
									$rs_SelNLMember=dB::mExecuteSql($qry);
									if(count($rs_SelNLMember)>0) {
										foreach($rs_SelNLMember as $kk=>$vv) {
											$teacher_name = $vv->first_name." ".$vv->middle_name." ".$vv->last_name;
											//if($vv->email_address!="") $emailArr[]=$vv->email_address."~".$teacher_name."~".$vv->mobile."~".$vv->id;
											if($vv->email_address!="" && !in_array($vv->email_address,$teacheremail)) {
												$teacheremail[]=$vv->email_address;	
												$emailArr[]=$vv->email_address."~".$teacher_name."~".$vv->mobile."~".$vv->id;
											}
										}
									}
									
								}
								
								else if($rs_tt[0]=='SSG' && $_REQUEST['type']=="parent"){
									$table_name = "grade_student";
									$qry="SELECT b.id, b.first_name, b.middle_name, b.last_name, b.email_address, b.father_email, b.mother_email, b.father_phone, b.mother_phone, b.father_name, b.mother_name, b.mobile FROM `grade_student` a, `student` b where a.school_id=".$school_id[1]." and a.grade_id=".$rs_tt[1]." and a.student_id=b.id and b.first_name LIKE '%".$q."%' group by a.student_id";
									$rs_SelNLMember=dB::mExecuteSql($qry);
									if(count($rs_SelNLMember)>0) {
										foreach($rs_SelNLMember as $kk=>$vv) {
											$student_name = $vv->first_name." ".$vv->middle_name." ".$vv->last_name;
											if($vv->father_email!="") $emailArr[]=$vv->father_email."~".$vv->father_name."~".$vv->father_phone."~".$vv->id."~".$student_name;
											if($vv->mother_email!="") $emailArr[]=$vv->mother_email."~".$vv->mother_name."~".$vv->mother_phone."~".$vv->id."~".$student_name;
											if($vv->father_email=="" && $vv->mother_email=="") $emailArr[]=$vv->email_address."~".$vv->father_name."~".$vv->mobile."~".$vv->id."~".$student_name;
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
	
	if(count($emailArr)>0) {
		 foreach($emailArr as $kk=>$vv) {
			$tempArr=array();
		 	$tempArr = explode("~",$vv);
  			if($_REQUEST['type']=="teacher") echo trim($tempArr[1]).", ".trim($tempArr[0]).", ".trim($tempArr[2])."|".trim($tempArr[3])."\n";
			if($_REQUEST['type']=="parent") echo trim($tempArr[4]).", ".trim($tempArr[1]).", ".trim($tempArr[0]).", ".trim($tempArr[2])."|".trim($tempArr[3])."\n";
		 }
	}
	
 }
 
?>