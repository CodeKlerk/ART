<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function get_patient_scaleup($filters){
		$columns = array();
		$scaleup_data = array(
			array('type' => 'column', 'name' => 'Paediatric', 'data' => array()),
			array('type' => 'column', 'name' => 'Adult', 'data' => array()),
			array('type' => 'spline', 'name' => 'Forecast', 'data' => array())
		);

		$this->db->select("CONCAT_WS('/', data_month, data_year) period,
		 SUM(IF(age_category = 'paed', total, NULL)) paed_total, 
		 SUM(IF(age_category = 'adult', total, NULL)) adult_total,
			 round(RAND()*150000)+650000  combined_total 
			-- SUM(total) combined_total 
			", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('period');
		$this->db->order_by("data_year ASC, FIELD( data_month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' )");
		$query = $this->db->get('dsh_patient');
		$results = $query->result_array();

		if($results){
			foreach ($results as $result) {
				$columns[] = $result['period'];
				foreach ($scaleup_data as $index => $scaleup) {
					if($scaleup['name'] == 'Adult'){
						array_push($scaleup_data[$index]['data'], $result['adult_total']);
					}else if($scaleup['name'] == 'Paediatric'){
						array_push($scaleup_data[$index]['data'], $result['paed_total']);
					}else if($scaleup['name'] == 'Forecast'){
						array_push($scaleup_data[$index]['data'], $result['combined_total']);	
					}
				}
			}
		}
		return array('main' => $scaleup_data, 'columns' => $columns);
	}

	public function get_national_mos($filters){
		$columns = array();
		$scaleup_data = array(
			array('name' => 'Pending Orders', 'data' => array()),
			array('name' => 'KEMSA', 'data' => array()),
			array('name' => 'Facilities', 'data' => array())
		);

		$this->db->select('drug, facility_mos, cms_mos, supplier_mos');
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('drug');
		$this->db->order_by('drug', 'DESC');
		$query = $this->db->get('dsh_mos');
		$results = $query->result_array();

		foreach ($results as $result) {
			$columns[] = $result['drug'];
			foreach ($scaleup_data as $index => $scaleup) {
				if($scaleup['name'] == 'Facilities'){
					array_push($scaleup_data[$index]['data'], $result['facility_mos']);
				}else if($scaleup['name'] == 'KEMSA'){
					array_push($scaleup_data[$index]['data'], $result['cms_mos']);
				}else if($scaleup['name'] == 'Pending Orders'){
					array_push($scaleup_data[$index]['data'], $result['supplier_mos']);	
				}
			}
		}
		return array('main' => $scaleup_data, 'columns' => $columns);
	}

	public function get_commodity_consumption($filters){
		$columns = array();
		$tmp_data = array();
		$consumption_data = array();

		$this->db->select("drug, CONCAT_WS('/', data_month, data_year) period, SUM(total) total", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('drug, period');
		$this->db->order_by("data_year ASC, FIELD( data_month, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' )");
		$query = $this->db->get('dsh_consumption');
		$results = $query->result_array();

		foreach ($results as $result) {
			array_push($columns, $result['period']);
			$tmp_data[$result['drug']]['data'][] = $result['total'];
		}

		$counter = 0;
		foreach ($tmp_data as $name => $item) {
			$consumption_data[$counter]['name'] = $name;
			$consumption_data[$counter]['data'] = $item['data'];
			$counter++;
		}
		return array('main' => $consumption_data, 'columns' => array_values(array_unique($columns)));
	}

	public function get_county_patient_distribution($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(county, 1, 1)),LOWER(SUBSTRING(county, 2))) name, SUM(total) y", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('y', 'DESC');
		$query = $this->db->get('dsh_patient');
		$results = $query->result_array();

		foreach ($results as $result) {
			array_push($columns, $result['name']);
		}

		return array('main' => $results, 'columns' => $columns);
	}

	public function get_county_patient_distribution_numbers($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(county, 1, 1)),LOWER(SUBSTRING(county, 2))) name, COUNT(facility) sites, SUM(IF(age_category='adult', total, NULL)) adult, SUM(IF(age_category='paed', total, NULL)) paed, SUM(total) total", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('sites, total', 'DESC');
		$query = $this->db->get('dsh_patient');
		return array('main' => $query->result_array(), 'columns' => $columns);
	}

	public function get_subcounty_patient_distribution($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(sub_county, 1, 1)),LOWER(SUBSTRING(sub_county, 2))) name, SUM(total) y", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('y', 'DESC');
		$this->db->limit(30);
		$query = $this->db->get('dsh_patient');
		$results = $query->result_array();

		foreach ($results as $result) {
			array_push($columns, $result['name']);
		}

		return array('main' => $results, 'columns' => $columns);
	}

	public function get_subcounty_patient_distribution_numbers($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(sub_county, 1, 1)),LOWER(SUBSTRING(sub_county, 2))) name, COUNT(facility) sites, SUM(IF(age_category='adult', total, NULL)) adult, SUM(IF(age_category='paed', total, NULL)) paed, SUM(total) total", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('sites, total', 'DESC');
		$query = $this->db->get('dsh_patient');
		return array('main' => $query->result_array(), 'columns' => $columns);
	}

	public function get_facility_patient_distribution($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(facility, 1, 1)),LOWER(SUBSTRING(facility, 2))) name, SUM(total) y", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('y', 'DESC');
		$this->db->limit(30);
		$query = $this->db->get('dsh_patient');
		$results = $query->result_array();

		foreach ($results as $result) {
			array_push($columns, $result['name']);
		}

		return array('main' => $results, 'columns' => $columns);
	}

	public function get_facility_patient_distribution_numbers($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(facility, 1, 1)),LOWER(SUBSTRING(facility, 2))) name, 1 sites, SUM(IF(age_category='adult', total, NULL)) adult, SUM(IF(age_category='paed', total, NULL)) paed, SUM(total) total", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get('dsh_patient');
		return array('main' => $query->result_array(), 'columns' => $columns);
	}

	public function get_partner_patient_distribution($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(partner, 1, 1)),LOWER(SUBSTRING(partner, 2))) name, SUM(total) y", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('y', 'DESC');
		$this->db->limit(30);
		$query = $this->db->get('dsh_patient');
		$results = $query->result_array();

		foreach ($results as $result) {
			array_push($columns, $result['name']);
		}

		return array('main' => $results, 'columns' => $columns);
	}

	public function get_partner_patient_distribution_numbers($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(partner, 1, 1)),LOWER(SUBSTRING(partner, 2))) name, 1 sites, SUM(IF(age_category='adult', total, NULL)) adult, SUM(IF(age_category='paed', total, NULL)) paed, SUM(total) total", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get('dsh_patient');
		return array('main' => $query->result_array(), 'columns' => $columns);
	}

	public function get_adt_site_distribution($filters){
		$columns = array();

		$this->db->select("CONCAT(UCASE(SUBSTRING(county, 1, 1)),LOWER(SUBSTRING(county, 2))) name, SUM(case when installed = 'yes' then 1 else 0 end) installed, SUM(case when installed = 'no' then 1 else 0 end) not_yet", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->group_by('name');
		$query = $this->db->get('dsh_site');
		$results = $query->result_array();

		$data = array();
		$installed = array();
		$not_yet = array();
		foreach ($results as $result) {
			array_push($columns, $result['name']);
			foreach ($result as $key => $value) {
				if($key == 'installed'){
					$installed[] = $value;
				}else if($key == 'not_yet'){
					$not_yet[] = $value;
				}
			}
		}
		$data[] = array('name' => 'installed', 'data' => $installed);
		$data[] = array('name' => 'not_yet', 'data' => $not_yet);

		return array('main' => $data, 'columns' => $columns);
	}

	public function get_adt_site_distribution_numbers($filters){
		$columns = array();

		$this->db->select("facility, county, subcounty, partner, installed, version, internet, backup, active_patients", FALSE);
		if(!empty($filters)){
			foreach ($filters as $category => $filter) {
				$this->db->where_in($category, $filter);
			}
		}
		$this->db->order_by('active_patients', 'DESC');
		$query = $this->db->get('dsh_site');
		return array('main' => $query->result_array(), 'columns' => $columns);
	}

	public function get_drug_summary($filters){
		$columns = array();

		$json = '{"main":[{"type":"column","name":"Paediatric","data":["72098","72622","72852","72957","75239","76129","77730","78112","78037","78083","78446","78739","78775","79082","79221","79812","80536","81088","81444"]},{"type":"column","name":"Adult","data":["805077","815679","813367","817185","825951","832314","841161","857762","863881","875937","896053","899337","907697","914550","922972","930310","932158","940401","950290"]},{"type":"spline","name":"Forecast","data":["721669","688272","773782","684692","779395","796940","767260","739500","730186","662713","794460","651354","746453","687297","720148","748715","786529","732920","724915"]}],"columns":["Jan\/2016","Feb\/2016","Mar\/2016","Apr\/2016","May\/2016","Jun\/2016","Jul\/2016","Aug\/2016","Sep\/2016","Oct\/2016","Nov\/2016","Dec\/2016","Jan\/2017","Feb\/2017","Mar\/2017","Apr\/2017","May\/2017","Jun\/2017","Jul\/2017"]}';
		$results = json_decode($json, TRUE);
		return $results;
	}
	
}