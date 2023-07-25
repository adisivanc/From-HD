<? 
ob_start();
ob_clean();
set_time_limit(0);
require_once("includes.php");

	require('PhpCsvGen.php');
	$phpcsvobj = new PhpCsvGen();
	$phpcsvobj->setCol(29);
	$PageRowIndex=0;	
	$toDay = time();
	$todate = date('d/m/Y');
	
	$school_id = $_REQUEST['school_id'];
	$rs_school = School::getSchoolById($school_id);
	
	$phpcsvobj->writeText($PageRowIndex, 0, 'Generated On: '.$todate);
	$PageRowIndex++;
	$phpcsvobj->writeText($PageRowIndex, 1, $rs_school->school_name);
	$PageRowIndex++;
	
	if($_REQUEST['filename']=="Student"){  
		
		$phpcsvobj->writeText($PageRowIndex, 0, 'S.NO');
		$phpcsvobj->writeText($PageRowIndex, 1, 'Student Name');
		$phpcsvobj->writeText($PageRowIndex, 2, 'Gender');
		$phpcsvobj->writeText($PageRowIndex, 3, 'Grade');
		$phpcsvobj->writeText($PageRowIndex, 4, 'Address');
		$phpcsvobj->writeText($PageRowIndex, 5, 'Phone');
		$phpcsvobj->writeText($PageRowIndex, 6, 'Mobile');
		$phpcsvobj->writeText($PageRowIndex, 7, 'Email Address');
		$phpcsvobj->writeText($PageRowIndex, 8, 'Emergency Contact Number');
		$phpcsvobj->writeText($PageRowIndex, 9, 'Nationality');
		$phpcsvobj->writeText($PageRowIndex, 10, 'Mother Tongue');
		$phpcsvobj->writeText($PageRowIndex, 11, 'Father Name');
		$phpcsvobj->writeText($PageRowIndex, 12, 'Mother Name');
		$phpcsvobj->writeText($PageRowIndex, 13, 'Father Qualification');
		$phpcsvobj->writeText($PageRowIndex, 14, 'Mother Qualification');
		$phpcsvobj->writeText($PageRowIndex, 15, 'Father Email');
		$phpcsvobj->writeText($PageRowIndex, 16, 'Mother Email');
		$phpcsvobj->writeText($PageRowIndex, 17, 'Father Phone');
		$phpcsvobj->writeText($PageRowIndex, 18, 'Mother Phone');
		
		$PageRowIndex++;
	
		extract($_REQUEST); 
	
		$studentObj = new Student;
		
			$student_obj = new Student();
			if($school_id!='' && $school_id!='undefined'){ $student_obj->school_id = $school_id; }
			if($gradeId!="" && $gradeId!="undefined") $student_obj->grade_id=$gradeId;
			
			if($actionPage=="Grade") $student_obj->student_id_in_grade=$gradeId;
			
			if($searchBy=="N") {
				if($searchByNameId!="" && $searchByNameId!="undefined") $student_obj->search_id=$searchByNameId; 
				if($searchByName!="" && $searchByName!="undefined") $student_obj->name_search=$searchByName; 
			}
			
			if($searchBy=="Id") {
				if($searchById!="" && $searchById!="undefined") $student_obj->search_id=$searchById; 
			}
			
			if($searchBy=="E") {
				if($searchByEmail!="" && $searchByEmail!="undefined") $student_obj->check_all_emails=$searchByEmail; 
			}
			
			if($orderBy!="") $order_by=$orderBy; else $order_by='first_name';
			if($sortBy!="") $sort_by=$sortBy; else $sort_by='ASC';
			
			$student_obj->orderby = $order_by;
			$student_obj->sortby = $sort_by;
			$rs_student = $student_obj->getAllStudentDtls();
		 
		
			if(count($rs_student)>0) { 	
				foreach($rs_student as $M=>$N) {
					$rs_GradeDtl = Grade::getGradeById($N->grade_id);
					$rs_BusRouteDtl = Transportation::getBusRouteById($N->bus_route_id);
					$student_name = stripslashes($N->first_name)." ".stripslashes($N->middle_name)." ".stripslashes($N->last_name);
					$PageRowIndex++;
					$phpcsvobj->writeText($PageRowIndex, 0, $M+1);
					$phpcsvobj->writeText($PageRowIndex, 1, trim($student_name));
					$phpcsvobj->writeText($PageRowIndex, 2, stripslashes($GLOBALS['Gender'][$N->gender]));
					$phpcsvobj->writeText($PageRowIndex, 3, stripslashes($rs_GradeDtl->grade_name));
					$phpcsvobj->writeText($PageRowIndex, 4, stripslashes($N->current_address));
					$phpcsvobj->writeText($PageRowIndex, 5, stripslashes($N->phone));
					$phpcsvobj->writeText($PageRowIndex, 6, stripslashes($N->mobile));
					$phpcsvobj->writeText($PageRowIndex, 7, stripslashes($N->email_address));
					$phpcsvobj->writeText($PageRowIndex, 8, stripslashes($N->emergency_contact_number));
					$phpcsvobj->writeText($PageRowIndex, 9, stripslashes($N->nationality));
					$phpcsvobj->writeText($PageRowIndex, 10, stripslashes($N->mother_tongue));
					$phpcsvobj->writeText($PageRowIndex, 11, stripslashes($N->father_name));
					$phpcsvobj->writeText($PageRowIndex, 12, stripslashes($N->mother_name));
					$phpcsvobj->writeText($PageRowIndex, 13, stripslashes($N->father_qualification));
					$phpcsvobj->writeText($PageRowIndex, 14, stripslashes($N->mother_qualification));
					$phpcsvobj->writeText($PageRowIndex, 15, stripslashes($N->father_email));
					$phpcsvobj->writeText($PageRowIndex, 16, stripslashes($N->mother_email));
					$phpcsvobj->writeText($PageRowIndex, 17, stripslashes($N->father_phone));
					$phpcsvobj->writeText($PageRowIndex, 18, stripslashes($N->mother_phone));
				}
			}
		
	}
	
	if($_REQUEST['filename']=="EventReg"){
		
	$phpcsvobj->writeText($PageRowIndex, 0, 'S.NO');
	$phpcsvobj->writeText($PageRowIndex, 1, 'Reg Id');
	$phpcsvobj->writeText($PageRowIndex, 2, 'Name');
	$phpcsvobj->writeText($PageRowIndex, 3, 'Email');
	$phpcsvobj->writeText($PageRowIndex, 4, 'Gender');
	$phpcsvobj->writeText($PageRowIndex, 5, 'Date of birth');
	$phpcsvobj->writeText($PageRowIndex, 6, 'Address');
	$phpcsvobj->writeText($PageRowIndex, 7, 'Session Details');
	$phpcsvobj->writeText($PageRowIndex, 8, 'Session Amount');
	$phpcsvobj->writeText($PageRowIndex, 9, 'Paid');
	
	$PageRowIndex++;
	
		extract($_REQUEST);
			$reg_obj = new EventRegistration();
			$reg_obj->event_id = $_REQUEST['EventId'];
			$reg_obj->sortby = "DESC";
			$reg_obj->orderby = "id";
			
			if($_REQUEST['searchType']!=''){
			if($_REQUEST['searchType']=='name'){
				$reg_obj->reg_name = $_REQUEST['searchTxt'];
 			}
			if($_REQUEST['searchType']=='emailaddress'){
				$reg_obj->reg_email_address = $_REQUEST['searchTxt_emailaddress'];
 			}
			if($_REQUEST['searchType']=='id'){ 
				$reg_obj->searchTxt_id = $_REQUEST['searchTxt_id'];
 			}
			if($_REQUEST['searchType']=='session'){ 
				$getEventSessionId = $reg_obj->getEventSessionRegByEventSessionId($_REQUEST['session_id']);
				foreach($getEventSessionId as $M=>$N){
					$rs_regs[] = $reg_obj->getEventRegById($N->reg_id);
 				}
			}
			if($_REQUEST['searchType']=='date'){ 
				$searchTxt_fromDate = date('Y-m-d',strtotime($_REQUEST['searchTxt_fromDate']));
				$searchTxt_toDate = date('Y-m-d',strtotime($_REQUEST['searchTxt_toDate']));
			
 				$rs_event_regs = $reg_obj->getEventSessionRegByEventSessionDate($searchTxt_fromDate,$searchTxt_toDate,$_REQUEST['EventId']);
				foreach($rs_event_regs as $M=>$N){
					$rs_regs[] = $reg_obj->getEventRegById($N->reg_id);
 				}
 			}
			
 		}
		
		if($_REQUEST['searchType']!='session' && $_REQUEST['searchType']!='date'){ 
			$rs_regs = $reg_obj->getEventRegDtls();
		}
			//$rs_regs = $reg_obj->getEventRegDtls();
 			
			if(count($rs_regs)>0) { 	
				foreach($rs_regs as $M=>$N) {
								
					if($N->total_amount=="Y") $amount_paid = "Yes"; else $amount_paid = "No";
					$rs_etss = EventRegistration::getEventSessionRegByRegId($N->id);  
					$sessionArr = array();
					if(count($rs_etss)>0) {
						foreach($rs_etss as $sk=>$sv) {
							$sessionArr[$sv->event_date][] = $sv->event_session_id."~".$sv->session_time;
						}
					}
					
					$tempArr = array();
					if(count($sessionArr)>0) {
						foreach($sessionArr as $esk=>$esv) {  
								$tempArr[] = date("M d Y", strtotime($esk)); 
							if(count($esv)>0) { 
								foreach($esv as $k1=>$v1) {
								$v1Arr = explode("~", $v1); 
								$rs_event_session = EventSession::getSessionById($v1Arr[0]); 
									$tempArr[] .= $rs_event_session->event_session_name." ( ".$v1Arr[1]." ) ";
								}
							} 
						}
					}
					$sessionDtls = implode(", ", $tempArr);
					$PageRowIndex++;
					$phpcsvobj->writeText($PageRowIndex, 0, $M+1);
					$phpcsvobj->writeText($PageRowIndex, 1, stripslashes($N->id));
					$phpcsvobj->writeText($PageRowIndex, 2, stripslashes($N->reg_name));
					$phpcsvobj->writeText($PageRowIndex, 3, stripslashes($N->reg_email_address));
					$phpcsvobj->writeText($PageRowIndex, 4, stripslashes($N->reg_gender));
					$phpcsvobj->writeText($PageRowIndex, 5, stripslashes(date("d-m-Y",strtotime($N->reg_dob))));
					$phpcsvobj->writeText($PageRowIndex, 6, stripslashes($N->reg_address));
					$phpcsvobj->writeText($PageRowIndex, 7, stripslashes($sessionDtls));
					$phpcsvobj->writeText($PageRowIndex, 8, stripslashes($N->total_amount));
					$phpcsvobj->writeText($PageRowIndex, 9, stripslashes($amount_paid));
					
				}
			}
		
	}
	
	if($_REQUEST['filename']=="EventSession"){
		
	$phpcsvobj->writeText($PageRowIndex, 0, 'S.NO');
	$phpcsvobj->writeText($PageRowIndex, 1, 'Session Name');
	$phpcsvobj->writeText($PageRowIndex, 2, 'Session Date');
	$phpcsvobj->writeText($PageRowIndex, 3, 'Session Time');
	$phpcsvobj->writeText($PageRowIndex, 4, 'Session Type/Amount');
	$phpcsvobj->writeText($PageRowIndex, 5, 'Session Place');
	
	$PageRowIndex++;
	
		extract($_REQUEST);
			$event_session_obj = new EventSession();
 			$event_session_obj->sortby = "ASC";
			$event_session_obj->orderby = "id";
			$rs_event_session = $event_session_obj->getSessionByEventId($_REQUEST['EventId']);
 			
			if(count($rs_event_session)>0) { 	
				foreach($rs_event_session as $M=>$N) {
					if($N->session_type=="F"){ $session_amount ="Free" ;} else { $session_amount= $N->session_amount ;}
				
				$PageRowIndex++;
				$phpcsvobj->writeText($PageRowIndex, 0, $M+1);
				$phpcsvobj->writeText($PageRowIndex, 1, stripslashes($N->event_session_name));
				$phpcsvobj->writeText($PageRowIndex, 2, stripslashes(date("d-m-Y",strtotime($N->session_date))));
				$phpcsvobj->writeText($PageRowIndex, 3, stripslashes($N->session_time));
				$phpcsvobj->writeText($PageRowIndex, 4, stripslashes($session_amount));
				$phpcsvobj->writeText($PageRowIndex, 5, stripslashes($N->session_place));
				}
			}
		
	} 
	$phpcsvobj->output(array('filename'=>$_REQUEST['filename']));
	exit();

?>
