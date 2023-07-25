<?
function genSmartPaging($start, $limit, $nume, $page_name, $startName, $qs, $postArgv = array()){


	$postArgv = is_array($postArgv) ? $postArgv : array() ;

	$start = (int)$start;
	
	$start = $start > 0 ? $start : 1 ;
	
	$noOfPages = ceil( $nume / $limit ) ;
	
	if($noOfPages<1)
		return '';
	
	$first = 1 ;
	$prev = $start > 1 ? $start - 1 : 1 ;
	$current = $start ;	
    $next = $noOfPages > $start ? $start + 1 : $noOfPages ;
	$last = $noOfPages ;
	
	$uniqName = 'Nav_' . UniqueIdGen() ;	
	$Frm = $uniqName . '_Frm' ;	
	$hUniqId = $uniqName . '_hid' ;	
	$hUniqVal = $uniqName . '_Value' ;	
	$tUniqId = $uniqName . '_text' ;	
	$tUniqVal = $current ;
	$bUniqId = $uniqName . '_btn' ;	
	$bUniqVal = 'Submit' ;
	$jsFnSubmit = $uniqName . '_Submit' ;
	$jsFnOnSubmitCallBack = $uniqName . '_OnSubmitCallBack' ;
	
	$jsFnFirst = $uniqName . '_First' ;	
	$jsFnPrev = $uniqName . '_Prev' ;
	$jsFnNext = $uniqName . '_Next' ;	
	$jsFnLast = $uniqName . '_Last' ;
	$jsVar = $uniqName . '_Var_' ;	
	
	$retStr = '' ;
	
	if($nume > $limit ){ 
		
		$retStr .= '
		<form name="'.$Frm.'" id="'.$Frm.'" method="POST" action="'.$page_name.'" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" style="margin:0; padding:0;" onsubmit="return '.$jsFnOnSubmitCallBack.'(this)">
		<input type="hidden" name="'.$hUniqId.'" id="'.$hUniqId.'" value="'.$hUniqVal.'" />
		';
		
		foreach($postArgv as $K=>$V){
			$retStr .= '<input type="hidden" name="'.$V['name'].'" id="'.$V['id'].'" value="'.htmlentities($V['value']).'" />' ;
		}
		
		$retStr .= '<script>
		var '.$jsVar.'_bool = true ;
		function '.$jsFnSubmit.'(pN){
			var w = window ;
			var d = w.document ;
			var qs = pN == null ? "" : ( unescape("'.rawurlencode($startName).'") + "=" + pN ) ;			
			qs = "?" + ( qs != "" ? (qs + "&") : "" ) + unescape("'.rawurlencode($qs).'") ;			
			d.'.$Frm.'.action = unescape("'.rawurlencode($page_name).'") + qs;
			d.'.$Frm.'.method = "POST" ;
			d.'.$Frm.'.submit() ;
		}
		function '.$jsFnOnSubmitCallBack.'(frm){
			var w = window ;
			var d = w.document ;
			var '.$jsVar.'_pages = '.$noOfPages.' ;
			if('.$jsVar.'_bool){
				var val = parseInt(d.getElementById("'.$tUniqId.'").value, 10) ;
				val = isNaN(val) ? 0 : val ;
				if(val>=1 && val<='.$jsVar.'_pages){
					'.$jsVar.'_bool = false ;
					'.$jsFnSubmit.'(val) ;
					return true;
				}
				else{
					alert("Enter a Page Number between 1 and "+'.$jsVar.'_pages) ;
					d.getElementById("'.$tUniqId.'").focus();
					d.getElementById("'.$tUniqId.'").select();
					return false ;
				}
			}
			return true ;
		}
		function '.$jsFnFirst.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		function '.$jsFnLast.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		function '.$jsFnNext.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		function '.$jsFnPrev.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		</script>
		<table align = "center" border=0 cellspacing=0 cellpadding=2>
		<tr>
		<td  align="right" valign=middle nowrap="nowrap" style="white-space:nowrap"> ';
		
		//if($back >=0) { 
			$retStr .= '<a href="#nav-prev" onclick="'.$jsFnFirst.'('.$first.')" class="content" title="First"><img src="images/navFirst.gif" alt="First" border=0></a>'; 
			$retStr .= '&nbsp;'; 
			$retStr .= '<a href="#nav-prev" onclick="'.$jsFnPrev.'('.$prev.')" class="content" title="Previous"><img src="images/navPrev.gif" alt="Previous" border=0></a>'; 
		//} 		
		$retStr .= '</td><td align=right valign=middle nowrap="nowrap" style="white-space:nowrap">';
		$retStr .= '
			<input type="text" name="'.$tUniqId.'" id="'.$tUniqId.'" value="'.$tUniqVal.'" class="content" style="border: #75B4EB 1px solid; text-align:center; width:30px; height:20px; vertical-align: middle;" size=4 />&nbsp;<span class="content">of '.$noOfPages.'</span>&nbsp;
			<input type="submit" name="'.$bUniqId.'" id="'.$bUniqId.'" value="'.$bUniqVal.'" style="display:none" />
		';
		$retStr .= '</td><td  align="left" valign=middle nowrap="nowrap" style="white-space:nowrap">';
		//if($this1 < $nume) { 
		 $retStr .= '<a href="#nav-prev" onclick="'.$jsFnFirst.'('.$next.')" class="content" title="Next"><img src="images/navNext.gif" alt="Next" border=0></a>'; 
			$retStr .= '&nbsp;'; 
			$retStr .= '<a href="#nav-prev" onclick="'.$jsFnPrev.'('.$last.')" class="content" title="Last"><img src="images/navLast.gif" alt="Last" border=0></a>'; 
		//} 
		$retStr .= '</td></tr></table>
		</form>
		';
		
	}
	return $retStr ;
}

