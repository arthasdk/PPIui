<?php
 function exec_enabled() {
   $disabled = explode(', ', ini_get('disable_functions'));
   return !in_array('exec', $disabled);
 }
 ?>
<?php
 function execInBackground($cmd) {
     if (substr(php_uname(), 0, 7) == "Windows"){
         pclose(popen("start /B ". $cmd, "r"));
     }
     else {
         //exec($cmd . " > /dev/null &"); //not needed because the executable is for windows only
     }
 }
?>
<?php
 $FLAG_ERROR=1; //easier to make changes
 $FLAG_OK=0;

// session_start(); //not needed
 ini_set('max_execution_time',-1);
 ini_set('memory_limit','256M');
 ini_set('max_input_time',-1);
//set_time_limit(0);

$timestamp=time();
$dirpath="files/"."$timestamp";
mkdir("$dirpath");


$file1=fopen("$dirpath"."/input1.txt","w");
$file2=fopen("$dirpath"."/input2.txt","w");
$file3=fopen("$dirpath"."/speciesname.txt","w");

$flag=$FLAG_OK;
$msg="";
if(empty($_POST['name']))
{
 $msg="NM"; //name missing
 $flag=$FLAG_ERROR;
 echo $msg;
 exit(); //cannot continue without details
}
if(empty($_POST['email']) && (strpbrk($_POST['email'],'@')==FALSE))
{
 $msg="MM"; //mail missing
 $flag=$FLAG_ERROR;
 echo $msg;
 exit(); //cannot continue without details
}
$jobsubmitter=$_POST['email'];//mail id of job submitter
if(empty($_POST['seq1']))
{
 $msg="S1M"; //sequnce 1 missing
 $flag=$FLAG_ERROR;
 echo $msg;
 exit(); //cannot continue without details
}
if(empty($_POST['seq2']))
{
 $msg="S2M"; //sequence 2 missing
 $flag=$FLAG_ERROR;
 echo $msg;
 exit(); //cannot continue without details
}


/*if($flag==$FLAG_ERROR) //not needed anymore, error handled above
 {
  echo $msg;
  exit(); //cannot continue without details
  }*/

if($flag==$FLAG_OK)// no problem then
{
 //echo $_POST["name"];
 //echo $_POST['seq1'];
 //echo $_POST['seq2'];
 //echo $_POST['species'];
 fwrite($file1,$_POST['seq1']);
 fwrite($file2,$_POST['seq2']);
 fwrite($file3,$_POST['species']);
 fclose($file1);
 fclose($file2);
 fclose($file3);
 exec_enabled();

// session_write_close(); //not needed
 $ar=array();
 $comand="svm-predict"." $timestamp";// used for calling exec() function
 //echo $comand;
  //exec('svm-predict.exe $timestamp',$ar);// passing command value is creating some problem and needs further explore thats why I use comand string variable to solve it
 //ideally, what is needed is, starter.php should spawn a create the necessary resources, spawn a process and exit, giving the usre the jobid/timestamp for future reference
 exec($comand);//ok for passing command value is creating some problem and needs further explore thats why I use comand string variable to solve it
 $msg="EX".$timestamp; //executing

// session_start(); //not needed

 // for send mail purpose
 ini_set("sendmail_from","bsriwastava@gmail.com");// setting forsendmail_from in php.ini
 $header="From: Brijesh<bsriwastava@gmail.com>\r\n";
 $header.="MIME-Version: 1.0\r\n";
 $header.="Content-type: text/html; charset=utf-8\r\n";
 $recipient=$jobsubmitter;
 $subject="Job Started";
 $message="**PPIcons Server Protein-Protein Interaction**\r\nYour job has been submitted\r\nYou will be notified of the results soon.\r\nYour job number, for future reference is ".$timestamp."\r\n\r\nThank You for using this service.";
 mail($recipient,$subject,$message,$header);//for sending mail
}
echo $msg;
exit(); //exit (redundant)
 ?>
