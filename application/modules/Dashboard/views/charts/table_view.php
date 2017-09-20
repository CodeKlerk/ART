<?php
	$dyn_table = "<table class='table table-bordered table-condensed table-hover table-striped distribution_table'>";
	$dyn_table .= "<thead><tr><th>Name</th><th>Sites</th><th>Patients</th><th>Adults</th><th>Paediatrics</th></tr></thead><tbody>";
	$table_data = json_decode($chart_series_data, TRUE);
	$previous_heading = "";

	foreach ($table_data as $row_data) {
		$dyn_table .= "<tr><td>".$row_data['name']."</td><td>".number_format($row_data['sites'])."</td><td>".number_format($row_data['total'])."</td><td>".number_format($row_data['adult'])."</td><td>".number_format($row_data['paed'])."</td></tr>";
	}
	$dyn_table .= "</tbody></table>";
 	echo $dyn_table;
?>

<script type="text/javascript">
	$(function() {
	    /*DataTable*/
	    $('.distribution_table').DataTable({
	    	"bDestroy": true,
	    	"order": [[ 1, "desc" ]],
	    	"pagingType": "full_numbers"
	    });
	});
</script>