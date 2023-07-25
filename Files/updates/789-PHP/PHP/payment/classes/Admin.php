<?
class Admin
{

	static function getAdmin($username,$password) {
	 	 $admin_qry ="select * from `".TBL_NEWSET."` where admin_username = '".$username."' and admin_password = '".$password."'";
		return $rs_exists = dB::sExecuteSql($admin_qry);
		//if($rs_exists->id>0) return 1; else return 0;
	}
	
	static function getAllAdminDtl() {
		$query = "SELECT * FROM `".TBL_NEWSET."` ";
		return $rs=dB::sExecuteSql($query);
	}

}
