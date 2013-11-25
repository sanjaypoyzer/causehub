<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php');

	$cid = $_POST['cid'];
	$mid = $_POST['mid'];
	$sql = mysql_query("SELECT id,uid,name,slug,banner,description,tags,hidden FROM causes WHERE id='$cid' AND deleted='0'");
	$row = mysql_fetch_array($sql);
	$causeid = $row['id'];
	$ownerid = $row['uid'];
	$causename = $row['name'];
	$causeslug = $row['slug'];
	$causebanner = $row['banner'];
	$causedescription = $row['description'];
	$causetags = $row['tags'];
	$causestart = $row['started'];
	$causehidden = $row['hidden'];

	$causesname = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $causename)));
	$causesname = str_replace('-', '', $causesname);

	$cmoduleformjson = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/modules/'.$mid.'/package/edit_form.json');
	$cmoduleform = json_decode($cmoduleformjson,true);
						
	if($cmoduleform['ch_ef_version']=='1'){
		$cmoduleform = recursive_array_replace('#causeid#', $causeid, $cmoduleform);
		$cmoduleform = recursive_array_replace('#causename#', $causename, $cmoduleform);
		$cmoduleform = recursive_array_replace('#causesname#', $causesname, $cmoduleform);
		$cmoduleform = recursive_array_replace('#causeslug#', $causeslug, $cmoduleform);
		$cmoduleform = recursive_array_replace('#causetags#', $causetags, $cmoduleform);
		$cmoduleform = recursive_array_replace('#user_id#', getCurrentUserInfo('id'), $cmoduleform);
		$cmoduleform = recursive_array_replace('#user_username#', getCurrentUserInfo('username'), $cmoduleform);
		$cmoduleform = recursive_array_replace('#user_email#', getCurrentUserInfo('email'), $cmoduleform);
		$cmoduleform = recursive_array_replace('#user_fname#', getCurrentUserInfo('fname'), $cmoduleform);
		$cmoduleform = recursive_array_replace('#user_lname#', getCurrentUserInfo('lname'), $cmoduleform);

		echo '<input id="mtypeid" name="mtypeid" type="hidden" value="'.$mid.'"';

		for($i=0;$i<count($cmoduleform['elements']);$i++){
			$currentelm = $cmoduleform['elements'][$i];
			if($currentelm['link']==''){
				$constructelm = '<'.$currentelm['tag'].' ';
			} else {
				if(substr($currentelm['link'], 0, 4)=='http'){
					$constructelm = '<a href="'.$currentelm['link'].'" target=_blank><'.$currentelm['tag'].' ';
				} else {
					$constructelm = '<a href="'.$currentelm['link'].'"><'.$currentelm['tag'].' ';
				}
			}

			for($y=0;$y<count($cmoduleform['elements'][$i]['attributes']);$y++){
				$currentattr = $cmoduleform['elements'][$i]['attributes'][$y];
				$constructelm .= $currentattr['name'].'="'.$currentattr['value'].'" ';
			}

			$constructelm .= '>'.$currentelm['innerHTML'].'</'.$currentelm['tag'].'>';
			if($currentelm['link']!=''){$constructelm .= '</a>';}
				echo $constructelm;
		}
	} else {
		echo 'The ch_ef_version is not compatible with this version of CauseHub, please upgrade your edit_form.json to a newer format.<br>';
		print_r($cmoduleform);
	}
								
?>