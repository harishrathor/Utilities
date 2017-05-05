<?php

class DirUtility{
	private $cur_dir,$full_root_path,$parent_dir;

	function createDirs($full_root_path,$json){
		$this->full_root_path=$full_root_path;
		$this->parent_dir=$full_root_path;
		$parsed_json=json_decode($json);
		$parsed_json_array=(array)$parsed_json;
		$this->makeDirs('',$parsed_json_array,'');
	}

	function makeDirs($key_as_fol_name,$val_as_nested_dir,$parent_dir){

		if($key_as_fol_name)
			$this->cur_dir=$parent_dir.'/'.$key_as_fol_name;

		if($this->cur_dir)	
			if(!mkdir($this->full_root_path.$this->cur_dir,0777,true)){
					print("Failed to create dir ".$this->cur_dir." because of ");
					print_r(error_get_last());
				}
				else{
					print("Just created directory ".$this->cur_dir."\n");
				}

		if($val_as_nested_dir==""){
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
	$cr_dir=new DirUtility();
	$cr_dir->createDirs($full_root_path,$json);
	?>
