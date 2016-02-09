<html>
	<head>
	</head>
	<body>
		<?php
			require 'functions.php';
			ini_set('display_errors',1);
			ini_set('display_startup_errors',1);
			error_reporting(-1);

			// log file
			$file = "output.txt";
			// check if file exists
			if (!file_exists($file)) {
				print 'ERROR (receive.php): File not found';
			}
			// check if file can be opened (permissions etc)
			else if (!$fh = fopen($file, 'a')) {
				print 'ERROR (receive.php): Can\'t open file';
			}
			// if any data is received (is a valid GET request with parameters)
			else if (isset($_GET['days_array'])) {
				fwrite($fh, PHP_EOL . PHP_EOL . "---------------------------------------------------------------------------------------------------------------------");
				fwrite($fh, date("m/d/Y h:i:s a", time()) . ": writing to database" . PHP_EOL);
				saveToDatabase($fh, $_GET['days_array'], $_GET['starting_times_array'], $_GET['ending_times_array'], $_GET['classes_array']);
				fclose($fh);
			} else {
				echo "No access lad";
			}

		?>
	</body>
</html>

