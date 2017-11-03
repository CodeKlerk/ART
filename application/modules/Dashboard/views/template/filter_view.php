<div class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-collapse collapse" id="navbar-filter">
      <form class="navbar-form" role="search" id="filter_frm">
        <div class="form-group">
          <select name="filter_item" id="filter_item" data-filter_type="county" class="form-control county_filter">
              <option value="">National</option>
          </select>
        </div>
        <div class="form-group">
          <div class="filter form-control">
            <input type="hidden" name="filter_year" id="filter_year" value="" />
            Year: 
            <a href="#" class="filter-year" data-value="2015"> 2015 </a>|
            <a href="#" class="filter-year" data-value="2016"> 2016 </a>|
            <a href="#" class="filter-year" data-value="2017"> 2017 </a>
          </div>
          <div class="filter form-control">
            <input type="hidden" name="filter_month" id="filter_month" value="" />
            Month: 
            <a href="#" class="filter-month" data-value="Jan"> Jan </a>|
            <a href="#" class="filter-month" data-value="Feb"> Feb </a>|
            <a href="#" class="filter-month" data-value="Mar"> Mar </a>|
            <a href="#" class="filter-month" data-value="Apr"> Apr </a>|
            <a href="#" class="filter-month" data-value="May"> May </a>|
            <a href="#" class="filter-month" data-value="Jun"> Jun </a>|
            <a href="#" class="filter-month" data-value="Jul"> Jul </a>|
            <a href="#" class="filter-month" data-value="Aug"> Aug </a>|
            <a href="#" class="filter-month" data-value="Sep"> Sep </a>| 
            <a href="#" class="filter-month" data-value="Oct"> Oct </a>|
            <a href="#" class="filter-month" data-value="Nov"> Nov </a>|
            <a href="#" class="filter-month" data-value="Dec"> Dec</a>
          </div>
        </div>
        <button type="submit" id="btn-filter-pending" class="btn btn-warning btn-md"><span class="glyphicon glyphicon-filter"></span> Filter</button>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url().'public/js/filter.js';?>"></script>