<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-03-16 06:20:12 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'skl_categorys.id' in 'on clause' [ SELECT `skl_models`.`id` AS `id`, `skl_models`.`sku` AS `sku`, `skl_models`.`name` AS `name`, `skl_models`.`alias` AS `alias`, `skl_categorys`.`name` AS `category`, `skl_models`.`modificated` AS `modificated`, `skl_models`.`price` AS `price` FROM `skl_models` JOIN `skl_categorys` ON (`skl_categorys`.`id` = `skl_models`.`id_categorys`) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 06:20:12 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(1, 'SELECT `skl_mod...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(96): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(153): Model_SkladModels->GetAll()
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 06:21:31 --- EMERGENCY: View_Exception [ 0 ]: The requested view modelsa/edit_model could not be found ~ SYSPATH/classes/Kohana/View.php [ 265 ] in /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php:145
2015-03-16 06:21:31 --- DEBUG: #0 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(145): Kohana_View->set_filename('modelsa/edit_mo...')
#1 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(30): Kohana_View->__construct('modelsa/edit_mo...', NULL)
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(170): Kohana_View::factory('modelsa/edit_mo...')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php:145
2015-03-16 07:05:08 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/classes/Model/SkladModels.php [ 226 ] in file:line
2015-03-16 07:05:08 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-03-16 07:21:46 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'parent_id' in 'where clause' [ SELECT * FROM `skl_categorys` WHERE `parent_id` = '0' ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:21:46 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(1, 'SELECT * FROM `...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(164): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(205): Model_SkladModels->CategoriesGetCurrent(Array)
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:35:02 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keywords' in 'field list' [ INSERT INTO `skl_categorys` (`name`, `title`, `menu`, `text`, `description`, `keywords`, `storage_id`, `alias`, `id_parent`, `created`, `modificated`) VALUES ('Компьютеры', 'Компьютеры', 'Компьютеры', '', '', '', '', 'kompyuteryi', '0', NOW(), NOW()) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:35:02 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(202): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(209): Model_SkladModels->AddCategory(Array, '0')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:35:52 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: keywords ~ APPPATH/classes/Model/SkladModels.php [ 194 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:194
2015-03-16 07:35:52 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(194): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 194, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(209): Model_SkladModels->AddCategory(Array, '0')
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:194
2015-03-16 07:36:10 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'storage_id' in 'field list' [ INSERT INTO `skl_categorys` (`name`, `title`, `menu`, `text`, `description`, `storage_id`, `alias`, `id_parent`, `created`, `modificated`) VALUES ('Компьютеры', 'Компьютеры', 'Компьютеры', '', '', '', 'kompyuteryi', '0', NOW(), NOW()) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:36:10 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(201): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(209): Model_SkladModels->AddCategory(Array, '0')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:37:30 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'storage_id' in 'field list' [ INSERT INTO `skl_categorys` (`name`, `title`, `menu`, `text`, `description`, `storage_id`, `alias`, `id_parent`, `created`, `modificated`) VALUES ('Компьютеры', 'Компьютеры', 'Компьютеры', '', '', '', 'kompyuteryi', '0', NOW(), NOW()) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:37:30 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(201): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(209): Model_SkladModels->AddCategory(Array, '0')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:37:44 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'alias' in 'field list' [ INSERT INTO `skl_categorys` (`name`, `title`, `menu`, `text`, `description`, `id`, `alias`, `id_parent`, `created`, `modificated`) VALUES ('Компьютеры', 'Компьютеры', 'Компьютеры', '', '', '', 'kompyuteryi', '0', NOW(), NOW()) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:37:44 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(201): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(209): Model_SkladModels->AddCategory(Array, '0')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:38:09 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: category_id ~ APPPATH/classes/Controller/Sklad.php [ 218 ] in /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php:218
2015-03-16 07:38:09 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(218): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 218, Array)
#1 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php:218
2015-03-16 07:38:46 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'sklad.skl_categories' doesn't exist [ SELECT * FROM `skl_categories` WHERE `id` = '1' LIMIT 1 ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:38:46 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(1, 'SELECT * FROM `...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(175): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(218): Model_SkladModels->CategoriesGetById('1')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:45:55 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Model_SkladModels::NewStorage() ~ APPPATH/classes/Controller/Sklad.php [ 156 ] in file:line
2015-03-16 07:45:55 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-03-16 07:46:54 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'operation' in 'field list' [ INSERT INTO `skl_models` (`sku`, `name`, `title`, `id_categorys`, `short_text`, `text`, `in_price`, `price`, `complete`, `description`, `keywords`, `operation`, `storage_id`, `alias`, `created`, `modificated`) VALUES ('943049', 'АйМак', 'АйМак', '2', 'шорт текст', 'биг текст', '15000', '20000', 'хз че тут писать', 'дескрипшн', 'ключи', 'new', '', 'aymak', NOW(), NOW()) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:46:54 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(34): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(156): Model_SkladModels->NewModel(Array)
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:47:27 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'storage_id' in 'field list' [ INSERT INTO `skl_models` (`sku`, `name`, `title`, `id_categorys`, `short_text`, `text`, `in_price`, `price`, `complete`, `description`, `keywords`, `storage_id`, `alias`, `created`, `modificated`) VALUES ('943049', 'АйМак', 'АйМак', '2', 'шорт текст', 'биг текст', '15000', '20000', 'хз че тут писать', 'дескрипшн', 'ключи', '', 'aymak', NOW(), NOW()) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:47:27 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(34): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(156): Model_SkladModels->NewModel(Array)
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:48:43 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'storage_id' in 'field list' [ INSERT INTO `skl_models` (`sku`, `name`, `title`, `id_categorys`, `short_text`, `text`, `in_price`, `price`, `complete`, `description`, `keywords`, `storage_id`, `alias`, `created`, `modificated`) VALUES ('943049', 'АйМак', 'АйМак', '2', 'шорт текст', 'биг текст', '15000', '20000', 'хз че тут писать', 'дескрипшн', 'ключи', '', 'aymak', NOW(), NOW()) ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:48:43 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(35): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(156): Model_SkladModels->NewModel(Array)
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-16 07:48:56 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: deleted ~ APPPATH/views/models/show_models.php [ 31 ] in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:31
2015-03-16 07:48:56 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/views/models/show_models.php(31): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 31, Array)
#1 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(62): include('/var/www/sklad-...')
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(359): Kohana_View::capture('/var/www/sklad-...', Array)
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /var/www/sklad-go-byte-ru/application/views/template.php(38): Kohana_View->__toString()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(62): include('/var/www/sklad-...')
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(359): Kohana_View::capture('/var/www/sklad-...', Array)
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /var/www/sklad-go-byte-ru/application/classes/Controller/SkladTmp.php(39): Kohana_Controller_Template->after()
#9 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(87): Controller_SkladTmp->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#12 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#14 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#15 {main} in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:31
2015-03-16 07:49:31 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: in_price ~ APPPATH/views/models/show_models.php [ 56 ] in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:56
2015-03-16 07:49:31 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/views/models/show_models.php(56): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 56, Array)
#1 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(62): include('/var/www/sklad-...')
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(359): Kohana_View::capture('/var/www/sklad-...', Array)
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /var/www/sklad-go-byte-ru/application/views/template.php(38): Kohana_View->__toString()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(62): include('/var/www/sklad-...')
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/View.php(359): Kohana_View::capture('/var/www/sklad-...', Array)
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /var/www/sklad-go-byte-ru/application/classes/Controller/SkladTmp.php(39): Kohana_Controller_Template->after()
#9 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(87): Controller_SkladTmp->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#12 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#14 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#15 {main} in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:56
2015-03-16 07:51:01 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: model_id ~ APPPATH/classes/Model/SkladModels.php [ 40 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:40
2015-03-16 07:51:01 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(40): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 40, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(160): Model_SkladModels->UpdateModel(Array)
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:40
2015-03-16 07:51:48 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: models_id ~ APPPATH/classes/Model/SkladModels.php [ 40 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:40
2015-03-16 07:51:48 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(40): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 40, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(160): Model_SkladModels->UpdateModel(Array)
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:40
2015-03-16 07:53:00 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: models_id ~ APPPATH/classes/Model/SkladModels.php [ 40 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:40
2015-03-16 07:53:00 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(40): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 40, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(160): Model_SkladModels->UpdateModel(Array)
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:40
2015-03-16 11:02:38 --- EMERGENCY: ErrorException [ 1 ]: Class 'Cache' not found ~ APPPATH/classes/Model/SkladModels.php [ 272 ] in file:line
2015-03-16 11:02:38 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-03-16 11:02:52 --- EMERGENCY: Cache_Exception [ 0 ]: Failed to load Kohana Cache group: file ~ MODPATH/cache/classes/Kohana/Cache.php [ 131 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:272
2015-03-16 11:02:52 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(272): Kohana_Cache::instance()
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(48): Model_SkladModels->GetAllModelsCached()
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_main()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:272