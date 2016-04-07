<style>

	#filter_bar label{
		text-transform: lowercase;
	}

	#filter_bar select, #filter_bar select:focus{
		border-style: hidden;
		box-shadow: none;
		text-align: left;
		padding-left: 2px;
	}

	#filter_bar{
		font-weight: bold;
	}

	#filter_bar option{
		font-weight: bold;
		color: #333399;
	}

	#filter_bar option[disabled]{
		font-weight: normal;
	}

	#filter_bar #by_make_select, #filter_bar #by_type_select{
		color: #333399;
	}

</style>


<div class="col-lg-2 col-md-2 form-group" id="filter_bar">

	<h4 style="text-transform: none;"><b>Filter by</b></h4>

	<div class="checkbox" style="margin-top: 20px;">
		<label><input type="checkbox"> <b>2 Wheeler</b> </label>
	</div>
	<div class="checkbox" style="margin-top: 10px;">
		<label><input type="checkbox"> <b>3 Wheeler</b> </label>
	</div>

	<hr style="background-color:#000;"/>

	<div class="" style="margin-top: 10px;">
		<div class="form-group">
			<select class="form-control" id="by_make_select">
				<option selected disabled>By Make/Model</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
			</select>
		</div>
	</div>

	<hr style="background-color:#000;"/>

	<div class="" style="margin-top: 10px;">
		<div class="form-group">
  			<select class="form-control" id="by_type_select">
  				<option selected disabled>By Type</option>
    			<option>1</option>
    			<option>2</option>
    			<option>3</option>
    			<option>4</option>
  			</select>
		</div>
	</div>

</div>