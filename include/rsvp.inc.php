<?php

if (isset($_POST['rsvp-submit'])) {

	require 'dbh.inc.php';


	$firstName = $_POST['first'];
	$lastName = $_POST['last'];
	$attend = $_POST['att'];
	$numAttend = $_POST['numAtt'];
	$songRec = $_POST['song'];

//Error Handling
	//Check if empty
	if (empty($firstName) || empty($lastName) || empty($attend) || empty($numAttend) || empty($songRec)) {
		header("Location: ../rsvp.php?error=emptyfields&first=".$firstName."&last=".$lastName."&att=".$attend."&numAtt=".$numAttend."&song=".$songRec);
		exit();
	}
	//Checks guest name for #'s
	else if (!preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $lastName)) {
		header("Location: ../rsvp.php?error=invalidname&att=".$attend."&numAtt=".$numAttend."&song=".$songRec);
		exit();
	}
	else {
		$sql = "SELECT First_Name AND Last_Name FROM userData WHERE First_Name=? OR Last_Name=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../rsvp.php?error=sqlerror");
			exit();
		}
		////Checking for duplicate names on Guest list////
		else { 
			mysqli_stmt_bind_param($stmt, "s", $firstName);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("Location: ../rsvp.php?error=GuestAlreadyRSVP&att=".$attend."&numAtt".$numAttend."&song".$songRec);
				exit();
			}
			else {

				$sql = "INSERT INTO userData (First_Name, Last_Name, Attending, Number_Attending, Song_Recommendations) VALUES (?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);

				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../rsvp.php?error=sqlerror2");
					exit();
				}
				else {
					mysqli_stmt_bind_param($stmt, "sssis", $firstName, $lastName, $attend, $numAttend, $songRec);
					mysqli_stmt_execute($stmt);
					header("Location: ../rsvp_success.php");
					exit();
				}	
			}
		}

	}
	//Close to save resources
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

}
else {
	header("Location: ../rsvp.php");
	exit();
}

?>