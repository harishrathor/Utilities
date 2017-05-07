<?php

class DirUtility{
	private $cur_dir,$full_root_path,$separator;

	function createDirs($full_root_path,$separator,$json){
		$this->full_root_path=$full_root_path;
		$this->separator=$separator;
		$constants = get_defined_constants(true);
		$json_errors = array();
		foreach ($constants["json"] as $name => $value) {
			if (!strncmp($name, "JSON_ERROR_", 11)) {
				$json_errors[$value] = $name;
			}
		}


		$parsed_json=json_decode(rtrim($json,"\0"),true); 

		echo 'Last error: ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
		

		$parsed_json_array=(array)$parsed_json;
		$this->makeDirs('',$parsed_json_array,'');
	}

	function makeDirs($key_as_fol_name,$val_as_nested_dir,$parent_dir){

		if($key_as_fol_name)
			$this->cur_dir=$parent_dir.$this->separator.$key_as_fol_name;

		if($this->cur_dir)	
			if(!mkdir($this->full_root_path.$this->cur_dir,0777)){
				print("Failed to create dir ".$this->cur_dir." because of ");
				print_r(error_get_last());
			}
			else{
				print("Just created directory ".$this->cur_dir."\n");
			}

			if($val_as_nested_dir=="/"){
				$this->cur_dir=$parent_dir;
				return ;
			}
			else {
				$parent_dir=$this->cur_dir;
				foreach ($val_as_nested_dir as $key => $value){
					$this->makeDirs($key,$value,$parent_dir);
				}

				return ;
			}
		}
	}
	
	$full_root_path=getcwd();
	$json=file_get_contents("file.json");
	$separator="/"; // "\\" for windows and "/" for linux

	$cr_dir=new DirUtility();
	$cr_dir->createDirs($full_root_path,$separator,$json);
	?>
