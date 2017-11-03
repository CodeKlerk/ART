<script type="text/javascript">
	$(function(){

		$.getJSON("Dashboard/get_regimens", function(jsonData){
			cb = '';
			$.each(jsonData, function(i,data){
				cb+='<option value="#'+data.id+'">'+data.code+'</option>';
			});
			$("#single_regimen_filter").append(cb);
		});

			$("#single_regimen_filter").change(function(){
				$("#main_tabs a[href='#drug']").trigger('click');
			});

	});

</script>
<div role="tabpanel" class="tab-pane" id="commodity">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<!--commodities analysis-->
				<div class="form-group">
					<select name="single_regimen_filter" id="single_regimen_filter" data-filter_type="regimen" class="form-control regimen_filter">
						<option value="">-- select Regimen --</option>
					</select>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="chart-wrapper">
					<div class="chart-title">
						COMMODITIES
					</div>
					<div class="chart-stage">
						<div id="drug_summary_chart"></div>
					</div>
					<div class="chart-notes">
						Filtered By: <span class="commodity_analysis_heading"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>