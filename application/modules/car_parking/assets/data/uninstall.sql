DELETE FROM `language` WHERE `language`.`phrase` = 'car_parking';
DELETE FROM `language` WHERE `language`.`phrase` = 'zone_list';
DELETE FROM `language` WHERE `language`.`phrase` = 'slot_list';
DELETE FROM `language` WHERE `language`.`phrase` = 'vehicle_list';
DELETE FROM `language` WHERE `language`.`phrase` = 'setting_list';
DELETE FROM `language` WHERE `language`.`phrase` = 'book_parking';
DELETE FROM `language` WHERE `language`.`phrase` = 'parking_list';
DELETE FROM `sec_menu_item` WHERE `sec_menu_item`.`module` = 'car_parking';
DELETE FROM acc_coa WHERE acc_coa.HeadCode = '30306';