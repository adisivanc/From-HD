<?php

/******************************************
* Author: Ilan Mandel
* Copyright: Correlsense, 2011
*---------------------------------
* functions.php - general functions to make our lives easier
*******************************************/
 
 	function pendingField($pendingFieldName) {
		$rs_pending = PendingData::getPatientPendingByIdandFieldName($_REQUEST['Pid'], $pendingFieldName);
		if($rs_pending->id != "") { echo '<img src="images/pending_icon.jpg" border="0" alt="Pending Data" title="Pending Data" />'; }
	}
 
function ProcessSFDCReportForHTML($entries)
{
	$result = array();
	if (!$entries || count($entries)==0)
	{
		return $result;
	}
	$i = 0;
	foreach ($entries as $entry)
	{
		$result[$i] = $entry;
		if ($entry['sync_status'] == "SUCCESS")
		{
			$result[$i]['sync_status'] = "<span class='status_ok'>SUCCESS</span>";
		}
		else if ($entry['sync_status'] == "FAIL")
		{
			$result[$i]['sync_status'] = "<span class='status_bad'>FAILURE</span>";
		}
		else
		{
			$result[$i]['sync_status'] = "<span class='status_warning'>QUESTIONABLE</span>";
		}
		$result[$i]['mapped_leads'] = $entry['BA_records_mapped_to_leads'];
		$result[$i]['mapped_contacts'] = $entry['BA_records_mapped_to_contacts'];
		$result[$i]['skipped'] = (int)$entry['ba_record_not_found'] + (int)$entry['contact_no_opportunities'];
		$result[$i]['errors'] = (int)$entry['failed_to_update_batch'] + (int)$entry['failed_to_update_error'];
		$result[$i]['report_link'] = "<a href='".$result[$i]['report_link']."' target='_blank'>Click me</a>";
		$result[$i]['report_summary_link'] = "<a href='".$result[$i]['report_summary_link']."' target='_blank'>Click me</a>";
		
		$i++;
	}
	return $result;		
}

function rotate_hash($thehash)
{
	$result = array();
	$i=0;
	foreach (array_keys($thehash) as $key)
	{
		$result[$i]['Attribute'] = $key;
		$result[$i]['Value'] = $thehash[$key];
		$i++;
	}
	return $result;	
} 

function reverse_list($list)
{
	$length = count($list);
	if ($length == 0)
	{
		return $list;
	}
	$new_list = array();
	for ($i=0; $i < $length; $i++)
	{
		$new_list[$i] = $list[$length-$i-1];
	}
	$length_new = count($new_list);
	return $new_list;
}
 
function GetSystemStatus()
{
	return "OK";
}

/*function GenerateUUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}*/

function MakeTitle($title)
{
	echo ("<h1 class='title'>".$title."</h1>");
}

function GetNow($datetime_format=DATE_TIME_FORMAT)
{
	return date($datetime_format);
}
function UniqueIdGen()
{
	return md5(uniqid(rand(), true));
}
function doEncode($str){
	return str_replace("=", "", base64_encode($str)) ;
}
function doDecode($str){
	return base64_decode($str) ;
}
function resizeCropForImgTag($argvs=array()){
	$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
	if(fileExists($src)){
		$Ext = strtolower(getFileExtension($src));
		/*if ($Ext == "jpg") $srcr = imagecreatefromjpeg($src);
		if ($Ext == "png") $srcr = imagecreatefrompng($src);
		if ($Ext == "gif") $srcr = imagecreatefromgif($src);*/
		
		$srcr = @imagecreatefromjpeg($src);
		if(!is_resource($srcr))
			$srcr = @imagecreatefrompng($src);
		if(!is_resource($srcr))
			$srcr = @imagecreatefromgif($src);
			
		if($srcr){
			list($width, $height) = getimagesize($src);
			if($width > $height){
				$w = $rw; 
				$diff = $width / $w;
				$h = $height / $diff;
			}
			else{
				$h = $rh; 
				$diff = $height / $h;
				$w = $width / $diff;
			}
			$w=ceil($w);
			$h=ceil($h);
			$tmpr = imagecreatetruecolor($w, $h);
			//imagealphablending($tmpr, true);
			imagecopyresampled($tmpr, $srcr, 0, 0, 0, 0, $w, $h, $width, $height);
			header('content-type:image/jpeg');
			imagejpeg($tmpr, $dest);
			imagedestroy($srcr);
			imagedestroy($tmpr);
		}
	}
	return '';
}

function resizeImageForImgTag($argvs=array()){
	$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
	
	if(fileExists($src)){
		$Ext = strtolower(getFileExtension($src));
		/*if ($Ext == "jpg") $srcr = imagecreatefromjpeg($src);
		if ($Ext == "png") $srcr = imagecreatefrompng($src);
		if ($Ext == "gif") $srcr = imagecreatefromgif($src);*/
		
		/*if ($Ext == "jpg") $srcr = imagecreatefromjpeg($src);
		if ($Ext == "png") $srcr = imagecreatefrompng($src);
		if ($Ext == "gif") $srcr = imagecreatefromgif($src);*/
		
		$srcr = @imagecreatefromjpeg($src);
		if(!is_resource($srcr))
			$srcr = @imagecreatefrompng($src);
		if(!is_resource($srcr))
			$srcr = @imagecreatefromgif($src);
		
		if($srcr){
			list($width, $height) = getimagesize($src);
			if($width > $height){
				$w = $rw; 
				$diff = $width / $w;
				$h = $height / $diff;
			}
			else{
				$h = $rh; 
				$diff = $height / $h;
				$w = $width / $diff;
			}
			$w=ceil($w);
			$h=ceil($h);
			$tmpr = imagecreatetruecolor($w, $h);
			//imagealphablending($tmpr, true);
			imagecopyresampled($tmpr, $srcr, 0, 0, 0, 0, $w, $h, $width, $height);
			header('content-type:image/jpeg');
			imagejpeg($tmpr, $dest);
			imagedestroy($srcr);
			imagedestroy($tmpr);
		}
	}
	return '';
}

function getFileExtension($FileName){
	$tmp = "" ;
	$tmp = pathinfo($FileName) ;
	return $tmp["extension"] ;	
}

function getFileName($FileName){
	$tmp = "" ;
	$tmp = pathinfo($FileName) ;
	return $tmp["basename"] ;	
}

function getFileDirectory($FileName){
	$tmp = "" ;
	$tmp = pathinfo($FileName) ;
	return $tmp["dirname"] ;	
}

function fileExists($file){
	return file_exists($file) && !is_dir($file) ;
}

function ValidUUID($uuid)
{
	return preg_match('#^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}$#', $guid);
}

function IsTokenValid($encrypted_token,$email,$event,$salt)
{
   $clear_token = $salt . $email . $event . $salt;
   $test_token = md5($clear_token);
   return ($test_token == $encrypted_token); 
}

