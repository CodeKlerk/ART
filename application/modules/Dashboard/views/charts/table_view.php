<?php
	$dyn_table = "<table class='table table-bordered table-condensed table-hover table-striped distribution_table'>";
	$thead = "<thead><tr>";
	$table_data = json_decode($chart_series_data, TRUE);
	$count = 0;
	$tbody = "<tbody>";
	foreach ($table_data as $row_data) {
		$tbody .= "<tr>";
		foreach ($row_data as $key => $value) {
			//Header
			if($count == 0){
				$thead .= "<th>".$key."</th>";
			}
			$tbody .= "<td>".$value."</td>";
		}
		$tbody .= "</tr>";
		$count++;
	}
	$thead .= "</tr></thead>";
	$tbody .= "</tbody>";
	$dyn_table .= $thead;
	$dyn_table .= $tbody;
	$dyn_table .= "</table>";
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