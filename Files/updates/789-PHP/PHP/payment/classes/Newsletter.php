<?
class Newsletter{
		
		
	static function insertPayType($add_paymethod) {
		$addeddate = date('Y-m-d H:i:s',time());			
		$query="INSERT INTO `".TBL_PY_TYPE."` (`pay_type`,`added_date`,`updated_date`) VALUES ('$add_paymethod','$addeddate','$addeddate')";
		$insertId=dB::insertSql($query);
		return $insertId;
	} 
		
		
	static function getAllPayType() {
		$query = "select * from `".TBL_PY_TYPE."` ";
		return dB::mExecuteSql($query);
	}
		
	
	static function insertCustDltss ($customer_address, $customer_mobile, $cust_pay_method, $customer_name) {
		$query="INSERT INTO `".TBL_PY_DETAILS."` (`address` ,`mobile` ,`pay_method` ,`customer_name`) VALUES ('$customer_address' ,'$customer_mobile' , '$cust_pay_method', '$customer_name')";
		$insertId=dB::insertSql($query);
		return $insertId;
	} 



		
	// Newsletter Functions
	function insertNewsletter() {

	 $query="INSERT INTO `".TBL_NEWSDB."` (`Name`,`Subject`,`Content`,`Url`,`SendAs`,`SendFrom`,`AddedDate`) VALUES ('$this->Name','$this->Subject','$this->Content','$this->Url','$this->SendAs','$this->SendFrom','$this->AddedDate')";			
	$insertId=dB::insertSql($query);
		return $insertId;
	} 

	function updateNewsletter() {
	
	 $query="Update ".TBL_NEWSDB." set  `Subject`='".$this->Subject."',`Name`='".$this->Name."',`SendAs`='".$this->SendAs."',`SendFrom`='".$this->SendFrom."',`Content`='".$this->Content."',`Url`='".$this->Url."' , `UpdatedDate`= '".$this->Updated_Date."' where `Id`='".$this->Id."'";
	$rs_Upd = dB::updateSql($query);
	return $rs_Upd; 
	
	}
	
	function getNewsletterbyId($id) {
		$query = "select * from `".TBL_NEWSDB."` where id = '".$id."'";
		return dB::sExecuteSql($query);
	}

	function delNewsletter(){
	 	$query="delete from ".TBL_NEWSDB." where Id  ='".$this->Id."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	
	}
	
	function UpdateNewsletterByField() {

		$query=" update ".TBL_NEWSDB." set ".$this->field." = '".$this->fieldvalue."' where `Id`='".$this->id."'";
		return dB::updateSql($query);
	}
	
	function getNewsletterContactDtl() {
	
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->Email!='') $sub_qry[] .= "Email  IN ('".$this->Email."')";
		if($this->Name!='') $sub_qry[] .= " Name=".$this->Name;
		if($this->Type!='') $sub_qry[] ="`Type`='".$this->Type."'";
		if($this->fields=='') $this->fields='*';
		if($this->groupby!='') $sort_qry = " group by ".$this->groupby;
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		$query="select ".$this->fields." from ".TBL_NEWCON." ".$subqry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
	function getNSContactByEmail($contact_email) {
		$query = "select * from `".TBL_NEWCON."` where Email = '".$contact_email."'";
		return dB::sExecuteSql($query);
	}
	
	function deleteContactFromNS($contact_email){
	 	$query="delete from `".TBL_NEWCON."` where Email='".$contact_email."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	}
	
	function getNewsletterDtl() {
	
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
	    $query="select ".$this->fields." from ".TBL_NEWSDB." ".$subqry.$sort_qry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
	function updateStatus() {
	   
		$query="Update ".TBL_NEWSDB." set  `Status`='".$this->Status."' where `Id`='".$this->Id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
		
	}
	
	function insertNewsletterLog() {

	  	$query="INSERT INTO `".TBL_NEWSDB_LOG."` (`NewsletterId`, `Members`, `AddSchedule`, `CreatedDate`) VALUES ('$this->newsletter_id','$this->members','$this->AddSchedule','$this->created_date')";			
		$insertId=dB::insertSql($query);
		return $insertId;
	} 

  	function getNewsletterLogDtl(){
	
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->newsletter_id!='') $sub_qry[] .= " NewsletterId=".$this->newsletter_id;
		if($this->email_address!='') $sub_qry[] .= " Members LIKE '%".$this->email_address."%'";
		if($this->sent!='') $sub_qry[] ="`Sent`='".$this->sent."'";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		$query="select ".$this->fields." from ".TBL_NEWSDB_LOG." ".$subqry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
		
	function updateNewsletterLogStatus() {
	   
		$query="Update ".TBL_NEWSDB_LOG." set `Sent`='".$this->Sent."',`UpdatedDate`='".$this->last_updated_date."' where `Id`='".$this->Id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
		
	}
	
	function getImportDtl() {
	
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->Type!='') $sub_qry[] .= " Type= '".$this->Type."'";
		//if($this->groupby=='Email') $group_qry .= "group by `EmailAddress`";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
	    $query="select ".$this->fields." from ".TBL_IMPORTS." ".$subqry.$group_qry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
	function updateNSLogStatus($sent, $id) {
		$today=time();
		$sqlDateTime=date('Y-m-d H:i:s',$today);
		$query="Update ".TBL_NEWSDB_LOG." set `Sent`='".$sent."',`UpdatedDate`='".$sqlDateTime."' where `Id`='".$id."'";
		return $rs_Upd = dB::updateSql($query);
	}
	
	static function deleteContactFromNSLog($contact_email, $email_type){
		
		$email_obj = new Newsletter();
		$email_obj->email_address=$contact_email;
		$rs_email = $email_obj->getNewsletterLogDtl();
		if(count($rs_email)>0) {
			foreach($rs_email as $K=>$V) {
				if($email_type!="") $unsetEmail = $contact_email."-".$email_type;
				else $unsetEmail = $contact_email; 
				$members = str_replace($unsetEmail, "", $V->Members);
				$today=time();
				$sqlDateTime=date('Y-m-d H:i:s',$today);
				$query = "UPDATE ".TBL_NEWSDB_LOG." SET `Members`='".$members."', `UpdatedDate`='".$sqlDateTime."' WHERE `Id`='".$V->Id."'";
				return $rs_Upd = dB::updateSql($query);
			}
		}
		
	}
	
}