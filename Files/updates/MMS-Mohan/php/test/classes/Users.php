<?
class Users
{
     
	 var $FirstName;
	 var $LastName;
	 var $Email;
	 var $Company;
	 var $Type;
	 var $Phone;
	  
	 function Users($email='', $password='')
	 {
	    $this->email=$email;
		$this->password=$password;
	 }    
	
	//insert User using ajax
	function insertUser()
	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="INSERT INTO `".TBL_REGISTRATION."` (`FirstName`,`MiddleName`,`LastName`,`Password`,`EmailAddress`,`Gender`,`Designation` ,`Institute`,`Address`,`City`,`State`,`ZipCode`,`Country`,`Mobile`,`TotalAmount`,`PackageType`,`PackagePrize`,`DateOfArrival`,`DateOfDepature`,`Nights`,`AddedDate`) VALUES ('$this->FirstName','$this->MiddleName','$this->LastName','$this->Password','$this->EmailAddress','$this->Gender','$this->Designation','$this->Institute', '$this->Address','$this->City','$this->State','$this->ZipCode','$this->Country','$this->Mobile','$this->TotalAmount','$this->type','$this->amount','$this->DateOfArrival','$this->DateOfDepature','$this->Nights','$sqlDateTime')";			
		
		$insertId=dB::insertSql($query);
		
