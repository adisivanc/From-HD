<?
class SubscribeNewsletter{
	
	function insertSubscribeNewsletter($name,$email_address){
		$today = time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		echo $query = "INSERT INTO `".TBL_SUBNEWSLETTER."` (`name`,`email_address`,`added_date`) VALUES('".$name."','".$email_address."','".$sqlDateTime."')";
		return dB::insertSql($query);
	}
	
	function updateSubscribeNewsletterByField($field, $fieldvalue, $id) {
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s',$today);
		echo $query = "UPDATE ".TBL_SUBNEWSLETTER." set ".$field." = '".$fieldvalue."', `updated_date`='".$sqlDateTime."' where `id`='".$id."'";
		return dB::updateSql($query);
	}
	
	function getSubscriberNewsletterById($id){
		echo $query = "SELECT * FROM `".TBL_SUBNEWSLETTER."` WHERE `id`='".$id."'";
		return db::sExecuteSql($query);
	}
}
?>