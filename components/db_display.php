<?php

$db_conn = array
(
	"servername" => "localhost",
	"dbname" => "294_test",
	"username" => "secret",
	"password" => "secret",
);

// Create connection
$conn = new mysqli($db_conn["servername"], $db_conn["username"], $db_conn["password"], $db_conn["dbname"]);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, title, author, isbn, publisher, year FROM BookStore";
$result = $conn->query($sql);

echo "<table class=\"mdl-data-table mdl-js-data-table mdl-cell-elements\">";
echo "<thead><tr>";
echo "<th>ID</th>";
echo "<th>Title</th>";
echo "<th>Author</th>";
echo "<th>ISBN</th>";
echo "<th>Publisher</th>";
echo "<th>Year</th>";
echo "</tr></thead><tbody>";

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row["id"] . "</td>";
		echo "<td>" . $row["title"] . "</td>";
		echo "<td>" . $row["author"] . "</td>";
		echo "<td>" . $row["isbn"] . "</td>";
		echo "<td>" . $row["publisher"] . "</td>";
		echo "<td>" . $row["year"] . "</td>";
		echo "</tr>";
	}
} else {
	echo "<tr><td>No Results</td></tr>";
}
echo "</tbody></table>";

$conn->close();

?>