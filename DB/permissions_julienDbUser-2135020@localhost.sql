GRANT USAGE ON *.* TO `julienDbUser-2135020`@`localhost` IDENTIFIED BY PASSWORD '*475D3F6DA6658C135DBBAFEAB139F28ACF79AF85'
GRANT SELECT, SHOW VIEW ON `database2135020`.`view_orders_detailed` TO `julienDbUser-2135020`@`localhost`
GRANT SELECT, SHOW VIEW ON `database2135020`.`products` TO `julienDbUser-2135020`@`localhost`
GRANT SELECT, SHOW VIEW ON `database2135020`.`orders` TO `julienDbUser-2135020`@`localhost`
GRANT SELECT, SHOW VIEW ON `database2135020`.`customers` TO `julienDbUser-2135020`@`localhost`
GRANT SELECT, EXECUTE, SHOW VIEW ON `database2135020`.* TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_products_update_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_products_select_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_products_select_all` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_products_insert_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_products_delete_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_orders_update_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_orders_select_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_orders_select_all` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_orders_select_all_with_optional_filters` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_orders_insert_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_orders_delete_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_customers_update_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_customers_select_from_username` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_customers_select_from_id` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_customers_select_all` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_customers_insert_one` TO `julienDbUser-2135020`@`localhost`
GRANT EXECUTE ON PROCEDURE `database2135020`.`procedure_customers_delete_one` TO `julienDbUser-2135020`@`localhost`