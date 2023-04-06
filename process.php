<?php
include("config.php");

if(isset($_POST['login'])){
	$loginUsername = cleanup($_POST['loginUsername']);
	$loginPassword = cleanup(sha1($_POST['loginPassword']));
	$chklogin = $conn->query("SELECT * FROM users WHERE username = '$loginUsername' AND password = '$loginPassword' ");
	if($chklogin->num_rows > 0){
		$lgd = $chklogin->fetch_assoc();
		$_SESSION['role'] = $lgd['role'];
		$_SESSION['user'] = $lgd['username'];
		header("location: home.php");
	}else{
		header("location: index.php?incorrect");
	}
}

if(isset($_POST['addstaff'])){
	$fullname = cleanup($_POST['sfullname']);
	$username = cleanup($_POST['susername']);
	$password = cleanup(sha1($_POST['spassword']));
	if(isset($_POST['sstatus'])){
		$sstatus = "active";
	}else{
		$sstatus = "inactive";
	}
	$chkstaff = $conn->query("SELECT * FROM users WHERE username = '$username' ");
	if($chkstaff->num_rows == 0){
		$ins = $conn->query("INSERT INTO users VALUES ('','$username','$password','staff','$sstatus','$fullname' )");
		header("location: staffs.php?added");
	}else{
		header("location: staffs.php?exists");
	}
}

if(isset($_POST['editstaff'])){
	$userid = cleanup($_POST['userid']);
	$efullname = cleanup($_POST['efullname']);
	$eusername = cleanup($_POST['eusername']);
	if(isset($_POST['sstatus'])){
		$sstatus = "active";
	}else{
		$sstatus = "inactive";
	}
	if(isset($_POST['resetpass'])){
		$npass = sha1(1234);
		$sql = $conn->query("UPDATE users SET fullname= '$efullname', username = '$eusername', password = '$npass', status = '$sstatus' WHERE userid = '$userid' ");
	}else{
		$sql = $conn->query("UPDATE users SET fullname= '$efullname', username = '$eusername' , status = '$sstatus' WHERE userid = '$userid' ");
	}
	
	header("location: staffs.php?editsuccess=".$userid);
}

if(isset($_POST['addcourse'])){
	$department = cleanup($_POST['department']);
	$coursecode = cleanup($_POST['coursecode']);
	$coursetitle = cleanup($_POST['coursetitle']);
	$courseunit = cleanup($_POST['courseunit']);
	$attendancemerit = cleanup($_POST['attendancemerit']);
	$studytimemerit = cleanup($_POST['studytimemerit']);
	$chkcourse = $conn->query("SELECT * FROM courses WHERE department = '$department' AND coursecode = '$coursecode' ");
	if($chkcourse->num_rows == 0){
		$ins = $conn->query("INSERT INTO courses VALUES ('','$department','$coursecode','$coursetitle','$courseunit','$attendancemerit','$studytimemerit') ");
		header("location: courses.php?added");
	}else{
		header("location: courses.php?exists");
	}
}

if(isset($_POST['addstudent'])){
	$matricno = cleanup($_POST['matricno']);
	$department = cleanup($_POST['department']);
	$age = cleanup($_POST['age']);
	$gender = cleanup($_POST['gender']);
	$attendancerating = cleanup($_POST['attendancerating']);
	$studytimerating = cleanup($_POST['studytimerating']);
	$yearadmitted = cleanup($_POST['yearadmitted']);
	$chkstudent = $conn->query("SELECT * FROM studentdata WHERE matricno = '$matricno' ");
	if($chkstudent->num_rows == 0){
		$ins = $conn->query("INSERT INTO studentdata VALUES ('','$matricno','$department','$age','$gender','$studytimerating','$attendancerating','$yearadmitted',Now()) ");
		header("location: students.php?added");
	}else{
		header("location: students.php?exists");
	}
}
if(isset($_POST['editstudent'])){
	$studid = cleanup($_POST['studid']);
	$ematric = $_POST['ematricno'];
	$edepartment = cleanup($_POST['edepartment']);
	$eage = cleanup($_POST['eage']);
	$egender = cleanup($_POST['egender']);
	$eattendancerating = cleanup($_POST['eattendancerating']);
	$estudytimerating = cleanup($_POST['estudytimerating']);
	$eyearadmitted = cleanup($_POST['eyearadmitted']);
	$updateQ = $conn->query("UPDATE studentdata SET department = '$edepartment', matricno = '$ematric', age = '$eage', gender = '$egender', studytime = '$estudytimerating', attendance = '$eattendancerating', yearadmitted = '$eyearadmitted' WHERE stud_id = '$studid' ");
	header("location: students.php?edited");
}