		if($insertId>0) {
		//$this->sendNotificationEmailtoAdmin();
		return $insertId; } return 0;
	
	}
	
	
	function update_newusers()
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		$query="Update ".TBL_REGISTRATION." set  `PackageType`='".$this->type."',`PackagePrize`='".$this->amount."',`FirstName`='".$this->FirstName."',`MiddleName`='".$this->MiddleName."',`LastName`='".$this->LastName."',`Password`='".$this->Password."',`Gender`='".$this->Gender."',`Designation`='".$this->Designation."',`Institute`='".$this->Institute."',`Address`='".$this->Address."',`City`='".$this->City."',`State`='".$this->State."',`ZipCode`='".$this->ZipCode."',`Country`='".$this->Country."',`Mobile`='".$this->Mobile."',`EmailAddress`='".$this->EmailAddress."',`TotalAmount`='".$this->TotalAmount."',`DateOfArrival`='".$this->DateOfArrival."',`DateOfDepature`='".$this->DateOfDepature."',`Nights`='".$this->Nights."',`LastUpdated`='".$sqlDateTime."' where `Id`='".$this->id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	
	function update_regusers()
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		$query="Update ".TBL_REGISTRATION." set  `FirstName`='".$this->FirstName."',`MiddleName`='".$this->MiddleName."',`LastName`='".$this->LastName."',`Password`='".$this->Password."',`Gender`='".$this->Gender."',`Designation`='".$this->Designation."',`Institute`='".$this->Institute."',`Address`='".$this->Address."',`City`='".$this->City."',`State`='".$this->State."',`ZipCode`='".$this->ZipCode."',`Country`='".$this->Country."',`Mobile`='".$this->Mobile."',`EmailAddress`='".$this->EmailAddress."',`DateOfArrival`='".$this->DateOfArrival."',`DateOfDepature`='".$this->DateOfDepature."',`Nights`='".$this->Nights."',`LastUpdated`='".$sqlDateTime."' where `Id`='".$this->id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	
	function getAllUserDtl() {
	
		if($this->ChkPaid!='') $sub_qry[] .= "Paid='".$this->ChkPaid."' ";
		if($this->OccupancyType!='') $sub_qry[] .= "OccupancyType='".$this->OccupancyType."' ";
		if($this->Name!='') $sub_qry[] =" ( `FirstName` LIKE '%".($this->Name)."%' or `LastName` LIKE  '%".($this->Name)."%' ) ";
		if($this->PaymentThrough!='') $sub_qry[] ="`PaymentThrough`='".$this->PaymentThrough."'";
		if($this->accomodationamt!='') $sub_qry[] ="`AccommodationAmount`>".$this->accomodationamt."";
		if($this->EmailAddress!='') $sub_qry[] ="`EmailAddress`='".$this->EmailAddress."'";
		if($this->Password!='') $sub_qry[] ="`Password`='".$this->Password."'";
		if($this->id!='') $sub_qry[] .= " Id=".$this->id;
		if($this->searchName_id!='') $sub_qry[] .= " Id=".$this->searchName_id;
		if($this->facultyid!='') $sub_qry[] .= " FacultyId=".$this->facultyid;
		if($this->PackageType!='') $sub_qry[] ="`PackageType`='".$this->PackageType."'";
		if($this->City!='') $sub_qry[] ="`City`!='".$this->City."'";
		if($this->RId!='') $sub_qry[] .= " Id=".$this->RId;
		if($this->RType=='Paid') $sub_qry[] ="`Paid`='Y' and `RegistrationFee`!='F' and `Cancel_Registration`='N'";
		if($this->RType=='Free') $sub_qry[] ="`RegistrationFee`='F' and `Cancel_Registration`='N'";
		if($this->RType=='Total') $sub_qry[] ="`Paid`='Y' and `Cancel_Registration`='N'";
		if($this->RType=='Cancel') $sub_qry[] ="`Cancel_Registration`='Y'";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		$query="select ".$this->fields." from ".TBL_REGISTRATION." ".$subqry.$groupby_qry;	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}
	
	
	function CheckifEmailExists()
	{
		$query = "select * from `".TBL_REGISTRATION."` where EmailAddress='".$this->EmailAddress."' and Paid='Y' and PaymentThrough!='C'";	
		return dB::getNumRows($query);
	}
	
	function CheckifRegistered()
	{
		$query = "select * from `".TBL_REGISTRATION."` where EmailAddress='".$this->EmailAddress."' and (Paid='Y' or (Paid='N' and  PaymentThrough='C' and BankName!='') )";	
		return dB::sExecuteSql($query);	
	}

	function getRegistrationID() {
		$query = "select Id, EmailAddress from `".TBL_REGISTRATION."` where EmailAddress='".$this->EmailAddress."' and Paid='N'";	
		return dB::sExecuteSql($query);
			
			
	}
	
	function delNewUser(){
	
		$query="delete from ".TBL_REGISTRATION." where Id  ='".$this->user_id."'";
		$Res_del = db::deleteSql($query);
		return $Res_del;
	
	}

	
	function update_userbyfield() {
	
		$query=" update ".TBL_REGISTRATION." set ".$this->field." = '".$this->fieldvalue."' where `Id`='".$this->user_id."'";
		return dB::updateSql($query);
	}
	
	
	function updtae_itinerary()
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
	
		if($this->id>0){
			$query="Update ".TBL_REGISTRATION." set  `DateOfArrival`='".$this->DateOfArrival."',`DateOfDepature`='".$this->DateOfDepature."',`ArrivalTime`='".$this->ArrivalTime."',`DepartureTime`='".$this->DepartureTime."',`ArrivalType`='".$this->ArrivalType."',`DepartureType`='".$this->DepartureType."',`ArrivalFlightNumber`='".$this->ArrivalFlightNumber."',`ArrivalTrainNumber`='".$this->ArrivalTrainNumber."',`DepartureFlightNumber`='".$this->DepartureFlightNumber."',`DepartureTrainNumber`='".$this->DepartureTrainNumber."',`LastUpdated`='".$sqlDateTime."' where `Id`='".$this->id."'";
			$rs_Upd = dB::updateSql($query);
		}else{
			$query="Update ".TBL_REGISTRATION." set  `DateOfArrival`='".$this->DateOfArrival."',`DateOfDepature`='".$this->DateOfDepature."',`ArrivalTime`='".$this->ArrivalTime."',`DepartureTime`='".$this->DepartureTime."',`ArrivalType`='".$this->ArrivalType."',`DepartureType`='".$this->DepartureType."',`ArrivalFlightNumber`='".$this->ArrivalFlightNumber."',`ArrivalTrainNumber`='".$this->ArrivalTrainNumber."',`DepartureFlightNumber`='".$this->DepartureFlightNumber."',`DepartureTrainNumber`='".$this->DepartureTrainNumber."',`LastUpdated`='".$sqlDateTime."' where `FacultyId`='".$this->FId."'";
			$rs_Upd = dB::updateSql($query);
		}
		return $rs_Upd; 
	}
	
	function updtae_itinerarytime()
	{
		if($this->id>0){
			$query="Update ".TBL_REGISTRATION." set  `arrivaltime_format`=str_to_date('".$this->ArrivalTime1."','%h:%i:%p'),`departuretime_format`=str_to_date('".$this->DepartureTime1."','%h:%i:%p') where `Id`='".$this->id."'";
			$update =dB::updateSql($query);
		}else{
			$query="Update ".TBL_REGISTRATION." set  `arrivaltime_format`=str_to_date('".$this->ArrivalTime1."','%h:%i:%p'),`departuretime_format`=str_to_date('".$this->DepartureTime1."','%h:%i:%p') where `FacultyId`='".$this->FId."'";
			$update =dB::updateSql($query);
		}
		return $update; 
	}
	
	
	function sendNotificationEmailtoAdmin()
	{
	
			$Users_obj = new Users();
			$Users_obj->id =$this->id;
			$user_det=$Users_obj->getAllUserDtl();
			
			if($user_det->CheckNumber!=''){
			
				$ChequeDtl = '<strong>Cheque No </strong>: '.$user_det->CheckNumber.' <br />';
			}
	
			if($user_det->PackageType=='C'){
				$rs_packagetype='Consultant';
			}elseif($user_det->PackageType=='S' || $user_det->PackageType=='SF'){
				$rs_packagetype='Student';
			}
			
			if($user_det->PackagePrize>0){
				$PackagePrizeDtl = ' <br /> <strong>Package Prize</strong> : '.$user_det->PackagePrize.' ';
			}else{
				$PackagePrizeDtl = '';
			}
			
			if($user_det->AccomodationFee>0){
				$AccomodationDtl = ' <br /> <strong>Accommodation Amount</strong> : '.$user_det->AccomodationFee.' ';
			}else{
				$AccomodationDtl = '';
			}
			
			if($user_det->ReductionAmount>0){
				$ReductionDtl = ' <br /> <strong>Reduction Amount</strong> : '.$user_det->ReductionAmount.' ';
			}else{
				$ReductionDtl = '';
			}
			
			if($user_det->BankName!=''){
				$BankDtl = '<br /> <strong>Bank Name</strong> : '.$user_det->BankName.' <br /> ';
			}else{
				$BankDtl = '';
			}
			
			if($user_det->PackageType!='SF'){
				if($user_det->TotalAmount>0){
					$TotalDtl = '<br /> <strong>Total Amount</strong> : '.$user_det->TotalAmount.' ';
				}else{
					$TotalDtl = '<br /> <b>Free Registration</b>';
				}
			
			
				if($user_det->OccupancyType!='N/A'){
					
					if($user_det->OccupancyType=='S'){
						$OccupancyType='Single Occupancy';
					}elseif($user_det->OccupancyType=='D'){
						$OccupancyType='Double Occupancy';
					}elseif($user_det->OccupancyType=='T'){
						$OccupancyType='Triple Occupancy';
					}elseif($user_det->OccupancyType=='TW'){
						$OccupancyType='Twin Occupancy';
					}
					$OccupancyTypeDtl = ' <br /> <strong>Occupancy Type</strong> : '.$OccupancyType.' ';
				}else{
					$OccupancyTypeDtl = '';
				}
				
			}
			//MAIL TO ADMIN
			$subject = "[WIO13] Registration Details for National Conference of Women's Imaging 2013";
			$message = '
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td>Dear Admin <br /> <br /></td>
			</tr>
			<tr>
			<td>A new member has been <strong>registered via cheque</strong> successfully, details below, <br /> </td>
			</tr>
			<tr>
			<td><strong>Registration Id </strong>: #'.$user_det->Id.' <br />  <strong>Name</strong> : '.$user_det->FirstName.' <br /> <strong>EmailAddress</strong> : '.$user_det->EmailAddress.'</td>
			</tr>
			<tr>
			<td> <strong>Registration Type</strong> : <strong> '.$rs_packagetype.'</strong> </td>
			</tr>
			<tr>
			<td>'.$BankDtl.' '.$ChequeDtl.''.$OccupancyTypeDtl.''.$PackagePrizeDtl.''.$AccommodationDtl.''.$ReductionDtl.' '.$TotalDtl.'</td>
			</tr>
			
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Best, </td>
			</tr>
			<tr>
			<td>Kavitha Rajan<br />Online Co-ordinator<br />WIO13</td>
			</tr>
			</table>
			';
			
			$headers = "From: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n"; 
			
			$headers .= "Reply-To: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
			$headers .= "Return-Path: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: WI 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";
			
			$mail             = new PHPMailer();
			$mail->IsHTML(true);
			$mail->From       = "kavitharjn@womensimagingindia.com";
			$mail->FromName   = "Online Co-ordinator";
			$mail->Subject    = $subject;
			$mail->MsgHTML($message);
			$mail->AddReplyTo('kavitharjn@womensimagingindia.com', 'Online Co-ordinator');
			$mail->AddAddress('kavitharjn@gmail.com','kavitharjn@gmail.com');
			$mail->AddAddress('karthik@mmsprojects.com','karthik@mmsprojects.com');
			$mail->Send();
	
	}
	
	
	
	function getAllRegisterDetail($argvs=array()) {
	
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
		
		//pagination
		$retCountOnly = $COUNT == 1 ;
		$start = (int)$start ;
		$limit = (int)$limit ;
		$paging = '' ;		
		if($limit>0)
		{
			$paging = 'LIMIT ' . $start . ', ' . $limit ;
		}	
		
		
		$subQry='';
		
		
		if($SAddedFromDate!='') $SAddedFromDate = date('Y/m/d',strtotime($SAddedFromDate));
		if($SAddedToDate!='') $SAddedToDate = date('Y/m/d',strtotime($SAddedToDate));
		
		if($SAddedFromDate!='' && $SAddedToDate!='')
			$subQry = " and DATE_FORMAT(AddedDate, '%Y/%m/%d') between '$SAddedFromDate' and '$SAddedToDate'";
		elseif($SAddedFromDate!='' && $SAddedToDate=='')
			$subQry = " and DATE_FORMAT(AddedDate, '%Y/%m/%d') >= '$SAddedFromDate'";
		elseif($SAddedFromDate=='' && $SAddedToDate!='')
			$subQry = " and DATE_FORMAT(AddedDate, '%Y/%m/%d') <= '$SAddedToDate'";
		
		//home page search
		
		if($SCType!='' && $SCType=='Last 5 Days') {
		
			$TodaysDate = date('Y-m-d',time());	//todays date
			$subQry = " and DATEDIFF('$TodaysDate', DATE_FORMAT(AddedDate,'%Y-%m-%d')) < '5'";
		
		}
		elseif($SCType!='' && $SCType=='Date Range') {
		
			if($SCAddedFromDate!='') $SCAddedFromDate = date('Y/m/d',strtotime($SCAddedFromDate));
			if($SCAddedToDate!='') $SCAddedToDate = date('Y/m/d',strtotime($SCAddedToDate));
			
			if($SCAddedFromDate!='' && $SCAddedToDate!='')
			$subQry .= " and DATE_FORMAT(AddedDate, '%Y/%m/%d') between '$SCAddedFromDate' and '$SCAddedToDate'";
			elseif($SCAddedFromDate!='' && $SCAddedToDate=='')
			$subQry .= " and DATE_FORMAT(AddedDate, '%Y/%m/%d') >= '$SCAddedFromDate'";
			elseif($SCAddedFromDate=='' && $SCAddedToDate!='')
			$subQry .= " and DATE_FORMAT(AddedDate, '%Y/%m/%d') <= '$SCAddedToDate'";
		}elseif($SCType!='' && $SCType=='Fname'){
			$subQry .= " and FirstName like '%".$first_name."%'";
		}elseif($SCType!='' && $SCType=='SEmail'){
			$subQry .= " and EmailAddress like '%".$Email."%'";
		}
		elseif($SCType!='' && $SCType=='SRId'){
			$subQry .= " and Id = '".$Id."'";
		}
		elseif($SCType!='' && $SCType=='SSRId'){
			$subQry .= " and Id = '".$PId."'";
		}
		elseif($SCType!='' && $SCType=='SRegId'){
			$subQry .= " and Id = '".$PId."'";
		}
		if($user_type!='')  $Qry_UserType = "and MemberType='$user_type'";	
		
		if($RegistrationType!='' && $RegistrationType=='S') {
		
			if($RDate!='') $RDate = date('Y/m/d',strtotime($RDate));
			$Qry_UserType .=  " and RegistrationType ='".$RegistrationType."'";
			if($RDate!='')	$Qry_UserType .= " and DATE_FORMAT(RegistrationDate, '%Y/%m/%d') = '$RDate'";
		}
		if($RegistrationType!='' && $RegistrationType=='F'){
			$Qry_UserType .= " and RegistrationType ='".$RegistrationType."'";
		}
		
		if($PaymentThrough!='') $Qry_UserType .= "and PaymentThrough='$PaymentThrough'";			//from index - show contacts except Subscriber
		
		if($accom_type!='') $Qry_AccoType = "and Accommodation='$accom_type'";
		
		
		if($CheckNumber=='Yes')	$subQry .= " and CheckNumber !='' ";
		
		if($CheckNumber=='No')	$subQry.= " and CheckNumber ='' ";	
		if($BankName=='Yes')	$subQry .= " and BankName !='' ";
		
		if($pendingtype=='YES')	$subQry.= " and  (BankName='') ";	
		
		if($paymenttype=='YES')	$subQry.= " and  ( PaymentThrough='C' and BankName!='' ) ";	
		if($Arrivaltype=='X')	$subQry.= " and  Arrivaltype!='X'";	
		if($Arrivaltype=='yes')	$subQry.= " and  Arrivaltype='X'";	

		
		if($subQry!='')
		$qryBuilt = ' WHERE 1 '.$subQry;
		else
		$qryBuilt = ' WHERE 1 ';
		
		if($Qry_UserType!='') $qryBuilt  = $qryBuilt.$Qry_UserType.$Qry_AccoType;
		$subQry;
		
		if($COUNT==1) {
			  $qryListSSRegistration = "select count(*) as Total from ".TBL_REGISTRATION.$qryBuilt;
			return $Rs->Total = dB::sExecuteSql($qryListSSRegistration);	
		}
		else
		{
			
			if($SCType!='' && $SCType=='SRId'  && $Id!='')
			{
				$qryListSSRegistration = "select * from ".TBL_REGISTRATION.$qryBuilt." order by Id Desc ".$paging;	
			}
			else if($type==1)
			{
				$qryListSSRegistration = "select * from ".TBL_REGISTRATION.$qryBuilt." order by Id Desc ".$paging;	
			}
			else
			{
				$qryListSSRegistration = "select * from ".TBL_REGISTRATION.$qryBuilt." and Paid='$paid_type' order by Id Desc ".$paging;	
			}
			
			return $Rs = dB::mExecuteSql($qryListSSRegistration);	
		
		}
	
	}
	
	
	function update_userDDdetails()
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="Update ".TBL_REGISTRATION." set  `OfficeUseBankName`='".$this->OfficeUseBankName."',`OfficeUseChequeNo`='".$this->OfficeUseChequeNo."',  `OfficeUseAmount`='".$this->OfficeUseAmount."',`OfficeUseChequeDate`='".$this->OfficeUseChequeDate."',`LastUpdated`='".$sqlDateTime ."' where `Id`='".$this->user_id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	
	function update_userBankdetails()
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);

		$query="Update ".TBL_REGISTRATION." set  `BankName`='".$this->BankName."',`CheckNumber`='".$this->CheckNumber."',`TotalAmount`='".$this->TotalAmount."',`LastUpdated`='".$sqlDateTime ."' where `Id`='".$this->user_id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	
	function sendConfirmMailToUsers(){
	
		$user_obj = new Users();
		$user_obj->id = $this->user_id;
		$user_Dtl = $user_obj->getAllUserDtl();


		$Subject="[WIO13] Congratulations Your Payment Received";
		$siteEmail="info@womensimagingindia.com";
		
		$headers = "From: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n"; 
		$headers .= "Reply-To: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
		$headers .= "Return-Path:  Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
		$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
		$headers .= "Organization: WIO13\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
		$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
		$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";
		
		$Message = " Dear ".$user_Dtl->FirstName." ".$user_Dtl->LastName.",<br /><br />";
		$Message .= "Congratulations, your account has been activated. We have received your cheque ( <strong>No :</strong> ".$user_Dtl->OfficeUseChequeNo."  <strong>Dated :</strong> ".date('M d,Y',strtotime($user_Dtl->OfficeUseChequeDate))."    <strong>Bank :</strong> ".$user_Dtl->OfficeUseBankName." ) for the amount of Rs.".number_format($user_Dtl->OfficeUseAmount,2,'.','')." If you do have any technical queries, please dont hesitate to contact Kavitha Rajan @ <a href='mailto:kavitharjn@womensimagingindia.com'>kavitharjn@womensimagingindia.com</a><br /><br /> ";
		
		$Message .= 'Thank You,<br /><br />Kavitha Rajan<br />Online Co-ordinator';
		
		$mail             = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-ordinator";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		$mail->AddReplyTo('kavitharjn@womensimagingindia.com', 'Online Co-ordinator');
     	$mail->AddAddress($user_Dtl->EmailAddress,$user_Dtl->EmailAddress);
	    //$mail->AddAddress('kavitharjn@gmail.com', 'kavitharjn@gmail.com');
	    $mail->Send();
	
		
		
	
		$NameDtl=array();
	
		$NameDtl = explode('.',$user_Dtl->FirstName);
		$Name2 = strtoupper($NameDtl[1]);
		$MiddleName = strtoupper($user_Dtl->MiddleName);
		$LastName = strtoupper($user_Dtl->LastName);
		
		$subject="[WIO13] Important Announcements Regarding WIO13.";
		$mail  = new PHPMailer();
		
		ob_start();	
		include '../announcement.php';	
		$body = ob_get_contents();

		
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-Ordinator";
		$mail->Subject    = $subject;
		$mail->MsgHTML($body);
		//$mail->AddAddress('karthik@mmsprojects.com', 'karthik@mmsprojects.com');
		//$mail->AddAddress($user_Dtl->EmailAddress,$user_Dtl->EmailAddress);
		//$mail->Send(); 
		
	
	}
	
	
	function getTotalAmount(){
	
		$query ="select sum(TotalAmount) as totalamount,count(*) as total from ".TBL_REGISTRATION." where Paid ='Y'";
		$rs = dB::sExecuteSql($query);
		return $rs;
		
	}
	
	function fun_sendmailtopendingusers()
	{
	$user_obj=new Users();
    $user_obj->id=$this->Id;
    $res_user=$user_obj->getAllUserDtl();

		if($this->from=='kavitharjn@womensimagingindia.com')
	    {
	    $from='Online Co-ordinator';
	    }
	  	 $siteEmail="info@womensimagingindia.com";
	    $headers = "From:  ".$from." < ".$this->from." > \r\n"; 
		$headers .= "Reply-To: ".$from." < ".$this->from." > \r\n";
		$headers .= "Return-Path: ".$from." <".$this->from." > \r\n";
		$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
		$headers .= "Organization: SISNM 2013\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
		$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
		$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";
	    $Subject=$this->subject;
		
	    $mail             = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-ordinator";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($this->content);
		$mail->AddReplyTo('kavitharjn@womensimagingindia.com', 'Online Co-ordinator');
		//$mail->AddAddress('karthik@mmsprojects.com', 'karthik@mmsprojects.com');
     	$mail->AddAddress($res_user->EmailAddress,$res_user->EmailAddress);
	    $mail->Send();

	}
	
	function RegisterFaculty()
	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		 $query="INSERT INTO `".TBL_REGISTRATION."` (`FirstName`,`EmailAddress`,`Password`,`Designation`,`Address`,`IsFaculty`,`CouponName`,`FacultyId`,`RegistrationFee`,`Paid`,`TotalAmount`,`PaymentThrough`,`AddedDate`, `OccupancyType`,`PackageType`,`PackagePrize`) VALUES ('$this->FirstName','$this->EmailAddress','12345','$this->Designation', '$this->Address','$this->Isfaculty','$this->CouponName','$this->FacultyId','$this->RegistrationFee','$this->Paid','0','$this->PaymentThrough','$sqlDateTime','$this->OccupancyType','$this->PackageType','$this->PackagePrize')";			
