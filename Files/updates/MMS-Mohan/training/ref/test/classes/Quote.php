<?
  class Quote
  {

	static function insertQuote($name,$email,$phone,$location,$type,$budget){
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="INSERT INTO `".TBL_QUOTE."`(`name`, `email`, `phone`, `location`, `type`, `budget`, `created_date`) VALUES ('$name', '$email', '$phone', '$location', '$type', '$budget','$sqlDateTime')";
		$insertId=dB::insertSql($query);
		if($insertId>0) {
			Quote::sentQuoteToAdmin($name,$email,$phone,$location,$type,$budget);
			return $insertId; } return 0;
		
	}
	
	static function updateQuote($name,$email,$phone,$location,$type,$budget,$qid)
	{
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="Update `".TBL_QUOTE."` set `name`='$name',`email`='$email',`phone`='$phone',`location`='$location',`type`='$type',`budget`='$budget',`modified_date`='$sqlDateTime' where `id`=".$qid;	
		
		$updateId=dB::updateSql($query);
		if($updateId) {
		return $updateId; } return 0;
	}
	
	static function getQuoteById($id){
		$query = "SELECT * FROM `".TBL_QUOTE."` where id ='".$id."'";
		$rs=dB::sExecuteSql($query);return $rs->name;
	}
	
  	static function update_Quotebyfield($field,$fieldvalue,$qid) {
	
		$query=" update ".TBL_QUOTE." set ".$field." = '".$fieldvalue."' where `id`='".$qid."'";
		return dB::updateSql($query);
	}
	
	
	static function deleteQuote($qid) {
		 $query = "DELETE FROM `".TBL_QUOTE."` where id=".$qid;
		 dB::deleteSql($query);
	}

	
	function sentQuoteToAdmin($name,$email,$phone,$location,$type,$budget)
	{
		
		$Subject="[ConferenceLogistics] Quote Details ";
		
		$Message = " Dear Admin,<br /><br />";
		$Message .= " The new Quote has been submited , Details listed below,<br /> Name : ".$name." <br /> Email : ".$email." <br /> Phone : ".$phone." <br /> Location : ".$location." <br /> Type : ".$type." <br /> Budget : ".$budget."   ";
		//echo $Message;
		
		$body = eregi_replace("[\]", '', $Message);
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "From:".$name." <".$email.">\n";
		
	    //@mail('karthik@mmsprojects.com', $Subject, $body, $headers);
		@mail('info@conferencelogistics.in', $Subject, $Message, $headers);
		@mail('enquiry@conferencelogistics.in', $Subject, $Message, $headers);
		
	}

 }
?>