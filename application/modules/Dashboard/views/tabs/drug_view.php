<script type="text/javascript">
	$(function(){

		$.getJSON("Dashboard/get_regimens", function(jsonData){
			cb = '';
			$.each(jsonData, function(i,data){
				cb+='<option value="#'+data.id+'">'+data.code+'</option>';
			});
			$("#regimen_filter").append(cb);
		});
	});
</script>
<div role="tabpanel" class="tab-pane" id="drug">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<!--commodities analysis-->
				<div class="form-group">
					<select name="regimen_filter" id="regimen_filter" data-filter_type="regimen" class="form-control regimen_filter">
						<option value="">-- select regimen --</option>
					</select>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="chart-wrapper">
					<div class="chart-title">
						Regimens where drug used
					</div>
					<div class="chart-stage">
						<div id="drug_regimen_consumption_chart"></div>
					</div>
					<div class="chart-notes">
						Filtered By: <span class="drug_regimen_heading"></span>
					</div>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="chart-wrapper">
					<div class="chart-title">
						Drug consumption
					</div>
					<div class="chart-stage">
						<div id="drug_consumption_chart"></div>
					</div>
					<div class="chart-notes">
						Filtered By: <span class="drug_consumption_heading"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>