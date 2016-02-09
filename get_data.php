<?php
	require 'functions.php';

	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// log file
	$file = "output.txt";
	// check if file exists
	if (!file_exists($file)) {
		print 'ERROR (get_data.php): File not found';
	}
	// check if file can be opened (permissions etc)
	else if (!$fh = fopen($file, 'a')) {
		print 'ERROR (get_data.php): Can\'t open file';
	}
	else {
		// writing to log file
		fwrite($fh, PHP_EOL . PHP_EOL . "---------------------------------------------------------------------------------------------------------------------" . PHP_EOL);
		fwrite($fh, date("m/d/Y h:i:s a", time()) . ": getting data" . PHP_EOL);

		// arrays
    	$classes_array[] = array();
    	$s_bg_color_array[] = array();
    	$s_fore_color_array[] = array();
    	$s_css_top_array[] = array();
    	$s_css_left_array[] = array();
    	$s_css_width_array[] = array();
    	$s_days_array[] = array();

    	$teachers_array[] = array();
    	$t_bg_color_array[] = array();
    	$t_fore_color_array[] = array();
    	$t_days_array[] = array();

		// handle connection
		$connection = include 'connection.php';
		if ($connection == null) {
			fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#40 (get_data.php): Error while connecting to server: " . PHP_EOL);
		}
		else {
			// get classes
			$sql = "SELECT class_name, bg_color, fore_color, css_top, css_left, width, on_day FROM classes";
			$result = mysqli_query($connection, $sql);
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$classes_array[] = $row['class_name'];
			    	$s_bg_color_array[] = $row['bg_color'];
			    	$s_fore_color_array[] = $row['fore_color'];
			    	$s_css_top_array[] = $row['css_top'];
			    	$s_css_left_array[] = $row['css_left'];
			    	$s_css_width_array[] = $row['width'];
			    	$s_days_array[] = getDayName($fh, $connection, $row['on_day']);
			    }
			} else {
				fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#57 (get_data.php): Can't get classes: " . $sql . " == " . $connection->error . PHP_EOL);
			}

			// get teachers
			$sql = "SELECT teacher_name, bg_color, fore_color, on_day FROM teachers";
			$result = mysqli_query($connection, $sql);
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$teachers_array[] = $row['teacher_name'];
			    	$t_bg_color_array[] = $row['bg_color'];
			    	$t_fore_color_array[] = $row['fore_color'];
			    	$t_days_array[] = getDayName($fh, $connection, $row['on_day']);
			    }
			} else {
				fwrite($fh, date("m/d/Y h:i:s a", time()) . "...ERROR Line#71 (get_data.php): Can't get teachers: " . $sql . " == " . $connection->error . PHP_EOL);
			}

			// prepare final data and send back
			$final_data = array();
			$final_data["classes"] = $classes_array;
			$final_data["s_bg_colors"] = $s_bg_color_array;
			$final_data["s_fore_colors"] = $s_fore_color_array;
			$final_data["s_css_top"] = $s_css_top_array;
			$final_data["s_css_left"] = $s_css_left_array;
			$final_data["s_css_width"] = $s_css_width_array;
			$final_data["s_days"] = $s_days_array;

			$final_data["teachers"] = $teachers_array;
			$final_data["t_bg_colors"] = $t_bg_color_array;
			$final_data["t_fore_colors"] = $t_fore_color_array;
			$final_data["t_days"] = $t_days_array;
			echo json_encode($final_data);
		}
		fclose($fh);
	}

?>
