
<div class="mdl-card mdl-shadow--6dp mdl-cell-elements">
	<div class="mdl-card__title mdl-color--primary mdl-color-text--white">
		<h2 class="mdl-card__title-text">Book Inventory Management</h2>
	</div>
		<div class="mdl-card__supporting-text">
		<form method="post" action="file_handler.php">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		    <select class="mdl-textfield__input" type="select" id="op-select" name="op_select">
		    	<option selected disabled>Select Operation</option>
		    	<option value="add">Add New</option>
		    	<option value="delete">Delete</option>
		    	<option value="find">Search</option>
		    	<!-- <option value="edit">Edit</option> -->
		    </select>
		</div>

		<hr>
		
		<!-- Book Title -->
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		    <input class="mdl-textfield__input" type="text" id="title" name="title">
		    <label class="mdl-textfield__label" for="title">Title: </label>
		</div>

		<!-- Author -->
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
		    <input class="mdl-textfield__input" type="text" id="author" name="author">
		    <label class="mdl-textfield__label" for="title">Author: </label>
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
		    <label class="mdl-textfield__label" for="title">Year: </label>
		</div>

	</div>

	<div class="mdl-card__actions mdl-card--border">
		<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Go!!!</button>
	</div>

	</form>
</div>