function genAjaxSmartPaging($start, $limit, $nume, $page_name, $startName, $qs, $postArgv = array(), $config=array()){


	$postArgv = is_array($postArgv) ? $postArgv : array() ;

	$start = (int)$start;
	
	$start = $start > 0 ? $start : 1 ;
	
	$noOfPages = ceil( $nume / $limit ) ;
	
	if($noOfPages<1)
		return '';
	
	$first = 1 ;
	$prev = $start > 1 ? $start - 1 : 1 ;
	$current = $start ;	
	$next = $noOfPages > $start ? $start + 1 : $noOfPages ;
	$last = $noOfPages ;
	
	$uniqName = 'Nav_' . UniqueIdGen() ;	
	$Frm = $uniqName . '_Frm' ;	
	$hUniqId = $uniqName . '_hid' ;	
	$hUniqVal = $uniqName . '_Value' ;	
	$tUniqId = $uniqName . '_text' ;	
	$tUniqVal = $current ;
	$bUniqId = $uniqName . '_btn' ;	
	$bUniqVal = 'Submit' ;
	$jsFnSubmit = $uniqName . '_Submit' ;
	$jsFnOnSubmitCallBack = $uniqName . '_OnSubmitCallBack' ;
	
	$jsFnFirst = $uniqName . '_First' ;	
	$jsFnPrev = $uniqName . '_Prev' ;
	$jsFnNext = $uniqName . '_Next' ;	
	$jsFnLast = $uniqName . '_Last' ;
	$jsVar = $uniqName . '_Var_' ;	
	
	$retStr = '' ;
	
	if($nume > $limit ){ 
		
		$retStr .= '
		<form name="'.$Frm.'" id="'.$Frm.'" method="POST" action="'.$page_name.'" marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" style="margin:0; padding:0;" onsubmit="return '.$jsFnOnSubmitCallBack.'(this)">		
		';
		
		$configStr='';
		
		if(is_array($postArgv)){
			foreach($postArgv as $KK=>$VV){
				$configStr.=', \''.$KK.'\':\''.$VV.'\'';
			}
		}
		
		$configName = $config['configName'] ;
		$configType = $config['configType'] ;
		$prefix = $config['prefix'] ;
		
		$cfg = $configName;
		
		$retStr .= '<script type="text/javascript">
		var '.$jsVar.'_bool = true ;
		function '.$jsFnSubmit.'(pN){
			var w = window ;
			var d = w.document ;
			var qs = pN == null ? "" : ( unescape("'.rawurlencode($startName).'") + "=" + pN ) ;
			qs = ( qs != "" ? (qs + "&") : "" ) + unescape("'.rawurlencode($qs).'") ;
			ajax({
				a:"'.$config['pagname'].'",
				b:qs,
				e:function(){},
				d:function(data){;
					'.$config['successfn'].'(data);
				}
			})
			return false;			
		}
		function '.$jsFnOnSubmitCallBack.'(frm){
			var w = window ;
			var d = w.document ;
			var '.$jsVar.'_pages = '.$noOfPages.' ;
			if('.$jsVar.'_bool){
				var val = parseInt(d.getElementById("'.$tUniqId.'").value, 10) ;
				val = isNaN(val) ? 0 : val ;
				if(val>=1 && val<='.$jsVar.'_pages){
					'.$jsVar.'_bool = false ;
					'.$jsFnSubmit.'(val) ;
					return false;
				}
				else{
					alert("Enter a Page Number between 1 and "+'.$jsVar.'_pages) ;
					d.getElementById("'.$tUniqId.'").focus();
					d.getElementById("'.$tUniqId.'").select();
					return false ;
				}
			}
			return false ;
		}
		function '.$jsFnFirst.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		function '.$jsFnLast.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		function '.$jsFnNext.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		function '.$jsFnPrev.'(pN){
			if('.$jsVar.'_bool){
				'.$jsVar.'_bool = false ;
				'.$jsFnSubmit.'(pN) ;
			}
		}
		</script>
		<table align = "center" border=0 cellspacing=0 cellpadding=2>
		<tr>
		<td  align="right" valign=middle nowrap="nowrap" style="white-space:nowrap"> ';
		
		//if($back >=0) { 
			$retStr .= '<a href="javascript:blank()" onclick="'.$jsFnFirst.'('.$first.')" class="content" title="First"><img src="images/navFirst.gif" alt="First" border=0></a>'; 
			$retStr .= '&nbsp;'; 
			$retStr .= '<a href="javascript:blank()" onclick="'.$jsFnPrev.'('.$prev.')" class="content" title="Previous"><img src="images/navPrev.gif" alt="Previous" border=0></a>'; 
		//} 		
		$retStr .= '</td><td align=right valign=middle nowrap="nowrap" style="white-space:nowrap">';
		$retStr .= '
			<input type="text" name="'.$tUniqId.'" id="'.$tUniqId.'" value="'.$tUniqVal.'" class="content" style="border: #AAAAAA 1px solid; text-align:center; width:30px; height:20px; vertical-align: middle;" size=4 />&nbsp;<span class="content">of '.$noOfPages.'</span>
			<input type="submit" name="'.$bUniqId.'" id="'.$bUniqId.'" value="'.$bUniqVal.'" style="display:none" />
		';
		$retStr .= '</td><td  align="left" valign=middle nowrap="nowrap" style="white-space:nowrap">';
		//if($this1 < $nume) { 
			$retStr .= '<a href="javascript:blank()" onclick="'.$jsFnFirst.'('.$next.')" class="content" title="Next"><img src="images/navNext.gif" alt="Next" border=0></a>'; 
			$retStr .= '&nbsp;'; 
			$retStr .= '<a href="javascript:blank()" onclick="'.$jsFnPrev.'('.$last.')" class="content" title="Last"><img src="images/navLast.gif" alt="Last" border=0></a>'; 
		//} 
		$retStr .= '</td></tr></table>
		</form>
		';
		
	}
	return $retStr ;
}

?>