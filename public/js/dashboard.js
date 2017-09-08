var chartURL = 'Dashboard/get_chart'
var tab = 'summary'
var filters = {}
var charts = []

charts['summary'] = ['patient_scaleup_chart', 'national_mos_chart']
charts['trend'] = ['commodity_consumption_chart']
charts['county'] = ['county_patient_distribution_chart', 'county_patient_distribution_table']
charts['subcounty'] = ['subcounty_patient_distribution_chart', 'subcounty_patient_distribution_table']
charts['facility'] = ['facility_patient_distribution_chart', 'facility_patient_distribution_table']
charts['partner_summary'] = ['partner_summary_chart']
charts['partner_trend'] = ['partner_trend_chart']
charts['adt_site'] = ['adt_site_distribution_chart', 'adt_site_distribution_table']

$(function() {
    /*Load Charts*/
    $.each(charts[tab], function(key, chartName) {
        chartID = '#'+chartName
        LoadChart(chartID, chartURL, chartName, filters)
    });
    /*Set selected tab*/
    $("#filter_tab").val(tab)
    /*Tab Change Event*/
    $("#main_tabs a").on("click", TabFilterHandler);
});

function LoadChart(divID, chartURL, chartName, selectedfilters){
    /*Load Spinner*/
    LoadSpinner(divID)
    /*Load Chart*/
    $(divID).load(chartURL, {'name':chartName, 'selectedfilters': selectedfilters});
}

function LoadSpinner(divID){
    var spinner = new Spinner().spin()
    $(divID).empty('')
    $(divID).height('auto')
    $(divID).append(spinner.el)
}

function TabFilterHandler(e){
    var filtername = $(e.target).attr('href')
    var filters = {}
    tab = filtername.replace('#', '')

    //Reset filter identifier
    $("#filter_tab").val(tab)

    /*Load Charts*/
    $.each(charts[tab], function(key, chartName) {
        chartID = '#'+chartName
        LoadChart(chartID, chartURL, chartName, filters)
    });
}