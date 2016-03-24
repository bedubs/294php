
<div class="mdl-card mdl-shadow--6dp mdl-cell-elements">
	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
		<h2 class="mdl-card__title-text">Book Inventory Management</h2>
	</div>
		<div class="mdl-card__supporting-text">
		<form method="post" action="db_handler.php">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		    <select class="mdl-textfield__input" type="select" id="op-select" name="op_select" onchange="toggle_div();" >
		    	<option selected disabled>Select Operation</option>
		    	<option id="add" value="add">Add New</option>
		    	<option id="del" value="delete">Delete</option>
		    	<option id="seek" value="find">Search</option>
		    </select>
		</div>

		<hr>

		<div id="select-by-div" style="display: none;">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <select class="mdl-textfield__input" type="select" id="selectby" name="select_by">
			    	<option selected disabled>Search or Delete by:</option>
			    	<option value="title">Title</option>
			    	<option value="author">Author</option>
			    	<option value="isbn">ISBN</option>
			    	<option value="publisher">Publisher</option>
			    	<option value="year">Year</option>
			    </select>
			</div>
			<!-- Book Field -->
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input class="mdl-textfield__input" type="text" id="bkfield" name="bkfield">
			    <label class="mdl-textfield__label" for="bkfield">Search/Delete: </label>
			</div>
		</div>

		<div id="add-field-div" style="display: none;">
			<!-- Book Title -->
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input class="mdl-textfield__input" type="text" id="title" name="title">
			    <label class="mdl-textfield__label" for="title">Title: </label>
			</div>

			<!-- Author -->
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input class="mdl-textfield__input" type="text" id="author" name="author">
			    <label class="mdl-textfield__label" for="author">Author: </label>
			</div>

			<!-- ISBN -->
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="isbn" name="isbn">
				<label class="mdl-textfield__label" for="isbn">ISBN: </label>
			</div>

			<!-- Publisher -->
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input class="mdl-textfield__input" type="text" id="publisher" name="publisher">
			    <label class="mdl-textfield__label" for="publisher">Publisher: </label>
			</div>

			<!-- Year -->
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="year" name="year">
			    <label class="mdl-textfield__label" for="year">Year: </label>
			</div>
		</div>

	</div>

	<div class="mdl-card__actions mdl-card--border">
		<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Go!!!</button>
	</div>

	</form>

	<script type="text/javascript">
	function toggle_div() {
		var selectOpt = document.getElementById("op-select");
		var selectedValue = selectOpt.options[selectOpt.selectedIndex].value;
		var addDiv = document.getElementById("add-field-div");
		var selectDiv = document.getElementById("select-by-div");

		if(selectedValue == 'add') {
			addDiv.style.display = 'block';
			selectDiv.style.display = 'none';
		} else {
			addDiv.style.display = 'none';
			selectDiv.style.display = 'block';
		}
	}
</script>
</div>
