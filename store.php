<?php
	$stringData = $_POST["data"];

	$newSpell = array();

	// var_dump($_POST["classes"]);

	// echo "<br><br>";

	$newSpell["name"] = $_POST["spellName"];
	$newSpell["casting_time"] = $_POST["time"];
	$newSpell["components"] = $_POST["components"];
	$newSpell["description"] = $_POST["description"];
	$newSpell["duration"] = $_POST["duration"];
	$newSpell["level"] = $_POST["level"];
	$newSpell["range"] = $_POST["range"];
	$newSpell["school"] = $_POST["school"];
	$newSpell["classes"] = $_POST["classes"];

	// var_dump($newSpell);

	$myFile = "spells.json";
	$jsonString = file_get_contents($myFile);
	$spellArray = json_decode($jsonString, true);

	array_push($spellArray["spells"], $newSpell);

	$modifiedSpellString = json_encode($spellArray);
	$error = json_last_error();
	if (!$error == JSON_ERROR_NONE) {
		$fh = fopen($myFile, 'w') or die("Can't open file");
		$success = file_put_contents($myFile,$modifiedSpellString);
		echo $success;
		fclose($fh);
	}


	unset($_POST);

    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=index.html'>";    
    exit; 
	
?>