function GeneratePassword($length=8, $strength=4)
{
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
function makeSortFunction($field,$orderby) {

		if(strtolower($orderby)=='desc')
			 $code = "return strnatcmp(\$b['$field'], \$a['$field']);";
		else 
			 $code = "return strnatcmp(\$a['$field'], \$b['$field']);"; 
		
		return create_function('$a,$b', $code); 
	}
	
	
function GenerateUUID()
  {
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    $mId= sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	return  $mId;

}	

	function getSeoName($seoname){	
	/*$seoname = strtolower($seoname);
	$seoname = str_replace("(", "", $seoname) ;
	$seoname = str_replace(")", "", $seoname) ;
	$seoname = str_replace(",", "", $seoname) ;
	$seoname = str_replace("-", "", $seoname) ;
	$seoname = str_replace(" ", "-", $seoname) ;
	$seoname = str_replace(" - ", "-", $seoname) ;
	//$seoname = str_replace("/", "", $seoname) ;
	$seoname = str_replace("&", "", $seoname) ;
	$seoname = str_replace("amp;", "", $seoname) ;
	$seoname = str_replace("#", "", $seoname) ;
	$seoname = str_replace("'", "", $seoname) ;
	$seoname=str_replace("39;", "-", $seoname);	
	$seoname=str_replace("45;", "", $seoname);*/
	
	$seoname = strtolower(stripslashes($seoname));
	$seoname = str_replace("(", "", $seoname) ;
	$seoname = str_replace(")", "", $seoname) ;
	$seoname = str_replace(":", "", $seoname) ;
	$seoname = str_replace(",", "", $seoname) ;
	$seoname = str_replace("-", "", $seoname) ;
	$seoname = str_replace(".", "", $seoname) ;
	$seoname = str_replace("/", "", $seoname) ;
	$seoname = str_replace("&", "", $seoname) ;
	$seoname = str_replace("amp;", "", $seoname) ;
	$seoname = str_replace("#", "", $seoname) ;
	$seoname = str_replace("'", "", $seoname) ;
	$seoname=str_replace("39;", "-", $seoname);
	$seoname = str_replace("\ ", "", $seoname);
	$seoname = str_replace("?", "", $seoname) ;
	$seoname=str_replace("45;", "", $seoname);
	$seoname = str_replace("'", "", $seoname) ;
	$seoname = str_replace("'", "", $seoname) ;
	
	while(strpos($seoname, "  ")){
		$seoname = str_replace("  ", " ", $seoname) ;
	}
	$seoname = str_replace(" ", "-", $seoname) ;
	$seoname = str_replace("~", "-", $seoname) ;
	$seoname = str_replace(".", "-", $seoname) ;
	$seoname = str_replace("--", "-", $seoname) ;
	
	return $seoname;
}
	

function getSeoUrl($argvs=array()){
	$argvs = is_array($argvs) ? $argvs : array(); extract($argvs);	
	//$pn = $pn.'?seo=1';
	
	$seourl = '';
   	$siteprefix = BASE_URL;
	//print_r($siteprefix);

	switch($pn)
	{
		case 'index.php':
		{
			$seourl='index.html';
			break;
		}
		case 'registration.php':
		{
			$seourl='registration';	
			break;
		}
		case'getpersonaldetails.php':
		{
			$seourl='get-personal-details';	
			break;
		}
		case'getpaymentdetails.php':
		{
			$seourl='get-payment-details';	
			break;
		}
		case'review_details.php':
		{
			$seourl='review-details';	
			break;
		}
		case'registration_thankyou.php':
		{
			$seourl='registration-thankyou';	
			break;
		}
		case'free_registration_thankyou.php':
		{
			$seourl='free-registration-thankyou';	
			break;
		}
		
		case'abstract_submission_closed.php':
		{
			$seourl='abstract-submission-closed';	
			break;
		}
		
		case 'venue.php':
		{
			$seourl='venue';	
			break;
		}
		case 'team.php':
		{
			$seourl='team';	
			break;
		}
		case 'faculty.php':
		{
			$seourl='faculty';	
			break;
		}
		case 'sponsors.php':
		{
			$seourl='sponsors';	
			break;
		}
		case 'contact.php':
		{
			$seourl='contact';	
			break;
		}
		case 'become_partner.php':
		{
			$seourl='become-partner';	
			break;
		}
		case 'abstract.php':
		{
			$seourl='abstract';	
			break;
		}
		case 'callforabstract.php':
		{
			if($Abstract_Type && $ParentCategory){
				switch($ParentCategory)
				{
					case 'EP':
					{
						$seourl='e-poster-scientific-abstract';	
						break;
					}
					case 'OL':
					{
						$seourl='oral-scientific-abstract';	
						break;
					}
				}
			
			}
			
			if($ParentCategory){
				switch($ParentCategory)
				{
					case 'CM':
					{
						$seourl='complication-management';	
						break;
					}
					
				}
			
			}
			break;
		}
		case 'callforabstracttype.php':
		{
			if($ParentCategory)
			{
				switch($ParentCategory)
				{
					case 'CM':
					{
						$seourl='complication-management';	
						break;
					}
					
					case 'EP':
					{
						$seourl='e-poster';	
						break;
					}
					case 'OL':
					{
						$seourl='oral';	
						break;
					}
				}
			}
			break;
		}

		case 'callforabstract_thankyou.php':
		{
			$seourl='callforabstract-thankyou';	
			break;
		}
		case 'mumbai_attractions.php':
		{
			$seourl='mumbai-attractions';	
			break;
		}
		case 'newsletters.php':
		{
			$seourl='newsletters';	
			break;
		}
		case 'newsletter/newsletter1.php':
		{
		$seourl='newsletter/invitation-for-annual-conference-of-ISVIR-2014';
		break;
		}
		case 'newsletter/newsletter2.php':
		{
		$seourl='newsletter/prove-your-ir-iq';
		break;
		}
		case 'newsletter/newsletter3.php':
		{
		$seourl='newsletter/isvir-meets-bsir';
		break;
		}
		case 'product_device.php':
		{
			$seourl='nominate-your-product';	
			break;
		}
		case 'faculty_registration.php':
		{
			$seourl='faculty-registration';	
			break;
		}
		case 'newsletter/newsletter5.php':
		{
		$seourl='newsletter/appeal-to-the-industry-partners';
		break;
		}
		case 'newsletter/newsletter6.php':
		{
		$seourl='newsletter/special-offer-only-for-PG-students-and-fellows';
		break;
		}
		case 'terms.php':
		{
			$seourl='terms-and-conditions';	
			break;
		}
		case 'privacy.php':
		{
			$seourl='privacy-statement';	
			break;
		}
		case 'newsletter/newsletter7.php':
		{
		$seourl='newsletter/early-bird-registration-ends-on-jan31-2014';
		break;
		}
		case 'newsletter/newsletter8.php':
		{
		$seourl='newsletter/abstract-submission-closes-on-jan-31-2014';
		break;
		}
		case 'newsletter/newsletter10.php':
		{
		$seourl='newsletter/abstract-submission-extended-till-feb-15-2014';
		break;
		}
		case 'newsletter/newsletter12.php':
		{
		$seourl='newsletter/early-bird-registration-extended-till-feb-20-2014';
		break;
		}
		case 'newsletter/newsletter13.php':
		{
		$seourl='newsletter/best-oral-presentation-gets-a-chance-to-attend-free-training';
		break;
		}
		case 'newsletter/newsletter14.php':
		{
		$seourl='newsletter/abstract-submission-extended-till-feb-28-2014';
		break;
		}
		case 'newsletter/newsletter16.php':
		{
		$seourl='newsletter/early-bird-registration-extended-till-feb-28-2014';
		break;
		}
		case 'selectedteam.php':
		{
		$seourl='winning-team';
		break;
		}
		case 'newsletter/newsletter17.php':
		{
		$seourl='newsletter/early-bird-registration-extended-till-mar-15-2014';
		break;
		}
		case 'newsletter/newsletter18.php':
		{
		$seourl='newsletter/abstract-submission-extended-till-mar-15-2014';
		break;
		}

	 default:
	   $seourl=$pn;
	   break;	
	}
	if($htaccess<=0)
	 	$seoprefix=BASE_URL;
		
	return $seoprefix.$seourl; 	
}
function countries(){
	return $country_array = array('AF'=>'AFGHANISTAN',
	'AL'=>'ALBANIA',
	'DZ'=>'ALGERIA',
	'AS'=>'AMERICAN SAMOA',
	'AD'=>'ANDORRA',
	'AO'=>'ANGOLA',
	'AI'=>'ANGUILLA',
	'AQ'=>'ANTARCTICA',
	'AG'=>'ANTIGUA AND BARBUDA',
	'AR'=>'ARGENTINA',
	'AM'=>'ARMENIA',
	'AW'=>'ARUBA',
	'AU'=>'AUSTRALIA',
	'AT'=>'AUSTRIA',
	'AZ'=>'AZERBAIJAN',
	'BS'=>'BAHAMAS',
	'BH'=>'BAHRAIN',
	'BD'=>'BANGLADESH',
	'BB'=>'BARBADOS',
	'BY'=>'BELARUS',
	'BE'=>'BELGIUM',
	'BZ'=>'BELIZE',
	'BJ'=>'BENIN',
	'BM'=>'BERMUDA',
	'BT'=>'BHUTAN',
	'BO'=>'BOLIVIA',
	'BA'=>'BOSNIA AND HERZEGOVINA',
	'BW'=>'BOTSWANA',
	'BV'=>'BOUVET ISLAND',
	'BR'=>'BRAZIL',
	'IO'=>'BRITISH INDIAN OCEAN TERRITORY',
	'BN'=>'BRUNEI DARUSSALAM',
	'BG'=>'BULGARIA',
	'BF'=>'BURKINA FASO',
	'BI'=>'BURUNDI',
	'KH'=>'CAMBODIA',
	'CM'=>'CAMEROON',
	'CA'=>'CANADA',
	'CV'=>'CAPE VERDE',
	'KY'=>'CAYMAN ISLANDS',
	'CF'=>'CENTRAL AFRICAN REPUBLIC',
	'TD'=>'CHAD',
	'CL'=>'CHILE',
	'CN'=>'CHINA',
	'CX'=>'CHRISTMAS ISLAND',
	'CC'=>'COCOS (KEELING) ISLANDS',
	'CO'=>'COLOMBIA',
	'KM'=>'COMOROS',
	'CG'=>'CONGO',
	'CD'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
	'CK'=>'COOK ISLANDS',
	'CR'=>'COSTA RICA',
	'CI'=>'COTE D IVOIRE',
	'HR'=>'CROATIA',
	'CU'=>'CUBA',
	'CY'=>'CYPRUS',
	'CZ'=>'CZECH REPUBLIC',
	'DK'=>'DENMARK',
	'DJ'=>'DJIBOUTI',
	'DM'=>'DOMINICA',
	'DO'=>'DOMINICAN REPUBLIC',
	'TP'=>'EAST TIMOR',
	'EC'=>'ECUADOR',
	'EG'=>'EGYPT',
	'SV'=>'EL SALVADOR',
	'GQ'=>'EQUATORIAL GUINEA',
	'ER'=>'ERITREA',
	'EE'=>'ESTONIA',
	'ET'=>'ETHIOPIA',
	'FK'=>'FALKLAND ISLANDS (MALVINAS)',
	'FO'=>'FAROE ISLANDS',
	'FJ'=>'FIJI',
	'FI'=>'FINLAND',
	'FR'=>'FRANCE',
	'GF'=>'FRENCH GUIANA',
	'PF'=>'FRENCH POLYNESIA',
	'TF'=>'FRENCH SOUTHERN TERRITORIES',
	'GA'=>'GABON',
	'GM'=>'GAMBIA',
	'GE'=>'GEORGIA',
	'DE'=>'GERMANY',
	'GH'=>'GHANA',
	'GI'=>'GIBRALTAR',
	'GR'=>'GREECE',
	'GL'=>'GREENLAND',
	'GD'=>'GRENADA',
	'GP'=>'GUADELOUPE',
	'GU'=>'GUAM',
	'GT'=>'GUATEMALA',
	'GN'=>'GUINEA',
	'GW'=>'GUINEA-BISSAU',
	'GY'=>'GUYANA',
	'HT'=>'HAITI',
	'HM'=>'HEARD ISLAND AND MCDONALD ISLANDS',
	'VA'=>'HOLY SEE (VATICAN CITY STATE)',
	'HN'=>'HONDURAS',
	'HK'=>'HONG KONG',
	'HU'=>'HUNGARY',
	'IS'=>'ICELAND',
	'IN'=>'INDIA',
	'ID'=>'INDONESIA',
	'IR'=>'IRAN, ISLAMIC REPUBLIC OF',
	'IQ'=>'IRAQ',
	'IE'=>'IRELAND',
	'IL'=>'ISRAEL',
	'IT'=>'ITALY',
	'JM'=>'JAMAICA',
	'JP'=>'JAPAN',
	'JO'=>'JORDAN',
	'KZ'=>'KAZAKSTAN',
	'KE'=>'KENYA',
	'KI'=>'KIRIBATI',
	'KP'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF',
	'KR'=>'REPUBLIC OF KOREA',
	'KW'=>'KUWAIT',
	'KG'=>'KYRGYZSTAN',
	'LA'=>'LAO PEOPLES DEMOCRATIC REPUBLIC',
	'LV'=>'LATVIA',
	'LB'=>'LEBANON',
	'LS'=>'LESOTHO',
	'LR'=>'LIBERIA',
	'LY'=>'LIBYAN ARAB JAMAHIRIYA',
	'LI'=>'LIECHTENSTEIN',
	'LT'=>'LITHUANIA',
	'LU'=>'LUXEMBOURG',
	'MO'=>'MACAU',
	'MK'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
	'MG'=>'MADAGASCAR',
	'MW'=>'MALAWI',
	'MY'=>'MALAYSIA',
	'MV'=>'MALDIVES',
	'ML'=>'MALI',
	'MT'=>'MALTA',
	'MH'=>'MARSHALL ISLANDS',
	'MQ'=>'MARTINIQUE',
	'MR'=>'MAURITANIA',
	'MU'=>'MAURITIUS',
	'YT'=>'MAYOTTE',
	'MX'=>'MEXICO',
	'FM'=>'MICRONESIA, FEDERATED STATES OF',
	'MD'=>'MOLDOVA, REPUBLIC OF',
	'MC'=>'MONACO',
	'MN'=>'MONGOLIA',
	'MS'=>'MONTSERRAT',
	'MA'=>'MOROCCO',
	'MZ'=>'MOZAMBIQUE',
	'MM'=>'MYANMAR',
	'NA'=>'NAMIBIA',
	'NR'=>'NAURU',
	'NP'=>'NEPAL',
	'NL'=>'NETHERLANDS',
	'AN'=>'NETHERLANDS ANTILLES',
	'NC'=>'NEW CALEDONIA',
	'NZ'=>'NEW ZEALAND',
	'NI'=>'NICARAGUA',
	'NE'=>'NIGER',
	'NG'=>'NIGERIA',
	'NU'=>'NIUE',
	'NF'=>'NORFOLK ISLAND',
	'MP'=>'NORTHERN MARIANA ISLANDS',
	'NO'=>'NORWAY',
	'OM'=>'OMAN',
	'PK'=>'PAKISTAN',
	'PW'=>'PALAU',
	'PS'=>'PALESTINIAN TERRITORY, OCCUPIED',
	'PA'=>'PANAMA',
	'PG'=>'PAPUA NEW GUINEA',
	'PY'=>'PARAGUAY',
	'PE'=>'PERU',
	'PH'=>'PHILIPPINES',
	'PN'=>'PITCAIRN',
	'PL'=>'POLAND',
	'PT'=>'PORTUGAL',
	'PR'=>'PUERTO RICO',
	'QA'=>'QATAR',
	'RE'=>'REUNION',
	'RO'=>'ROMANIA',
	'RU'=>'RUSSIAN FEDERATION',
	'RW'=>'RWANDA',
	'SH'=>'SAINT HELENA',
	'KN'=>'SAINT KITTS AND NEVIS',
	'LC'=>'SAINT LUCIA',
	'PM'=>'SAINT PIERRE AND MIQUELON',
	'VC'=>'SAINT VINCENT AND THE GRENADINES',
	'WS'=>'SAMOA',
	'SM'=>'SAN MARINO',
	'ST'=>'SAO TOME AND PRINCIPE',
	'SA'=>'SAUDI ARABIA',
	'SN'=>'SENEGAL',
	'SC'=>'SEYCHELLES',
	'SL'=>'SIERRA LEONE',
	'SG'=>'SINGAPORE',
	'SK'=>'SLOVAKIA',
	'SI'=>'SLOVENIA',
	'SB'=>'SOLOMON ISLANDS',
	'SO'=>'SOMALIA',
	'ZA'=>'SOUTH AFRICA',
	'GS'=>'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
	'ES'=>'SPAIN',
	'LK'=>'SRI LANKA',
	'SD'=>'SUDAN',
	'SR'=>'SURINAME',
	'SJ'=>'SVALBARD AND JAN MAYEN',
	'SZ'=>'SWAZILAND',
	'SE'=>'SWEDEN',
	'CH'=>'SWITZERLAND',
	'SY'=>'SYRIAN ARAB REPUBLIC',
	'TW'=>'TAIWAN, PROVINCE OF CHINA',
	'TJ'=>'TAJIKISTAN',
	'TZ'=>'TANZANIA, UNITED REPUBLIC OF',
	'TH'=>'THAILAND',
	'TG'=>'TOGO',
	'TK'=>'TOKELAU',
	'TO'=>'TONGA',
	'TT'=>'TRINIDAD AND TOBAGO',
	'TN'=>'TUNISIA',
	'TR'=>'TURKEY',
	'TM'=>'TURKMENISTAN',
	'TC'=>'TURKS AND CAICOS ISLANDS',
	'TV'=>'TUVALU',
	'UG'=>'UGANDA',
	'UA'=>'UKRAINE',
	'AE'=>'UNITED ARAB EMIRATES',
	'GB'=>'UNITED KINGDOM',
	'US'=>'UNITED STATES',
	'UM'=>'UNITED STATES MINOR OUTLYING ISLANDS',
	'UY'=>'URUGUAY',
	'UZ'=>'UZBEKISTAN',
	'VU'=>'VANUATU',
	'VE'=>'VENEZUELA',
	'VN'=>'VIET NAM',
	'VG'=>'VIRGIN ISLANDS, BRITISH',
	'VI'=>'VIRGIN ISLANDS, U.S.',
	'WF'=>'WALLIS AND FUTUNA',
	'EH'=>'WESTERN SAHARA',
	'YE'=>'YEMEN',
	'YU'=>'YUGOSLAVIA',
	'ZM'=>'ZAMBIA',
	'ZW'=>'ZIMBABWE',
	);
}
function USState() {

return $StateList = array('AL'=>"Alabama",
                'AK'=>"Alaska", 
                'AZ'=>"Arizona", 
                'AR'=>"Arkansas", 
                'CA'=>"California", 
                'CO'=>"Colorado", 
                'CT'=>"Connecticut", 
                'DE'=>"Delaware", 
                'DC'=>"District Of Columbia", 
                'FL'=>"Florida", 
                'GA'=>"Georgia", 
                'HI'=>"Hawaii", 
                'ID'=>"Idaho", 
                'IL'=>"Illinois", 
                'IN'=>"Indiana", 
                'IA'=>"Iowa", 
                'KS'=>"Kansas", 
                'KY'=>"Kentucky", 
                'LA'=>"Louisiana", 
                'ME'=>"Maine", 
                'MD'=>"Maryland", 
                'MA'=>"Massachusetts", 
                'MI'=>"Michigan", 
                'MN'=>"Minnesota", 
                'MS'=>"Mississippi", 
                'MO'=>"Missouri", 
                'MT'=>"Montana",
                'NE'=>"Nebraska",
                'NV'=>"Nevada",
                'NH'=>"New Hampshire",
                'NJ'=>"New Jersey",
                'NM'=>"New Mexico",
                'NY'=>"New York",
                'NC'=>"North Carolina",
                'ND'=>"North Dakota",
                'OH'=>"Ohio", 
                'OK'=>"Oklahoma", 
                'OR'=>"Oregon", 
                'PA'=>"Pennsylvania", 
                'RI'=>"Rhode Island", 
                'SC'=>"South Carolina", 
                'SD'=>"South Dakota",
                'TN'=>"Tennessee", 
                'TX'=>"Texas", 
                'UT'=>"Utah", 
                'VT'=>"Vermont", 
                'VA'=>"Virginia", 
                'WA'=>"Washington", 
                'WV'=>"West Virginia", 
                'WI'=>"Wisconsin", 
                'WY'=>"Wyoming");

}

function IndiaStateArr(){
return $StateArr = array(
		'AN'=>'Andaman and Nicobar',
		'AP'=>'Andhra Pradesh',
		'AR'=>'Arunachal Pradesh',
		'AS'=>'Assam',
		'BR'=>'Bihar',
		'CH'=>'Chandigarh',
		'CG'=>'Chattisgarh',
		'DN'=>'Dadra and Nagar Haveli',
		'DD'=>'Daman and Diu',
		'DL'=>'Delhi',
		'GA'=>'Goa',
		'GJ'=>'Gujarat',
		'HR'=>'Haryana',
		'HP'=>'Himachal Pradesh',
		'JK'=>'Jammu and Kashmir',
		'JH'=>'Jharkhand',
		'KA'=>'Karnataka',
		'KL'=>'Kerala',
		'LD'=>'Lakshadweep',
		'MP'=>'Madhya Pradesh',
		'MH'=>'Maharashtra',
		'MN'=>'Manipur',
		'ML'=>'Meghalaya',
		'MZ'=>'Mizoram',
		'NL'=>'Nagaland',
		'OR'=>'Orissa',
		'PY'=>'Puducherry',
		'PB'=>'Punjab',
		'RJ'=>'Rajasthan',
		'SK'=>'Sikkim',
		'TN'=>'Tamil Nadu',
		'TR'=>'Tripura',
		'UL'=>'Uttarakhand(Formerly Uttaranchal)',
		'UP'=>'Uttar Pradesh',
		'WB'=>'West Bengal');
}

function tamilnaduDistrict(){
	return $district_array = array('Ariyalur'=>'Ariyalur',
	'Chennai'=>'Chennai',
	'Coimbatore'=>'Coimbatore',
	'Cuddalore'=>'Cuddalore',
	'Dharmapuri'=>'Dharmapuri',
	'Dindigul'=>'Dindigul',
	'Erode'=>'Erode',
	'Kanchipuram'=>'Kanchipuram',
	'Kanniyakumari'=>'Kanniyakumari',
	'Karur'=>'Karur',
	'Krishnagiri'=>'Krishnagiri',
	'Madurai'=>'Madurai',
	'Nagapattinam'=>'Nagapattinam',
	'Namakkal'=>'Namakkal',
	'Nilgiris'=>'Nilgiris',
	'Perambalur'=>'Perambalur',
	'Pudukkottai'=>'Pudukkottai',
	'Ramanathapuram'=>'Ramanathapuram',
	'Salem'=>'Salem',
	'Sivaganga'=>'Sivaganga',
	'Thanjavur'=>'Thanjavur',
	'Theni'=>'Theni',
	'Thoothukudi'=>'Thoothukudi',
	'Thiruvarur'=>'Thiruvarur',
	'Tirunelveli'=>'Tirunelveli',
	'Tiruchirappalli'=>'Tiruchirappalli',
	'Thiruvallur'=>'Thiruvallur',
	'Tiruppur'=>'Tiruppur',
	'Tiruvannamalai'=>'Tiruvannamalai',
	'Vellore'=>'Vellore',
	'Villupuram'=>'Villupuram',
	'Virudhunagar'=>'Virudhunagar'
	);
}

function canadaStates(){
	
	return $canadastates = array('Alberta'=>'Alberta',
	 'British Columbia'=>'British Columbia',
	 'Manitoba'=>'Manitoba',
	 'New Brunswick'=>'New Brunswick',
	 'Newfoundland'=>'Newfoundland',
	 'Northwest Territories'=>'Northwest Territories',
	 'Nova Scotia'=>'Nova Scotia',
	 'Nunavut'=>'Nunavut',
	 'Ontario'=>'Ontario',
	 'Prince Edward Island'=>'Prince Edward Island',
	 'Quebec'=>'Quebec',
	 'Saskatchewan'=>'Saskatchewan',
	 'Yukon'=>'Yukon'
	 );
}



	function check_input($value)
	{
	// Stripslashes
		if (get_magic_quotes_gpc())
		{
		$value = stripslashes($value);
		}
		// Quote if not a number
		if (!is_numeric($value))
		{
		$value = mysql_real_escape_string($value);
		}
		
		$value = trim($value);
		$value = htmlspecialchars($value);
		//  $ostring = htmlentities($ostring);
		
		
		return $value;
	
	
	
	}
function redirectUrl($PageUrl){
	ob_clean();	
	header("Location:".$PageUrl);
	//exit();
}
	
function getUnique(){
	return md5(uniqid(rand(), true));
}

function CountryCode(){
return $countrycode = array('AF 93'=>'Afghanistan (+93)', 'AL 355'=>'Albania (+355)','DZ 213'=>'Algeria (+213)','AS 1'=>'American Samoa (+1)', 'AD 376'=>'Andorra (+376)', 'AO 244'=>'Angola (+244)',  'AI 1'=>'Anguilla (+1)',  'AQ 672'=>'Antarctica (+672)',  'AG 1'=>'Antigua and Barbuda (+1)',  'AR 54'=>'Argentina (+54)',  'AM 374'=>'Armenia (+374)',  'AW 297'=>'Aruba (+297)',  'AU 61'=>'Australia (+61)',  'AT 43'=>'Austria (+43)',  'AZ 994'=>'Azerbaijan (+994)',  'BS 1'=>'Bahamas (+1)',  'BH 973'=>'Bahrain (+973)',  'BD 880'=>'Bangladesh (+880)',  'BB 1'=>'Barbados (+1)',  'BY 375'=>'Belarus (+375)',  'BE 32'=>'Belgium (+32)',  'BZ 501'=>'Belize (+501)',  'BJ 229'=>'Benin (+229)',  'BM 1'=>'Bermuda (+1)',  'BT 975'=>'Bhutan (+975)',  'BO 591'=>'Bolivia (+591)',  'BA 387'=>'Bosnia and Herzegovina (+387)',  'BW 267'=>'Botswana (+267)',  'BV'=>'Bouvet Island (+)',  'BR 55'=>'Brazil (+55)',  'IO 246'=>'British Indian Ocean Territory (+246)',  'BN 673'=>'Brunei Darussalam (+673)',  'BG 359'=>'Bulgaria (+359)',  'BF 226'=>'Burkina Faso (+226)',  'BI 257'=>'Burundi (+257)',  'KH 855'=>'Cambodia (+855)',  'CM 237'=>'Cameroon (+237)',  'CA 1'=>'Canada (+1)',  'CV 238'=>'Cape Verde (+238)',  'KY 1'=>'Cayman Islands (+1)',  'CF 236'=>'Central African Republic (+236)',  'TD 235'=>'Chad (+235)',  'CL 56'=>'Chile (+56)',  'CN 86'=>'China (+86)',  'CX 61'=>'Christmas Island (+61)',  'CC 61'=>'Cocos (Keeling) Islands (+61)',  'CO 57'=>'Colombia (+57)',  'KM 269'=>'Comoros (+269)',  'CG 242'=>'Congo (+242)',  'CD 243'=>'Congo, The Democratic Republic Of The (+243)',  'CK 682'=>'Cook Islands (+682)',  'CR 506'=>'Costa Rica (+506)',  'HR 385'=>'Croatia (+385)',  'CU 53'=>'Cuba (+53)',  'CY 357'=>'Cyprus (+357)','CZ 420'=>'Czech Republic (+420)', 'CI 225'=>'Cote D Ivoire (+225)', 'DK 45'=>'Denmark (+45)', 'DJ 253'=>'Djibouti (+253)', 'DM 1'=>'Dominica (+1)', 'DO 1'=>'Dominican Republic (+1)', 'EC 593'=>'Ecuador (+593)', 'EG 20'=>'Egypt (+20)', 'SV 503'=>'El Salvador (+503)', 'GQ 240'=>'Equatorial Guinea (+240)', 'ER 291'=>'Eritrea (+291)', 'EE 372'=>'Estonia (+372)', 'ET 251'=>'Ethiopia (+251)', 'FK 500'=>'Falkland Islands (Malvinas) (+500)', 'FO 298'=>'Faroe Islands (+298)', 'FJ 679'=>'Fiji (+679)', 'FI 358'=>'Finland (+358)', 'FR 33'=>'France (+33)', 'GF 594'=>'French Guiana (+594)', 'PF 689'=>'French Polynesia (+689)', 'TF'=>'French Southern Territories (+)', 'GA 241'=>'Gabon (+241)', 'GM 220'=>'Gambia (+220)', 'GE 995'=>'Georgia (+995)', 'DE 49'=>'Germany (+49)', 'GH 233'=>'Ghana (+233)', 'GI 350'=>'Gibraltar (+350)', 'GR 30'=>'Greece (+30)', 'GL 299'=>'Greenland (+299)', 'GD 1'=>'Grenada (+1)', 'GP 590'=>'Guadeloupe (+590)', 'GU 1'=>'Guam (+1)', 'GT 502'=>'Guatemala (+502)', 'GG 44'=>'Guernsey (+44)', 'GN 224'=>'Guinea (+224)', 'GW 245'=>'Guinea-Bissau (+245)', 'GY 592'=>'Guyana (+592)', 'HT 509'=>'Haiti (+509)', 'HM'=>'Heard and McDonald Islands (+)', 'VA 39'=>'Holy See (Vatican City State) (+39)', 'HN 504'=>'Honduras (+504)', 'HK 852'=>'Hong Kong (+852)', 'HU 36'=>'Hungary (+36)', 'IS 354'=>'Iceland (+354)', 'IN 91'=>'India (+91)', 'ID 62'=>'Indonesia (+62)', 'IR 98'=>'Iran, Islamic Republic Of (+98)', 'IQ 964'=>'Iraq (+964)', 'IE 353'=>'Ireland (+353)', 'IM 44'=>'Isle of Man (+44)', 'IL 972'=>'Israel (+972)', 'IT 39'=>'Italy (+39)', 'JM 1'=>'Jamaica (+1)', 'JP 81'=>'Japan (+81)', 'JE 44'=>'Jersey (+44)', 'JO 962'=>'Jordan (+962)', 'KZ 7'=>'Kazakhstan (+7)', 'KE 254'=>'Kenya (+254)', 'KI 686'=>'Kiribati (+686)', 'KP 850'=>'Korea, Democratic Peoples Republic Of (+850)', 'KR 82'=>'Korea, Republic of (+82)', 'KW 965'=>'Kuwait (+965)', 'KG 996'=>'Kyrgyzstan (+996)', 'LA 856'=>'Lao Peoples Democratic Republic (+856)', 'LV 371'=>'Latvia (+371)', 'LB 961'=>'Lebanon (+961)', 'LS 266'=>'Lesotho (+266)', 'LR 231'=>'Liberia (+231)', 'LY 218'=>'Libya (+218)', 'LI 423'=>'Liechtenstein (+423)', 'LT 370'=>'Lithuania (+370)', 'LU 352'=>'Luxembourg (+352)', 'MO 853'=>'Macao (+853)', 'MK 389'=>'Macedonia, the Former Yugoslav Republic Of (+389)', 'MG 261'=>'Madagascar (+261)', 'MW 265'=>'Malawi (+265)', 'MY 60'=>'Malaysia (+60)', 'MV 960'=>'Maldives (+960)', 'ML 223'=>'Mali (+223)', 'MT 356'=>'Malta (+356)', 'MH 692'=>'Marshall Islands (+692)', 'MQ 596'=>'Martinique (+596)', 'MR 222'=>'Mauritania (+222)', 'MU 230'=>'Mauritius (+230)','YT 269'=>'Mayotte (+269)', 'MX 52'=>'Mexico (+52)', 'FM 691'=>'Micronesia, Federated States Of (+691)', 'MD 373'=>'Moldova, Republic of (+373)', 'MC 377'=>'Monaco (+377)','MN 976'=>'Mongolia (+976)', 'ME 382'=>'Montenegro (+382)', 'MS 1'=>'Montserrat (+1)', 'MA 212'=>'Morocco (+212)', 'MZ 258'=>'Mozambique (+258)', 'MM 95'=>'Myanmar (+95)', 'NA 264'=>'Namibia (+264)', 'NR 674'=>'Nauru (+674)', 'NP 977'=>'Nepal (+977)', 'NL 31'=>'Netherlands (+31)', 'AN 599'=>'Netherlands Antilles (+599)', 'NC 687'=>'New Caledonia (+687)', 'NZ 64'=>'New Zealand (+64)', 'NI 505'=>'Nicaragua (+505)', 'NE 227'=>'Niger (+227)', 'NG 234'=>'Nigeria (+234)', 'NU 683'=>'Niue (+683)', 'NF 672'=>'Norfolk Island (+672)', 'MP 1'=>'Northern Mariana Islands (+1)', 'NO 47'=>'Norway (+47)', 'OM 968'=>'Oman (+968)', 'PK 92'=>'Pakistan (+92)', 'PW 680'=>'Palau (+680)', 'PS 970'=>'Palestinian Territory, Occupied (+970)', 'PA 507'=>'Panama (+507)', 'PG 675'=>'Papua New Guinea (+675)', 'PY 595'=>'Paraguay (+595)', 'PE 51'=>'Peru (+51)', 'PH 63'=>'Philippines (+63)', 'PN'=>'Pitcairn (+)', 'PL 48'=>'Poland (+48)', 'PT 351'=>'Portugal (+351)', 'PR 1'=>'Puerto Rico (+1)', 'QA 974'=>'Qatar (+974)', 'RO 40'=>'Romania (+40)', 'RU 7'=>'Russian Federation (+7)', 'RW 250'=>'Rwanda (+250)', 'RE 262'=>'Reunion (+262)', 'BL 590'=>'Saint Barthelemy (+590)', 'SH 290'=>'Saint Helena (+290)', 'KN 1'=>'Saint Kitts And Nevis (+1)', 'LC 1'=>'Saint Lucia (+1)', 'MF 590'=>'Saint Martin (+590)', 'PM 508'=>'Saint Pierre And Miquelon (+508)', 'VC 1'=>'Saint Vincent And The Grenedines (+1)', 'WS 685'=>'Samoa (+685)', 'SM 378'=>'San Marino (+378)', 'ST 239'=>'Sao Tome and Principe (+239)', 'SA 966'=>'Saudi Arabia (+966)', 'SN 221'=>'Senegal (+221)', 'RS 381'=>'Serbia (+381)', 'SC 248'=>'Seychelles (+248)', 'SL 232'=>'>Sierra Leone (+232)', 'SG 65'=>'Singapore (+65)', 'SK 421'=>'Slovakia (+421)', 'SI 386'=>'Slovenia (+386)', 'SB 677'=>'Solomon Islands (+677)', 'SO 252'=>'Somalia (+252)', 'ZA 27'=>'South Africa (+27)', 'GS 500'=>'South Georgia and the South Sandwich Islands (+500)', 'SS 211'=>'South Sudan (+211)', 'ES 34'=>'Spain (+34)', 'LK 94'=>'Sri Lanka (+94)', 'SD 249'=>'Sudan (+249)', 'SR 597'=>'Suriname (+597)', 'SJ 47'=>'Svalbard And Jan Mayen (+47)', 'SZ 268'=>'Swaziland (+268)', 'SE 46'=>'Sweden (+46)', 'CH 41'=>'Switzerland (+41)', 'SY 963'=>'Syrian Arab Republic (+963)', 'TW 886'=>'Taiwan, Republic Of China (+886)', 'TJ 992'=>'Tajikistan (+992)', 'TZ 255'=>'Tanzania, United Republic of (+255)', 'TH 66'=>'Thailand (+66)', 'TL 670'=>'Timor-Leste (+670)', 'TG 228'=>'Togo (+228)', 'TK 690'=>'Tokelau (+690)', 'TO 676'=>'Tonga (+676)', 'TT 1'=>'Trinidad and Tobago (+1)', 'TN 216'=>'Tunisia (+216)', 'TR 90'=>'Turkey (+90)', 'TM 993'=>'Turkmenistan (+993)', 'TC 1'=>'Turks and Caicos Islands (+1)', 'TV 688'=>'Tuvalu (+688)', 'UG 256'=>'Uganda (+256)', 'UA 380'=>'Ukraine (+380)', 'AE 971'=>'United Arab Emirates (+971)', 'GB 44'=>'United Kingdom (+44)', 'US 1'=>'United States (+1)', 'UM'=>'United States Minor Outlying Islands (+)', 'UY 598'=>'Uruguay (+598)', 'UZ 998'=>'Uzbekistan (+998)', 'VU 678'=>'Vanuatu (+678)', 'VE 58'=>'Venezuela, Bolivarian Republic of (+58)', 'VN 84'=>'Vietnam (+84)', 'VG 1'=>'Virgin Islands, British (+1)', 'VI 1'=>'Virgin Islands, U.S. (+1)', 'WF 681'=>'Wallis and Futuna (+681)', 'EH 212'=>'Western Sahara (+212)', 'YE 967'=>'Yemen (+967)', 'ZM 260'=>'Zambia (+260)', 'ZW 263'=>'Zimbabwe (+263)', 'AX 358'=>'land Islands (+358)');
}


function getTimeDifference($fromTime, $toTime) {
	 //echo $fromTime."-".$toTime;
	 $time=date("H:i", strtotime($toTime)-strtotime($fromTime));
	 $timeArr = explode(":", $time);
	 return $timeArr[0]." hours, ".$timeArr[1]." minutes";
}

function getTimeDifferenceInHours($fromTime, $toTime) {
	 //echo $fromTime."-".$toTime;
	 $time=date("H:i", strtotime($toTime)-strtotime($fromTime));
	 $timeArr = explode(":", $time);
	 if($timeArr[1]>0) return ($timeArr[0]+1);
	 
	 //return $timeArr[0]." Hours ".$timeArr[1]." Minutes";
}


function getTimeDifferenceinMinutes($fromTime, $toTime) {
	 $fromTime."-".$toTime;
	 $time=date("H:i", strtotime($toTime)-strtotime($fromTime));
	 $timeArr = explode(":", $time);
	 return ($timeArr[0]*60) + $timeArr[1];
}

function getRangeFromArray($valueToCheck, $rangeArr) {

	if(count($rangeArr) > 0) {
		foreach($rangeArr as $K=>$V) {
			$valArr = explode('-',$V);
			if ($valueToCheck >= $valArr[0] && $valueToCheck <= $valArr[1]) {
				return $V;
			}	
		}
	}
	return '';
}

function getDaysBetweenDates($fromdate, $todate) {
  
  $start_ts = strtotime($fromdate);
  $end_ts = strtotime($todate);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);

}

