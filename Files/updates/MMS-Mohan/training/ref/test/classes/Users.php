<?
  class User
  {
     
	 var $username;
	 var $password;
	  
	
	function checkUser()
	{
		$admin_qry ="select * from `".TBL_USERS."` where username= '".$this->username."' and password  = '".$this->password."' and active='Y' ";
		return  $adminRes=dB::sExecuteSql($admin_qry);
	}
	  
	static function getUsertDtl($userId){
		$query="select * from ".TBL_USERS." where Id=".$userId." ";
		$rs=dB::sExecuteSql($query);
		return $rs;
	}
	
	static function getAllUserDtls($tabval){
		
		if($tabval!=''){
			$subqry = "where `user_type`='".$tabval."' ";
		}
		
		$query="select * from ".TBL_USERS." ".$subqry." ";
		$rs=dB::mExecuteSql($query);
		return $rs;
	}
	
	static function insertUser($name,$company_name,$username,$password ,$user_type,$emailaddress,$phone)
	{
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="INSERT INTO `".TBL_USERS."`(`name`, `company_name`, `username`, `password`, `user_type`, `emailaddress`, `phone`,`created_date`) VALUES ('$name', '$company_name', '$username', '$password', '$user_type', '$emailaddress', '$phone','$sqlDateTime')";
		$insertId=dB::insertSql($query);
		if($insertId>0) {
		return $insertId; } return 0;
	}
	
	static function updateUser($name,$company_name,$username,$password ,$user_type,$emailaddress,$phone,$aid)
	{
		
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		$query="Update `".TBL_USERS."` set `name`='$name', `company_name`='$company_name', `username`='$username', `password`='$password', `user_type`='$user_type', `emailaddress`='$emailaddress', `phone`='$phone',`modified_date`='$sqlDateTime' where `Id`=".$aid;	

		$updateId=dB::updateSql($query);
		if($updateId>0) {
		return $updateId; } return 0;
	}

	static function deleteUser($UId){
		$query="delete from  ".TBL_USERS." where Id  ='".$UId."'";
		db::deleteSql($query);
		
	}
	
	function update_Userbyfield() 
	{
		$query=" update ".TBL_USERS." set ".$this->field." = '".$this->fieldvalue."' where `Id`='".$this->Id."'";
		return dB::updateSql($query);
	}
  
  
  }
?>