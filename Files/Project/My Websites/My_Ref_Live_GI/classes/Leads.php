<? 
class Leads {

//TBL_AIRPORTS   TBL_AIRPORT_CAR_FARE   TBL_CARS
static function getLeads($params=array()) {
	
	if(count($params)>0) foreach($params as $K=>$V){ 
	  $tempArr =explode('-',$V);
	   $$K=$V;
	  if(count($tempArr)==2) {
	  $field = $K;
	  $fieldval = $tempArr[0];
	  $fieldType = $tempArr[1];
	  if($fieldType=='INT' || $fieldType=='' || $fieldType=='ENUM' || $fieldType=='CHAR') $sub_qry[]="`$field`=".$fieldval;
	  if($fieldType=='STRING') $sub_qry[]="`$field` like '%".$fieldval."%'";
	  if($fieldType=='DATE') $sub_qry[]="`$field` = '".date_format('Y-m-d',$fieldval)."'";
	  }
	}
	if($orderby!='') { 	if($sortby=='') $sortby='ASC'; 	$sort_qry = " order by ".$orderby.' '.$sortby; 	}
	if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
	if(count($fieldsArr)==0) $fields='*'; else $fields=implode(',',$fieldsArr);
	 $query="select ".$fields." from ".TBL_LEADS." $subqry $sort_qry";
	if($id=='')	return dB::mExecuteSql($query);
	return dB::sExecuteSql($query);
}


static function getLeadName($params=array()) {
	if(count($params)>0) foreach($params as $K=>$V) $$K=$V;
	if($state!='') $sub_query = " and state = '$state' ";
    $query="select * from ".TBL_LEADS." where (name like '%$name%' or code like '%$code%')" .$sub_query;
	$rs = dB::mExecuteSql($query);
	return $rs;
}

static function leadAlreadyExists($email_address) {
  $rsLead = Leads::getLeads(array('email_address'=>$email_address.'-STRING'));
  if(count($rsLead)>0) return $rsLead[0]->id;
  return 0;	
}

static function insertLead($params=array()) {
	ini_set('display_error',1);
	if(count($params)>0) foreach($params as $K=>$V){ if($V!='') {
		$$K=$V; 
		$fieldArr[]=$K;} 
	}
	foreach($fieldArr as $K=>$V) $fieldVal[] = "'".$$V."'";
	$leadId=0;
	if($email!='-')	$leadId = Leads::leadAlreadyExists($email);
	if($leadId>0) {
      return "Error1::Lead Already Exists::".$leadId;  	
	} else {
		 $query = "insert into ".TBL_LEADS."( ".implode(',',$fieldArr).",added_date) 
						   values (".implode(',',$fieldVal).",'".date('Y-m-d H:i:s',time())."')";
		$leadId= dB::insertSql($query);		if($leadId>0)	{ 
		return "Success::Successfully added::".$leadId;
	}
	else return "Error2::Something is wrong with database connection.";
	}
}



static function updateLead($params=array()) {
	if(count($params)>0) foreach($params as $K=>$V){ $$K=$V; if($K!='company_id') $updateFields[]=$K; }
	foreach($updateFields as $K=>$V) $subQry[] = "`".$V."`='".$$V."'";
	$uptFields = implode(',',$subQry);				 
	 $query = "update ".TBL_LEADS." set ".$uptFields." where id =$company_id ";
	$affectedRows = dB::updateSql($query);
	if($affectedRows>0)	return "Success::Successfully updated::".$company_id;
	else return "Success::".$affectedRows." rows affected::".$company_id;
}

static function SetStatus($leadId,$status) {
	 $query = "update ".TBL_LEADS." set `status`='$status'
											 where id =$leadId ";
	$affectedRows = dB::updateSql($query);
}




static function getLeadFollowups($params=array()) {
	
	if(count($params)>0) foreach($params as $K=>$V){ 
	  $tempArr =explode('-',$V);
	   $$K=$V;
	  if(count($tempArr)==2) {
	  $field = $K;
	  $fieldval = $tempArr[0];
	  $fieldType = $tempArr[1];
	  if($fieldType=='INT' || $fieldType=='' || $fieldType=='ENUM' || $fieldType=='CHAR') $sub_qry[]="`$field`=".$fieldval;
	  if($fieldType=='STRING') $sub_qry[]="`$field` like '%".$fieldval."%'";
	  if($fieldType=='DATE') $sub_qry[]="`$field` = '".date_format('Y-m-d',$fieldval)."'";
	  }
	}
	if($orderby!='') { 	if($sortby=='') $sortby='ASC'; 	$sort_qry = " order by ".$orderby.' '.$sortby; 	}
	if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);
	if(count($fieldsArr)==0) $fields='*'; else $fields=implode(',',$fieldsArr);
	$query="select ".$fields." from ".TBL_LEAD_FOLLOWUP." $subqry $sort_qry";
	if($id=='')	return dB::mExecuteSql($query);
	return dB::sExecuteSql($query);
}


static function insertLeadFollowup($params=array()) {
	if(count($params)>0) foreach($params as $K=>$V){ if($V!='') {
		$$K=$V; 
		if($K=='followup_date') $$K = date('Y-m-d',strtotime($V));
		if($K!='followup_id')$fieldArr[]=$K;} 
	}
	
	foreach($fieldArr as $K=>$V) $fieldVal[] = "'".$$V."'";
	  $query = "insert into ".TBL_LEAD_FOLLOWUP."( ".implode(',',$fieldArr).",added_date) 
						   values (".implode(',',$fieldVal).",'".date('Y-m-d H:i:s',time())."')";
		$leadId= dB::insertSql($query);		if($leadId>0)	{ 
		return "Success::Successfully added::".$leadId;
	}
	else return "Error2::Something is wrong with database connection.";

}



static function updateLeadFollowup($params=array()) {
	if(count($params)>0) foreach($params as $K=>$V){ $$K=$V; 
	if($K=='followup_date') $$K=date('Y-m-d',strtotime($V));
	if($K!='followup_id') $updateFields[]=$K; }
	foreach($updateFields as $K=>$V) $subQry[] = "`".$V."`='".$$V."'";
	$uptFields = implode(',',$subQry);				 
	 $query = "update ".TBL_LEAD_FOLLOWUP." set ".$uptFields." where id =$followup_id ";
	$affectedRows = dB::updateSql($query);
	if($affectedRows>0)	return "Success::Successfully updated::".$company_id;
	else return "Success::".$affectedRows." rows affected::".$company_id;
}



	static function deleteFollowup($followupId){
		$query = "delete from ".TBL_LEAD_FOLLOWUP." where id=$followupId";
		return dB::deleteSql($query);
	}

}
?>