<?  

class PhpCsvGen {
	function PhpCsvGen($argvs=array()){
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
		$this->type=$type;
		$this->filename=$filename;
		$this->rdata = array();
		$this->BOF();
	}
	function BOF() {
		$this->data = '';
		$this->rdata = array();
	}
	function EOF() {
		$rows=count($this->rdata);
		$rowsvisited=0;
		for($rowindex=0;;$rowindex++){			
			if($rows<=$rowsvisited){
				break;
			}
			if(array_key_exists($rowindex, $this->rdata)){
				$rowsvisited++;
			}
			for($colindex=0;$colindex<$this->cols;$colindex++){
				$this->data .= $this->processData($this->rdata[$rowindex][$colindex]) . ( $colindex+1<$this->cols ? ',' : ( $rowsvisited<$rows ? "\n" : '' ) );
			}
		}	
	}
	function setCol($cols=0){
		$this->cols = $cols;
	}
	function processData($value){
		return '"' . str_replace('"', '""', $value) . '"';
	}
	function writeText($row, $col, $value ) {
		$this->rdata[$row][$col] = $value;
	} 
	function output($argvs=array()){
		$argvs=is_array($argvs)?$argvs:array(); extract($argvs);
		if($type!='')
			$this->type=$type;
		if($filename!='')
			$this->filename=$filename;
		$this->EOF();
		
		if($this->type=='I' || $this->type==''){
			ob_clean();
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-type: application/csv");
			header("Content-Disposition: inline;filename=".$this->filename.".csv");
			header("Content-Transfer-Encoding: binary ");			
			header("Content-Length: ".strlen($this->data));
			echo $this->data;
			exit();
		}
		elseif($this->type=='D' ){
			ob_clean();
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Type: application/csv");
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			header("Content-Disposition: attachment;filename=".$this->filename.".csv");
			header("Content-Transfer-Encoding: binary ");
			header("Content-Length: ".strlen($this->data));
			echo $this->data;
			exit();
		}		elseif($this->type=='F'){
			ob_clean();
			file_put_contents($this->filename.'.csv',$this->data);
			
		}
		
	}
}

?>