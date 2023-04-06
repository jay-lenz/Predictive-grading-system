 <?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'grading');
define('UPLOAD_DIR','media/');

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die("Connection failed: " . mysqli_connect_error());

function cleanup($value){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$data = $link->real_escape_string(stripslashes(htmlspecialchars($value)));
	return $data;
}
function check_login(){
	if(!isset($_SESSION['role'])){
		header("location: index.php?loggedout");
	}
}
function gettabledata($table,$field,$id,$data){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$sql = $link->query("SELECT * FROM ".$table." WHERE ".$field." = '$id' ORDER BY '$field' DESC LIMIT 1");
	$row = $sql->fetch_assoc();
	return $row[$data];
}
function getdatarow($table){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$data = $link->query("SELECT * FROM $table");
	return $data->num_rows;
}
function updatematricnorating($matricno){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$getalldata = $link->query("SELECT * FROM coursestaken WHERE matricno = '$matricno' ");
	$att = array();
	$stu = array();
	while($d = $getalldata->fetch_assoc()){
		$att[] = $d['attendance'];
		$stu[] = $d['studytime'];
	}
	$getstudinfo = $link->query("SELECT * FROM studentdata WHERE matricno = '$matricno' ");
	$studinfo = $getstudinfo->fetch_assoc();
	$attcount = count($att) + 1;
	$stucount = count($stu) + 1;
	$attsum = array_sum($att) + $studinfo['attendance'];
	$stusum = array_sum($stu) + $studinfo['studytime'];
	$newatt = ceil($attsum / $attcount);
	$newstu = ceil($stusum / $stucount);
	$link->query("UPDATE studentdata SET attendance = '$newatt', studytime = '$newstu' WHERE matricno = '$matricno' ");
	return 'done';
}
function getuserfullname($username){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$data = $link->query("SELECT * FROM users WHERE username = '$username'");
	$d = $data->fetch_assoc();
	return $d['fullname'];
}
function getstudentlist(){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$data = $link->query("SELECT * FROM studentdata");
	while($d = $data->fetch_assoc()){
		?>
		<option value="<?=$d['matricno']?>"><?=$d['matricno']?></option>
		<?php
	}
}
function getcourselist(){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$data = $link->query("SELECT * FROM courses");
	while($d = $data->fetch_assoc()){
		?>
		<option value="<?=$d['courseid']?>"><?=$d['coursecode']?> - <?=$d['coursetitle']?></option>
		<?php
	}
}
function getcourseinfo($courseid){
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$data = $link->query("SELECT * FROM courses WHERE courseid = '$courseid' ");
	$d = $data->fetch_assoc();
	return $d['coursecode'].'-'.$d['coursetitle'];
}
function departmentlist(){
	?>
	<option>Business Administration</option>
	<option>Computer Science</option>
	<option>Computer Technology</option>
	<option>Mass Communication</option>
	<option>Nursing</option>
	<option>Political Science</option>
	<option>Public Health and Administration</option>
	<?php
}
function getgrade($score){
	if($score <= 100 && $score >= 80){
		echo "A";
	}elseif($score < 80 && $score >= 60){
		echo "B";
	}elseif($score < 60 && $score >= 50){
		echo "C";
	}elseif($score < 50 && $score >= 40){
		echo "D";
	}elseif($score < 40 && $score >= 30){
		echo "E";
	}elseif($score < 30){
		echo "F";
	}
}
