<?
class Users
{
	function CheckIfRegistered()
	{
		echo $query = "SELECT * FROM ". TBL_REGISTRATION . " WHERE reg_email='". $this->emailaddress ."' ";
		return dB::sExecuteSql($query);
	}

}

?>
