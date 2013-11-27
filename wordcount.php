<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');

	$sql = mysql_query("SELECT * FROM causes WHERE deleted='0'");
	while($array = mysql_fetch_array($sql)){

		$json = $array['description'];
		$jsondescarray = json_decode($json,true);

		for($i=0;$i<count($jsondescarray['data']);$i++){

			$datatext = preg_replace("/[^A-Za-z0-9 ]/", '', $jsondescarray['data'][$i]['data']['text']);
			$arr = explode(' ', $datatext);

			for($y=0;$y<count($arr);$y++){
				
				$arr[$y] = strtolower($arr[$y]);

				if (strpos($arr[$y],'http') !== false || $arr[$y]=='') {
				    unset($arr[$y]);
				    break;
				}
				
				$words[$arr[$y]]['word'] = $arr[$y];
				$words[$arr[$y]]['num'] += 1;
				$total += 1;

			}
		}
	}

	arsort($words);
	$words = array_values($words);

	for($i=0;$i<count($words);$i++){
		$words[$i]['percent'] = $words[$i]['num'] / $total;
		$words[$i]['percent'] = $words[$i]['percent'] * 100;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Word Stats for descriptions</title>
</head>
<body>
	<div id='word' style='font-size: 25px; padding: 5px; margin-top: 10px;'>Hover over a bar to show the word</div>

	<div style='width: 100%; background-color: black; height: 50px; margin-top: 25px;'>
	<?php
		for($i=0;$i<count($words);$i++){
			$movercommand = "document.getElementById('word').innerHTML = '".$words[$i]['word']."';";
			echo '<div style="width: '.$words[$i]['percent'].'%; height: 50px; float: left; background-color: rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).');" onmouseover="'.$movercommand.'"><br></div>';
		}
	?>
	</div>
</body>
</html>