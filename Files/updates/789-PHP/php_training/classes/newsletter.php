<?
class Registration
{

	static function insertRegistration($user_name, $password, $age, $gender, $dateofyear) {
		$addeddate = date('Y-m-d H:i:s',time());
		$query = "INSERT INTO ".TBL_CONTACT_FORM." (user_name, password, age, gender, date_of_year, added_date) VALUES ('$user_name', '".$password."', '".$age."', '".$gender."', '".$dateofyear."', '".$addeddate."')";
		return $id = dB::insertSql($query);
	}
	
	static function updateRegistration($id, $user_name, $password, $age, $gender, $dateofyear) {
		$addeddate = date('Y-m-d H:i:s',time());
		$query = "UPDATE ".TBL_CONTACT_FORM." set 
				  `user_name`='".$user_name."', 
				  `password`='".$password."', 
				  `age`='".$age."', 
				  `gender`='".$gender."', 
				  `date_of_year`='".$dateofyear."', 
				  `updated_date`= '".$addeddate."'
				 WHERE id = '".$id."'";
		return dB::updateSql($query);
		
	}
	
	static function getAllRegistrations() {
		$query = "SELECT * FROM `".TBL_CONTACT_FORM."` ";
		return $rs=dB::mExecuteSql($query);
	}
	
	static function getRegById($id) {
		$query = "SELECT * FROM `".TBL_CONTACT_FORM."` where id='$id'";
		return $rs=dB::sExecuteSql($query);  
	}
	
	
	static function delRegById($id) {
		echo $query = "DELETE FROM `".TBL_CONTACT_FORM."` where id='$id'";
		return $rs=dB::deleteSql($query);
	}
	
}