function currentYearMonth() {
	//$current_month_number = date('m');
	$month_arr=array();
	for ($m=1; $m<=12; $m++) {
		$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
        $month_arr[sprintf("%02s", $m)] = ($month);
	}
    return $month_arr;          
}

function listofyears($limit, $limitend) {
	
	if($limit=="") $limit = 2014; else $limit=$limit;
	if($limitend=="") $limitend = 2100; else $limitend=$limitend;
	
	$year_arr=array();
	for ($y=$limit; $y<=$limitend; $y++) {
        $year_arr[$y] = ($y);
	}
    return $year_arr; 
	
}

function getTimeDifferenect($date) {
	
	$diff = abs( time() - strtotime($date));
	$days = intval( $diff / 86400 );
	$hours = round( ( $diff % 86400 ) / 3600);
	$mins = round( ( $diff / 60 ) % 60 );
	$secs = round( $diff % 60 );
	
	if($days>0) {
		if($days>1) $plural = " days"; else $plural = " day";
		$lastBookTime = $days.$plural;
	} elseif($hours>0) {
		if($hours>1) $plural = " hours"; else $plural = " hour";
		$lastBookTime = $hours.$plural;
	} elseif($mins>0) {
		if($mins>1) $plural = " mins"; else $plural = " min";
		$lastBookTime = $mins.$plural;
	} elseif($secs>0) {
		if($secs>1) $plural = " secs"; else $plural = " sec";
		$lastBookTime = $secs.$plural;
	} else {
		$lastBookTime = "";
	}
	
	return $lastBookTime;
		
}

