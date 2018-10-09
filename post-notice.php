<?php

	$group_users = "|14503||9249||13758||13772||13741||8349||13764||8360||13855||8386||13763||13852||8378||13765||13739||8384||14560||13750||8385||8380||4367||14073||8363||8350||13756||13752||13854||8351||4366||8375||8572||8374||13740||8371||8379||13853||13768||13754||8376||8381||13749||13760||13986||8365||13753||9251||13745||13744||14587||8357||8445||14721||13777||13766||14725||13743||13746||8377||13776||9268||13759||8444||13769||8372||13755||8352||8417||13748||8373||8382||13747||13912||13751||8359||8361||8364||8370||13770||13742||8345||14308||8366||8355||14719||8348||8337||13952||8367||8358||8354||8338||8356||13757||13771||13762||14720||8362||12372||8353||8383||8369||8368||13767||13761|";


	function extract_ids($ids,$id_type = null,$delimeter = "|"){
		
		$extracted_ids = array();
		
		$ids = explode($delimeter,$ids);
		
		foreach($ids as $key => $id){
			
			if($id != "" && $id != null){
				
				if($id_type != null)		
					$extracted_ids[] = trim(str_replace($id_type, '', $id));
				else
					$extracted_ids[] = $id;
				
			}
			
		}
		
		return $extracted_ids;
		
	}

	$users = extract_ids($group_users);

	$notice_to_id = array("G1088");

	function get_active_user($user_id)
	{
		$conn = new mysqli("localhost", "root", "", "kaizensy_kaizendb");
		$sql = "SELECT * FROM gm_users WHERE id = '" . $user_id . "' AND userStatus = 'ACTIVE'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		return $row;
	}

	// foreach ($users as $key)
	// {
	// 	$row = get_active_user($key);
		
	// 	if (count($row) > 0)
	// 	{
	// 		if (in_array('P'.$row['positionId'], $notice_to_id))
	// 		{
	// 			echo "Hello";
	// 		}
	// 	}
	// }
	
	foreach ($notice_to_id as $to)
	{
		if (strpos($to, "G") !== false)
		{
			$toId = substr($to, 1);
			$conn = new mysqli("localhost", "root", "", "kaizensy_kaizendb");
			$sql = "SELECT * FROM gm_group_positiongroups_positions WHERE positionGroupId = '" . $toId . "'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

			if (count($row) > 0)
			{
				
			}
		}
	}