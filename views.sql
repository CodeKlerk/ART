CREATE OR REPLACE VIEW `vw_regimen_drug` AS
select 
concat(`tr`.`code`,' | ',`tr`.`name`) AS `regimen`,`dl`.`name` AS `drug`,`tc`.`total` AS `total`,`tc`.`period_year` AS `data_year`,`tc`.`period_month` AS `data_month`,str_to_date(concat_ws('-',`tc`.`period_year`,`tc`.`period_month`,'01'),'%Y-%b-%d') AS `data_date` from (((`tbl_regimen` `tr` left join `tbl_regimen_drug` `trd` on((`tr`.`id` = `trd`.`regimen_id`))) join `vw_drug_list` `dl` on((`trd`.`drug_id` = `dl`.`id`))) join `tbl_consumption` `tc` on((`dl`.`id` = `tc`.`drug_id`)));



CREATE OR REPLACE VIEW `vw_facility` AS
select `f`.`name` AS `facility`,`f`.`mflcode` AS `mflcode`,`f`.`category` AS `category`,`c`.`name` AS `county`,`sc`.`name` AS `sub_county`,`s`.`internet` AS `internet`,`s`.`backup` AS `backup`,`s`.`installed` AS `installed`,`s`.`version` AS `version` from (((`tbl_facility` `f` join `tbl_subcounty` `sc` on((`sc`.`id` = `f`.`subcounty_id`))) join `tbl_county` `c` on((`c`.`id` = `sc`.`county_id`))) left join `dsh_site` `s` on((`f`.`name` = `s`.`facility`)));


update dsh_site set data_date = STR_TO_DATE(CONCAT_WS('-', data_year,data_month, '01'),'%Y-%b-%d');

update dsh_consumption set data_date = STR_TO_DATE(CONCAT_WS('-', data_year,data_month, '01'),'%Y-%b-%d');