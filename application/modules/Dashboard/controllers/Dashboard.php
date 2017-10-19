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

	public function get_filter()
	{	
		$tab = $this->input->post('filter_tab');
		$type = $this->input->post('filter_type');
		$item = $this->input->post('filter_item');
		$year = $this->input->post('filter_year');
		$month = $this->input->post('filter_month');

		echo json_encode('');
	}

	public function get_chart()
	{
		$chartname = $this->input->post('name');
		$selectedfilters = $this->input->post('selectedfilters');
		//Get default filters
		if(empty($selectedfilters)){
			$selectedfilters = $this->config->item($chartname.'_filters_default');
		}
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
		}
		return $main_data;
	}
	
}