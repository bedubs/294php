<?php

$tab = "&nbsp;&nbsp;&nbsp;&nbsp;";

$db_conn = array
(
	"servername" => "localhost",
	"dbname" => "294_test",
	"username" => "secret",
	"password" => "secret",
);

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

$search_data = array
(
	!empty($_POST["select_by"]) ? $_POST["select_by"] : "NULL",
	$_POST["bkfield"],
);

function loop_data($data)
{
	foreach ($data as $key => $value) {
		echo "<li class=\"mdl-list__item\"><b>" . $key . ": </b>" . $GLOBALS['tab'] . $GLOBALS['tab'] . "<span style=\"color:green\" class=\"mdl-list__item-primary-content\">" . check_empty($value) . "</span></li>";
	}
}

$operation = array
(
	"add" 	 => function($db_conn, $data){
		echo "<h2 class=\"mdl-card__title-text\">Adding Book</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		$ulist = "<ul class=\"mdl-list\">" . loop_data($data) . "</ul>";
		// Create connection
		$conn = new mysqli($db_conn["servername"], $db_conn["username"], $db_conn["password"], $db_conn["dbname"]);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$a = $data["Author"];
		$b = $data["Title"];
		$c = $data["ISBN"];
		$d = $data["Publisher"];
		$e = $data["Year"];

		$sql = "INSERT INTO BookStore (author, title, isbn, publisher, year) 
		VALUES ( '$a', '$b', '$c', '$d', '$e' )";
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	},
	"delete" => function($db_conn, $data){
		echo "<h2 class=\"mdl-card__title-text\">Deleting Book</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		
		// Create connection
		$conn = new mysqli($db_conn["servername"], $db_conn["username"], $db_conn["password"], $db_conn["dbname"]);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$a = !empty($data[0]) ? "'$data[0]'" : "NULL";
		$b = !empty($data[1]) ? "'$data[1]'" : "NULL";

		extract($_POST);
		$a = str_replace("'", "", $a);

		$sql = "SELECT * FROM BookStore WHERE " . $a . " = " . $b;
		
		if ($result = $conn->query($sql)) {
			$row_cnt = $result->num_rows;
			printf("Result set has %d rows.\n", $row_cnt);
			while ($row = $result->fetch_assoc()) {
				echo "<h3>Book info</h3><hr>";
				echo "<ul>";
				echo "<li>ID: " . $row["id"] . "</li>";
				echo "<li>Title: " . $row["title"] . "</li>";
				echo "<li>Author: " . $row["author"] . "</li>";
				echo "<li>ISBN: " . $row["isbn"] . "</li>";
				echo "<li>Publisher: " . $row["publisher"] . "</li>";
				echo "<li>Year: " . $row["year"] . "</li>";
				echo "</ul>";
			}
			$result->close();
		} else {
			print_r("No luck.");
			echo $sql;
		}

		$sql = "DELETE FROM BookStore WHERE " . $a . " = " . $b;
		
		if ($result = $conn->query($sql)) {
			echo "<p>Deleting Selection</p>";
			//$result->close();
		} else {
			print_r("No luck.");
			echo $sql;
		}
		$conn->close();

	},
	"edit" 	 => function($db_conn, $data){
		echo "<h2 class=\"mdl-card__title-text\">Editing Book</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		$ulist = "<ul class=\"mdl-list\">" . loop_data($data) . "</ul>";
	},
	"find" 	 => function($db_conn, $data){
		echo "<h2 class=\"mdl-card__title-text\">Search Results</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
		//$subject = make_str($data);

		// Create connection
		$conn = new mysqli($db_conn["servername"], $db_conn["username"], $db_conn["password"], $db_conn["dbname"]);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$a = !empty($data[0]) ? "'$data[0]'" : "NULL";
		$b = !empty($data[1]) ? "'$data[1]'" : "NULL";

		extract($_POST);
		$a = str_replace("'", "", $a);
		$sql = "SELECT * FROM BookStore WHERE " . $a . " = " . $b;
		
		if ($result = $conn->query($sql)) {
			$row_cnt = $result->num_rows;
			printf("Result set has %d rows.\n", $row_cnt);
			while ($row = $result->fetch_assoc()) {
				echo "<h3>Book info</h3><hr>";
				echo "<ul>";
				echo "<li>ID: " . $row["id"] . "</li>";
				echo "<li>Title: " . $row["title"] . "</li>";
				echo "<li>Author: " . $row["author"] . "</li>";
				echo "<li>ISBN: " . $row["isbn"] . "</li>";
				echo "<li>Publisher: " . $row["publisher"] . "</li>";
				echo "<li>Year: " . $row["year"] . "</li>";
				echo "</ul>";
			}
			$result->close();
		} else {
			print_r("No luck.");
			echo $sql;
		}
		$conn->close();
	},
);

echo "<div class=\"mdl-grid\"><div class=\"mdl-cell mdl-cell--5-col mdl-cell--top\">";

$error_count = 0;
$empty_count = 0;

if (isset($_POST["op_select"])) {
	$oper = $_POST["op_select"];

	echo "<div class=\"mdl-card mdl-shadow--6dp mdl-cell-elements\" style=\"max-height:441px;\"><div class=\"mdl-card__title mdl-color--primary mdl-color-text--white\">";

	if ($oper == "add") {

		foreach ($book_data as $key => $value) {
			if(empty($value)) {
				$empty_count = $empty_count + 1;
			}
		}

		if (!preg_match($validation["string"], $book_data["Author"])) {
			$error_count = $error_count + 1;
		}

		if ($error_count>0 || $empty_count > 4) {
			echo "<h2 class=\"mdl-card__title-text\">Error</h2></div><div class=\"mdl-card__supporting-text\" style=\"overflow-y:auto;\">";
			echo "<p>Not all entries are valid.</p><p>Please try again</p>";
			echo $error_count . " " . $empty_count;

		} else {
			$operation[$oper]($db_conn, $book_data);
		}
	} else {
		$operation[$oper]($db_conn, $search_data);
	}

	

	echo "</div><div class=\"mdl-card__actions mdl-card--border\"><a class=\"mdl-button mdl-js-button\" href=\"book_form.php\" >Go back</a></div></div>";

} else {
	echo "<h3>You did not set the operation</h3>";
}

echo "</div><div class=\"mdl-cell mdl-cell--7-col mdl-cell--top\" style=\"max-height:400px; overflow-y:auto;\">";

include("components/db_display.php");
echo "</div></div>";

include("includes/footer.php");

?>
