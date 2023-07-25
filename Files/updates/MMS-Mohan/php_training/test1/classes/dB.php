<?

class dB{
	
	function dB(){
	}
	
	function insertSql($Sql){
		mysql_query($Sql);	
		return mysql_insert_id() ;
	}
	
	function updateSql($Sql){
		mysql_query($Sql);	
		return mysql_affected_rows() ;
	}
	
	function deleteSql($Sql){
		mysql_query($Sql);	
		return mysql_affected_rows() ;
	}
	
	function sExecuteSql($Sql){
		$Resource = mysql_query($Sql);	
		$Row = @mysql_fetch_object($Resource) ;
		@mysql_free_result($Resource);
		return $Row ;
	}
	
	function mExecuteSql($Sql){
		$Resource = mysql_query($Sql);	
		while($Row = @mysql_fetch_object($Resource)) {$Rs[] = $Row;}
		@mysql_free_result($Resource);
		return $Rs ;
	}

   function getNumRows($Sql) {
 		$Resource = mysql_query($Sql);	
		$rowCount= mysql_num_rows($Resource);
		@mysql_free_result($Resource);
		return $rowCount;
   }		
	
}

?>