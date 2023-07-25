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
	
	if($_REQUEST['filename']=="StudentUniformList"){  
		
		$phpcsvobj->writeText($PageRowIndex, 0, 'S.NO');
		$phpcsvobj->writeText($PageRowIndex, 1, 'Student Name');
		$phpcsvobj->writeText($PageRowIndex, 2, 'Gender');
		$phpcsvobj->writeText($PageRowIndex, 3, 'Grade');
		$phpcsvobj->writeText($PageRowIndex, 4, 'Father Name');
		$phpcsvobj->writeText($PageRowIndex, 5, 'Father Email');
		$phpcsvobj->writeText($PageRowIndex, 6, 'Father Phone');
		$phpcsvobj->writeText($PageRowIndex, 7, 'Mother Name');
		$phpcsvobj->writeText($PageRowIndex, 8, 'Mother Email');
		$phpcsvobj->writeText($PageRowIndex, 9, 'Mother Phone');
		$phpcsvobj->writeText($PageRowIndex, 10, 'T-Shirts');
		$phpcsvobj->writeText($PageRowIndex, 11, 'Skirts/Pants/Shorts');
		$phpcsvobj->writeText($PageRowIndex, 12, 'Uniform Notes');
		
		$PageRowIndex++;
	
		extract($_REQUEST); 
	
		$studentObj = new Student;
		
			$query = 'SELECT a.id, CONCAT(a.first_name, " ", a.middle_name, " ", a.last_name) as student_name, a.gender, a.father_name, a.father_email, a.father_phone, a.mother_name, a.mother_email, a.mother_phone, b.grade_name, a.t_shirts, a.skirts_pants, a.dress_notes FROM `student` a, `grade` b where (a.t_shirts>0 or a.skirts_pants>0) and a.grade_id=b.id order by b.grade_name, a.first_name ASC';
			$rs_student = dB::mExecuteSql($query);
		 
		
			if(count($rs_student)>0) { 	
				foreach($rs_student as $K=>$V) {
					$rs_GradeDtl = Grade::getGradeById($V->grade_id);
					$PageRowIndex++;
					$phpcsvobj->writeText($PageRowIndex, 0, $K+1);
					$phpcsvobj->writeText($PageRowIndex, 1, trim($V->student_name));
					$phpcsvobj->writeText($PageRowIndex, 2, stripslashes($GLOBALS['Gender'][$V->gender]));
					$phpcsvobj->writeText($PageRowIndex, 3, stripslashes($V->grade_name));
					$phpcsvobj->writeText($PageRowIndex, 4, stripslashes($V->father_name));
					$phpcsvobj->writeText($PageRowIndex, 5, stripslashes($V->father_email));
					$phpcsvobj->writeText($PageRowIndex, 6, stripslashes($V->father_phone));
					$phpcsvobj->writeText($PageRowIndex, 7, stripslashes($V->mother_name));
					$phpcsvobj->writeText($PageRowIndex, 8, stripslashes($V->mother_email));
					$phpcsvobj->writeText($PageRowIndex, 9, stripslashes($V->mother_phone));
					$phpcsvobj->writeText($PageRowIndex, 10, stripslashes($V->t_shirts));
					$phpcsvobj->writeText($PageRowIndex, 11, stripslashes($V->skirts_pants));
					$phpcsvobj->writeText($PageRowIndex, 12, stripslashes($V->dress_notes));
				}
			}
		
	}
	
	
	$phpcsvobj->output(array('filename'=>$_REQUEST['filename']));
	exit();

?>
