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

}