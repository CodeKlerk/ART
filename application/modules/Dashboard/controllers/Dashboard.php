<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	function __construct() {
		ini_set("max_execution_time", "100000");
		ini_set("memory_limit", '2048M');
	}

	public function index()
	{	
		$data['page_title'] = 'ART | Dashboard';
		$this->load->view('template/dashboard_view', $data);
	}

	public function get_filter($chartname, $selectedfilters)
	{
		$filter = array();	
		$defaultfilters = $this->config->item($chartname.'_filters_default');
		$filtersColumns = $this->config->item($chartname.'_filters');

		// check if input has filters/values
		if(empty($selectedfilters)){
			$filter = $defaultfilters;
		}
		else{

			// check if selectedfilters have the required filters 
			$missing_keys = array_keys(array_diff_key($selectedfilters, $defaultfilters));
			$merged_filters = array_merge($defaultfilters, $selectedfilters);
			foreach ($merged_filters as $key => $value) {
				if(!in_array($key, $missing_keys)){
					$filter[$key] = $value;
				}
			}	
		}
		return $filter;
	}

	public function get_chart()
	{

		/// use default filter columns & values if filters not set

		$chartname = $this->input->post('name');
		$selectedfilters = $this->get_filter($chartname,$this->input->post('selectedfilters'));

		//Get default filters
		//Get chart configuration
		$data['chart_name']  = $chartname;
		$data['chart_title']  = $this->config->item($chartname.'_title');
		$data['chart_yaxis_title'] = $this->config->item($chartname.'_yaxis_title');
		$data['chart_xaxis_title'] = $this->config->item($chartname.'_xaxis_title');
		$data['chart_source'] = $this->config->item($chartname.'_source');
		$chartview = $this->config->item($chartname.'_chartview');
		$has_drilldown = $this->config->item($chartname.'_has_drilldown');
		//Get data
		$main_data = array('main' => array(), 'drilldown' => array(), 'columns' => array());
		$main_data = $this->get_data($chartname, $selectedfilters);
		$data['chart_series_data'] = json_encode($main_data['main'], JSON_NUMERIC_CHECK);
		if($has_drilldown){
			$data['chart_drilldown_data'] = json_encode(@$main_data['drilldown'], JSON_NUMERIC_CHECK);
		}else{
			$data['chart_categories'] =  json_encode(@$main_data['columns'], JSON_NUMERIC_CHECK);
		}
		//Load chart
		$this->load->view($chartview, $data);
	}

	public function get_data($chartname, $filters)
	{	

		if($chartname == 'patient_scaleup_chart'){
			$main_data = $this->dashboard_model->get_patient_scaleup($filters);
		}else if($chartname == 'patient_services_chart'){
			$main_data = $this->dashboard_model->get_patient_services($filters);
		}else if($chartname == 'national_mos_chart'){
			$main_data = $this->dashboard_model->get_national_mos($filters);
		}else if($chartname == 'commodity_consumption_chart'){
			$main_data = $this->dashboard_model->get_commodity_consumption($filters);
		}else if($chartname == 'county_patient_distribution_chart'){
			$main_data = $this->dashboard_model->get_county_patient_distribution($filters);
		}else if($chartname == 'county_patient_distribution_table'){
			$main_data = $this->dashboard_model->get_county_patient_distribution_numbers($filters);
		}else if($chartname == 'subcounty_patient_distribution_chart'){
			$main_data = $this->dashboard_model->get_subcounty_patient_distribution($filters);
		}else if($chartname == 'subcounty_patient_distribution_table'){
			$main_data = $this->dashboard_model->get_subcounty_patient_distribution_numbers($filters);
		}else if($chartname == 'facility_patient_distribution_chart'){
			$main_data = $this->dashboard_model->get_facility_patient_distribution($filters);
		}else if($chartname == 'facility_patient_distribution_table'){
			$main_data = $this->dashboard_model->get_facility_patient_distribution_numbers($filters);
		}else if($chartname == 'partner_patient_distribution_chart'){
			$main_data = $this->dashboard_model->get_partner_patient_distribution($filters);
		}else if($chartname == 'partner_patient_distribution_table'){
			$main_data = $this->dashboard_model->get_partner_patient_distribution_numbers($filters);
		}else if($chartname == 'adt_site_distribution_chart'){
			$main_data = $this->dashboard_model->get_adt_site_distribution($filters);
		}else if($chartname == 'adt_site_distribution_table'){
			$main_data = $this->dashboard_model->get_adt_site_distribution_numbers($filters);
		}else if($chartname == 'regimen_patient_chart'){
			$main_data = $this->dashboard_model->get_regimen_patients($filters);
		}else if($chartname == 'drug_regimen_consumption_chart'){
			$main_data = $this->dashboard_model->get_regimen_top_commodities($filters);
		}else if($chartname == 'regimen_patients_counties_chart'){
			$main_data = $this->dashboard_model->get_regimen_patients_by_county($filters);
		}else if($chartname == 'drug_consumption_chart'){
			$main_data = $this->dashboard_model->get_drug_consumption($filters);
		}else if($chartname == 'adt_version_distribution_chart'){
			$main_data = $this->dashboard_model->get_adt_versions_summary($filters);
		}
		return $main_data;
	}

	function get_regimens(){
		$regimens = $this->dashboard_model->get_regimens();
		header('Content-Type: application/json');
		echo json_encode($regimens);

	}

	function get_counties(){
		$counties = $this->dashboard_model->get_counties();
		header('Content-Type: application/json');
		echo json_encode($counties);

	}

	function get_sites(){
		$counties = $this->dashboard_model->get_adt_sites_summary();
		header('Content-Type: application/json');
		echo json_encode($counties);

	}


	
	
}