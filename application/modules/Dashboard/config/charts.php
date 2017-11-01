<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*patient_scaleup_chart*/
$config['patient_scaleup_chart_chartview'] = 'charts/stacked_column_view';
$config['patient_scaleup_chart_title'] = 'Patient Scaleup Trend';
$config['patient_scaleup_chart_yaxis_title'] = 'No. of Patients';
$config['patient_scaleup_chart_source'] = 'Source: www.nascop.org';
$config['patient_scaleup_chart_has_drilldown'] = FALSE;
$config['patient_scaleup_chart_xaxis_title'] = '';
$config['patient_scaleup_chart_view_name'] = 'dsh_patient';
$config['patient_scaleup_chart_filters'] = array('data_year', 'county', 'sub_county', 'facility', 'regimen_service');
$config['patient_scaleup_chart_filters_default'] = array(
	'data_year' => array('2017','2016'), 
	'regimen_service' => array('ART')
);

/*national_mos_chart*/
$config['national_mos_chart_chartview'] = 'charts/stacked_bar_view';
$config['national_mos_chart_title'] = 'National Commodity Months of Stock(MOS)';
$config['national_mos_chart_yaxis_title'] = 'Months of Stock(MOS)';
$config['national_mos_chart_source'] = 'Source: www.nascop.org';
$config['national_mos_chart_has_drilldown'] = FALSE;
$config['national_mos_chart_xaxis_title'] = '';
$config['national_mos_chart_view_name'] = 'dsh_mos';
$config['national_mos_chart_filters'] = array('data_year', 'data_month', 'drug');
$config['national_mos_chart_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun'), 
	'drug' => array(
		'Zidovudine/Lamivudine/Nevirapine (AZT/3TC/NVP) 60/30/50mg FDC Tabs',
		'Zidovudine/Lamivudine/Nevirapine (AZT/3TC/NVP) 300/150/200mg FDC Tabs',
		'Zidovudine/Lamivudine (AZT/3TC) 60/30mg FDC Tabs',
		'Zidovudine/Lamivudine (AZT/3TC) 300/150mg FDC Tabs',
		'Zidovudine (AZT) 10mg/ml Liquid'
	)
);

/*commodity_consumption_chart*/
$config['commodity_consumption_chart_chartview'] = 'charts/line_view';
$config['commodity_consumption_chart_title'] = 'Commodity Consumption Trend';
$config['commodity_consumption_chart_yaxis_title'] = 'No. of Packs';
$config['commodity_consumption_chart_source'] = 'Source: www.nascop.org';
$config['commodity_consumption_chart_has_drilldown'] = FALSE;
$config['commodity_consumption_chart_xaxis_title'] = '';
$config['commodity_consumption_chart_view_name'] = 'dsh_consumption';
$config['commodity_consumption_chart_filters'] = array('county', 'sub_county', 'facility', 'drug');
$config['commodity_consumption_chart_filters_default'] = array(
	'drug' => array(
		'Abacavir (ABC) 300mg Tabs', 
		'Lamivudine (3TC) 150mg Tabs'
	)
);