function getExplodeImplodeVal($explodeArr) {
	$productArr = explode(",", $explodeArr);
	$product=array();
	foreach($productArr as $K=>$V) {
		$product[] = $GLOBALS['ProductName'][$V];
	}
	$product_details = implode(", ", $product);
	return $product_details;
}

function generatePagination($functionName="", $arrayCount, $arraySliceCount, $pageLimit=10, $adjacent=1, $page=1, $type="") {

	$resultCount = $arrayCount;
	$resultSplitCount = $arraySliceCount;
	
	$start = ($page-1) * $pageLimit;
	$adjacents = 1;
		
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($resultCount/$pageLimit);
	$lpm1 = $lastpage - 1;   
	$pagination = "";

	if($lastpage > 1)
    {   

        if ($page > 1)
            $pagination.= "<a style='cursor:pointer' class='pagination_box' border='0' id='pagination_prev' onClick='".$functionName."Paging(".($prev).", &quot;".$type."&quot;);'></a>";
        else
            $pagination.= "<span class='disabled pagination_box' id='pagination_prev' style='cursor:pointer' border='0'></span>";
			   
        if ($lastpage < 7 + ($adjacents * 2))
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {  
                if ($counter == $page)
                    $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0'>".sprintf("%02s", $counter)."</span>";
                else
                    $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
                         
            }
        }
        elseif($lastpage > 4 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2))
            {
                for($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
                {
                    if($counter == $page)
                        $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0'>".sprintf("%02s", $counter)."</span>";
                    else
                        $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
                }
                $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>...</span>";
                $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lpm1).", &quot;".$type."&quot;);'>".sprintf("%02s", $lpm1)."</a>";
                $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lastpage).", &quot;".$type."&quot;);'>".sprintf("%02s", $lastpage)."</a>";   
           
           }
           elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
           {
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(1, &quot;".$type."&quot;);'>1</a>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(2, &quot;".$type."&quot;);'>2</a>";
               $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>...</span>";
               for($counter = ($page - $adjacents)+1; $counter <= ($page + $adjacents)+1; $counter++)
               {
                   if($counter == $page)
                       $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</span>";
                   else
                       $pagination.= "<a style='cursor:pointer' class='pagination_box' border='0' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
               }
               $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>..</span>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lpm1).", &quot;".$type."&quot;);'>".sprintf("%02s", $lpm1)."</a>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($lastpage).", &quot;".$type."&quot;);'>".sprintf("%02s", $lastpage)."</a>";   
           }
           else
           {
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(1, &quot;".$type."&quot;);'>".sprintf("%02s", 1)."</a>";
               $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(2, &quot;".$type."&quot;);'>".sprintf("%02s", 2)."</a>";
               $pagination.= "<span class='pagination_box' style='background:none; border:none; color:#000;'>..</span>";
               for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<span class='pagination_active pagination_box' style='cursor:pointer' border='0'>".sprintf("%02s", $counter)."</span>";
                   else
                        $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' onClick='".$functionName."Paging(".($counter).", &quot;".$type."&quot;);'>".sprintf("%02s", $counter)."</a>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<a style='cursor:pointer' border='0' class='pagination_box' id='pagination_next' onClick='".$functionName."Paging(".($next).", &quot;".$type."&quot;);'></a>";

        else
            $pagination.= "<span class='disabled pagination_box' id='pagination_next' style='cursor:pointer' border='0'></span>";
        
    }
	$table_val = "<span style='float:left; line-height:25px;'><b>Showing ".($start+1)." to ".($start+$resultSplitCount)." of ".$resultCount." entries</b></span>";
	$table_val .= "<span style='float:right;'>".$pagination."</span>";
	
	return $table_val;
		 
}

