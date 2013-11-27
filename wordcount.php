<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/scripts/connect.php');

	$sql = mysql_query("SELECT * FROM causes WHERE id='24' AND deleted='0'");
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
<body id='body' style='top: 0; left: 0; width: 100%; height: 100%;'>
	<div style='width: 100%; background-color: black; height: 50px; margin-top: 25px;'>
	<?php
		for($i=0;$i<count($words);$i++){
			$movercommand = "document.getElementById('word').innerHTML = '".$words[$i]['word']."'; this.style.height = '60px'; document.getElementById('body').style.backgroundColor = this.style.backgroundColor;";
			$moutcommand = "document.getElementById('word').innerHTML = 'Hover over a bar to show the word'; this.style.height = '50px'; document.getElementById('body').style.backgroundColor = 'white';";
			echo '<div style="width: '.$words[$i]['percent'].'%; height: 50px; float: left; background-color: rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).');" onmouseover="'.$movercommand.'" onmouseout="'.$moutcommand.'"><br></div>';
		}
	?>
	</div>
	<div id='word' style='font-size: 45px; padding: 10px; margin-top: 50px; text-align: center; width: 100%; font-weight: bold;'>Hover over a bar to show the word</div>
</body>
</html>