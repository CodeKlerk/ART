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
		//$main_data = $this->get_data($chartname, $selectedfilters);
		$data['chart_series_data'] = json_encode($main_data['main'], JSON_NUMERIC_CHECK);
		if($has_drilldown){
			$data['chart_drilldown_data'] = json_encode(@$main_data['drilldown'], JSON_NUMERIC_CHECK);
		}else{
			$data['chart_categories'] =  json_encode(@$main_data['columns'], JSON_NUMERIC_CHECK);
		}
		//Load chart
		//$this->load->view($chartview, $data);
	}

	public function get_data($chartname, $filters)
	{	
		if($chartname == 'patient_by_regimen'){
			$main_data = $this->dashboard_model->get_patient_regimen_numbers($filters);
		}else if($chartname == 'stock_status'){
			$main_data = $this->dashboard_model->get_national_mos($filters);
		}else if($chartname == 'national_mos'){
			$main_data = $this->dashboard_model->get_national_mos($filters);
		}else if($chartname == 'drug_consumption_trend'){
			$main_data = $this->dashboard_model->get_drug_consumption_trend($filters);
		}else if($chartname == 'patient_in_care'){
			$main_data = $this->dashboard_model->get_patient_in_care($filters);
		}else if($chartname == 'patient_regimen_category'){
			$main_data = $this->dashboard_model->get_patient_regimen_category($filters);
		}else if($chartname == 'nrti_drugs_in_regimen'){
			$main_data = $this->dashboard_model->get_nrti_drugs_in_regimen($filters);
		}else if($chartname == 'nnrti_drugs_in_regimen'){
			$main_data = $this->dashboard_model->get_nnrti_drugs_in_regimen($filters);
		}else if($chartname == 'patient_scaleup'){
			$main_data = $this->dashboard_model->get_patient_scaleup($filters);
		}
		return $main_data;
	}
	
}