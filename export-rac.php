<?php

	$conn = new mysqli("localhost", "root", "", "kaizensy_kaizendb");

	$month = 2;
	$month_name = 'February';
	$directory = 'daily-logins-february';
	for ($ctr = 1; $ctr <= 31 ; $ctr++) { 
		$sql = "
			SELECT
				COUNT(user_id)AS times_login,
				gm_log_users.user_id,
				gm_log_users.group_id,
				gm_log_users.`timestamp`,
				gm_users.username,
				gm_users.firstName,
				gm_users.lastName
			FROM
				gm_log_users
			INNER JOIN gm_users ON gm_log_users.user_id = gm_users.id
			WHERE
				gm_log_users.`timestamp` > '2018-{$month}-{$ctr} 00:00:00'
			AND gm_log_users.`timestamp` < '2018-{$month}-{$ctr} 23:59:59'
			AND gm_log_users.group_id = 185
			GROUP BY
				gm_log_users.user_id
			ORDER BY
				gm_log_users.user_id ASC
		";
		$result = $conn->query($sql);

		$file = fopen("{$directory}/{$month_name} {$ctr}, 2018.csv", 'w');
		$headers = array('Times Login', 'User ID', 'Time Stamp', 'Username', 'First Name', 'Last Name');
		fputcsv($file, $headers);

		while ($row = $result->fetch_assoc()) {
			$val = array($row['times_login'], $row['user_id'], $row['timestamp'], $row['username'], $row['firstName'], $row['lastName']);
			fputcsv($file, $val);
		}

		fclose($file);
	}