if(isset($_POST['adddataset'])){
	$course = cleanup($_POST['course']);
	$matricno = cleanup($_POST['matricno']);
	$attendancerating = cleanup($_POST['attendancerating']);
	$studytimerating = cleanup($_POST['studytimerating']);
	$score = cleanup($_POST['score']);
	$grade = getgrade($_POST['score']);
	$chkdata = $conn->query("SELECT * FROM coursestaken WHERE matricno = '$matricno' AND courseid = '$course' ");
	if($chkdata->num_rows == 0){
		$ins = $conn->query("INSERT INTO coursestaken VALUES ('','$course','$matricno','$attendancerating','$studytimerating','$score','$grade') ");
		// update matricno attendance and studytime average rating
		updatematricnorating($matricno);
		header("location: datasets.php?added");
	}else{
		header("location: datasets.php?exists");
	}
}

if(isset($_POST['uploaddataset'])){
	$file = $_FILES['csv']['tmp_name'];
	if (($handle = fopen($file, "r")) !== FALSE) {
	    # Set the parent multidimensional array key to 0.
	    $nn = 0;
	    while (($data = fgetcsv($handle, 15000, ",")) !== FALSE) {
	        # Count the total keys in the row.
	        $c = count($data);
	        # Populate the multidimensional array.
	        for ($x=0;$x<$c;$x++){
	            $csvarray[$nn][$x] = $data[$x];
	        }
	        $nn++;
	    }
	    # Close the File.
	    fclose($handle);
	}
	$pass = array();
	$fail = array();
	for ($x=1;$x<$nn;$x++){
	    $course = cleanup($csvarray[$x][0]);
	    $matricno = cleanup($csvarray[$x][1]);
	    $attendancerating = cleanup($csvarray[$x][2]);
	    $studytimerating = cleanup($csvarray[$x][3]);
	    $totalscore = cleanup($csvarray[$x][4]);
	    $chkdata = $conn->query("SELECT * FROM coursestaken WHERE matricno = '$matricno' AND courseid = '$course' ");
		if($chkdata->num_rows == 0){
			$ins = $conn->query("INSERT INTO coursestaken VALUES ('','$course','$matricno','$attendancerating','$studytimerating','$totalscore','') ");
			// update matricno attendance and studytime average rating
			updatematricnorating($matricno);
			$pass[] = $course;
		}else{
			$fail[] = $course;
		}
	}
	header("location: datasets.php?uploaded&pass=".count($pass)."&fail=".count($fail));
}

if(isset($_POST['predictscore'])){
	$courseid = cleanup($_POST['course']);
	$matric = cleanup($_POST['matric']);
	$staff = cleanup($_POST['staff']);
	// get course study and attendance rating
	$courseattendance = gettabledata('courses','courseid',$courseid,'meritattendance');
	$coursestudytime = gettabledata('courses','courseid',$courseid,'studytime');
	$matricattendance = gettabledata('studentdata','matricno',$matric,'attendance');
	$matricstudytime = gettabledata('studentdata','matricno',$matric,'studytime');
	$avgatt = ($courseattendance + $matricattendance)/200 * 100;
	$avgstu = ($coursestudytime + $matricstudytime)/200 * 100;
	$prescore = ceil(($avgstu + $avgatt)/200 * 100);
	$pregrade = getgrade($prescore);
	$updata = $conn->query("INSERT INTO coursestaken VALUES ('','$courseid','$matric','$avgatt','$avgstu','$prescore','$pregrade') ");
	updatematricnorating($matric);
	header("location: home.php?result=$matric&course=$courseid&avgatt=$avgatt&avgstu=$avgstu&score=$prescore&staff=$staff");
}

if(isset($_POST['saveprediction'])){
	$student = cleanup($_POST['student']);
	$courseid = cleanup($_POST['courseid']);
	$staff = cleanup($_POST['staff']);
	$avgatt = cleanup($_POST['avgatt']);
	$avgstu = cleanup($_POST['avgstu']);
	$prescore = cleanup($_POST['prescore']);
	$pregrade = getgrade($prescore);
	$chkpred = $conn->query("SELECT * FROM predictions WHERE courseid = '$courseid' AND matricno = '$student' ");
	if($chkpred->num_rows == 0){
		$ins = $conn->query("INSERT INTO predictions VALUES ('','$courseid','$student','$avgatt','$avgstu','$prescore','','complete',Now(),'$staff') ");
		header("location: home.php?success=".$student);
	}else{
		header("location: home.php?scoreexist&matricno=".$student);
	}
}

if(isset($_GET['test'])){
	/*$courseid = 1;
	$matric = '19/1111';
	$staff = cleanup($_POST['staff']);
	// get course study and attendance rating
	$courseattendance = gettabledata('courses','courseid',$courseid,'meritattendance');
	$coursestudytime = gettabledata('courses','courseid',$courseid,'studytime');
	$matricattendance = gettabledata('studentdata','matricno',$matric,'attendance');
	$matricstudytime = gettabledata('studentdata','matricno',$matric,'studytime');

	$avgatt = ($courseattendance + $matricattendance)/200 * 100;
	$avgstu = ($coursestudytime + $matricstudytime)/200 * 100;
	$prescore = ($avgstu + $avgatt)/200 * 100;

	echo $avgatt.'<br>'.$avgstu.'<br>'.$prescore;*/
}