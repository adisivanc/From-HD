<?
  class SubscribeNewsletter
  {

	  
	static function getSubscribeNewslettertDtl($SId){
		$query="select * from ".TBL_SUBSCRIBE_NEWSLETTER." where id=".$SId." ";
		$rs=dB::sExecuteSql($query);
		return $rs;
	}
	
	static function chkEmailExist($email){
		$query="select * from ".TBL_SUBSCRIBE_NEWSLETTER." where subscribe_email='".$email."' ";
		return $rs=dB::sExecuteSql($query);
	}
	
	static function getAllSubscribeNewsletterDtls(){
		$query="select * from ".TBL_SUBSCRIBE_NEWSLETTER." ";
		$rs=dB::mExecuteSql($query);
		return $rs;
	}
	
	static function insertSubscribeNewsletter($subscribe_email)
	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="INSERT INTO `".TBL_SUBSCRIBE_NEWSLETTER."`(`subscribe_email`,`created_date`) VALUES ('$subscribe_email','$sqlDateTime')";
		$insertId=dB::insertSql($query);
		if($insertId>0) {
		return $insertId; } return 0;
	}
	
	static function deleteSubscribeNewsletter($SId){
		$query="delete from  ".TBL_SUBSCRIBE_NEWSLETTER." where id  ='".$SId."'";
		db::deleteSql($query);
		
	}
	
	function update_SubscribeNewsletterbyfield() {
	
		$query=" update ".TBL_SUBSCRIBE_NEWSLETTER." set ".$this->field." = '".$this->fieldvalue."' where `id`='".$this->SId."'";
		return dB::updateSql($query);
	}
  
  
  }
?>