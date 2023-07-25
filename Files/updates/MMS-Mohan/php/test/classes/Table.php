<?
class Table
{
	function Table(){}
	
	function insertRecord($argvs = array())
	{	
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
		
		/*$HierDtl = Hierarchy::selectHierarchy(serialize(array('Fields'=>array('MAX(`Position`)'))));
		$Position = $HierDtl[0]->Position + 1;
		$argvs['Position'] = $Position;*/
		
		$qryBuildArr = array() ;
		foreach($argvs as $K=>$V) {
			if(!empty($V) && $K!='TableName' && $K!='showSQL')
				$qryBuildArr[] = "`".$K."`='".$V."'" ;
		}
	
		$qryBuilt = implode(', ', $qryBuildArr);
		
		$SQL = 'INSERT INTO `'.constant($TableName).'` SET ' . $qryBuilt . ' ' ;
		
		if($showSQL=='YES'){
		echo $SQL;
		}
		$Id = dB::insertSql($SQL);
		
		
		return $Id;
	}
	
	
	function selectRecords($sval="")
	{
		if(unserialize($sval))
			$argvs = unserialize($sval);
		elseif(is_array($sval))
			$argvs = $sval;
		
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
		
		//pagination
		$retCountOnly = $COUNT == 1 ;
		$start = (int)$start ;
		$limit = (int)$limit ;
		$paging = '' ;		
		if($limit>0)
		{
			$paging = 'LIMIT ' . $start . ', ' . $limit ;
		}	
		//pagination	
		
		if(isset($Where))
		{
		//print_r($Where);
			if(empty($Condition))
				$Condition = "AND";
			$qryBuildArr = array();
			
			foreach($Where as $K=>$V)
			{
			  if(strstr($V,':::'))
			  {
				$v1 = explode(':::',$V);
				/**
				 * $qryBuildArr[] = $K." ".$v1[0]." '".$v1[1]."'";
				 * single quote removed for the value part.
				 * For Date condition.
				 */
				$qryBuildArr[] = $K." ".$v1[0]." ".$v1[1]."";
			  }
			  else
			  {
				  $qryBuildArr[] = $K."='".$V."'";
			  }
			}
			
			$qryBuilt = 'WHERE ' . implode(" $Condition ", $qryBuildArr);
		}
		
		if($subqry!='')
			$qryBuilt.=$subqry;
			
		if(isset($Group))
		{
			$qryBuilt.= ' GROUP BY '.$Group;
		}
		
		if(isset($Orderby))
		{
			if(empty($Sort))
				$Sort = "DESC";
			$qryBuilt.= ' ORDER BY '.$Orderby.' '.$Sort;
		}
		
		if(isset($Fields))
		{
			$fieldsel = "";
			foreach($Fields as $K=>$V)
			{
				if($K>0)
					$fieldsel .= ",";
				$fieldsel .= $V;
			}
		}
		else
			$fieldsel = "*";
			
		$fieldsSel = $retCountOnly ? 'COUNT(*) AS \'TOTAL\'' : $fieldsel ;

	 	  $SQL = " SELECT $fieldsSel FROM `".constant($TableName)."` ".$qryBuilt;
		
	if($showSQL=='YES'){
		echo $SQL;
		}

		if($retCountOnly)
		{
			$row = dB::sExecuteSql($SQL);
			return $row->TOTAL ;
		}
		else
		{
			$SQL = $SQL . ' '. $paging ;
			return dB::mExecuteSql($SQL);
		}
	}
	
	
	function updateRecord($sval="")
	{
		
		if(unserialize($sval))
			$argvs = unserialize($sval);
		elseif(is_array($sval))
			$argvs = $sval;
		
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
		
		
		$qryBuildArr = array() ;
		
		foreach($Values as $K=>$V) 
		{
			//if(!empty($V) && $K!='TableName')	//sat - empty values not updating
			if($K!='TableName')
				$qryBuildArr[] = "`".$K."`='".$V."'" ;
		}
		
		$qryBuilt = implode(', ', $qryBuildArr);
		
		
		if(isset($Where))
		{
			if(empty($Condition))
				$Condition = "AND";
			$qryBuildArr = array();

			foreach($Where as $K=>$V)
			{
			  if(strstr($V,':::'))
			  {
				$v1 = explode(':::',$V);
				/**
				 * $qryBuildArr[] = $K." ".$v1[0]." '".$v1[1]."'";
				 * single quote removed for the value part.
				 * For Date condition.
				 */
				$qryBuildArr[] = $K." ".$v1[0]." ".$v1[1]."";
			  }
			  else
			  {
				  $qryBuildArr[] = $K."='".$V."'";
			  }
			}
			
			$qryBuiltWhere = ' WHERE ' . implode(" $Condition ", $qryBuildArr);
		}
    else
		{
		   $qryBuiltWhere=" Where `Id` = '$Id'";
		}
		
		$SQL = " UPDATE  `".constant($TableName)."` SET  " . $qryBuilt .$qryBuiltWhere;

		if($showSQL=='YES'){
		echo $SQL;
		}
		if(dB::updateSql($SQL)){
			return true;
		}
	}
	
	
	function deleteRecord_old($argvs = array())
	{		
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);

		if($Id>0)
		{
			$SQL = " DELETE FROM `".constant($TableName)."` WHERE `Id` = '".$Id."' " ;
			
			if($showSQL=='YES'){
				echo $SQL;
			}
			if(dB::deleteSql($SQL)){
				return true;
			}
		}
	}
	
	function deleteProjectThreadRecord($argvs = array())
	{		
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);

		if($MId>0)
		{
			$SQL = " DELETE FROM `".constant($TableName)."` WHERE `MId` = '".$MId."' " ;
			
			if($showSQL=='YES'){
				echo $SQL;
			}
			
			if(dB::deleteSql($SQL)){
				return true;
			}
		}
	}


	function deleteRecord($argvs = array())
	{		
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);

//		if($Id>0)
	//	{
		
	if(isset($Where))
		{
			if(empty($Condition))
				$Condition = "AND";
			$qryBuildArr = array();

			foreach($Where as $K=>$V)
			{
			  if(strstr($V,':::'))
			  {
				$v1 = explode(':::',$V);
				/**
				 * $qryBuildArr[] = $K." ".$v1[0]." '".$v1[1]."'";
				 * single quote removed for the value part.
				 * For Date condition.
				 */
				$qryBuildArr[] = $K." ".$v1[0]." ".$v1[1]."";
			  }
			  else
			  {
				  $qryBuildArr[] = $K."='".$V."'";
			  }
			}
			
			$qryBuiltWhere = ' WHERE ' . implode(" $Condition ", $qryBuildArr);
		}
    else
		{
		   $qryBuiltWhere=" Where `Id` = '$Id'";
		}
		
			$SQL = " DELETE FROM `".constant($TableName)."`  ".$qryBuiltWhere; ;
			
			if($showSQL=='YES'){
				echo $SQL;
			}
			if(dB::deleteSql($SQL)){
				return true;
			}
		//}
	}

	
}
?>