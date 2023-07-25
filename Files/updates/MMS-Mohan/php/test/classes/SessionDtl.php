<?
 		
  class Session
  {
     var $Id;
	 var $Title;
	 var $SubTitle;
	  var $SessionDate;

	function insertSessionCat()
	{
		
				
		$query="INSERT INTO `".TBL_SESSION_CAT."` (`PersonType`,`SessionCategory`,`Hall`,`Title`,`SubTitle`,`SessionDate`,`FromTime`,`ChairPerson`,`ToTime`,`AddedDate`) VALUES ('$this->PersonType','$this->SessionCategory','$this->Hall','$this->Title','$this->SubTitle','$this->SessionDate','$this->FromTime','$this->ChairPerson','$this->ToTime','$this->AddedDate')";			
		$insertId=dB::insertSql($query);
		return $insertId; 
 
		
	}
	
	function getSessionCatDtl() {
		
		
		if($this->Title!='') $sub_qry[] ="`Title`='".$this->Title."'";
		if($this->CatId!='') $sub_qry[] ="`CatId`='".$this->CatId."'";
		if($this->id!='') $sub_qry[] .= " Id=".$this->id;
		if($this->SessionDate!='') $sub_qry[] .= " SessionDate='".$this->SessionDate."'";
		if($this->fields=='') $this->fields="*, date_format(`FromTime`, '%h:%i %p') as SessionFromTime ,date_format(`ToTime`, '%h:%i %p') as SessionToTime ";
		if($this->sortby!='')  $sort_qry = " order by ".$this->FromTime.' '.$this->sortby;
		if($this->groupby!='') $group_qry = " group by ".$this->groupby;
		if($this->sorderby!='NO') $rs_orderby = " order by `SessionDate` , `FromTime`";
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$group_qry.$sort_qry;
	    $query="select ".$this->fields." from ".TBL_SESSION_CAT." ".$subqry.$rs_orderby;	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}

	
	function updateSessionCat()
	{
		
		$query="Update ".TBL_SESSION_CAT." set  `PersonType`='".$this->PersonType."',`SessionCategory`='".$this->SessionCategory."',`Hall`='".$this->Hall."',`Title`='".$this->Title."',`SubTitle`='".$this->SubTitle."',`SessionDate`='".$this->SessionDate."',`FromTime`='".$this->FromTime."',`ToTime`='".$this->ToTime."',`ChairPerson`='".$this->ChairPerson."', `UpdatedDate`='".$this->UpdatedDate."' where `Id`='".$this->session_id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	function delSessionCat(){
	 	$query="delete from ".TBL_SESSION_CAT." where Id  ='".$this->id."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	
	}
	
	
	
	
	
	function insertSession()
	{
		
	$query="INSERT INTO `".TBL_SESSION."` (`Hall`,`CatId`,`FacultyId`,`Title`,`SessionDate`,`FromTime`,`ToTime`,`AddedDate`) VALUES ('$this->Hall','$this->CatId','$this->FacultyId','$this->Title','$this->SessionDate','$this->FromTime','$this->ToTime','$this->AddedDate')";			
		$insertId=dB::insertSql($query);
		return $insertId; 
		
	}
	
	function getSessionDtl() {
		
		
		if($this->FacultyId!='') $sub_qry[] .= "( FacultyId = '".$this->FacultyId."' or (FacultyId LIKE '%,".$this->FacultyId.",%' or FacultyId LIKE '%,".$this->FacultyId."' or FacultyId LIKE '".$this->FacultyId.",%') ) ";
		if($this->Title!='') $sub_qry[] ="`Title`='".$this->Title."'";
		if($this->SessionDate!='') $sub_qry[] ="`SessionDate`='".$this->SessionDate."'";
		if($this->inid!='') $sub_qry[] .= "Id IN (".$this->inid.") ";
		if($this->id!='') $sub_qry[] .= "Id=".$this->id;
		if($this->CatId!='') $sub_qry[] .= "CatId=".$this->CatId;
		if($this->qry_string!='') $sub_qry[] ="`Title`like '%".$this->qry_string."%'  ";
		if($this->fields=='') $this->fields="*, date_format(`FromTime`, '%h:%i %p') as SessionFromTime ,date_format(`ToTime`, '%h:%i %p') as SessionToTime ";
		if($this->sortby!='')  $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if($this->groupby!='') $group_qry = " group by ".$this->groupby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$group_qry.$sort_qry;
		$query="select ".$this->fields." from ".TBL_SESSION." ".$subqry;	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}

	
	function updateSession()
	{
		
		$query="Update ".TBL_SESSION." set  `CatId`='".$this->CatId."',`Hall`='".$this->Hall."',`FacultyId`='".$this->FacultyId."',`Title`='".$this->Title."',`SessionDate`='".$this->SessionDate."',`FromTime`='".$this->FromTime."',`ToTime`='".$this->ToTime."', `UpdatedDate`='".$this->UpdatedDate."' where `Id`='".$this->Id."'";
		
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	function delSession(){
	 	$query="delete from ".TBL_SESSION." where Id  ='".$this->id."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	
	}
	
	
	function getsessionforcat() {
	 	$query="select *,date_format(`FromTime`, '%h:%i %p') as SessionFromTime ,date_format(`ToTime`, '%h:%i %p') as SessionToTime from ".TBL_SESSION." where CatId  ='".$this->CatId."' order by `FromTime`";
	    return db::mExecuteSql($query);
	
	}
	
	
	
	function insertChairpersons()
	{
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
				
		$query="INSERT INTO `".TBL_CHAIRPERSONS."` (`FacultyId`,`TalkId`,`Type`,`AddedDate`) VALUES ('$this->FacultyId','$this->TalkId','$this->Type','$sqlDateTime')";			
		$insertId=dB::insertSql($query);
		return $insertId; 
 
		
	}
	
	function getChairpersonsDtl() {
		
		if($this->TalkId!='') $sub_qry[] .= " ( TalkId = '".$this->TalkId."' or (TalkId LIKE '%,".$this->TalkId.",%' or TalkId LIKE '%,".$this->TalkId."' or TalkId LIKE '".$this->TalkId.",%') ) ";	
		if($this->id!='') $sub_qry[] .= " Id=".$this->id;
		if($this->Type!='') $sub_qry[] .= " Type=".$this->Type;
		if($this->FacultyId!='') $sub_qry[] .= " FacultyId='".$this->FacultyId."'";
		if($this->fields=='') $this->fields="*";
		if($this->groupby!='') $group_qry = " group by ".$this->groupby;
		if($this->sortby!='')  $sort_qry = " order by ".$this->orderby.' '.$this->sortby;
		if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry).$group_qry.$sort_qry;
	    $query="select ".$this->fields." from ".TBL_CHAIRPERSONS." ".$subqry.$rs_orderby;	
		if($this->id=='')
		return dB::mExecuteSql($query);			
		else
		return dB::sExecuteSql($query);	
	}

	
	function updateChairpersons()
	{
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		$query="Update ".TBL_CHAIRPERSONS." set  `FacultyId`='".$this->FacultyId."',`TalkId`='".$this->TalkId."',`Type`='".$this->Type."', `UpdatedDate`='".$sqlDateTime."' where `Id`='".$this->chairper_id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	function delChairpersons(){
	 	$query="delete from ".TBL_CHAIRPERSONS." where Id  ='".$this->id."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	
	}
	
	
	
}
?>