function getContentAsTable($contentDtls, $page) {

	$totalColumns = count($contentDtls['Fields']);
	$totalRows = count($contentDtls['Rows']);
	$records = $contentDtls['Rows'];
	
	$page = $page;
	$totalRows = $totalRows;
	$pageLimit=10;
	$adjacent=1;
	
	$totalPages= ceil(($totalRows)/($pageLimit));
	if($totalPages==0) $totalPages=1;
	$StartIndex= ($page-1)*$pageLimit;
	
	if(count($records)>0) $recordsArr = array_slice($records,$StartIndex,$pageLimit,true);
	
	if(count($records)>0 && $totalPages > 1){ 
		$rs_pagination = generatePagination("mdashboardDlts", $totalRows, count($recordsArr), $pageLimit, $adjacent, $page); 
	}
	
	$html = "<table border='0' cellpadding='0' cellsapcing='0' width='100%' class='".$contentDtls['TableClass']."'>";
	
	$html .= "	<tr>";
	
		foreach($contentDtls['Fields'] as $hk=>$hv){
			$html .= '<th>'.$hv.'</th>';
		}
		
	$html .= "	</tr>";

	if(count($recordsArr)>0) {
		foreach($recordsArr as $rk=>$rv){ 
			$html .= "	<tr>";
				foreach($rv as $kk=>$vv){ 
					if($kk=="Total") { $txtalign = "align='right' style='background:#ffb330;'"; } else $txtalign = "align=''";
					$html .= '<td '.$txtalign.'>'.$vv.'</td>';
				}
			$html .= "	</tr>";
		}
		
		if($rs_pagination!='') {
			$html .= "	<tr height='39'>";
				$html .= "<td colspan='$totalColumns' style='width:97%;'>".$rs_pagination."</td>";
			$html .= "	</tr>";
		}
		
	} else {
		$html .= "	<tr>";
			$html .= "<td colspan='".$totalColumns."' style='width:97%;'>No Results Found</td>";
		$html .= "	</tr>";
	}
	
	$html .= "<table>";

	return $html;
	
}
/*
// Get STATE from Google GeoData
function reverse_geocode($address) {
	$address = str_replace(" ", "+", "$address");
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
	$result = file_get_contents("$url");
	$json = json_decode($result);

	foreach ($json->results as $result)
	{
		foreach($result->address_components as $addressPart) {
			if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$city = $addressPart->long_name;
	    	else if(((in_array('administrative_area_level_1', $addressPart->types))) && (in_array('political', $addressPart->types)))
	    		$state = $addressPart->long_name;
	    	else if(((in_array('administrative_area_level_2', $addressPart->types))) && (in_array('political', $addressPart->types)))
	    		$disctrict = $addressPart->long_name;
			else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$country = $addressPart->long_name;
			else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$country = $addressPart->long_name;
		}
		
		$lat = $result->geometry->location->lat;
		$long = $result->geometry->location->lng;
	}
	
	if(($city != '') && ($state != '') && ($country != ''))
		$address = $city.', '.$state.', '.$country;
	else if(($city != '') && ($state != ''))
		$address = $city.', '.$state;
	else if(($state != '') && ($country != ''))
		$address = $state.', '.$country;
	else if($country != '')
		$address = $country;
		
	$addressArr=array();
	$addressArr['Lat']=$lat;
	$addressArr['Long']=$long;
	$addressArr['Country']=$country;
	$addressArr['State']=$state;
	$addressArr['District']=$disctrict;
	$addressArr['City']=$city;
	
	// return $address;
	//return "$lat/$long/$country/$state/$disctrict/$city";
	return $addressArr;
}*/