//exit();
		$insertId=dB::insertSql($query);
		if($insertId>0) {
		return $insertId; } return 0;
	
	}
	

	function sendThankyoumailToUsers()
	{
	
		$reg_obj = new Users();
		$reg_obj->id = $this->RId;
		$rs_RegistrationDtl = $reg_obj->getAllUserDtl();
		
		$from = 'info@womensimagingindia.com';
		$Subject="[WIO13] Thank you for your Registration";
		
		
		ob_start();
		include 'thankyoumail.php';	
		$message = ob_get_contents();
		
		$mail  = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-Ordinator";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($message);
		//$mail->AddAddress('karthik@mmsprojects.com', 'karthik@mmsprojects.com');
		$mail->AddAddress($rs_RegistrationDtl->EmailAddress,$rs_RegistrationDtl->EmailAddress);
		$mail->Send();
		
	}
	
	
	function sendAccomodationEmailtoAdmin()
	{
	
			$Users_obj = new Users();
			$Users_obj->id =$this->id;
			$user_det=$Users_obj->getAllUserDtl();
			
			if($user_det->CheckNumber!=''){
			
				$ChequeDtl = '<strong>Cheque No </strong>: '.$user_det->CheckNumber.' <br />';
			}
	
			if($user_det->PackageType=='C'){
				$rs_packagetype='Consultant';
			}elseif($user_det->PackageType=='S'){
				$rs_packagetype='Student';
			}
			
			if($user_det->ReductionAmount>0){
				$ReductionDtl = ' <br /> <strong>Reduction Amount</strong> : '.$user_det->ReductionAmount.' ';
			}else{
				$ReductionDtl = '';
			}
			
			if($user_det->OccupancyType!='N/A'){
				
				if($user_det->OccupancyType=='S'){
					$OccupancyType='Single Occupancy';
				}elseif($user_det->OccupancyType=='D'){
					$OccupancyType='Double Occupancy';
				}elseif($user_det->OccupancyType=='T'){
					$OccupancyType='Triple Occupancy';
				}elseif($user_det->OccupancyType=='TW'){
					$OccupancyType='Twin Occupancy';
				}
				$OccupancyTypeDtl = ' <br /> <strong>Occupancy Type</strong> : '.$OccupancyType.' ';
			}else{
				$OccupancyTypeDtl = '';
			}
			
			//MAIL TO ADMIN
			$subject = "[WIO13] Accommodation Details for National Conference of Women's Imaging 2013";
			$message = '
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td>Dear Admin <br /> <br /></td>
			</tr>
			<tr>
			<td>A new member has been <strong>updated via cheque</strong> successfully, details below, <br /> </td>
			</tr>
			<tr>
			<td><strong>Registration Id </strong>: #'.$user_det->Id.' <br />  <strong>Name</strong> : '.$user_det->FirstName.' <br /> <strong>EmailAddress</strong> : '.$user_det->EmailAddress.'</td>
			</tr>
			<tr>
			<td> <strong>Registration Type</strong> : <strong> '.$rs_packagetype.'</strong> </td>
			</tr>
			<tr>
			<td><strong>Bank Name</strong> : '.$user_det->BankName.' <br /> '.$ChequeDtl.'<br />'.$OccupancyTypeDtl.'<br /><strong>Package Prize : </strong>'.$user_det->PackagePrize.'<br /><strong>Accommodation Amount : </strong>'.$user_det->AccomodationFee.''.$ReductionDtl.'<br /> <strong>Total Amount</strong> : '.$user_det->TotalAmount.' </td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Best, </td>
			</tr>
			<tr>
			<td>Kavitha Rajan<br />Online Co-ordinator<br />WIO13</td>
			</tr>
			</table>
			';
			
			$headers = "From: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n"; 
			
			$headers .= "Reply-To: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
			$headers .= "Return-Path: Online Co-ordinator <kavitharjn@womensimagingindia.com>\r\n";
			$headers .= "Message-ID:<".date("Y/m/d H:i:s")." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n"; 
			$headers .= "Organization: WI 2013\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
			$headers .= "X-Originating-IP: [69.160.61.146]\r\n";
			$headers .= "X-Sender-IP:  69.160.61.146\r\n";  
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html;boundary=".md5(time())." charset=iso-8859-1\r\n";
			
			$mail             = new PHPMailer();
			$mail->IsHTML(true);
			$mail->From       = "kavitharjn@womensimagingindia.com";
			$mail->FromName   = "Online Co-ordinator";
			$mail->Subject    = $subject;
			$mail->MsgHTML($message);
			$mail->AddReplyTo('kavitharjn@womensimagingindia.com', 'Online Co-ordinator');
			$mail->AddAddress('kavitharjn@gmail.com','kavitharjn@gmail.com');
			$mail->AddAddress('karthik@mmsprojects.com','karthik@mmsprojects.com');
			$mail->Send();
	
	}
	
	function sendBookingAccmailToUsers(){
		
		$Users_obj = new Users();
		$Users_obj->id =$this->RId;
		$user_Dtl=$Users_obj->getAllUserDtl();
		
		$from = 'info@womensimagingindia.com';
		$Subject = "[WIO13] Update Accommodation Details for National Conference of Women's Imaging 2013";
		
		
		$Message = " Dear ".$user_Dtl->FirstName." ".$user_Dtl->LastName.",<br /><br />";
		$Message .= " 
		In order to make your presence safe and secure, we also make arrangements for accomodation. To view more details about accomodation, please click on the link below: <br />
		<a style='cursor:pointer' target='_blank' href='".BASE_WI_URL."bookAccomodation.php'> ".BASE_WI_URL."bookAccomodation.php </a> <br /><br />
		
		if you have any questions regarding this, please email us to <a href='mailto:kavitharjn@womensimagingindia.com'>kavitharjn@womensimagingindia.com</a>.
		";
		
		$Message .= '<br /><br />Thank You,<br /><br />Kavitha Rajan<br />Online Co-ordinator';
		
		$mail  = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-Ordinator";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		//$mail->AddAddress('karthik@mmsprojects.com', 'karthik@mmsprojects.com');
		$mail->AddAddress($user_Dtl->EmailAddress,$user_Dtl->EmailAddress);
		$mail->Send();
		
	}
	
	function sendRegAlertmailToUsers(){
		
		$Users_obj = new Users();
		$Users_obj->id =$this->RId;
		$user_Dtl=$Users_obj->getAllUserDtl();
		
		$from = 'info@womensimagingindia.com';
		$Subject = "[WIO13] Payment Pending Reminder for National Conference of Women's Imaging 2013";
		
		$Message = " Dear ".$user_Dtl->FirstName." ".$user_Dtl->LastName.",<br /><br />";
		$Message .= " 
			
			Thank you for registering for the National Conference of Women's Imaging 2013 . This email is to notify you that we have not yet received your cheque for the amount of Rs.".$user_Dtl->TotalAmount."
 Kindly send the cheque as soon as possible.Only after we receive your cheque, we would be able to activate your registration.
 
		";
		
		$Message .= '<br /><br />Thank you for your co-operation,<br /><br />Best,<br />Kavitha Rajan<br />Online Co-ordinator';
		
		$mail  = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-Ordinator";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		//$mail->AddAddress('kavitharjn@gmail.com', 'kavitharjn@gmail.com');
		$mail->AddAddress($user_Dtl->EmailAddress,$user_Dtl->EmailAddress);
		$mail->Send();
		
	}
	
	function sendAlertforReg(){
		
		$Users_obj = new Users();
		$Users_obj->id =$this->RId;
		$user_Dtl=$Users_obj->getAllUserDtl();
		
		$from = 'info@womensimagingindia.com';
		$Subject = "[WIO13] Incomplete Registration Reminder for National Conference of Women's Imaging 2013";
		
		
		$Message = " Dear ".$user_Dtl->FirstName." ".$user_Dtl->LastName.",<br /><br />";
		$Message .= " 
			
			 We see that you have tried to register for the National Conference of Women's Imaging 2013. If you had any technical difficulties in completing the registration, kindly let us know.  Please email us for any further assistance.

 
		";
		
		$Message .= '<br /><br />Thank you,<br /><br />Best,<br />Kavitha Rajan<br />Online Co-ordinator';
		
		$mail  = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-Ordinator";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		//$mail->AddAddress('kavitharjn@gmail.com', 'kavitharjn@gmail.com');
		$mail->AddAddress($user_Dtl->EmailAddress,$user_Dtl->EmailAddress);
		$mail->Send();
		
	}
	
	function sendItineraryAlertmailToUsers(){
		
		$Users_obj = new Users();
		$Users_obj->id =$this->RId;
		$user_Dtl=$Users_obj->getAllUserDtl();
		
		$from = 'info@womensimagingindia.com';
		$Subject = "[WIO13] Update Itinerary Details for National Conference of Women's Imaging 2013";
		
		$key = 'ItInErArY';
		$rs_Link = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $this->RId, MCRYPT_MODE_CBC, md5(md5($key))));
		
		ob_start();
		include '../news_itinerary.php';
		$Message = ob_get_contents();
		
		$mail  = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "kavitharjn@womensimagingindia.com";
		$mail->FromName   = "Online Co-Ordinator";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		//$mail->AddAddress('karthiinfotech@gmail.com','karthiinfotech@gmail.com');
		$mail->AddAddress($user_Dtl->EmailAddress,$user_Dtl->EmailAddress);
		$mail->Send();
				
	}
	
	function getItinearyDetail($argvs=array())
	{

	    $tmpqry ='';
        if($this->adate!='') $adate = date('Y/m/d',strtotime($this->adate));
			
		if($this->DType=='Arrival' && $this->adate!='')
		{
		$tmpqry .= " and DATE_FORMAT(DateOfArrival, '%Y/%m/%d') = '$adate'";
		}
		 if($this->DType=='Departure' && $this->adate!='')
		{
		$tmpqry .= " and DATE_FORMAT(DateOfDepature, '%Y/%m/%d') = '$adate'";
		}
		 if($this->Atype!='' && $this->DType=='Arrival')
		{
		$tmpqry .= " and  ArrivalType   = '$this->Atype'";
		}
		 if($this->deptype!='' && $this->DType=='Departure')
		{
		$tmpqry .= " and  DepartureType  = '$this->deptype'";
		}
	   if($this->paid!='')
		{
		$tmpqry .= " and  Paid = '$this->paid'";
		}
		 if($this->Type!='')
		{
		$tmpqry .= " and  PackageType  = '$this->Type'";
		}
		
		if($this->name!='')
		{
		$tmpqry.="and  FirstName like '%".$this->name."%' ";
		}
	
	  	$qry="select * from ".TBL_REGISTRATION." where 1=1 ".$tmpqry."  AND   ArrivalType!='X' group by DateOfArrival";
		return  dB::mExecuteSql($qry);
	}
	
	
}
  
?>