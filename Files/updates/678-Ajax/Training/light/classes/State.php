<?
class State
{
	//check already exist or not
	function checkIfExist()
	{
		$query = "SELECT * FROM " . TBL_STATE . " WHERE state_name = '$this->state_name'";
		return dB::sExecuteSql($query);		
	}
	
	//insert new state via ajax
	function insertState()
	{
		echo $query = "INSERT INTO ". TBL_STATE ." (state_name) VALUES ('$this->state_name')";
		return dB::insertSql($query);
	}
	
	//update state
	function updateState()
	{
		$query = "UPDATE ". TBL_STATE ." SET state_name = '$this->state_name' WHERE state_id = '$thia->state_id'";
		return dB::updateSql($query);
	}
	
	
	
	
	//insert new state via js
	function insertStateJs()
	{
		$query = "INSERT INTO ". TBL_STATE ." (state_name) VALUES ('$this->state_name')";
		dB::insertSql($query);
	}

	

}

?>