function getDistance($lat1, $lng1, $lat2, $lng2, $unit = 'mi') {
	// radius of earth; @note: the earth is not perfectly spherical, but this is considered the 'mean radius'
	if ($unit == 'km') $radius = 6371.009; // in kilometers
	elseif ($unit == 'mi') $radius = 3958.761; // in miles

	// convert degrees to radians
	$lat1 = deg2rad((float) $lat1);
	$lng1 = deg2rad((float) $lng1);
	$lat2 = deg2rad((float) $lat2);
	$lng2 = deg2rad((float) $lng2);

	// great circle distance formula
	return $radius * acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lng1 - $lng2));
}

// Get STATE from Google GeoData
function reverse_geocode($address) {
	$address = str_replace(" ", "+", "$address");
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
	$result = file_get_contents("$url");
	$json = json_decode($result);

	foreach ($json->results as $result)
	{
		foreach($result->address_components as $addressPart) {
			if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$city = $addressPart->long_name;
	    	else if(((in_array('administrative_area_level_1', $addressPart->types))) && (in_array('political', $addressPart->types)))
	    		$state = $addressPart->short_name;
	    	else if(((in_array('administrative_area_level_2', $addressPart->types))) && (in_array('political', $addressPart->types)))
	    		$disctrict = $addressPart->long_name;
			else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$country = $addressPart->long_name;
			else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
	    		$country = $addressPart->long_name;
		}
		
		$lat = $result->geometry->location->lat;
		$long = $result->geometry->location->lng;
	}
	
	if(($city != '') && ($state != '') && ($country != ''))
		$address = $city.', '.$state.', '.$country;
	else if(($city != '') && ($state != ''))
		$address = $city.', '.$state;
	else if(($state != '') && ($country != ''))
		$address = $state.', '.$country;
	else if($country != '')
		$address = $country;
		
	$addressArr=array();
	$addressArr['Lat']=$lat;
	$addressArr['Long']=$long;
	$addressArr['Country']=$country;
	$addressArr['State']=$state;
	$addressArr['District']=$disctrict;
	$addressArr['City']=$city;
	
	// return $address;
	//return "$lat/$long/$country/$state/$disctrict/$city";
	return $addressArr;
}


