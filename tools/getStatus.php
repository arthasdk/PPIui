<?php
$jobid=$_GET['job'];
if(empty($jobid)){
	echo "JE"; //job id error
	exit();
}else{
	$dp="../files/".$jobid;
	if(is_dir($dp)){
		//valid jpb id, directory exists
		$statf=$dp."/"."timeinfo.txt";
		if(is_file($statf)){
			$file=fopen($statf);
			if($file){
				$s=fgets($file);
				$arr=explode(",",$s);
				echo $arr[0]; //% complete
				exit();
			}else{
				echo "FE"; //file error, no access
				exit();			
			}
		}else{
			echo "FE"; //file error, does not exist
			exit();
		}
	}else{
		echo "JE"; //invalid job id
		exit();
	}
}
exit(); //redundant
?>
