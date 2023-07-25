<?
function SqlDate2Ts($SqlDate){
	if($SqlDate!='' && $SqlDate!='0000-00-00 00:00:00')
		return strtotime($SqlDate);
		
}
function sqlDate2TimeFormat($Format, $SqlDate){	
	$TimeStamp = SqlDate2Ts($SqlDate) ;
	if($TimeStamp>0)
		return date($Format, $TimeStamp);	
}
function ConvertMDY_To_MySQL($Date){
	$Tmp = explode("/", $Date) ;
	if ( checkdate((int)$Tmp[0], (int)$Tmp[1], (int)$Tmp[2]) ){
		return date("Y-m-d", mktime(0, 0, 0, (int)$Tmp[0], (int)$Tmp[1], (int)$Tmp[2]));
	}
	return FALSE;
}
function ConvertMySQL_To_MDY($Date){
	$Tmp = explode("-", $Date) ;
	if ( checkdate((int)$Tmp[1], (int)$Tmp[2], (int)$Tmp[0]) ){			
		return date("m/d/Y", strtotime($Date)) ;
	}
	else
		return FALSE;
}
function ConvertMDY_To_MySQL_doct($Date){
	$Tmp = explode("-", $Date) ;
	if ( checkdate((int)$Tmp[0], (int)$Tmp[1], (int)$Tmp[2]) ){
		return date("Y-m-d", mktime(0, 0, 0, (int)$Tmp[0], (int)$Tmp[1], (int)$Tmp[2]));
	}
	return FALSE;
}

?>