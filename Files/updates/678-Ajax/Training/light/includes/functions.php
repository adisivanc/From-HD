<?php

/******************************************
* Author: Ilan Mandel
* Copyright: Correlsense, 2011
*---------------------------------
* functions.php - general functions to make our lives easier
*******************************************/
 
 
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
		case 'aboutus.php':
		{
		$seourl='about-stemi2014';
		break;
		}
		case 'team.php':
		{
		$seourl='course-directors-stemi2014';
		break;
		}
		case 'venue.php':
		{
		$seourl='venue-stemi2014';
		break;
		}
		case 'contact.php':
		{
		$seourl='contact-stemi2014';
		break;
		}
		case 'organizers.php':
		{
		$seourl='team-stemi2014';
		break;
		}
		case 'newsletters.php':
		{
		$seourl='newsletters-stemi2014';
		break;
		}
		case 'registration.php':
		{
		$seourl='registration-stemi2014';
		break;
		}
		case 'cardiopersonaldtl.php':
		{
		$seourl='cardiology-personal-detail';
		break;
		}
		case 'stemipersonaldtl.php':
		{
		$seourl='stemi-personal-detail';
		break;
		}
		case 'registration_thankyou.php':
		{
		$seourl='registration-thankyou';
		break;
		}
		case 'newsletters.php':
		{
		$seourl='newsletters-stemi2014';
		break;
		}
		case 'privacy.php':
		{
		$seourl='privacy-policy-stemi2014';
		break;
		}
		case 'terms.php':
		{
		$seourl='terms-and-conditions-stemi2014';
		break;
		}
		case 'newsletter/issue1.php':
		{
		$seourl='newsletter/explore-interactively-the-latest-developments-in-st-elevation-myocardial-infarction';
		break;
		}
		case 'newsletter/issue2.php':
		{
		$seourl='newsletter/why-and-who-should-attend-this-conference';
		break;
		}
		case 'newsletter/issue3.php':
		{
		$seourl='newsletter/online-registration-is-now-open';
		break;
		}
		case 'schedule.php':
		{
		$seourl='schedule-stemi2014';
		break;
		}
		case 'newsletter/issue4.php':
		{
		$seourl='newsletter/the-scientific-programme-is-now-online';
		break;
		}
		case 'faculty.php':
		{
		$seourl='speakers-stemi2014';
		break;
		}
		case 'newsletter/invitation.php':
		{
		$seourl='newsletter/explore-interactively-the-latest-developments-in-management-of-st-elevation-myocardial-infarction';
		break;
		}
		case 'newsletter/venue.php':
		{
		$seourl='newsletter/2014-stemi-india-at-renaissance-mumbai';
		break;
		}
		case 'newsletter/magazine.php':
		{
		$seourl='newsletter/stemi-india-featured-on-cardiosource-worldnews';
		break;
		}
		case 'studentpersonaldtl.php':
		{
		$seourl='pg-student-registration';
		break;
		}
		case 'free_registration_thankyou.php':
		{
		$seourl='thankyou-for-registration';
		break;
		}
		case 'ippersonaldtl.php':
		{
		$seourl='industry-partner-personal-detail';
		break;
		}
		case 'sponsors.php':
		{
		$seourl='sponsors';
		break;
		}
		case 'newsletter/issue7.php':
		{
		$seourl='newsletter/stemi-india-2014-conference-has-gone-mobile';
		break;
		}
		case 'newsletter/issue8_ws_course.php':
		{
		$seourl='newsletter/stemi-india-2014-courses-and-workshops';
		break;
		}
		case 'newsletter/issue9_mmc_accreditation.php':
		{
		$seourl='newsletter/mmc-accreditation-for-stemi-india-2014';
		break;
		}
		case 'newsletter/issue_mobile_app.php':
		{
		$seourl='newsletter/iphone-app-stemi-india-2014';
		break;
		}
		case 'gallery/index.php':
		{
			switch($p)
			{
				case 1:{
					$seourl = 'gallery/photo-day1';
					break;
				}
				case 2:{
					$seourl = 'gallery/photo-day2';
					break;
				
				}
			
			}
		break;
		}
		case 'newsletter/photo_gallery.php':
		{
		$seourl='newsletter/stemi-india-2014-photo-gallery';
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
	'KR'=>'KOREA REPUBLIC OF',
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
		'AN'=>'Andaman & Nicobar',
		'AP'=>'Andhra Pradesh',
		'AR'=>'Arunachal Pradesh',
		'AS'=>'Assam',
		'BR'=>'Bihar',
		'CH'=>'Chandigarh',
		'CG'=>'Chattisgarh',
		'DN','Dadra and Nagar Haveli',
		'DD'=>'Daman & Diu',
		'DL'=>'Delhi',
		'GA'=>'Goa',
		'GJ'=>'Gujarat',
		'HR'=>'Haryana',
		'HP'=>'Himachal Pradesh',
		'JK'=>'Jammu & Kashmir',
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
function maharastraDistrict(){
	
	return $district_array = array('Aurangabad'=>'Aurangabad',
								   'Bandra(Mumbai Suburban district)'=>'Bandra(Mumbai Suburban district)',
								   'Nagpur'=>'Nagpur',
								   'Pune'=>'Pune',
								   'Akola'=>'Akola',
								   'Chandrapur'=>'Chandrapur',
								   'Jalgaon'=>'Jalgaon',
								   'Parbhani'=>'Parbhani',
								   'Sholapur'=>'Sholapur',
								   'Thane'=>'Thane',
								   'Latur'=>'Latur',
								   'Mumbai'=>'Mumbai',
								   'Buldhana'=>'Buldhana',
								   'Dhule'=>'Dhule',
								   'Kolhapur'=>'Kolhapur',
								   'Nanded'=>'Nanded',
								   'Raigad'=>'Raigad',
								   'Amravati'=>'Amravati',
								   'Nashik'=>'Nashik',
								   'Wardha'=>'Wardha',
								   'Ahmednagar'=>'Ahmednagar',
								   'Beed'=>'Beed',
								   'Bhandara'=>'Bhandara',
								   'Gadchiroli'=>'Gadchiroli',
								   'Jalna'=>'Jalna',
								   'Osmanabad'=>'Osmanabad',
								   'Ratnagiri'=>'Ratnagiri',
								   'Sangli'=>'Sangli',
								   'Satara'=>'Satara',
								   'Sindudurg'=>'Sindudurg',
								   'Yavatmal'=>'Yavatmal',
								   'Nandurbar'=>'Nandurbar',
								   'Washim'=>'Washim',
								   'Gondia'=>'Gondia',
								   'Hingoli'=>'Hingoli'
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
	

?>