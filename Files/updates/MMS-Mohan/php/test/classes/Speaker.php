<?
 		
  class Speaker
  {
     
	 var $FirstName;
	 var $LastName;
	 var $Email;
	 var $Company;
	 var $Type;
	 var $Phone;
	  
	 function Speakers($email='', $password='')
	 {
	    $this->email=$email;
		$this->password=$password;
	 }    
	 
	function getSpeakerDtl() {
	
	
		if($this->NotSpeakerId!='') $sub_qry[] ="`Id`!='".$this->NotSpeakerId."'";
		if($this->ChairPersonIds!='') $sub_qry[] = " `Id` IN (".$this->ChairPersonIds.")";
		if($this->qry_string!='') $sub_qry[] ="`Name`like '%".$this->qry_string."%'  ";
		if($this->Email!='') $sub_qry[] ="`Email`='".$this->Email."'";
		if($this->id!='') $sub_qry[] .= " Id=".$this->id;
		if($this->type!='') $sub_qry[] ="`Type`='".$this->type."'";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='')  $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		//if($this->sortby1!='')  $sort_qry1 = " order by ".$this->orderby.' '.$this->sortby;
		//if($this->id=='') $sub_qry[] ="`Id`!=14";
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		$query="select ".$this->fields." from ".TBL_SPEAKERS." ".$subqry.$sort_qry1;	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}

	
	//insert Speaker using ajax
	function insertSpeaker()
	{
		
		$maxval = new Speaker();
		$MaxVal = $maxval->getSpkMax()->MaxValue+1;
		
		$ActivationKey = mt_rand().mt_rand().mt_rand().mt_rand().mt_rand();
		  $query="INSERT INTO `".TBL_SPEAKERS."` (`Prefix`,`Name`,`SEO_Name`,`Email`,`Designation`,`Address`,`Type`,`ShortDescription` , `ActivationKey`,`Position`, `AddedDate`) VALUES ('$this->Prefix','$this->Name','$this->SEO_Name','$this->Email','$this->Designation','$this->Address', '$this->Falculty_Type','$this->ShortDescription','$ActivationKey','$MaxVal', '$this->AddedDate')";			
		$insertId=dB::insertSql($query);
		
		/*$faculty_obj = new Speaker();
		$faculty_obj->speaker_id = $insertId;
		$faculty_obj->facultymail();*/
		return $insertId; 
		
	}
	
	function updateSpeaker()
	{
		
		if($this->FinancialAssistance==''){
			$this->FinancialAssistance = 'N';
		}
		$query="Update ".TBL_SPEAKERS." set  `FinancialAssistance`='".$this->FinancialAssistance."',`Prefix`='".$this->Prefix."',`Name`='".$this->Name."',`SEO_Name`='".$this->SEO_Name."',`Email`='".$this->Email."',`Designation`='".$this->Designation."', `Address`='".$this->Address."', `ShortDescription`='".$this->ShortDescription."', `Type`='".$this->Falculty_Type."', `UpdatedDate`='".$this->UpdatedDate."' where `Id`='".$this->speaker_id."'";
		
		$rs_Upd = dB::updateSql($query);
		
		return $rs_Upd; 
	
	}
	function delSpeaker(){
	 	$query="delete from ".TBL_SPEAKERS." where Id  ='".$this->speaker_id."'";
	    $Res_del = db::deleteSql($query);
		
	    return $Res_del;
	
	}
	function updateSpeakerPhoto() {
		
		if($this->speaker_id) $sub_qry = " Id= ".$this->speaker_id;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	    $query="update ".TBL_SPEAKERS." set Photo = '".$this->Photo."' ".$sub_qry;	
		return dB::updateSql($query);
		
	}
	function updateSpeakerFlag() {
		
		if($this->speaker_id) $sub_qry = " Id= ".$this->speaker_id;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	    $query="update ".TBL_SPEAKERS." set Flag = '".$this->Flag."' ".$sub_qry;	
		return dB::updateSql($query);
		
	}
	function updateSpeakerPosition() {
		
		if($this->speaker_id) $sub_qry = " Id= ".$this->speaker_id;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	    $query="update ".TBL_SPEAKERS." set Position = '".$this->Position."' ".$sub_qry;	
		return dB::updateSql($query);
		
	}
	function getSpeakerByPositionDtl() {
		
		if($this->status) $sub_qry = " Status= '".$this->status."'";
		if($this->Id) $sub_qry = " Id= '".$this->Id."'";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
		$query="select ".$this->fields." from ".TBL_SPEAKERS." ".$sub_qry.$sort_qry;	
		return dB::mExecuteSql($query);			
		
	}

	
	function chkFacultyDtl() {
		
		$query = "select * from ".TBL_SPEAKERS." where ActivationKey='".$this->activationkey."'";
		return dB::sExecuteSql($query);			
		
	}
	
	function updateSpeakerStatus(){
		
		//update speaker status
		$query="Update ".TBL_SPEAKERS." set  `Status`='Y' where `Id`='".$this->speaker_id."'";
		$rs_Upd = dB::updateSql($query);
		
		if($rs_Upd){
			//sent conform mail to admin
			$subject="Confirmation Mail";
			$From=$this->Email;
			
			$headers = "From: Confirmation Mail <".$From.">\r\n"; 
			$headers .= "Reply-To: Confirmation Mail <".$From.">\r\n";
			$headers .= "Return-Path: Confirmation Mail <".$From.">\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: ISVIR 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";

			$message='
			<p>Dear Admin!</p>
			<p>'.$this->Name.' are now activate and update the contact details!.</p>
			<p>Regards,.</p>
			<p>ISVIR2013 Team.</p>
			';
			@mail('kavitharjn@gmail.com', $subject, $message, $headers);
			@mail('karthik@mmsprojects.com', $subject, $message, $headers);
				   
			return true;
		}
		return false;
		
	}
	
	function updateFacultyStatus() {
				
		if($this->speaker_id) $sub_qry = " Id= ".$this->speaker_id;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
		$query="update ".TBL_SPEAKERS." set Status = '".$this->Status."' ".$sub_qry;	
		$rs_updtl = dB::updateSql($query);
		return $rs_updtl;
				
	}
	function facultymail()
	{
		//select speaker dtl
		$faculty_obj = new Speaker();
		$faculty_obj->id = $this->speaker_id;
		$rs_facultydtl = $faculty_obj->getSpeakerDtl();
		
		//sent activationkey to corresponding speaker
		if($rs_facultydtl->Id!=''){
		
			$activeUrl = getSeoUrl(array('pn'=>'activation.php','activationkey'=>$rs_facultydtl->ActivationKey));
			
			$subject="ISVIR 2013 - Update Faculy Information";
			
			$headers = "From: Faculty Information <noreply@isvir13.com>\r\n"; 
			$headers .= "Reply-To: Faculty Information <noreply@isvir13.com>\r\n";
			$headers .= "Return-Path: Faculty Information <noreply@isvir13.com>\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: ISVIR 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";

			$message='
			<p>Dear '.$rs_facultydtl->Name.'!</p>
			
			<p>Greetings from ISVIR 13  Secretariat.</p>
			<p>Plans for the Congress are in full swing. This mail has been sent to you to invite you to join us as faculty. Kindly click on the link below and fill your details at the earliest. The data and your photograph will get uploaded in the website. .</p>
			<p>Update your Information :  '.$activeUrl.'</p>
			<p>We would be grateful if you would send us back the details within 48 hours..</p>
			<p>Yours sincerely,<br />Dr. Mathew Cherian.<br />Organizing Secretary,<br />ISVIR 2013.<br />www.isvir13.com</p>
			
			';
			
			@mail($rs_facultydtl->Email, $subject, $message, $headers);	   
			
			return true;
	   }
	   return false;
	}
	
	
	function updateEmailId() {
		
		$ActivationKey = mt_rand().mt_rand().mt_rand().mt_rand().mt_rand();
		if($this->id) $sub_qry = " Id= ".$this->id;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	    $query="update ".TBL_SPEAKERS." set `Email` = '".$this->EmailAddress."' , `ActivationKey` = '".$ActivationKey."' ".$sub_qry;	
		dB::updateSql($query);
		
		
		//select speaker dtl
		$faculty_obj = new Speaker();
		$faculty_obj->id = $this->id;
		$rs_facultydtl = $faculty_obj->getSpeakerDtl();
		
		//sent activationkey to corresponding speaker
		if($rs_facultydtl->Id!=''){
			
			
			$activeUrl = getSeoUrl(array('pn'=>'activation.php','activationkey'=>$rs_facultydtl->ActivationKey));
			
			$subject="ISVIR2013 - Activation Mail";
			
			$headers = "From: ISVIR2013 - Activation Mail <noreply@isvir13.com>\r\n"; 
			$headers .= "Reply-To: ISVIR2013 - Activation Mail <noreply@isvir13.com>\r\n";
			$headers .= "Return-Path: ISVIR2013 - Activation Mail <noreply@isvir13.com>\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: ISVIR 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";

			$message='
			<p>Dear '.$rs_facultydtl->Name.'!</p>
			
			<p>Greetings from ISVIR 13  Secretariat.</p>
			<p>Plans for the Congress are in full swing. This mail has been sent to you to invite you to join us as faculty. Kindly click on the link below and fill your details at the earliest. The data and your photograph will get uploaded in the website. .</p>
			<p>Update your Information :  '.$activeUrl.'</p>
			<p>We would be grateful if you would send us back the details within 48 hours..</p>
			<p>Yours sincerely,<br />Dr. Mathew Cherian.<br />Organizing Secretary,<br />ISVIR 2013.<br />www.isvir13.com</p>
			';
			
			@mail($rs_facultydtl->Email, $subject, $message, $headers);	   
			
			return true;
	   }
	   return false;
		
	}
	function getSpeakerDtlwithPic() {
		
		if($this->Email!='') $sub_qry[] ="`Email`='".$this->Email."'";
		$sub_qry[] ="`Photo`!=''";
		if($this->id!='') $sub_qry[] .= " Id=".$this->id;
		if($this->type!='') $sub_qry[] ="`Type`='".$this->type."'";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		$query="select ".$this->fields." from ".TBL_SPEAKERS." ".$subqry;	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}
	
	function insertSpeakerPgm()
	{
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$maxval = new Speaker();
		$MaxVal = $maxval->getSpkPgmMax()->MaxValue+1;
		
		$query="INSERT INTO `".TBL_SPEAKERS_PGM."` (`SpeakerId`,`Topic`,`TopicType`,`Sub_Name`,`EventType`,`Description`,`TopicDate`,`TopicTime` , `Position`,`ChairPersons`, `MajorType`,`WorkshopTopic`,`AddedDate`) VALUES ('$this->SpeakerId','$this->Topic','$this->TopicHeading2','$this->Sub_Name','$this->EventType','$this->Description','$this->TopicDate', '$this->TopicTime','$MaxVal','$this->ChairPersonsId','$this->MajorType','$this->WorkshopTopic', '$sqlDateTime')";			
		$insertId=dB::insertSql($query);

		return $insertId; 
		
	}
	function updateSpeakerPgm()
	{
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		
		$query="Update ".TBL_SPEAKERS_PGM." set  `SpeakerId`='".$this->SpeakerId."',`Topic`='".$this->Topic."',`TopicType`='".$this->TopicHeading2."',`Sub_Name`='".$this->Sub_Name."',`EventType`='".$this->EventType."',`Description`='".$this->Description."',`TopicDate`='".$this->TopicDate."', `TopicTime`='".$this->TopicTime."', `ChairPersons`='".$this->ChairPersonsId."', `MajorType`='".$this->MajorType."', `WorkshopTopic`='".$this->WorkshopTopic."', `UpdatedDate`='".$sqlDateTime."' where `Id`='".$this->Id."'";
		
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	
	function getSpeakerProgrammeDtl() {
		
		if($this->ProgrammeIds!='') $programme_sub_qry = " or `TopicType` IN (".$this->ProgrammeIds.")";
		if($this->SearchKeyword!='') $sub_qry[] ="`Topic` like '%".$this->SearchKeyword."%'  or  `Description` like '%".$this->SearchKeyword."%' ".$programme_sub_qry." and `EventType` != 'B'  ";
		if($this->SpeakerId!='') $sub_qry[] ="((`SpeakerId`='".$this->SpeakerId."') or (`ChairPersons`like '%;".$this->SpeakerId."' or `ChairPersons`like ';".$this->SpeakerId."' or ChairPersons like '%;".$this->SpeakerId.";%')) ";
		if($this->TopicDate!='') $sub_qry[] ="`TopicDate`='".date('Y-m-d',strtotime($this->TopicDate))."'";
		if($this->TopicType!='') $sub_qry[] ="`TopicType`='".$this->TopicType."'";
		if($this->TopicDate!='') $sub_qry[] ="`TopicDate`='".$this->TopicDate."'";
		if($this->MajorType!='') $sub_qry[] ="`MajorType`='".$this->MajorType."'";
		if($this->NotSpeakerId!='') $sub_qry[] ="`SpeakerId`!='".$this->NotSpeakerId."'";
		if($this->WorkshopTopic!='') $sub_qry[] ="`WorkshopTopic`='".$this->WorkshopTopic."'";
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->fields=='') $this->fields='*';
		if($this->groupby!='') $group_qry = " group by ".$this->groupby;
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
		$query="select ".$this->fields." from ".TBL_SPEAKERS_PGM." ".$subqry.$group_qry.$sort_qry;	
		if($this->Id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}
	
	function getPgmDtlFromWorkshopTopic(){
		
		if($this->SearchKeyword!='') $sub_qry[] ="`WorkshopTopic` like '%".$this->SearchKeyword."%' ";
		if($this->Workshop_Date!='') $sub_qry[] ="`TopicDate` = '".$this->Workshop_Date."' ";
		
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->fields=='') $this->fields='*';
		if($this->groupby!='') $group_qry = " group by ".$this->groupby;
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
		$query="select ".$this->fields." from ".TBL_SPEAKERS_PGM." ".$subqry.$group_qry.$sort_qry;	
		if($this->Id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}
	
	function getPgmDtlFromLivePgm(){
		
		if($this->	EventType!='') $sub_qry[] = " 	EventType = '".$this->EventType."'";
		if($this->SearchKeyword!='') $sub_qry[] =" `Description` like '%".$this->SearchKeyword."%' ";
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->fields=='') $this->fields='*';
		if($this->groupby!='') $group_qry = " group by ".$this->groupby;
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
		$query="select ".$this->fields." from ".TBL_SPEAKERS_PGM." ".$subqry.$group_qry.$sort_qry;	
		if($this->Id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}
	
	function getRandomSpeakerDtl() {
		
		$query = "select * from ".TBL_SPEAKERS." order by rand()" ;
		return dB::mExecuteSql($query);		

	}
	
	function getSpeakerPgmByDate() {
		
		$query = "select * from ".TBL_SPEAKERS_PGM." where TopicDate='".date('Y-m-d',strtotime($this->TopicDate))."' and TopicType = '".$this->TopicType."' order by ".$this->orderby." ".$this->sortby." ";
		return dB::mExecuteSql($query);			
		
	}
	
	function updateSpeakerPgmTopicPosition() {
		
		if($this->speakerpgmtopic_id) $sub_qry = " Id= ".$this->speakerpgmtopic_id;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	    $query="update ".TBL_SPEAKERS_PGM." set TopicPosition = '".$this->TopicPosition."' ".$sub_qry;	
		return dB::updateSql($query);
		
	}
	
	function updateSpeakerPgmPosition() {
		
		if($this->speakerpgm_id) $sub_qry = " Id= ".$this->speakerpgm_id;
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	    $query="update ".TBL_SPEAKERS_PGM." set Position = '".$this->Position."' ".$sub_qry;	
		return dB::updateSql($query);
		
	}
	
	function getSpkPgmMax(){
		
		$query = "select MAX(Position) as MaxValue from ".TBL_SPEAKERS_PGM." ";
		return dB::sExecuteSql($query);		
	}
	function getSpkMax(){
		
		$query = "select MAX(Position) as MaxValue from ".TBL_SPEAKERS." ";
		return dB::sExecuteSql($query);		
	}
	
	function insertTopicHeading()
	{
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		$query="INSERT INTO `".TBL_PROGRAMME_TOPIC."` (`TopicHeading`, `AddedDate`) VALUES ('$this->TopicHeading', '$sqlDateTime')";			
		$insertId=dB::insertSql($query);
		return $insertId; 
		
	}
	function getPgmTopicDtl() {
		
		if($this->Topic!='') $sub_qry[] ="`TopicHeading` like '%".$this->Topic."%'  ";
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
		$query="select ".$this->fields." from ".TBL_PROGRAMME_TOPIC." ".$subqry.$sort_qry;	
		if($this->Id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	

	}
	function deleteSpeakerProgrammeDtl(){
	 	$query="delete from ".TBL_SPEAKERS_PGM." where Id  ='".$this->ProgrammeId."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	}
	function getSpeakerByPosition()
	{
		$user_obj = new Speaker();
		$user_obj->groupby = 'SpeakerId';
		$rs_speaker=$user_obj->getSpeakerProgrammeDtl();
		if(count($rs_speaker)>0){
			foreach($rs_speaker as $K=>$V){
				$str[] = $V->SpeakerId;
			}
		}
		$Sql = "select ChairPersons from ir_speakers_pgm where ChairPersons!=''";
		$rs_ChairPerson = dB::mExecuteSql($Sql);
		if(count($rs_ChairPerson)>0){
			foreach($rs_ChairPerson as $k=>$v){
				$ChairArr = $v->ChairPersons.';'.$ChairArr;
			}
		}
		$ChairArr = substr($ChairArr,0,strlen($ChairArr)-1);	
		
		
		$Chair_str = str_replace(';',',',$ChairArr); 
		
		$Chair_str = str_replace(',,',',',$Chair_str); 
		$spk_str ='14,18,'.implode(',',$str);
		$sub_qry = "where `Id` IN (".$spk_str.$Chair_str.") ";
		if($this->fields=='') $this->fields='*';
		if($this->qry_string!='') $sub_qry_like =" and `Name`like '%".$this->qry_string."%'  ";
		$query = "select ".$this->fields." from ".TBL_SPEAKERS." ".$sub_qry." ".$sub_qry_like."  order by Position asc";
		return dB::mExecuteSql($query);
	}

	
	function speakerProgrammeMail()
	{
		//get speaker dtl
		$speaker_obj= new Speaker();
		$speaker_obj->id=$this->speaker_id;
		$rs_speaker=$speaker_obj->getSpeakerDtl();
	
		//select speakerpgm dtl
		$speakerpgm_obj = new Speaker();
		$speakerpgm_obj->SpeakerId = $this->speaker_id;
		$speakerpgm_obj->orderby='TopicDate';
		$speakerpgm_obj->sortby='asc';
		$SpeakerPgm_Dtl = $speakerpgm_obj->getSpeakerProgrammeDtl();
		
		$dev_servermail = false;
		if ($dev_servermail) {

			define("SITE_HTTP2","http://192.168.1.126/isvirhtml/");
		}else{
			define("SITE_HTTP2","http://www.isvir13.com");
		}
		
			
			$subject="ISVIR 2013 - Schedule Details";
			
			$headers = "From: Schedule Details <noreply@isvir13.com>\r\n"; 
			$headers .= "Reply-To: Schedule Details <noreply@isvir13.com>\r\n";
			$headers .= "Return-Path: Schedule Details <noreply@isvir13.com>\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: ISVIR 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";


			$message = '<table width="640" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:0;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#434d54;border:1px solid #000000">
				<tr>
					<td colspan="2"><img src="'.SITE_HTTP2.'/images/app_top.jpg" width="640" height="110" /></td>
				</tr>
				<tr style="background-color:#FFFFFF;">
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr style="background-color:#FFFFFF;">
					<td colspan="2" style="padding-left:10px;"><b>Dear '.$rs_speaker->Name.'</b></td>
				</tr>
				
				<tr style="background-color:#FFFFFF;">
					<td colspan="2" style="padding-left:20px;"><b>Your Schedule for ISVIR13 Annual conference.</b> </td>
				</tr>
				';
				
			$message.='<tr style="background-color:#FFFFFF"><td style="padding-left:20px;">';
			
			
			//FOR TRAINER [WORKSHOP]
			if(count($SpeakerPgm_Dtl)>0){
			$scheduleArr=array();
			foreach($SpeakerPgm_Dtl as $K=>$V){
			if($V->TopicTime!=''){
				$Date_Dtl = explode('-',$V->TopicTime);
				$FTTime = $Date_Dtl[0];
				$TTTime = $Date_Dtl[1];
			}
			if($V->MajorType=='W'){
			
			$message.='<tr bgcolor="#FFFFFF"><td>';
				if(!in_array('Trainer', $scheduleArr)){
				$scheduleArr[]='Trainer';
				$message.='<img style="vertical-align:middle" src="'.SITE_HTTP2.'/images/trainer.jpg" border="0" />';
				}
			$message.='<div style="padding-left:20px;"><br /><b style="font-size:16px">Workshop : '.$V->WorkshopTopic.'</b><br /><b style="color:#990000; font-size:14px">'.date('M dS,Y',strtotime($V->TopicDate)).'</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$FTTime.' - '.$TTTime.'</b><br /></div>';
				if($V->MajorType=='O' && $V->Description!='undefined'){
					$message.='<div style="padding-left:20px;">'.$V->Description.'<br /></div>';
				}
			}
			$message.='</td></tr>';
			} } 
			
			
			//FOR CHAIR PERSON
			if(count($SpeakerPgm_Dtl)>0){
			$scheduleArr=array();
			foreach($SpeakerPgm_Dtl as $K=>$V){
			
			if($V->TopicTime!=''){
				$Date_Dtl = explode('-',$V->TopicTime);
				$FTTime = $Date_Dtl[0];
				$TTTime = $Date_Dtl[1];
			}
			if($V->MajorType=='O' && $V->Description!='Competition Papers' && $V->Topic!='ISVIR Gold Medal Awards'){
			$message.='<tr bgcolor="#FFFFFF"><td>';
			$Chair = explode(';',$V->ChairPersons);
			if (in_array( $_REQUEST['speaker_id'],$Chair)) {
			
			if($V->Topic=='Interactive Cases'){
				if(!in_array('Panelists', $scheduleArr)){
				$scheduleArr[]='Panelists';
				$message.='<img style="vertical-align:middle" src="'.SITE_HTTP2.'/images/chiair_text.jpg" border="0" />';
				}
			}else{	
				if(!in_array('Chair Person', $scheduleArr)){
				$scheduleArr[]='Chair Person';
				$message.='<img style="vertical-align:middle" src="'.SITE_HTTP2.'/images/chair.jpg" border="0" />';
				}
			}
			$message.='<div style="padding-left:20px;"><br /><b style="font-size:16px">'.$V->Topic.'</b><br /><b style="color:#990000; font-size:14px">'.date('M dS,Y',strtotime($V->TopicDate)).'</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$FTTime.' - '.$TTTime.'</b><br /></div>';
			
				if($V->MajorType=='O' && $V->Description!='undefined'){
					$message.='<div style="padding-left:20px;">'.$V->Description.'<br /></div>';
				}
			}
			$message.='</td></tr>';
				} } }
			
			
			
			//FOR SPEAKER
			if(count($SpeakerPgm_Dtl)>0){
			$scheduleArr=array();
			foreach($SpeakerPgm_Dtl as $K=>$V){
			
			if($V->TopicTime!=''){
				$Date_Dtl = explode('-',$V->TopicTime);
				$FTTime = $Date_Dtl[0];
				$TTTime = $Date_Dtl[1];
			}
			if($V->MajorType=='O' && $V->Description!='Competition Papers' && $V->SpeakerId!='0' && $V->Topic!='ISVIR Gold Medal Awards'){
			$message.='<tr bgcolor="#FFFFFF"><td>';
				$SpeakerId[] = $V->SpeakerId;
				if (in_array( $_REQUEST['speaker_id'],$SpeakerId)) {
				
				if(!in_array('Speaker', $scheduleArr)){
				$scheduleArr[]='Speaker';
				$message.='<img style="vertical-align:middle" src="'.SITE_HTTP2.'/images/speaker.jpg" border="0" />';
				}
			$message.='<div style="padding-left:20px;"><br /><b style="font-size:16px">'.$V->Topic.'</b><br /><b style="color:#990000; font-size:14px">'.date('M dS,Y',strtotime($V->TopicDate)).'</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$FTTime.' - '.$TTTime.'</b><br /></div>';
		
				if($V->MajorType=='O' && $V->Description!='undefined'){
					$message.='<div style="padding-left:20px;">'.$V->Description.'<br /></div>';
				}
				
			}
			$message.='</td></tr>';
					
				} } }
			
			
			//FOR JUDGE
			if(count($SpeakerPgm_Dtl)>0){
			$scheduleArr=array();
			foreach($SpeakerPgm_Dtl as $K=>$V){
			
			if($V->TopicTime!=''){
				$Date_Dtl = explode('-',$V->TopicTime);
				$FTTime = $Date_Dtl[0];
				$TTTime = $Date_Dtl[1];
			}
			if($V->MajorType=='O' && $V->Description=='Competition Papers' && $V->Topic!='ISVIR Gold Medal Awards'){
			$message.='<tr bgcolor="#FFFFFF"><td>';
				if(!in_array('Judge', $scheduleArr)){
				$scheduleArr[]='Judge';
				$message.='<img style="vertical-align:middle" src="'.SITE_HTTP2.'/images/judge.jpg" border="0" />';
				}
			$message.='<div style="padding-left:20px;"><br /><b style="font-size:16px">'.$V->Topic.'</b><br /><b style="color:#990000; font-size:14px">'.date('M dS,Y',strtotime($V->TopicDate)).'</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$FTTime.' - '.$TTTime.'</b><br /></div>';
				if($V->MajorType=='O' && $V->Description!='undefined'){
					$message.='<div style="padding-left:20px;">'.$V->Description.'<br /></div>';
				}
				
			}
			$message.='</td></tr>';
				
				} } 
			
			//FOR GOLD MEDAL
			if(count($SpeakerPgm_Dtl)>0){
			$scheduleArr=array();
			foreach($SpeakerPgm_Dtl as $K=>$V){
			if($V->TopicTime!=''){
				$Date_Dtl = explode('-',$V->TopicTime);
				$FTTime = $Date_Dtl[0];
				$TTTime = $Date_Dtl[1];
			}
			if($V->Topic=='ISVIR Gold Medal Awards'){
			$message.='<tr bgcolor="#FFFFFF"><td>';
				$message.='<img style="vertical-align:middle" src="'.SITE_HTTP2.'/images/presided.jpg" border="0" />';
			$message.='<div style="padding-left:20px;"><br /><b style="font-size:16px">'.$V->Topic.'</b><br /><b style="color:#990000; font-size:14px">'.date('M dS,Y',strtotime($V->TopicDate)).'</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$FTTime.' - '.$TTTime.'</b><br /></div>';
					if($V->MajorType=='O' && $V->Description!='undefined'){
					$message.='<div style="padding-left:20px;">'.$V->Description.'<br />';
				}
				
			}
			$message.='</td></tr>';
				} } 
			
			
			
				
				
						
				
			$message.='</br>';
			$message.='<tr bgcolor="#FFFFFF"><td>&nbsp;</tr></td>';
			$message.='</tr></td>';
				$message .='<tr>
				<td colspan="2">
				<table width="640" border="0" cellspacing="0" cellpadding="0" style="background-color:#eff2f6">
				<tr>
				<td width="357" valign="top" style="padding-left:10px;padding-top:5px">
				<span style="font-size:16px"><b>Dr. Mathew Cherian</b></span><br />
				Organizing Chairman<br />
				<span style="font-size:16px"><b>Dr. Pankaj Mehta</b></span><br />
				Co-Chairman
				</td>
				<td width="283" align="right" style="font-size:12px;padding-left:5px;padding-top:5px;padding-right:10px">
				Department of Interventional Radiology<br />
				Kovai Medial Center and Hospital<br />
				Coimbatore, India.<br />
				Ph: +91 96009 00373, +91 98438 50350<br />
				email: <a href="mailto:info@isvir13.com" style="color:#414b52;text-decoration:none">info@isvir13.com</a>
				</td>
				</tr>
				<tr>
				<td colspan="2" align="center" style="font-size:12px;border-top:1px solid #babec4;padding-top:8px">
				ISVIR Annual Conference 2013. <a href="http://www.isvir13.com/" style="color:#414b52;text-decoration:underline" target="_blank">www.isvir13.com</a><br />
				Copyrights 2012 ISVIR13.com
				</td>
				</tr>
				</table>
				</td>
				</tr>
				</table>
				';


		
			echo $message;
			//@mail($rs_speaker->Email, $subject, $message, $headers);
			@mail('karthik@mmsprojects.com', $subject, $message, $headers);	   
			
			/*$today=time();
			$sqlDateTime = date('Y-m-d H:i:s',$today);
			$Type = 'SpeakerSchedule';
			
			$Sql = 'insert into '.TBL_MAIL_LOG.' set `SenderId`='.$rs_speaker->Id.',`Email`="'.$rs_speaker->Email.'",`Type`="'.$Type.'",`SendedDate`="'.$sqlDateTime.'" ';
			dB::insertSql($Sql);*/
		
	}	
	
	function remainingSpeakersDtl() {
		
		$query = "SELECT * FROM ".TBL_SPEAKERS." where `Email` not in (select EmailAddress from ".TBL_REGISTRATION.")";
		return dB::mExecuteSql($query);			
		
	}
	
	function remainingMemberDtl() {
		
		$query = "SELECT * FROM ".TBL_NEWSLETTER_EMAIL." where `Email` not in (select EmailAddress from ".TBL_REGISTRATION.") and `Type`='ISM'";
		return dB::mExecuteSql($query);			
		
	}
	
	function remainingFacMemberDtl() {
		
		$query = "SELECT * FROM ".TBL_SPEAKERS." where `Email` not in (select EmailAddress from ".TBL_REGISTRATION.") ";
		return dB::mExecuteSql($query);			
		
	}
	
	function formalMail(){
	
	
		//select speaker dtl
		$faculty_obj = new Speaker();
		$faculty_obj->id = $this->id;
		$rs_facultydtl = $faculty_obj->getSpeakerDtl();
		
		$Name = str_replace('Dr.',' ',$rs_facultydtl->Name);
		$Name = str_replace('Dr',' ',$Name);
		//sent activationkey to corresponding speaker
		if($rs_facultydtl>0){
		
			
			$subject="ISVIR 2013 - Register for the ISVIR-Conference";
			
			$headers = "From: Dr.Mathew Cherian <dr.mathewcherian@isvir13.com>\r\n"; 
			$headers .= "Reply-To: Dr.Mathew Cherian <dr.mathewcherian@gmail.com>\r\n";
			$headers .= "Return-Path: Dr.Mathew Cherian <dr.mathewcherian@isvir13.com>\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: ISVIR 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";

			echo $message='
			Dear Dr.'.$Name.',<br /><br />
		
			Kindly take ten minutes off to register for the conference.This will help us enormously to plan your accomodation and also to pass on your travel plans to the concerned department.<br /><br />

			Click on the link below to register<br /><br />

			<a target="_blank" href='.getSeoUrl(array('pn'=>'registration.php')).'>www.isvir13.com/registration</a><br /><br />

			Thanking You,.<br /><br />

			Best Regards,<br />Dr. Mathew Cherian.<br />Organizing Secretary,<br />ISVIR 2013.<br />www.isvir13.com
			
			';
			
			/*$today=time();
			$sqlDateTime = date('Y-m-d H:i:s',$today);
			$Type = 'ISM';
			
			$Sql = 'insert into '.TBL_MAIL_LOG.' set `SenderId`='.$rs_facultydtl->Id.',`Email`="'.$rs_facultydtl->Email.'",`Type`="'.$Type.'",`SendedDate`="'.$sqlDateTime.'" ';
			dB::insertSql($Sql);*/
			@mail($rs_facultydtl->Email, $subject, $message, $headers);	   
			//@mail('kavitharjn@gmail.com', $subject, $message, $headers);	   
			//@mail('karthik@mmsprojects.com', $subject, $message, $headers);	   
			
			return true;
	   }
	   return false;
	   
	
	}
	
	
	
	function formalmemberMail(){
	

		
		$Name = str_replace('Dr.',' ',$this->Name);
		$Name = str_replace('Dr',' ',$Name);
		//sent activationkey to corresponding speaker
		
			
			$subject="ISVIR 2013 - Register for the ISVIR-Conference";
			
			$headers = "From: Dr.Mathew Cherian <dr.mathewcherian@isvir13.com>\r\n"; 
			$headers .= "Reply-To: Dr.Mathew Cherian <dr.mathewcherian@gmail.com>\r\n";
			$headers .= "Return-Path: Dr.Mathew Cherian <dr.mathewcherian@isvir13.com>\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: ISVIR 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";

			echo $message='
			Dear Dr.'.$Name.',<br /><br />
		
			Kindly take ten minutes off to register for the conference.We have taken enormous pains to organize what we think, is a fabulous conference, Kindly encourage us by registering at the earliest.<br /><br />

			Click on the link below to register<br /><br />

			<a target="_blank" href='.getSeoUrl(array('pn'=>'registration.php')).'>www.isvir13.com/registration</a><br /><br />

			Thanking You,.<br /><br />

			Best Regards,<br />Dr. Mathew Cherian.<br />Organizing Secretary,<br />ISVIR 2013.<br />www.isvir13.com
			
			';
			
			$today=time();
			$sqlDateTime = date('Y-m-d H:i:s',$today);
			$Type = 'ISM';
			
			$Sql = 'insert into '.TBL_MAIL_LOG.' set `Email`="'.$this->Email.'",`Type`="'.$Type.'",`SendedDate`="'.$sqlDateTime.'" ';
			dB::insertSql($Sql);
			@mail($this->Email, $subject, $message, $headers);	   
			//@mail('kavitharjn@gmail.com', $subject, $message, $headers);	   
			//@mail('karthik@mmsprojects.com', $subject, $message, $headers);	   

	
	}
	
	function workshopMemberDtl() {
		
		
		$query = "select A.Id as Id,A.Name as Name,A.Email as Email,B.WorkshopTopic as WorkshopTopic,B.TopicDate as TopicDate,B.TopicTime as TopicTime from ".TBL_SPEAKERS." as A, ".TBL_SPEAKERS_PGM." as B where B.`MajorType` = '".$this->MajorType."' and B.SpeakerId = A.Id ";
		return dB::mExecuteSql($query);			
		
	}
	
	
	function fn_genpdf(){

		include "genpdf.php";
		
		$orderfileAbs = BASE_SS_URL.'uploads/pdf/';
	
		$mail = new PHPMailer();
		
		$mail->From="info@isvir13.com";
		$mail->FromName="ISVIR Abstract Attachment";
		$mail->Sender="sendto@isvir13.com";
		//$mail->AddReplyTo("replies@example.com", "Replies for my site");
		
		$mail->AddAddress("karthik@mmsprojects.com");
		$mail->Subject = "ISVIR 2013";
		
		$mail->IsHTML(true);
		$mail->AddAttachment($orderfileAbs, $this->Id.'.pdf'); // attach files/invoice-user-1234.pdf, and rename it to invoice.pdf
		$mail->Body = "Please find your file.";
		
		if(!$mail->Send())
		{
		   echo "Error sending: " . $mail->ErrorInfo;;
		}
		else
		{
		   echo "Letter is sent";
		}


		
		
	}
		
		
		
	function invitationLetter() {
		
	 if($this->LoginSpeakerId!=''){ $sub_query = ' where A.Id = '.$this->LoginSpeakerId.' '; }	
	 $query = "select A.Id as Id,A.Name as Name from ".TBL_SPEAKERS." A ".$sub_query."  group by A.Id ";
	 $speaker_rS= dB::mExecuteSql($query);	
	 
	 foreach($speaker_rS as $Key=>$Val) {
	 $Speaker_Arr['Id']=$Val->Id;
	 $Speaker_Arr['Name']=$Val->Name;
	    $query = "select A.Id as Id,A.Name as Name,A.Email as Email,B.MajorType, B.Topic,B.SpeakerId,B.Description,B.ChairPersons, B.WorkshopTopic as WorkshopTopic,date_format(B.TopicDate,'%D %M, %Y') as TopicDate,B.TopicTime as TopicTime from ".TBL_SPEAKERS." as A, ".TBL_SPEAKERS_PGM." as B where ( B.SpeakerId = A.Id  or B.ChairPersons like '%;".$Val->Id.";%' or B.ChairPersons like '%;".$Val->Id."' ) and A.Id=".$Val->Id . ' order by B.TopicDate, B.Position';
	 //echo '<hr>';
		$rS= dB::mExecuteSql($query);	$cnt=0;		
		if(is_array($rS))
		foreach($rS as $K=>$V)
		 {
		   $ChairPersons_Arr = explode(';',$V->ChairPersons); 
		   if($V->SpeakerId==$V->Id) {
		   if($V->MajorType=='W') {
		   $Topics[$cnt]['TName']=$V->WorkshopTopic;
		   $Topics[$cnt]['TType']='Workshop';
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   if($V->MajorType=='O') {
		   $Topics[$cnt]['TName']=$V->Topic;
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TType']='Speaker';
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   } 
		   if(in_array($V->Id,$ChairPersons_Arr)   ) {
		   if($V->MajorType=='O') {
		   if($V->Topic!='' && $V->SpeakerId>0) {
		   $Topics[$cnt]['TName']=$V->Topic;
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TType']='Chair';
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   
		   if($V->Description=='Competition Papers') {
		   
		   $Topics[$cnt]['TName']=$V->Topic;
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TType']='Papers';
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   
		   }
		   }
		   
		   
		   }
		   if($V->SpeakerId==0) {

		   if($V->Topic=='Interactive Cases') {
		    $Topics[$cnt]['TType']='IC';
			$Topics[$cnt]['TDesc']=$V->Description ;
		    $Topics[$cnt]['TName']=$V->Topic;
		    $Topics[$cnt]['TDate']=$V->TopicDate;
		    $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   
		   if($V->Topic=='ISVIR Gold Medal Awards') {
		    $Topics[$cnt]['TType']='Awards';
			$Topics[$cnt]['TName']=$V->Topic;
			$Topics[$cnt]['TDesc']=$V->Description ;
		    $Topics[$cnt]['TDate']=$V->TopicDate;
		    $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   
		  
		   if($V->Topic=='ISVIR Gold  Medal  Awards') {
		    $Topics[$cnt]['TType']='Awardee Introduction';
			$Topics[$cnt]['TName']=$V->Topic;
			$Topics[$cnt]['TDesc']=$V->Description ;
		    $Topics[$cnt]['TDate']=$V->TopicDate;
		    $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		  
		   
		   
		   }
		   
		
		 }
		 
		 $topicsarr= array();
		 foreach($Topics as $K1=>$V1) {
		 if($V1['TType']=='Speaker') {
		   $topicsarr['Speaker'][]=$V1;
		  }
		 if($V1['TType']=='Chair') {
		   $topicsarr['Chair'][]=$V1;
		  }
		 if($V1['TType']=='IC') {
		   $topicsarr['IC'][]=$V1;
		  } 
		  
		  if($V1['TType']=='Papers') {
		   $topicsarr['Papers'][]=$V1;
		  }
		 
		 
		 if($V1['TType']=='Workshop') {
		   $topicsarr['WS'][]=$V1;
		  }
		  
		  		 if($V1['TType']=='Awards') {
		   $topicsarr['Awards'][]=$V1;
		  }
		  
		   if($V1['TType']=='Awardee Introduction') {
		   $topicsarr['Awardee Introduction'][]=$V1;
		  }
		 }
		 $Speaker_Arr['Topic']=$topicsarr;
		 $Topics = array();
		 $Speakers[]=$Speaker_Arr;
		 $Speaker_Arr=array();
		 }

		
		foreach($Speakers as $K=>$V) {
	
		if(count($V['Topic'])>0) {
		
	echo '<hr>';
echo  "	Dear Dr.".$V['Name'].",<br /><br />
Greetings from ISVIR 2013!<br /><br />

The Organizing Committee takes immense pleasure in inviting you as a guest faculty  for the Annual Conference of the Indian Society of Vascular and Interventional  Radiology to be held at the Kovai Medical Center Auditorium between 14th and 17th  of February 2013. <br /> ";



if(is_array($V['Topic']['Speaker'])) {
$V1 = $V['Topic']['Speaker'];
 if(count($V1)>1) {
 echo '<br />You are requested to <b>give a guest speech on the following topics</b> <br /> <ul>'; } else
 echo '<br />You are requested to <b>give a guest speech on the following topic </b><br /> <ul>';
 foreach($V1 as $k=>$v) {
 echo '<li style="margin-left:25px">Topic:  <b>'.$v['TName'].'</b><br />
Date: '.$v['TDate'].'<br />
Time: '.$v['TTime'].'<br />
</li>';
 }
echo '</ul>';
} 
 

if(is_array($V['Topic']['Chair'])) {
$V1 = $V['Topic']['Chair'];
 if(count($V1)>1) {
 echo '<br />You are requested to <b>introduce the topic and  chair the session for the topics</b> <br /> <ul>'; } else
 echo '<br />You are requested to  <b>introduce the topic and  chair the session for the topic</b> <br /> <ul>';
 foreach($V1 as $k=>$v) {
 echo '<li> Topic:  <b>'.$v['TName'].'</b><br />
Date: '.$v['TDate'].'<br />
Time: '.$v['TTime'].'<br /><br />
</li>';
 }
echo '</ul>';
} 
 

if(is_array($V['Topic']['WS'])) {
$V1 = $V['Topic']['WS'];

 echo '<br />You are requested to give a <b>guest speech on '.$V1[0]['TName'].'</b> and <b>training on the same during hands-on training</b> on <br /> Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'<br /><br />
</li>';

} 


if(is_array($V['Topic']['Awardee Introduction'])) {
$V1 = $V['Topic']['Awardee Introduction'];

 echo '<br />You are requested to  introduce <b>'.$V1[0]['TDesc'].' </b> during the ISVIR Gold Medal Awards Function on <br /> Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'<br /><br />
</li>';

} 

if(is_array($V['Topic']['Awards'])) {
$V1 = $V['Topic']['Awards'];

 echo '<br />You are requested to<b> preside the ISVIR Gold Medal Awards Function</b> on <br /> Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'<br /><br />
</li>';

} 



if(is_array($V['Topic']['IC'])) {
$V1 = $V['Topic']['IC'];

 echo '<br />You are requested to <b>moderate the interactive case discussions </b>on the topics <br /> <ul><li>
<b>Topics</b> : <br />'. 
$V1[0]['TDesc'] .' <br />
Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'<br /><br />
</li></ul>';

} 

if(is_array($V['Topic']['Papers'])) {
$V1 = $V['Topic']['Papers'];

 echo '<br />You are requested to <b>evaluate the competion papers session by being a judge</b> on <br /> <ul><li>
'.'
Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'<br /><br />
</li></ul>';

} 


if(in_array($V['Id'],$GLOBALS['INTERNATIONAL_FACULTY'])) 
echo  'Please note that Organizing Committee of ISVIR will take care of your accomodation and domestic travel expenses  during your stay in Coimbatore for ISVIR 2013 Annual Conference . Kindly contact us if you need any more documents for clearance of your VISA for India.';
else
echo  'Also, please note that Organizing Committee of ISVIR will take care of your accomodation during your stay in Coimbatore for ISVIR 2013 Annual Conference.';


echo '<br /><br />
 Please do not hesitate to contact us for any of your questions. For technical queries, kindly contact our <b>online co-ordinator , Kavitha Rajan @ kavitharjn@isvir13.com</b> <br /><br />
';
echo 'Thanking You';


}
}






}


	function getinvitationLetter() {
		
	 if($this->LoginSpeakerId!=''){ $sub_query = ' where A.Id = '.$this->LoginSpeakerId.' '; }	
	 $query = "select A.Id as Id,A.Name as Name from ".TBL_SPEAKERS." A ".$sub_query."  group by A.Id ";
	 $speaker_rS = dB::mExecuteSql($query);	
	
	 foreach($speaker_rS as $Key=>$Val) {
	 $Speaker_Arr['Id']=$Val->Id;
	 $Speaker_Arr['Name']=$Val->Name;
	   $query = "select A.Id as Id,A.Name as Name,A.Email as Email,B.MajorType, B.Topic,B.SpeakerId,B.Description,B.ChairPersons, B.WorkshopTopic as WorkshopTopic,date_format(B.TopicDate,'%D %M, %Y') as TopicDate,B.TopicTime as TopicTime from ".TBL_SPEAKERS." as A, ".TBL_SPEAKERS_PGM." as B where ( B.SpeakerId = A.Id  or B.ChairPersons like '%;".$Val->Id.";%' or B.ChairPersons like '%;".$Val->Id."' ) and A.Id=".$Val->Id . ' order by B.TopicDate, B.Position';
	   
	 //echo '<hr>';
		$rS= dB::mExecuteSql($query);	$cnt=0;		
		if(is_array($rS))
		foreach($rS as $K=>$V)
		 {
		   $ChairPersons_Arr = explode(';',$V->ChairPersons); 
		   if($V->SpeakerId==$V->Id) {
		   if($V->MajorType=='W') {
		   $Topics[$cnt]['TName']=$V->WorkshopTopic;
		   $Topics[$cnt]['TType']='Workshop';
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   if($V->MajorType=='O') {
		   $Topics[$cnt]['TName']=$V->Topic;
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TType']='Speaker';
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   } 
		   if(in_array($V->Id,$ChairPersons_Arr)   ) {
		   if($V->MajorType=='O') {
			   
		   if($V->Topic!='' && $V->SpeakerId>0) {
		   if(strstr($V->Topic,'Orator'))    {
		   $Topics[$cnt]['TName']=$V->Topic;
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TType']='Introduction';
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
			   
			   
		   }else {
		   $Topics[$cnt]['TName']=$V->Topic;
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TType']='Chair';
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   }
		   
		   if($V->Description=='Competition Papers') {
		   
		   $Topics[$cnt]['TName']=$V->Topic;
		   $Topics[$cnt]['TDate']=$V->TopicDate;
		   $Topics[$cnt]['TType']='Papers';
		   $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   
		   }
		   }
		   
		   
		   }
		   if($V->SpeakerId==0) {

		   if($V->Topic=='Interactive Cases') {
		    $Topics[$cnt]['TType']='IC';
			$Topics[$cnt]['TDesc']=$V->Description ;
		    $Topics[$cnt]['TName']=$V->Topic;
		    $Topics[$cnt]['TDate']=$V->TopicDate;
		    $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   
		   if($V->Topic=='ISVIR Gold Medal Awards') {
		    $Topics[$cnt]['TType']='Awards';
			$Topics[$cnt]['TName']=$V->Topic;
			$Topics[$cnt]['TDesc']=$V->Description ;
		    $Topics[$cnt]['TDate']=$V->TopicDate;
		    $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		   
		  
		   if($V->Topic=='ISVIR Gold  Medal  Awards') {
		    $Topics[$cnt]['TType']='Awardee Introduction';
			$Topics[$cnt]['TName']=$V->Topic;
			$Topics[$cnt]['TDesc']=$V->Description ;
		    $Topics[$cnt]['TDate']=$V->TopicDate;
		    $Topics[$cnt]['TTime']=$V->TopicTime;$cnt++;
		   }
		  
		   
		   
		   }
		   
		
		 }
		 
		
		 $topicsarr= array();
		 if(count($Topics)>0)
		 foreach($Topics as $K1=>$V1) {
		 if($V1['TType']=='Speaker') {
		   $topicsarr['Speaker'][]=$V1;
		  }
		   if($V1['TType']=='Introduction') {
		   $topicsarr['Oration'][]=$V1;
		  }
		 if($V1['TType']=='Chair') {
		   $topicsarr['Chair'][]=$V1;
		  }
		 if($V1['TType']=='IC') {
		   $topicsarr['IC'][]=$V1;
		  } 
		  
		  if($V1['TType']=='Papers') {
		   $topicsarr['Papers'][]=$V1;
		  }
		 
		 
		 if($V1['TType']=='Workshop') {
		   $topicsarr['WS'][]=$V1;
		  }
		  
		  		 if($V1['TType']=='Awards') {
		   $topicsarr['Awards'][]=$V1;
		  }
		  
		   if($V1['TType']=='Awardee Introduction') {
		   $topicsarr['Awardee Introduction'][]=$V1;
		  }
		 }
		 $Speaker_Arr['Topic']=$topicsarr;
		 $Topics = array();
		 $Speakers[]=$Speaker_Arr;
		 $Speaker_Arr=array();
		 }

	
	 foreach($Speakers as $K=>$V) {
	 $content='';
	 if(count($V['Topic'])>0) {
		
	
if(is_array($V['Topic']['Introduction'])) {
$V1 = $V['Topic']['Introduction'];
 $content .= '<br />You are requested to <b>introduce  </b> <br /> ';
 foreach($V1 as $k=>$v) {
 $content .= '<b>'.$v['TName'].'</b><br />
Date: '.$v['TDate'].'<br />
Time: '.$v['TTime'].'<br />
';
 }

} 
 


if(is_array($V['Topic']['Speaker'])) {
$V1 = $V['Topic']['Speaker'];
 if(count($V1)>1) {
 $content .= '<br />You are requested to <b>give a guest speech on the following topics</b> <br /> <ul>'; } else
 $content .= 'You are requested to <b>give a guest speech on the following topic </b> <ul>';
 foreach($V1 as $k=>$v) {
 $content .= '<li style="padding-left:10px;">Topic:  <b>'.$v['TName'].'</b><br />
Date: '.$v['TDate'].'<br />
Time: '.$v['TTime'].'<br />
</li>';
 }
$content .= '</ul>';

}


if(is_array($V['Topic']['Chair'])) {
$V1 = $V['Topic']['Chair'];
 if(count($V1)>1) {
 $content .= '<br />You are requested to <b>introduce the topic and  chair the session for the topics</b> <br /> '; } else
 $content .= '<br />You are requested to  <b>introduce the topic and  chair the session for the topic</b> <br /> ';
 foreach($V1 as $k=>$v) {
 $content .= ' Topic:  <b>'.$v['TName'].'</b><br />
Date: '.$v['TDate'].'<br />
Time: '.$v['TTime'].'<br />
';
 }

} 
 

if(is_array($V['Topic']['WS'])) {
$V1 = $V['Topic']['WS'];

 
 foreach($V1 as $k=>$v) {
	 $content .= 'You are requested to give a <b>guest speech on '.$V1[0]['TName'].'</b> and <b>training on the same during hands-on training</b> on <br />';
     $content .=' Date: '.$v['TDate'].'<br />
    Time: '.$v['TTime'].'<br />';
 }

} 


if(is_array($V['Topic']['Awardee Introduction'])) {
$V1 = $V['Topic']['Awardee Introduction'];

 $content .= '<br />You are requested to  introduce <b>'.$V1[0]['TDesc'].' </b> during the ISVIR Gold Medal Awards Function on <br /> Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'<br /><br />';

} 

if(is_array($V['Topic']['Awards'])) {
$V1 = $V['Topic']['Awards'];

 $content .= '<br />You are requested to<b> preside the ISVIR Gold Medal Awards Function</b> on <br /> Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'<br /><br />';

} 



if(is_array($V['Topic']['IC'])) {
$V1 = $V['Topic']['IC'];
 $content .= '<br />You are requested to <b>moderate the interactive case discussions </b>on the topics <br /> <ul>'; 
  foreach($V1 as $k=>$v) {
	  print_r($v);
	 
 $content .= '<li><b>Topics</b> : <br />'. 
$v['TDesc'] .' <br />
Date: '.$v['TDate'].'<br />
Time: '.$v['TTime'].'</li>';
$content .= '<br/>';
  }
 $content .= '</ul>';
// exit();

} 

if(is_array($V['Topic']['Papers'])) {
$V1 = $V['Topic']['Papers'];

 $content .= '<br />You are requested to <b>evaluate the competion papers session by being a judge</b> on <br /> <ul><li>
'.'
Date: '.$V1[0]['TDate'].'<br />
Time: '.$V1[0]['TTime'].'</li></ul>';

} 





	}
	
	}



	$content = str_replace('<br>','<br />',$content);

	return $content;



}


function updateSpeakerPPT() {
		
	if($this->Id) $sub_qry = " Id= ".$this->Id;
	if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	$query="update ".TBL_SPEAKERS_PGM." set File = '".$this->File."' ".$sub_qry;	
	return dB::updateSql($query);
	
}	
	
	
/*You are requested to give a guest speech on 
"EMBOLIZATION" and training on the same during hands-on training on Feb 15th, 

7:00am to 9:00 am.

You are requested to introduce the topic and  chair the session for the topic " " on  " " 

from " " to "" 

You are requested to speak on the topic " " on " " from " " to  " " 

You are requested to moderate the interactive case discussions on the topics

1)
2)

on "  " from " " to ""


You are requested to evaluate the competion papers session by being a judge on " " 

from " " to " "

Indian:
Also, please note that Organizing Committee of ISVIR will take care of your 

accomodation during your stay in Coimbatore for ISVIR 2013 Annual Conference.

For:
Please note that Organizing Committee of ISVIR will take care of your accomodation 

and domestic travel expenses  during your stay in Coimbatore for ISVIR 2013 Annual 

Conference . Kindly contact us if you need any more documents for clearance of your 

VISA for India.
";*/

	function getFacultyDtlByautosuggest() {
		
		if($this->qry_string!='') $sub_qry[] =" `Name` LIKE '%".($this->qry_string)."%' ";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='')  $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' or ',$sub_qry).$sort_qry;
		$query="select ".$this->fields." from ".TBL_SPEAKERS." ".$subqry;	
		return dB::mExecuteSql($query);

	}
	
	function updateSpeakerReason() {
		if($sub_qry!='') $sub_qry = " where ".$sub_qry;
	    $query="update ".TBL_SPEAKERS." set Reason = '".$this->Reason."' where Id='".$this->speaker_id."' ".$sub_qry;	
		return dB::updateSql($query);
		
	}
	
	function isFacultyRegistered() {
		
		
		$query = "select count(*) as Total from ".TBL_REGISTRATION." where FacultyId=".$this->FacultyId;
		$rs=dB::sExecuteSql($query);		
		return ($rs->Total>0)?true:false;
		
		
	}
	
		
	function getRegistrationId() {
			
		$query = "select Id from ".TBL_REGISTRATION." where FacultyId=".$this->FacultyId;
		$rs=dB::sExecuteSql($query);	
		if(is_object($rs))	
		return $rs->Id;
	}
		
	function update_facultybyfield() {
	
			  $query=" update ".TBL_SPEAKERS." set `".$this->field."` = '".$this->fieldvalue."' where `Id`='".$this->fac_id."'";
			return dB::updateSql($query);
		}
	
		

	
  }
?>