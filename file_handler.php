<?php

$file_name = "./book_record.txt";
$file_header = "Author%Title%ISBN%Publisher%Year\n";
$tab = "&nbsp;&nbsp;&nbsp;&nbsp;";

include("includes/header.php");
echo "<a class=\"mdl-button mdl-js-button mdl-button--raised\" href=\"book_form.php\" >Go back</a>";

$validation = array
(
	'string' => "/^[a-zA-Z ]*$/", 
);

function check_empty($input) 
{
	$p_value = "--";
	if(!empty($input)) { 
		$p_value = $input;
	}
	return $p_value;
}

$book_data = array
(
	"Author" 	=> $_POST["author"],
	"Title"  	=> $_POST["title"],
	"ISBN"	 	=> $_POST["isbn"],
	"Publisher"	=> $_POST["publisher"],
	"Year"	 	=> $_POST["year"], 
);

function loop_data($data) 
{
	foreach ($data as $key => $value) {
		echo "<li class=\"mdl-list__item\"><b>" . $key . ": </b>" . $GLOBALS['tab'] . $GLOBALS['tab'] . "<span style=\"color:green\" class=\"mdl-list__item-primary-content\">" . check_empty($value) . "</span></li>";
	}
}

function make_str($data)
{
	$subject = "";
	$loop = 0;
	foreach ($data as $key => $value) {
		if ($loop>0) {
			$subject = $subject . "%" . $value;
		} else {
			$subject = $value;
		}
		$loop++;
	}
	return $subject;
}

$operation = array
(
	"add" 	 => function($file, $data){ 
		echo "<h2 class=\"mdl-card__title-text\">Adding Book</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		$ulist = "<ul class=\"mdl-list\">" . loop_data($data) . "</ul>";
		$book_record = fopen($file, "a+");
		fputcsv($book_record, $data, "%");
		fclose($book_record);
	},
	"delete" => function($file, $data){ 
		echo "<h2 class=\"mdl-card__title-text\">Deleting Book</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		$ulist = "<ul class=\"mdl-list\">" . loop_data($data) . "</ul>";
		
		$a = $data["Author"];
		$b = $data["Title"];
		$c = $data["ISBN"];
		$d = $data["Publisher"];
		$e = $data["Year"];

		$pattern = "/$a%.*$b%.*$c%.*$d%.*$e.*/i";
		
		$book_record = fopen($file, "r+");
		$line_array = array();
		while (!feof($book_record)) {
			$line = fgets($book_record);
			$line = str_replace('"', '', $line);
			if (!preg_match($pattern, $line)) {				
				array_push($line_array, $line);
			} 			
		}
		fclose($book_record);

		$new_record = fopen($file, "w+");
		foreach($line_array as $item) {
			fwrite($new_record, $item);
		}
		fclose($new_record);

	},
	"edit" 	 => function($data){ 
		echo "<h2 class=\"mdl-card__title-text\">Editing Book</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		$ulist = "<ul class=\"mdl-list\">" . loop_data($data) . "</ul>";
	},
	"find" 	 => function($file, $data){ 
		echo "<h2 class=\"mdl-card__title-text\">Search Results</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		$subject = make_str($data);
		$a = $data["Author"];
		$b = $data["Title"];
		$c = $data["ISBN"];
		$d = $data["Publisher"];
		$e = $data["Year"];
		$pattern = "/$a%.*$b%.*$c%.*$d%.*$e.*/i";
		$book_record = fopen($file, "r");
		$line_array = array();
		while (!feof($book_record)) {
			$line = fgets($book_record);
			$line = str_replace('"', '', $line);
			if (preg_match($pattern, $line)) {				
				echo "<h3>Book info</h3><hr>";
				$line_array = explode("%", $line);
				foreach ($line_array as $item) {
					echo "<p>".$item."</p>";
				}
			} 
			
		}
			
		fclose($book_record);	
	},
);

echo "<div class=\"mdl-grid\"><div class=\"mdl-cell mdl-cell--5-col mdl-cell--top\">";

$error_count = 0;
$empty_count = 0;

if (isset($_POST["op_select"])) {
	$oper = $_POST["op_select"];
	if (file_exists($file_name)) {
		$book_record = fopen("./book_record.txt", "a+");
	} else {
		$book_record = fopen("./book_record.txt", "a+");
		fwrite($book_record, $file_header);
	}
	fclose($book_record);

	echo "<div class=\"mdl-card mdl-shadow--6dp mdl-cell-elements\" style=\"max-height:441px;\"><div class=\"mdl-card__title mdl-color--primary mdl-color-text--white\">";

	foreach ($book_data as $key => $value) {
		if(empty($value)) {
			$empty_count = $empty_count + 1;
		}
	}

	if (!preg_match($validation["string"], $book_data["Author"])) {
		$error_count = $error_count + 1;
	}

	if ($error_count>0 || $empty_count>4) {
		echo "<h2 class=\"mdl-card__title-text\">Error</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		echo "<p>Not all entries are valid.</p><p>Please try again</p>";
		
	} else {
		$operation[$oper]("./book_record.txt", $book_data);
	}

	echo "</div><div class=\"mdl-card__actions mdl-card--border\"><a class=\"mdl-button mdl-js-button\" href=\"book_form.php\" >Go back</a></div></div>";
	
} else {
	echo "<h3>You did not set the operation</h3>";
}

echo "</div><div class=\"mdl-cell mdl-cell--7-col mdl-cell--top\" style=\"max-height:400px; overflow-y:auto;\">";

include("components/file_display.php"); 

echo "</div></div>";

include("includes/footer.php");

?>