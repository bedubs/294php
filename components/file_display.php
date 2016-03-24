<?php

$file_name = "./book_record.txt";
$file_header = "Author%Title%ISBN%Publisher%Year\n";

if (file_exists($file_name)) {
	$book_record = fopen($file_name, "r") or die("No Data to Display");
	echo "<table class=\"mdl-data-table mdl-js-data-table mdl-cell-elements\">";
	echo "";
	$lcounter = 0;
	while (!feof($book_record)) {
		$line = array();
		$line = fgetcsv($book_record, 0, "%");
		$num = count($line);

		if ($lcounter == 0) {
			echo "<thead><tr>";
			for($i=0; $i<$num; $i++) {
				echo "<th>" . $line[$i] . "</th>";
			}
			echo "</tr></thead><tbody>";
		} else {
			echo "<tr data-mdl-data-table-selectable-name=\"books[]\" data-mdl-data-table-selectable-value=>";
			// (!empty($line[1]) ? $line[1] : $line[0])
			for($i=0; $i<$num; $i++) {	
				echo "<td>" . $line[$i] . "</td>";
			}
			echo "</tr>";	
		}
		$lcounter++;
	}	
	echo "</tbody></table>";
	fclose($book_record);
} else {
	$book_record = fopen($file_name, "a+") or die("No Data to Display");
	fwrite($book_record, $file_header);
	fclose($book_record);
}

include("includes/footer.php");

?>