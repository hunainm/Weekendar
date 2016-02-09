<?php
	/*
	 * $fh:						file handle of log file
	 * $connection:				connection variable
	 *
	 * function used to empty DB
	 *
	 */
	function emptyDB($fh, $connection) {
		if (emptyTable($fh, $connection, 'classes') == 1 && emptyTable($fh, $connection, 'teachers') == 1 && emptyTable($fh, $connection, 'teachers_lst') == 1 && emptyTable($fh, $connection, 'classes_lst')) {
			return "Yes";
		} else {
			return "No";
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#13 (functions.php): Can't empty DB: ");
		}
	}

	function emptyTable($fh, $connection, $table_name) {
		$sql = "DELETE FROM $table_name WHERE 1";

		if ($connection->query($sql) === TRUE) {
		    return 1;
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#23 (functions.php): Can't delete $table_name: " . $sql . " == " . $connection->error);
		}
	}

	/*
	 * $fh:					file handle of log file
	 * $connection:			mysql connection variable
	 * $class:		 		class name
	 *
	 * function used to add a class to 'classes' table
	 *
	 */
	function addClass($fh, $connection, $class, $css_top, $css_left, $css_bg, $css_fore, $css_width, $day_id) {
		$sql_insert = "INSERT INTO classes (class_name, taught_by, css_top, css_left, bg_color, fore_color, width, on_day)
				VALUES ('$class', 1, '$css_top', '$css_left', '$css_bg', '$css_fore', '$css_width', $day_id)";

		if ($connection->query($sql_insert) === TRUE) {
			return $connection->insert_id;
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#42 (functions.php): Can't add class: " . $sql_insert . " == " . $connection->error);
		}
	}

	/*
	 * $fh:					file handle of log file
	 * $connection:			mysql connection variable
	 * $teacher:	 		teacher name
	 *
	 * function used to add a teacher to 'teachers' table
	 *
	 */
	function addTeacher($fh, $connection, $teacher, $css_top, $css_left, $css_bg, $css_fore, $day_id) {
		$sql_insert = "INSERT INTO teachers (teacher_name, css_top, css_left, bg_color, fore_color, on_day)
				VALUES ('$teacher', '$css_top', '$css_left', '$css_bg', '$css_fore', $day_id)";

		if ($connection->query($sql_insert) === TRUE) {
			return $connection->insert_id;
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#61 (functions.php): Can't add teacher: " . $sql_insert . " == " . $connection->error);
		}
	}

	/*
	 * $fh:					file handle of log file
	 * $connection:			mysql connection variable
	 * $teacher:		 	teacher name
	 *
	 * function used to add a teacher to 'teachers_lst' table
	 *
	 */
	function addTeacherList($fh, $connection, $teacher, $css_bg, $css_fore) {
		$sql_insert = "INSERT INTO teachers_lst (teacher_name, teacher_bgcolor, teacher_forecolor)
				VALUES ('$teacher', '$css_bg', '$css_fore')";

		if ($connection->query($sql_insert) === TRUE) {
			echo "YES";
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#80 (functions.php): Can't add teacher list: " . $sql_insert . " == " . $connection->error);
		}
	}

	/*
	 * $fh:					file handle of log file
	 * $connection:			mysql connection variable
	 * $class:			 	class name
	 *
	 * function used to add a class to 'class_lst' table
	 *
	 */
	function addClassList($fh, $connection, $class, $css_bg, $css_fore) {
		$sql_insert = "INSERT INTO classes_lst (class_name, class_bgcolor, class_forecolor)
				VALUES ('$class', '$css_bg', '$css_fore')";

		if ($connection->query($sql_insert) === TRUE) {
			echo "YES";
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#99 (functions.php): Can't add class list: " . $sql_insert . " == " . $connection->error);
		}
	}

	/*
	 * $fh:					file handle of log file
	 * $connection:			mysql connection variable
	 * $day:		 		day name
	 *
	 * function used to get day ID from day name from 'days' table
	 *
	 */
	function getClassDayID($fh, $connection, $day) {
		$day_id = 0;
		$sql = "SELECT day_id FROM days WHERE day_name='$day'";

		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $day_id = $row["day_id"];
		    }
		    return $day_id;
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#123 (functions.php): No rows found for $day: " . $sql . " == " . $connection->error);
			return 0;
		}
	}
	
	function getTeacherDayID($fh, $connection, $day) {
		$day_id = 0;
		$sql = "SELECT day_id FROM days WHERE day_name='$day'";

		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $day_id = $row["day_id"];
				
		    }
		    return $day_id;
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#123 (functions.php): No rows found for $day: " . $sql . " == " . $connection->error);
			return 0;
		}
	}


	/*
	 * $fh:					file handle of log file
	 * $connection:			mysql connection variable
	 * $day:		 		day name
	 *
	 * function used to get day name from day ID from 'days' table
	 *
	 */
	function getDayName($fh, $connection, $day) {
		$day_name = "";
		$sql = "SELECT day_name FROM days WHERE day_id='$day'";

		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $day_name = $row["day_name"];
		    }
		    return $day_name;
		} else {
			fwrite($fh, PHP_EOL . date("m/d/Y h:i:s a", time()) . "...ERROR Line#149 (functions.php): No rows found for $day: " . $sql . " == " . $connection->error);
			return "";
		}
	}

?>