/**
* easy image resize function
* @param $file - file name to resize
* @param $string - The image data, as a string
* @param $width - new image width
* @param $height - new image height
* @param $proportional - keep image proportional, default is no
* @param $output - name of the new file (include path if needed)
* @param $delete_original - if true the original image will be deleted
* @param $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
* @param $quality - enter 1-100 (100 is best quality) default is 100
* @return boolean|resource
*/
function smart_resize_image($file, $string = null, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false, $quality = 100) {
	
	if ( $height <= 0 && $width <= 0 ) return false;
	if ( $file === null && $string === null ) return false;
	
	# Setting defaults and meta
	$info = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
	$image = '';
	$final_width = 0;
	$final_height = 0;
	list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
	
	# Calculating proportionality
	if ($proportional) {
		if ($width == 0) $factor = $height/$height_old;
		elseif ($height == 0) $factor = $width/$width_old;
		else $factor = min( $width / $width_old, $height / $height_old );
		$final_width = round( $width_old * $factor );
		$final_height = round( $height_old * $factor );
	}
	else {
		$final_width = ( $width <= 0 ) ? $width_old : $width;
		$final_height = ( $height <= 0 ) ? $height_old : $height;
		$widthX = $width_old / $width;
		$heightX = $height_old / $height;
		$x = min($widthX, $heightX);
		$cropWidth = ($width_old - $width * $x) / 2;
		$cropHeight = ($height_old - $height * $x) / 2;
	}
	
	# Loading image to memory according to type
	switch ( $info[2] ) {
		case IMAGETYPE_JPEG: $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string); break;
		case IMAGETYPE_GIF: $file !== null ? $image = imagecreatefromgif($file) : $image = imagecreatefromstring($string); break;
		case IMAGETYPE_PNG: $file !== null ? $image = imagecreatefrompng($file) : $image = imagecreatefromstring($string); break;
		default: return false;
	}
	
	# This is the resizing/resampling/transparency-preserving magic
	$image_resized = imagecreatetruecolor( $final_width, $final_height );
	if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
		$transparency = imagecolortransparent($image);
		$palletsize = imagecolorstotal($image);
		if ($transparency >= 0 && $transparency < $palletsize) {
			$transparent_color = imagecolorsforindex($image, $transparency);
			$transparency = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
			imagefill($image_resized, 0, 0, $transparency);
			imagecolortransparent($image_resized, $transparency);
		}
		elseif ($info[2] == IMAGETYPE_PNG) {
			imagealphablending($image_resized, false);
			$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
			imagefill($image_resized, 0, 0, $color);
			imagesavealpha($image_resized, true);
		}
	}
	imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	# Taking care of original, if needed
	if ( $delete_original ) {
		if ( $use_linux_commands ) exec('rm '.$file);
		else @unlink($file);
	}
	
	# Preparing a method of providing result
	switch ( strtolower($output) ) {
		case 'browser':
		$mime = image_type_to_mime_type($info[2]);
		header("Content-type: $mime");
		$output = NULL;
		break;
		case 'file':
		$output = $file;
		break;
		case 'return':
		return $image_resized;
		break;
		default:
		break;
	}
	# Writing image according to type to the output destination and image quality
	switch ( $info[2] ) {
		case IMAGETYPE_GIF: imagegif($image_resized, $output); break;
		case IMAGETYPE_JPEG: imagejpeg($image_resized, $output, $quality); break;
		case IMAGETYPE_PNG:
		$quality = 9 - (int)((0.9*$quality)/10.0);
		imagepng($image_resized, $output, $quality);
		break;
		default: return false;
	}
	
