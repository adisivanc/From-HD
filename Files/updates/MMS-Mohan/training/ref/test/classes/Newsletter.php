<?
	class Newsletter{
		
	function Newsletter(){}
		
	static function insertNewsletter($name,$subject,$content,$url)
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="INSERT INTO `".TBL_NEWSLETTER."` (`name`,`subject`,`content`,`url`,`created_date`) VALUES ('$name','$subject','$content','$url','$sqlDateTime')";			
		$insertId=dB::insertSql($query);
		return $insertId;
	 } 

	static function updateNewsletter($name,$subject,$content,$url,$nid)
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="Update ".TBL_NEWSLETTER." set  `name`='".$name."',`subject`='".$subject."',`content`='".$content."',`url`='".$url."' , `modified_date`= '".$sqlDateTime."' where `id`='".$nid."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
	
	}
	
	static function getNewsletterDtl($id){
		
		$query = "SELECT * FROM `".TBL_NEWSLETTER."` where `id` ='".$id."' ";
		return $rs=dB::sExecuteSql($query);
	}
	
	static function getAllNewsletterDtl($field,$fieldvalue){
		
		if($fieldvalue=='Schedule' || $fieldvalue=='Sent' || $fieldvalue=='Draft'){
			$sub_qry="where `status`='".$fieldvalue."' ";
		}else{
			$sub_qry="where 1=1 ";
		}
		
		$query = "SELECT * FROM `".TBL_NEWSLETTER."` ".$sub_qry." order by created_date desc ";
		return dB::mExecuteSql($query);	
	}
	
	static function delNewsletter($id){
	 	$query="delete from ".TBL_NEWSLETTER." where id  ='".$id."'";
	    $Res_del = db::deleteSql($query);
	    return $Res_del;
	
	}
	 
	static function updateNewsletterByField($field,$fieldvalue,$id){
		
		$query = "update ".TBL_NEWSLETTER." set `".$field."`='".$fieldvalue."' where `id`=".$id." ";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
		
	}
	
	static function insertNewsletterMailLog($newsletter_id,$email_id,$sent_on,$user_group,$from_address,$subject)
	{
	
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="INSERT INTO `".TBL_NEWSLETTER_MAILLOG."` (`newsletter_id`,`email_id`,`sent_on`,`user_group`,`from_address`,`subject`) VALUES ('$newsletter_id','$email_id','$sent_on','$user_group','$from_address','$subject')";			
		$insertId=dB::insertSql($query);
		return $insertId;
	 } 
	 
	function insertNewsletterLog()
	{

	  $query="INSERT INTO `".TBL_NEWSLETTER_LOG."` (`newsletter_id`,`members`,`add_book`,`created_date`) VALUES ('$this->newsletter_id','$this->members','$this->add_book','$this->created_date')";			
	$insertId=dB::insertSql($query);
		return $insertId;
	 } 
	
	function updateStatus()
	{
	   
		$query="Update ".TBL_NEWSLETTER." set  `status`='".$status."' where `id`='".$id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
		
	}
	
	function updateNewsletterLogStatus()
	{
	   
		$query="Update ".TBL_NEWSLETTER_LOG." set  `sent`='".$this->sent."',`modified_date`='".$this->modified_date."' where `id`='".$this->id."'";
		$rs_Upd = dB::updateSql($query);
		return $rs_Upd; 
		
	}
	
	
	}
?>