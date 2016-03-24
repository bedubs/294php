<?php 

include("includes/header.php");

?>

<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">

	<div class="mdl-tabs__tab-bar">
		<a href="#db-form-panel" class="mdl-tabs__tab is-active">Database</a>
		<a href="#file-form-panel" class="mdl-tabs__tab">Textfile</a>
	</div>

	<div class="mdl-tabs__panel is-active" id="db-form-panel">

	<?php
	echo "<div class=\"mdl-grid\"><div class=\"mdl-cell mdl-cell--5-col\">";
	include("components/db_form.php");
	echo "</div><div class=\"mdl-cell mdl-cell--7-col\" style=\"max-height:500px; overflow-y:auto;\">";
	include("components/db_display.php");
	echo "</div></div>";
	?>

	</div>

	<div class="mdl-tabs__panel" id="file-form-panel">

	<?php
	echo "<div class=\"mdl-grid\"><div class=\"mdl-cell mdl-cell--5-col\">";
	include("components/file_form.php");
	echo "</div><div class=\"mdl-cell mdl-cell--7-col\" style=\"max-height:500px; overflow-y:auto;\">";
	include("components/file_display.php");
	echo "</div></div>";
	?>

	</div>

</div>



<?php
include("includes/footer.php");

?>
