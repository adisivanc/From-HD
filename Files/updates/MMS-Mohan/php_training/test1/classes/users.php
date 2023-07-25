<?

class Users{
	
	var $uName; 
	var $uUsername; 
	var $uPassword; 
	var $uEmail; 
	var $uMobile; 
	var $uStatus; 
	
	
	function insertUser(){
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		
		$query = "INSERT INTO users(`name`,`username`,`password`,`email`,`mobile_number`,`status`,`created_date`) VALUES ('$this->uName','$this->uUsername','$this->uPassword','$this->uEmail','$this->uMobile','$this->uStatus','$sqlDateTime')";
		$insertId=dB::insertSql($query);
		
		if($insertId>0){
			return $insertId;
		}
		return 0;
	}
	
	
	function getallTestimonialList()
	{
		$query = "SELECT * FROM `users` ORDER BY id desc";
		return dB::mExecuteSql($query);
	}
	
	
	
	
	
	
	
	
}

?>