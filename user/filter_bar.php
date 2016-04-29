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

	#filter_bar #by_vehicle_name, #filter_bar #by_type_select{
		color: #333399;
	}

</style>

<script type="text/javascript" src="./js/common_js.js"></script>

<div class="col-lg-2 col-md-2 form-group" id="filter_bar">

	<h4 style="text-transform: none;"><b>Filter by</b></h4>

	<div id="by_wheels">
		
		<div class="checkbox" style="margin-top: 20px;">
			<label><input type="checkbox" name="wheels_cb" id="wheels_2_cb"> <b>2 Wheeler</b> </label>
		</div>
		<div class="checkbox" style="margin-top: 10px;">
			<label><input type="checkbox" name="wheels_cb" id="wheels_3_cb"> <b>3 Wheeler</b> </label>
		</div>

	</div>

	<hr style="background-color:#000;"/>

	<div class="" style="margin-top: 10px;">
		<div class="form-group">
			<select class="form-control" id="by_vehicle_name">
				<option selected disabled>By Vehicle Name</option>

				<option>All</option>
				<option value=null>Clear</option>
				<option disabled><hr/></option>
				
				<!-- <option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option> -->
				
				<script type="text/javascript">
					fetchDistinctVehicles();
				</script>

			</select>
		</div>
	</div>

	<hr style="background-color:#000;"/>

	<!-- <div class="" style="margin-top: 10px;">
		<div class="form-group">
  			<select class="form-control" id="by_type_select">
  				<option selected disabled>By Type</option>
    			<option>1</option>
    			<option>2</option>
    			<option>3</option>
    			<option>4</option>
  			</select>
		</div>
	</div> -->

</div>

<div class="col-lg-10 col-md-10 col-sm-12" id="search-results-div" style="padding-left: 65px;" hidden>
	<div class="col-lg-12 col-md-12" style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-size: 1.2em; line-height: 25px;">
		Search Results
	</div>

	<div class="col-lg-12 col-md-12" id="display-search-result" style="margin-top: 50px; margin-bottom: 50px;">
					
		<!-- Search Results will be displayed here -->

	</div>

</div>

<div class="col-lg-2 col-md-2 form-group" style="height: 100%;">
</div>

<script type="text/javascript">

	getFilters();

</script>