/*county_patient_distribution_chart*/
$config['county_patient_distribution_chart_chartview'] = 'charts/column_view';
$config['county_patient_distribution_chart_title'] = 'County Patient Numbers';
$config['county_patient_distribution_chart_yaxis_title'] = 'No. of Patients';
$config['county_patient_distribution_chart_source'] = 'Source: www.nascop.org';
$config['county_patient_distribution_chart_has_drilldown'] = FALSE;
$config['county_patient_distribution_chart_xaxis_title'] = 'County';
$config['county_patient_distribution_chart_view_name'] = 'dsh_patient';
$config['county_patient_distribution_chart_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['county_patient_distribution_chart_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*county_patient_distribution_table*/
$config['county_patient_distribution_table_chartview'] = 'charts/table_view';
$config['county_patient_distribution_table_title'] = 'Counties';
$config['county_patient_distribution_table_yaxis_title'] = 'No. of Patients';
$config['county_patient_distribution_table_source'] = 'Source: www.nascop.org';
$config['county_patient_distribution_table_has_drilldown'] = FALSE;
$config['county_patient_distribution_table_xaxis_title'] = '';
$config['county_patient_distribution_table_view_name'] = 'dsh_patient';
$config['county_patient_distribution_table_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['county_patient_distribution_table_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*subcounty_patient_distribution_chart*/
$config['subcounty_patient_distribution_chart_chartview'] = 'charts/column_view';
$config['subcounty_patient_distribution_chart_title'] = 'Subcounty Patient Numbers';
$config['subcounty_patient_distribution_chart_yaxis_title'] = 'No. of Patients';
$config['subcounty_patient_distribution_chart_source'] = 'Source: www.nascop.org';
$config['subcounty_patient_distribution_chart_has_drilldown'] = FALSE;
$config['subcounty_patient_distribution_chart_xaxis_title'] = 'Subcounty';
$config['subcounty_patient_distribution_chart_view_name'] = 'dsh_patient';
$config['subcounty_patient_distribution_chart_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['subcounty_patient_distribution_chart_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*subcounty_patient_distribution_table*/
$config['subcounty_patient_distribution_table_chartview'] = 'charts/table_view';
$config['subcounty_patient_distribution_table_title'] = 'Subcounty Patient Numbers';
$config['subcounty_patient_distribution_table_yaxis_title'] = 'No. of Patients';
$config['subcounty_patient_distribution_table_source'] = 'Source: www.nascop.org';
$config['subcounty_patient_distribution_table_has_drilldown'] = FALSE;
$config['subcounty_patient_distribution_table_xaxis_title'] = 'Subcounty';
$config['subcounty_patient_distribution_table_view_name'] = 'dsh_patient';
$config['subcounty_patient_distribution_table_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['subcounty_patient_distribution_table_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*facility_patient_distribution_chart*/
$config['facility_patient_distribution_chart_chartview'] = 'charts/column_view';
$config['facility_patient_distribution_chart_title'] = 'Facility Patient Numbers';
$config['facility_patient_distribution_chart_yaxis_title'] = 'No. of Patients';
$config['facility_patient_distribution_chart_source'] = 'Source: www.nascop.org';
$config['facility_patient_distribution_chart_has_drilldown'] = FALSE;
$config['facility_patient_distribution_chart_xaxis_title'] = 'Facility';
$config['facility_patient_distribution_chart_view_name'] = 'dsh_patient';
$config['facility_patient_distribution_chart_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['facility_patient_distribution_chart_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*facility_patient_distribution_table*/
$config['facility_patient_distribution_table_chartview'] = 'charts/table_view';
$config['facility_patient_distribution_table_title'] = 'Facility Patient Numbers';
$config['facility_patient_distribution_table_yaxis_title'] = 'No. of Patients';
$config['facility_patient_distribution_table_source'] = 'Source: www.nascop.org';
$config['facility_patient_distribution_table_has_drilldown'] = FALSE;
$config['facility_patient_distribution_table_xaxis_title'] = 'Facility';
$config['facility_patient_distribution_table_view_name'] = 'dsh_patient';
$config['facility_patient_distribution_table_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['facility_patient_distribution_table_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*partner_patient_distribution_chart*/
$config['partner_patient_distribution_chart_chartview'] = 'charts/column_view';
$config['partner_patient_distribution_chart_title'] = 'Partner Patient Numbers';
$config['partner_patient_distribution_chart_yaxis_title'] = 'No. of Patients';
$config['partner_patient_distribution_chart_source'] = 'Source: www.nascop.org';
$config['partner_patient_distribution_chart_has_drilldown'] = FALSE;
$config['partner_patient_distribution_chart_xaxis_title'] = 'Partner';
$config['partner_patient_distribution_chart_view_name'] = 'dsh_patient';
$config['partner_patient_distribution_chart_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['partner_patient_distribution_chart_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*partner_patient_distribution_table*/
$config['partner_patient_distribution_table_chartview'] = 'charts/table_view';
$config['partner_patient_distribution_table_title'] = 'Partner Patient Numbers';
$config['partner_patient_distribution_table_yaxis_title'] = 'No. of Patients';
$config['partner_patient_distribution_table_source'] = 'Source: www.nascop.org';
$config['partner_patient_distribution_table_has_drilldown'] = FALSE;
$config['partner_patient_distribution_table_xaxis_title'] = 'Partner';
$config['partner_patient_distribution_table_view_name'] = 'dsh_patient';
$config['partner_patient_distribution_table_filters'] = array('data_year', 'data_month', 'regimen_category', 'regimen');
$config['partner_patient_distribution_table_filters_default'] = array(
	'data_year' => array('2017'), 
	'data_month' => array('Jun')
);

/*adt_site_distribution_chart*/
$config['adt_site_distribution_chart_chartview'] = 'charts/stacked_column_view';
$config['adt_site_distribution_chart_title'] = 'ADT Site Numbers';
$config['adt_site_distribution_chart_yaxis_title'] = 'No. of Sites';
$config['adt_site_distribution_chart_source'] = 'Source: www.nascop.org';
$config['adt_site_distribution_chart_has_drilldown'] = FALSE;
$config['adt_site_distribution_chart_xaxis_title'] = 'Sites';
$config['adt_site_distribution_chart_view_name'] = 'dsh_site';
$config['adt_site_distribution_chart_filters'] = array('partner', 'facility', 'internet', 'backup');
$config['adt_site_distribution_chart_filters_default'] = array();

/*adt_site_distribution_table*/
$config['adt_site_distribution_table_chartview'] = 'charts/table_view';
$config['adt_site_distribution_table_title'] = 'ADT Site Numbers';
$config['adt_site_distribution_table_yaxis_title'] = 'No. of Sites';
$config['adt_site_distribution_table_source'] = 'Source: www.nascop.org';
$config['adt_site_distribution_table_has_drilldown'] = FALSE;
$config['adt_site_distribution_table_xaxis_title'] = 'Sites';
$config['adt_site_distribution_table_view_name'] = 'dsh_site';
$config['adt_site_distribution_table_filters'] = array('partner', 'facility', 'internet', 'backup');
$config['adt_site_distribution_table_filters_default'] = array();


/*drug_summary_chart*/
$config['drug_summary_chart_chartview'] = 'charts/stacked_column_view';
$config['drug_summary_chart_title'] = 'Drugs Summary view';
$config['drug_summary_chart_yaxis_title'] = 'Consumption';
$config['drug_summary_chart_source'] = 'Source: www.nascop.org';
$config['drug_summary_chart_has_drilldown'] = FALSE;
$config['drug_summary_chart_xaxis_title'] = 'Drugs';
$config['drug_summary_chart_view_name'] = 'dsh_consumption';
$config['drug_summary_chart_filters'] = array('data_year', 'data_month', 'sub_county');
$config['drug_summary_chart_filters_default'] = array(
	'data_year' => array('2017','2016'), 
	'regimen_service' => array('ART')
);