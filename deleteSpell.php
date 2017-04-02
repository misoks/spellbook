<?php
	$spellID = intval($_GET["id"]);

	$myFile = "spells.json";
	$jsonString = file_get_contents($myFile);
	$spellArray = json_decode($jsonString, true);

	$spellName = $spellArray["spells"][$spellID]["name"];

	unset($spellArray["spells"][$spellID]);

	$modifiedSpellString = json_encode($spellArray);

	$fh = fopen($myFile, 'w') or die("Can't open file");
	
	$success = file_put_contents($myFile,$modifiedSpellString);
	if ($success) {
		echo "$spellName successfully deleted";
	}

	fclose($fh);
	
?>