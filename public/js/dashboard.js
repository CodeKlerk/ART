var chartURL = 'Dashboard/get_chart'
var tab = 'summary'
var filters = {}
var charts = []

charts['summary'] = ['patient_scaleup_chart','patient_services_chart', 'national_mos_chart']
charts['trend'] = ['commodity_consumption_chart']
charts['county'] = ['county_patient_distribution_chart', 'county_patient_distribution_table']
charts['subcounty'] = ['subcounty_patient_distribution_chart', 'subcounty_patient_distribution_table']
charts['facility'] = ['facility_patient_distribution_chart', 'facility_patient_distribution_table']
charts['partner_summary'] = ['partner_patient_distribution_chart', 'partner_patient_distribution_table']
charts['adt_site'] = ['adt_version_distribution_chart','adt_site_distribution_chart', 'adt_site_distribution_table']
charts['commodity'] = ['drug_summary_chart']
charts['drug'] = ['drug_consumption_chart','drug_regimen_consumption_chart','regimen_patients_counties_chart']


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

    // on regimen change. load regimen page
    $("#single_regimen_filter").on("change", TabFilterHandler);
    $("#regimen_filter").on("change", TabFilterHandler);
    // $("#single_regimen_filter, #regimen_filter").on("change", TabFilterHandler);
    
    /*Filter Month*/
    $(".filter-month").on("click", function(){
        month_selected = $(this).data('value');
        $("#filter_month").val(month_selected);
    });
    /*Filter Year*/
    $(".filter-year").on("click", function(){
        year_selected = $(this).data('value');
        $("#filter_year").val(year_selected);


    });
    /*Filter Submit*/
    $("#filter_frm").on("submit", function(e){
        //*Prevent submission*/
        e.preventDefault();
        /*Set filters*/
        filters['data_month'] = $("#filter_month").val();
        filters['data_year'] = $("#filter_year").val();
        filters['data_date'] = $("#filter_year").val()+ '-'+ $("#filter_month").val();

        filters['county'] = $(".county_filter").val();
        filters['regimen_id'] = $("#regimen_filter").val();



        /*Load Charts based on tab*/
        $.each(charts[tab], function(key, chartName) {
            chartID = '#'+chartName
            LoadChart(chartID, chartURL, chartName, filters)
        });
    });



    $('#btn-filter-clear').click(function(e){
              //*Prevent submission*/
              $('.county_filter').val("");
              $("#filter_month").val("");
              $("#filter_year").val("");
              $(".county_filter").val("");
              
              e.preventDefault();
              // /*clearSet filters*/
              clearfilters = {};
              // retain regimen id if set 
              clearfilters['regimen_id'] = $("#regimen_filter").val();

              /*Load Charts based on tab*/
              $.each(charts[tab], function(key, chartName) {
                chartID = '#'+chartName
                LoadChart(chartID, chartURL, chartName, clearfilters)
            });  

          });

    $.getJSON("Dashboard/get_counties", function(jsonData){
        cb = '';
        $.each(jsonData, function(i,data){
            cb+='<option value="'+data.name+'">'+data.name+'</option>';
        });
        $(".county_filter").append(cb);
    });


    $.getJSON("Dashboard/get_sites", function(jsonData){
        $('.total_sites').text(jsonData.total_sites);
        $('.internet_sites').text(jsonData.internet_sites);
        $('.internet_percentage').text(jsonData.internet_percentage+'%');
        $('.backup_sites').text(jsonData.backup_sites);
        $('.backup_percentage').text(jsonData.backup_percentage+'%');
        $('.installed_sites').text(jsonData.installed);

    });


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
    var filtername = ($(e.target).attr('href') !== undefined ) ? $(e.target).attr('href') :  '#drug'; 
    var filters = {}

    tab = filtername.replace('#', '')
    if(tab){
        //Reset filter identifier
        $("#filter_tab").val(tab)
        /*Load Charts*/
        $.each(charts[tab], function(key, chartName) {
            chartID = '#'+chartName
            LoadChart(chartID, chartURL, chartName, filters)
        });
    }
}

function setFilter(className, hiddenID){

}