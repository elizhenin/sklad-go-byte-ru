<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-03-17 04:07:21 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Model_SkladModels::GetAllModelsCached() ~ APPPATH/classes/Controller/Sklad.php [ 48 ] in file:line
2015-03-17 04:07:21 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-03-17 04:39:06 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: category ~ APPPATH/views/models/show_models.php [ 54 ] in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:54
2015-03-17 04:39:06 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/views/models/show_models.php(54): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 54, Array)
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
#15 {main} in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:54
2015-03-17 04:39:27 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: id_categorys ~ APPPATH/views/models/show_models.php [ 54 ] in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:54
2015-03-17 04:39:27 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/views/models/show_models.php(54): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 54, Array)
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
#15 {main} in /var/www/sklad-go-byte-ru/application/views/models/show_models.php:54
2015-03-17 05:01:26 --- EMERGENCY: Database_Exception [ 1146 ]: Table 'sklad.skl_models_categories' doesn't exist [ INSERT INTO `skl_models_categories` (`id_models`, `id_categorys`) VALUES (2, '1'), (2, '1') ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-17 05:01:26 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(2, 'INSERT INTO `sk...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(64): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(158): Model_SkladModels->NewModel(Array)
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-17 05:18:09 --- EMERGENCY: ErrorException [ 4 ]: syntax error, unexpected 'public' (T_PUBLIC) ~ APPPATH/classes/Model/SkladModels.php [ 208 ] in file:line
2015-03-17 05:18:09 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2015-03-17 05:33:05 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: allowed ~ APPPATH/classes/Model/SkladModels.php [ 238 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:238
2015-03-17 05:33:05 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(238): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 238, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(173): Model_SkladModels->CategoriesFullNameAllowed()
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:238
2015-03-17 05:35:03 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: id ~ APPPATH/classes/Model/SkladModels.php [ 100 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:100
2015-03-17 05:35:03 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(100): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 100, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(162): Model_SkladModels->UpdateModel(Array)
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:100
2015-03-17 05:45:12 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'skl_models_categorys.name' in 'field list' [ SELECT `skl_models_categorys`.`id` AS `id`, `skl_models_categorys`.`name` AS `name` FROM `skl_models_categorys` WHERE `skl_models_categorys`.`id_models` = '1' ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-17 05:45:12 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(1, 'SELECT `skl_mod...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(130): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(167): Model_SkladModels->GetById('1')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-17 05:45:40 --- EMERGENCY: ErrorException [ 8 ]: Undefined offset: 10 ~ APPPATH/classes/Model/SkladModels.php [ 134 ] in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:134
2015-03-17 05:45:40 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(134): Kohana_Core::error_handler(8, 'Undefined offse...', '/var/www/sklad-...', 134, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(167): Model_SkladModels->GetById('1')
#2 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models()
#3 [internal function]: Kohana_Controller->execute()
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#8 {main} in /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php:134
2015-03-17 06:10:50 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: categorys_id ~ APPPATH/classes/Controller/Sklad.php [ 232 ] in /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php:232
2015-03-17 06:10:50 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(232): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 232, Array)
#1 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php:232
2015-03-17 06:23:46 --- EMERGENCY: Kohana_Exception [ 0 ]: View variable is not set: items ~ SYSPATH/classes/Kohana/View.php [ 179 ] in /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php:207
2015-03-17 06:23:46 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(207): Kohana_View->__get('items')
#1 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#2 [internal function]: Kohana_Controller->execute()
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#4 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#7 {main} in /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php:207
2015-03-17 06:24:32 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'skl_models_categories.id_categorys' in 'where clause' [ SELECT `skl_models`.`id` AS `id`, `skl_models`.`sku` AS `sku`, `skl_models`.`name` AS `name`, `skl_models`.`price` AS `price`, `skl_models`.`in_price` AS `in_price` FROM `skl_models` JOIN `skl_models_categorys` ON (`skl_models`.`id` = `skl_models_categorys`.`id_models`) WHERE `skl_models_categories`.`id_categorys` = '0' ] ~ MODPATH/database/classes/Database/MySQLi.php [ 174 ] in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-17 06:24:32 --- DEBUG: #0 /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php(251): Database_MySQLi->query(1, 'SELECT `skl_mod...', false, Array)
#1 /var/www/sklad-go-byte-ru/application/classes/Model/SkladModels.php(171): Kohana_Database_Query->execute()
#2 /var/www/sklad-go-byte-ru/application/classes/Controller/Sklad.php(208): Model_SkladModels->GetCurrent('0')
#3 /var/www/sklad-go-byte-ru/system/classes/Kohana/Controller.php(84): Controller_Sklad->action_models_categories()
#4 [internal function]: Kohana_Controller->execute()
#5 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Sklad))
#6 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /var/www/sklad-go-byte-ru/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/sklad-go-byte-ru/index.php(118): Kohana_Request->execute()
#9 {main} in /var/www/sklad-go-byte-ru/modules/database/classes/Kohana/Database/Query.php:251
2015-03-17 06:24:59 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: deleted ~ APPPATH/views/models/show_categories.php [ 95 ] in /var/www/sklad-go-byte-ru/application/views/models/show_categories.php:95
2015-03-17 06:24:59 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/views/models/show_categories.php(95): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 95, Array)
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
#15 {main} in /var/www/sklad-go-byte-ru/application/views/models/show_categories.php:95
2015-03-17 06:25:33 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: modificated ~ APPPATH/views/models/show_categories.php [ 120 ] in /var/www/sklad-go-byte-ru/application/views/models/show_categories.php:120
2015-03-17 06:25:33 --- DEBUG: #0 /var/www/sklad-go-byte-ru/application/views/models/show_categories.php(120): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/sklad-...', 120, Array)
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
#15 {main} in /var/www/sklad-go-byte-ru/application/views/models/show_categories.php:120