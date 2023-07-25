<?

class FileUpload
{	
	var $FileToBeUploaded;
	var $ValidExtension;	
	var $FileName;
	var $File_Extension;
	var $File_Path;
	var $Prefix;

	function FileUpload(){}

	function Check_Val()
	{
		$err = "";
		if (!ini_get("file_uploads")) 
		{ 
			$err .= "HTTP file uploading is blocked in php configuration file (php.ini). Please, contact to server administrator."; 
			return $err; 
		}
		$pos = strpos(ini_get("disable_functions"), "move_uploaded_file");
		if ($pos !== false) 
		{ 
			$err .= "PHP function move_uploaded_file is blocked in php configuration file (php.ini). Please, contact to server administrator."; 
			return $err;
		}  
		
		return $err;
	}
	
	function AssignFile($InFile, $InputValidExt, $InputFilePath, $Prefix = "", $InputFileName = NULL)
	{
		if ($InFile['error'] == 4)
			return false;
		
		$this->FileToBeUploaded = $InFile;
		$FullFileName = trim($InFile["name"]);
		$length = strlen($FullFileName);
		$pos = strrpos($FullFileName, ".");	
		if ($pos === false) return false;		
		if ($length - $pos < 3 || $pos < 1) return false;

		$this->ValidExtension = $InputValidExt;
		$this->FileName = substr($FullFileName, 0, $pos);		
		$this->File_Extension = strtolower(substr($FullFileName, $pos + 1, $length - $pos - 1));
		$this->File_Path = $InputFilePath;
		$this->Prefix = $Prefix;
		
		if ($InputFileName != NULL && $InputFileName != "") $this->FileName = $InputFileName;
		
		return true;
	}
	
	function AssignFileName($InputFileName)
	{
		$this->FileName = $InputFileName;
	}
	
	function AssignFilePath($InputFilePath)
	{
		$this->File_Path = $InputFilePath;
	}
	
	function AssignFilePrefix($Prefix)
	{
		$this->Prefix = $Prefix;
	}
	
	function isNotEmptyFile()
	{
		$err = "";
		if (!isset($this->FileToBeUploaded)) 
		{ 
			$err .= "Empty file"; 
			return false; 
		}
  		elseif ( !is_uploaded_file( $this->FileToBeUploaded['tmp_name'] ) ) 
		{ 
			$err .= "Empty file"; 
			return false; 
		}		
  		return true;
		
	}
	
	function Check_Size()
	{
		if ( $this->FileToBeUploaded["size"] > MAX_FILE_SIZE)
			return false;
		else
			return true;
	}
	
	
	function Check_Valid_Ext()
	{
		if ( $this->ValidExtension == "*" )
			return true;
		
		$ExtArray = array_filter(explode(",", $this->ValidExtension));
		//print_r($ExtArray);
		if ( in_array($this->File_Extension, $ExtArray) )
			return true;
		else
			return false;
	}
	
	function Upload()
	{		
		if ( move_uploaded_file( $this->FileToBeUploaded["tmp_name"], $this->Prefix . $this->File_Path . "/". $this->FileName . "." .  $this->File_Extension) )
			return $this->File_Path . ($this->File_Path!=''?"/":''). $this->FileName . "." .  $this->File_Extension;
		else
			return "";
	}
	
	function AssignAndCheck($argvs=array()){
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
		$FileNotErrorBool = FALSE;
		if( $FileRef["error"] == 0 && $FileRef["size"] > 0 ){
			$File_Error = "";	
			$File_Error .= $this->Check_Val();
			$this->AssignFile($FileRef, $Extension, $Path, $PathPrefix,  $FileName); 
			if( $this->Check_Size() ){ 	
				if ( !$this->Check_Valid_Ext() ){
					$File_Error .= "InValid File Extension." . 
				( isset($this->File_Extension) && $this->File_Extension != "" ? "Enter ".$Extension ." format file" : "")
				."";
				}	
				if ( $this->isNotEmptyFile() && $File_Error == ""){
					return array('Type'=>2);
				}
				else{
					$FileNameError = $File_Error;
				}
			}
			else{
				$FileNameError = "Your are not able to upload more than " . MAX_FILE_SIZE_IN_MB . " ";
			}
			return array('Type'=>1, 'ErrorNo'=>2, 'Error'=>$FileNameError);	
		}
		else
			return array('Type'=>1, 'ErrorNo'=>1, 'Error'=>'Upload File');
	}

}


?>
