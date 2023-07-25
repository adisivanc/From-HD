 <?php

class DatabaseConnection
{
	var $dbconn;
	var $BA_DBHOST = BA_DBHOST;
	var $BA_DBUSER = BA_DBUSER;
	var $BA_DBPASSWORD = BA_DBPASSWORD;
	var $BA_DBNAME = BA_DBNAME;
	
	function DatabaseConnection()
	{
		$link = mysql_connect($this->BA_DBHOST, $this->BA_DBUSER, $this->BA_DBPASSWORD);
		if($link){
			$this->dbconn = $link;
			mysql_select_db ($this->BA_DBNAME,$link);
		}else{
			echo mysql_error();
			$this->dbconn = false;
		}
	}
	
	function Select($sql)
	{
		$result = mysql_query($sql) or die(mysql_error());
		return $this->rows_to_hash($result);
	}
	
	function SelectOne($sql)
	{
		$result = mysql_query($sql) or die(mysql_error());
		return $this->row_to_hash($result);
	}	
	
	function TotalCount($table)
	{
		$sql = "SELECT count(*) from " . $table;
		mysql_query($sql) or die(mysql_error());
		
	}
	
	function Execute($sql)
	{
		$result = mysql_query($sql) or die(mysql_error());
		return $result;
	}
	
	function rows_to_hash($result)
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
	
	function row_to_hash($result)
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
		
	function Close()
	{
		mysql_close($this->dbconn);
	}
   
   function __destruct() 
   {
       $this->Close();
   }	
	

} // class DatabaseConnection

$dbconn = new DatabaseConnection();

?>
