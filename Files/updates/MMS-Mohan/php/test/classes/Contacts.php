<?
  class Contacts
  {
     
	var $Name;
	var $MobileNo;
	var $EmailAddress;
	var $Institute;
	  
	 function Contact()
	 {
		$this->Name=$Name;
		$this->MobileNo=$MobileNo;
		$this->EmailAddress=$EmailAddress;
		$this->Institute=$Institute;
	 }    
	 
	 function insertContact()
	 {
		 $today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
			
		$query="INSERT INTO `".TBL_CONTACTS."` (`Name`,`MobileNo`,`EmailAddress`,`Institute`,`AddedDate`) VALUES ('$this->Name','$this->MobileNo','$this->EmailAddress','$this->Institute','$sqlDateTime')";			
		$insertId=dB::insertSql($query);
		return $insertId;
		
	  }

	
	function getContactDtl()
	{
		
		if($this->Name!='') $sub_qry[] ="`Name`LIKE '%".$this->Name."%'";
		if($this->EmailAddress!='') $sub_qry[] ="`EmailAddress`LIKE '%".$this->EmailAddress."%'";
		if($this->Id!='') $sub_qry[] .= " Id=".$this->Id;
		//if($this->Name!='') $sub_qry[] .= " Name=".$this->Name;
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
		 $query="select ".$this->fields." from ".TBL_CONTACTS." ".$subqry.$sort_qry;	
		if($this->Id=='')
			return dB::mExecuteSql($query);			
		else
			return dB::sExecuteSql($query);	
	}
	
	function CheckifEmailExists()
	{
		$query = "select EmailAddress from ".TBL_CONTACTS." where EmailAddress='".$this->EmailAddress."'";	
		if($this->Id!='')
		{
		$query= "select * from ".TBL_CONTACTS." where Id  NOT IN ('".$this->Id."') AND EmailAddress ='".$this->EmailAddress."'";
		}
		return dB::getNumRows($query);
	}

  }
?>