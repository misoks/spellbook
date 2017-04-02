<?php
	$stringData = $_POST["data"];

	$newSpell = array();

	// var_dump($_POST["classes"]);

	// echo "<br><br>";

	$newSpell["name"] = $_POST["spellName"];
	$newSpell["casting_time"] = $_POST["time"];
	$newSpell["components"] = $_POST["components"];
	$newSpell["description"] = utf8_encode($_POST["description"]);
	$newSpell["duration"] = $_POST["duration"];
	$newSpell["level"] = $_POST["level"];
	$newSpell["range"] = $_POST["range"];
	$newSpell["school"] = $_POST["school"];
	$newSpell["classes"] = $_POST["classes"];

	// var_dump($newSpell);

	$myFile = "spells.json";
	$jsonString = file_get_contents($myFile);
	$spellArray = json_decode($jsonString, true);
	if (!$spellArray["spells"]) {
		echo "Error json decoding string";
		exit;
	}

	array_push($spellArray["spells"], $newSpell);

	$modifiedSpellString = json_encode($spellArray);
	if (!$modifiedSpellString) {
		echo "Error json encoding array";
		exit;
	}

	switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }
	if ($error == JSON_ERROR_NONE) {
		$fh = fopen($myFile, 'w') or die("Can't open file");
		$success = file_put_contents($myFile,$modifiedSpellString);
		echo $success;
		fclose($fh);
	    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=index.html'>";    
	   
	}

	unset($_POST);
	exit; 

	
?>