return true;
}

function generateRandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getYesorNo($value) {
	if($value=="N") $val = "No";
	else if($value=="Y") $val = "Yes";
	else $val = "";
	return $val;
}

function randomCharacter($length=6) {
    $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function getCountryByIp($ip) {
    return file_get_contents("http://ipinfo.io/{$ip}/country");
}

function getCountryCode() {
	
return $countrycode = array('AF'=>'93', 'AL'=>'355', 'DZ'=>'213', 'AS'=>'001', 'AD'=>'376', 'AO'=>'244', 'AI'=>'001', 'AQ'=>'672', 'AG'=>'001', 'AR'=>'54', 'AM'=>'374', 'AW'=>'297', 'AU'=>'61', 'AT'=>'43', 'AZ'=>'994', 'BS'=>'001', 'BH'=>'973', 'BD'=>'880', 'BB'=>'001', 'BY'=>'375', 'BE'=>'32', 'BZ'=>'501', 'BJ'=>'229', 'BM'=>'001', 'BT'=>'975', 'BO'=>'591', 'BA'=>'387', 'BW'=>'267', 'BR'=>'55', 'IO'=>'246', 'BN'=>'673', 'BG'=>'359', 'BF'=>'226', 'BI'=>'257', 'KH'=>'855', 'CM'=>'237', 'CA'=>'001', 'CV'=>'238', 'KY'=>'001', 'CF'=>'236', 'TD'=>'235', 'CL'=>'56', 'CN'=>'86', 'CX'=>'61', 'CC'=>'61', 'CO'=>'57', 'KM'=>'269', 'CG'=>'242', 'CD'=>'243', 'CK'=>'682', 'CR'=>'506', 'HR'=>'385', 'CU'=>'53', 'CY'=>'357', 'CZ'=>'420', 'CI'=>'225', 'DK'=>'45', 'DJ'=>'253', 'DM'=>'001', 'DO'=>'001', 'EC'=>'593', 'EG'=>'20', 'SV'=>'503', 'GQ'=>'240', 'ER'=>'291', 'EE'=>'372', 'ET'=>'251', 'FK'=>'500', 'FO'=>'298', 'FJ'=>'679', 'FI'=>'358', 'FR'=>'33', 'GF'=>'594', 'PF'=>'689', 'GA'=>'241', 'GM'=>'220', 'GE'=>'995', 'DE'=>'49', 'GH'=>'233', 'GI'=>'350', 'GR'=>'30', 'GL'=>'299', 'GD'=>'001', 'GP'=>'590', 'GU'=>'001', 'GT'=>'502', 'GG'=>'44', 'GN'=>'224', 'GW'=>'245', 'GY'=>'592', 'HT'=>'509', 'VA'=>'39', 'HN'=>'504', 'HK'=>'852', 'HU'=>'36', 'IS'=>'354', 'IN'=>'91', 'ID'=>'62', 'IR'=>'98', 'IQ'=>'964', 'IE'=>'353', 'IM'=>'44', 'IL'=>'972', 'IT'=>'39', 'JM'=>'001', 'JP'=>'81', 'JE'=>'44', 'JO'=>'962', 'KZ'=>'7', 'KE'=>'254', 'KI'=>'686', 'KP'=>'850', 'KR'=>'82', 'KW'=>'965', 'KG'=>'996', 'LA'=>'856', 'LV'=>'371', 'LB'=>'961', 'LS'=>'266', 'LR'=>'231', 'LY'=>'218', 'LI'=>'423', 'LT'=>'370', 'LU'=>'352', 'MO'=>'853', 'MK'=>'389', 'MG'=>'261', 'MW'=>'265', 'MY'=>'60', 'MV'=>'960', 'ML'=>'223', 'MT'=>'356', 'MH'=>'692', 'MQ'=>'596', 'MR'=>'222', 'MU'=>'230', 'YT'=>'269', 'MX'=>'52', 'FM'=>'691', 'MD'=>'373', 'MC'=>'377', 'MN'=>'976', 'ME'=>'382', 'MS'=>'001', 'MA'=>'212', 'MZ'=>'258', 'MM'=>'95', 'NA'=>'264', 'NR'=>'674', 'NP'=>'977', 'NL'=>'31', 'AN'=>'599', 'NC'=>'687', 'NZ'=>'64', 'NI'=>'505', 'NE'=>'227', 'NG'=>'234', 'NU'=>'683', 'NF'=>'672', 'MP'=>'001', 'NO'=>'47', 'OM'=>'968', 'PK'=>'92', 'PW'=>'680', 'PS'=>'970', 'PA'=>'507', 'PG'=>'675', 'PY'=>'595', 'PE'=>'51', 'PH'=>'63', 'PL'=>'48', 'PT'=>'351', 'PR'=>'001', 'QA'=>'974', 'RO'=>'40', 'RU'=>'7', 'RW'=>'250', 'RE'=>'262', 'BL'=>'590', 'SH'=>'290', 'KN'=>'001', 'LC'=>'001', 'MF'=>'590', 'PM'=>'508', 'VC'=>'001', 'WS'=>'685', 'SM'=>'378', 'ST'=>'239', 'SA'=>'966', 'SN'=>'221', 'RS'=>'381', 'SC'=>'248', 'SL'=>'232', 'SG'=>'65', 'SK'=>'421', 'SI'=>'386', 'SB'=>'677', 'SO'=>'252', 'ZA'=>'27', 'GS'=>'500', 'SS'=>'211', 'ES'=>'34', 'LK'=>'94', 'SD'=>'249', 'SR'=>'597', 'SJ'=>'47', 'SZ'=>'268', 'SE'=>'46', 'CH'=>'41', 'SY'=>'963', 'TW'=>'886', 'TJ'=>'992', 'TZ'=>'255', 'TH'=>'66', 'TL'=>'670', 'TG'=>'228', 'TK'=>'690', 'TO'=>'676', 'TT'=>'001', 'TN'=>'216', 'TR'=>'90', 'TM'=>'993', 'TC'=>'001', 'TV'=>'688', 'UG'=>'256', 'UA'=>'380', 'AE'=>'971', 'GB'=>'44', 'US'=>'001', 'UY'=>'598', 'UZ'=>'998', 'VU'=>'678', 'VE'=>'58', 'VN'=>'84', 'VG'=>'001', 'VI'=>'001', 'WF'=>'681', 'EH'=>'212', 'YE'=>'967', 'ZM'=>'260', 'ZW'=>'263', 'AX'=>'358');

}

?>