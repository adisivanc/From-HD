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

	function mSelectHash($Sql){
		$Resource = mysql_query($Sql);	
		return db::rowsToHash($Resource);
		}
   
	function sSelectHash($Sql){
		$Resource = mysql_query($Sql);	
		return db::rowToHash($Resource);
		}

   
	function rowsToHash($result)
	{
		if (mysql_num_rows($result)==0)
			return false;
			
		$ret = array();
		$j=0;		
		while($thisrow=mysql_fetch_row($result))
		{
			$i = 0;
			while ($i < mysql_num_fields($result)) 
			{
				$meta = mysql_fetch_field($result, $i);
				$ret[$j][$meta->name] = $thisrow[$i];
				$i++;
			}
			$j++;
		}
		return $ret;
	}
	
	function rowToHash($result)
	{
		global $logger;
		if (mysql_num_rows($result)==0)
		{
			return false;
		}
		
		$i = 0;
		$ret = mysql_fetch_row($result);
		while ($i < mysql_num_fields($result)) 
		{
			$meta = mysql_fetch_field($result, $i);
			$ret[$meta->name] = $ret[$i];
			$i++;
		}
		return $ret;	
	}
	
	function SelectFilter($table,$fields="*",$where="",$order_by="",$order="ASC",$limit=1000,$offset=0)
	{
		$sql = "SELECT " . $fields . " FROM " . $table;
		if ($where != "")
		{
			$sql = $sql + " WHERE " . $where;
		}
		if ($order_by != "")
		{
			$sql = $sql + " ORDER BY " . $order_by . " " . $order;
		}
		$sql = $sql + " LIMIT " . $limit;
		if ($offset != "")
		{
			$sql = $sql + " OFFSET " . $offset;
		}
		$result = mysql_query($sql) or die(mysql_error());
		return $result;
	}	
		
}
?>