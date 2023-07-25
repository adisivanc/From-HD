<?
	class Newsletter{
		
	function Newsletter(){}
		
	function insertNewsletter()
	{

	 $query="INSERT INTO `".TBL_NEWSLETTER."` (`Name`,`Subject`,`Content`,`Url`,`Added_Date`) VALUES ('$this->Name','$this->Subject','$this->Content','$this->Url','$this->AddedDate')";			
	$insertId=dB::insertSql($query);
		return $insertId;
	 } 

	function updateNewsletter()
	{
	
	 $query="Update ".TBL_NEWSLETTER." set  `Subject`='".$this->Subject."',`Name`='".$this->Name."',`Content`='".$this->Content."',`Url`='".$this->Url."' , `Updated_Date`= '".$this->Updated_Date."' where `Id`='".$this->Id."'";
	$rs_Upd = dB::updateSql($query);
	return $rs_Upd; 
	
	}

	function delNewsletter(){
	 	$query="delete from ".TBL_NEWSLETTER." where Id  ='".$this->Id."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	
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
		$query="select ".$this->fields." from ".TBL_NEWSLETTER_CONTACT." ".$subqry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
	
	function getNewsletterDtl() {
	
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
	    $query="select ".$this->fields." from ".TBL_NEWSLETTER." ".$subqry.$sort_qry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
	function updateStatus()
	{
	   
		$query="Update ".TBL_NEWSLETTER." set  `Status`='".$this->Status."' where `Id`='".$this->Id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
		
	}
	function insertNewsletterLog()
	{

	  $query="INSERT INTO `".TBL_NEWSLETTER_LOG."` (`newsletter_id`,`members`,`AddSchedule`,`created_date`) VALUES ('$this->newsletter_id','$this->members','$this->AddSchedule','$this->created_date')";			
	$insertId=dB::insertSql($query);
		return $insertId;
	 } 

  function getNewsletterLogDtl() {
	
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		if($this->newsletter_id!='') $sub_qry[] .= " newsletter_id=".$this->newsletter_id;
		if($this->sent!='') $sub_qry[] ="`sent`='".$this->sent."'";
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		  $query="select ".$this->fields." from ".TBL_NEWSLETTER_LOG." ".$subqry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
	function updateNewsletterLogStatus()
	{
	   
		$query="Update ".TBL_NEWSLETTER_LOG." set  `Sent`='".$this->Sent."',`last_updated_date`='".$this->last_updated_date."' where `Id`='".$this->Id."'";
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
	
	}
?>