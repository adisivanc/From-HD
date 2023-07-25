<?
class Business
{

var $Name;
var $EmailAddress;
var $Password;
var $Website;


	function insertBusiness() 	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="INSERT INTO `".TBL_BUSINESS."` (`Name`,`EmailAddress`,`Password`,`Website`,`AddedDate`) VALUES 
				('$this->Name','$this->EmailAddress','$this->Password','$this->Website','$sqlDateTime' )";			
		$insertId=dB::insertSql($query);
		return $insertId; 
	}

	function getBusinessDtl() {
		if($this->EmailAddress!='') $sub_qry[] ="  `EmailAddress`='".$this->EmailAddress."'";
		if($this->Password!='') $sub_qry[] =" BINARY `Password`='".$this->Password."'";
		if($this->id!='') $sub_qry[] .= " Id=".$this->id;
		if($this->fields=='') $this->fields='*';
		if($this->sortby!='') $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$sort_qry;
		$query="select ".$this->fields." from ".TBL_BUSINESS." ".$subqry;	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}


	function updateBusiness() {
			$today=time();
			$sqlDateTime = date('Y-m-d H:i:s',$today);
			$query="Update ".TBL_BUSINESS." set  
				   `Name`='".$this->Name."',
				   `EmailAddress`='".$this->EmailAddress."', 
				   `Website`='".$this->Website."' 
				   `UpdatedDate`='".$sqlDateTime."' where `Id`='".$this->user_id."'";
			$rs_Upd = dB::updateSql($query);
			return $rs_Upd; 
		
		}

	function updateBusinessPassword()	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="Update ".TBL_BUSINESS." set  
			   `Password`='".$this->Password."',`UpdatedDate`='".$sqlDateTime."' where `Id`='".$this->id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	}

	function CheckifEmailExists() {
		$query = "select EmailAddress from ".TBL_BUSINESS." where EmailAddress='".$this->EmailAddress."'";	
		if($this->Id!='')
		{
		$query= "select * from ".TBL_BUSINESS." where Id  NOT IN ('".$this->Id."') AND EmailAddress ='".$this->EmailAddress."'";
		}
	    if(dB::getNumRows($query)>0) return 1 ;
		return 0;
	}

	function getBusinessDtlFrmBizGiveaway() {
		$query="select * from ".TBL_BUSINESS." where Id in  
		       (select BusinessId from `".TBL_BUSINESS_GIVEAWAY."` where Id = '".$this->Id ."')";	
		return dB::sExecuteSql($query);	
	}

}
