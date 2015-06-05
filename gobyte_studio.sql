-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 05 2015 г., 14:51
-- Версия сервера: 5.5.41-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gobyte_studio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `skl_articles`
--

CREATE TABLE IF NOT EXISTS `skl_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `alias` varchar(300) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `skl_articles`
--

INSERT INTO `skl_articles` (`id`, `title`, `name`, `keywords`, `description`, `alias`, `content`) VALUES
(1, 'Контакты', 'Контакты', NULL, NULL, 'contacts', 'Режим работы\n\nПн-Вс, без перерыва и выходных, с 10:00 до 20:00.\n\n\nТелефон\n\n8 (473) 200-10-95\n\nemail: bytevrn@gmail.com\n\nАдрес: г. Воронеж, ул 9 Января 68 "З"\n\nЗдание Эльдорадо.Третий этаж, офис №302. Вход справа от основного.'),
(2, 'Корпоративный отдел', 'Корпоративный отдел', NULL, NULL, 'corporate', 'Теперь в BYTE могут экономить и корпоративные клиенты!\n\n    Оптовые цены.\n    При заказе на 100 000 руб и более цены значительно ниже.\n    Индивидуальные скидки для постоянных оптовых покупателей.\n\n    Бесплатная доставка по г. Воронеж.\n    Курьер доставит Ваш заказ с полным пакетом документов.\n    Доставка в удобное для Вас время.\n\n    Быстрая замена в течение 48-ми часов.\n    Мы превзошли закон о защите прав потребителей!\n    Вам не нужно ожидать решения проблемы 20-45 дней.\n\n    Индивидуальный менеджер.\n    Полное сопровождение от заказа до получения товара. \n\n\nРежим работы\n\nПн-Вс, без перерыва и выходных, с 10:00 до 20:00.\n\nТелефон\n\n8 (473) 200-10-95\n\nemail: bytevrn@gmail.com\n\nАдрес: г. Воронеж, ул 9 Января 68 "З"\n\nЗдание Эльдорадо.Третий этаж, офис №302. Вход справа от основного.'),
(3, 'Помощь покупателю', 'Помощь покупателю', NULL, NULL, 'help', 'Помощь покупателю\nОткуда такие цены?\nУ нас самые низкие цены, это факт. Они одновременно притягивают и настораживают.\n\n\nЧто же такое Дисконт-магазин цифровой техники?\nВсе просто - у крупных торговых сетей при большом объеме товарооборота накапливается уцененный товар: \n- товар, который приобрел покупатель и вернул его в магазин в течение двух недель по причине того, что передумал и приобрел другую модель с доплатой;\n- упаковка, утерявшая товарный вид;\n- выставочные образцы, которые стояли на витринах магазинов;\n- товар с малозаметными микроцарапинами, от которого клиент отказался и попросил, к примеру, нераспечатанный телефон.\n- банально, ноутбуки, которые заменяют новым модельным рядом;\n- товар от которого отказался покупатель по причине того, что курьер привез технику не того цвета.\n\n    Как сказал один наш клиент: "Самое главное что этот товар сохраняет всю свою функциональность и вы даете гарантию"\n\n\n\nУ нас всех есть привычка говорить "Мне пожалуйста только не с витрины!" И мы  все это говорим!\nВ противном случае с недовольным лицом забираем то, что нам дают. Мы впервые даем возможность купить этот товар практически за пол цены!\n\nТорговые сети не могут, да и не хотят продавать такую продукцию, рискуя потерять репутацию. А для нас с Вами - это возможность...возможность покупать любимую технику по фантастически низкой цене. Так и появился проект BYTE, помогающий всем:\n- покупателям готовым экономить; \n- крупным торговым сетям;\n- нам, молодому и набирающему быструю популярность проекту BYTE.\n\n    P.S. Я прекрасно помню тот день, когда мы делали нашу первую закупку, как переживали, нервничали, а ожидание открыть коробку было запредельным. Все пришедшие телефоны и планшеты были идеальны и требовали разве что салфетки, а мы визжали от радости и понимали что это начало...успешное начало одного из лучших проектов, за которые мы брались!\n\n    OvnRtFoDLEA.jpg\n    .\n\n\nКак сделать заказ\n\n    1. Зайдите на наш сайт go-byte.ru найдите нужный товар в меню сайта\n\n    5bCpW848rDQ.jpg\n\n\n    или выберите его в колонках лучших предложений\n\n    TDM3kP-hngA.jpg\n\n\n    2. На странице товара нажать кнопку В КОРЗИНУ, появиться всплывающее окно которое предложит вам перейти к оформлению заказа, жмем ДА. Так же ваша корзина теперь не пуста в ней появится значок и количество товара.\n\n    3.jpg\n\n\n    3. Заполнить контактные данные по заказу. Это просто и без регистрации\n\n    4.jpg\n\n\n     Выбираем тип доставки и жмем ОФОРМИТЬ ЗАКАЗ. \n\n    Поздравляем! Ожидайте звонка для подтверждения заказа.\n\n\n\n    Как забрать / Доставка\n\n    Существует два способа получить заказ. \n\n    • Самовывоз \n\n        Вы самостоятельно можете забрать заказ у нас в офисе по адресу Вашего города\n        Все просто! Называете № заказа и получаете его. \n\n\n    • Доставка курьером \n\n        Курьер доставляет заказ по указанному вами адресу. \n        При выборе типа доставки курьером вы обнаружите статусы стоимости и времени доставки\n\n\n    Стоимость:    бесплатно     У нас бесплатная доставка на заказы от 5000 руб. При сумме заказа до 5000 руб стоимость доставки - $1000, другими словами доставкой на товары нижней ценовой планки не занимаемся.\n\n    Когда? :      в течении 24 ч    Наша курьерская служба доставит любой заказ в течении 24 часов с момента оформления заказа.\n\n    Предварительно с вами  свяжется оператор и уточнит удобное для вас и нас время. \n');

-- --------------------------------------------------------

--
-- Структура таблицы `skl_categorys`
--

CREATE TABLE IF NOT EXISTS `skl_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) DEFAULT NULL,
  `alias` varchar(120) DEFAULT NULL,
  `menu` varchar(90) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `text` longtext,
  `description` longtext,
  `id_parent` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modificated` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `skl_categorys`
--

INSERT INTO `skl_categorys` (`id`, `name`, `alias`, `menu`, `title`, `text`, `description`, `id_parent`, `created`, `modificated`, `deleted`) VALUES
(1, 'Ноутбуки', 'noutbuki', 'Ноутбуки', 'Ноутбуки', '', '', 0, '2015-03-23 12:28:07', '2015-03-23 12:28:07', NULL),
(2, 'Планшеты', 'planshetyi', 'Планшеты', 'Планшеты', '', '', 0, '2015-03-23 12:28:29', '2015-03-23 12:28:29', NULL),
(3, 'Телефоны', 'telefonyi', 'Телефоны', 'Телефоны', '', '', 0, '2015-03-23 12:28:45', '2015-03-23 12:28:45', NULL),
(4, 'Фототехника', 'fototehnika', 'Фототехника', 'Фототехника', '', '', 0, '2015-03-23 12:29:02', '2015-03-23 12:29:02', NULL),
(5, 'Авто', 'avto', 'Авто', 'Авто', '', '', 0, '2015-03-23 12:29:14', '2015-03-23 12:29:14', NULL),
(6, 'Игровые приставки', 'igrovyie-pristavki', 'Игровые приставки', 'Игровые приставки', '', '', 0, '2015-03-23 12:29:28', '2015-03-23 12:29:28', NULL),
(7, 'Книги', 'knigi', 'Книги', 'Книги', '', '', 2, '2015-03-23 12:29:52', '2015-03-23 12:30:05', NULL),
(8, 'Планшеты', 'planshetyi', 'Планшеты', 'Планшеты', '', '', 2, '2015-03-23 12:40:48', '2015-03-23 12:40:48', NULL),
(9, 'Смартфоны', 'smartfonyi', 'Смартфоны', 'Смартфоны', '', '', 3, '2015-03-23 12:41:18', '2015-03-23 12:41:18', NULL),
(10, 'Мобильные телефоны', 'mobilnyie-telefonyi', 'Мобильные телефоны', 'Мобильные телефоны', '', '', 3, '2015-03-23 12:41:32', '2015-03-23 12:41:32', NULL),
(11, 'Зеркальные фотоаппараты', 'zerkalnyie-fotoapparatyi', 'Зеркальные фотоаппараты', 'Зеркальные фотоаппараты', '', '', 4, '2015-03-23 12:41:57', '2015-03-23 12:41:57', NULL),
(12, 'Компактные фотоаппараты', 'kompaktnyie-fotoapparatyi', 'Компактные фотоаппараты', 'Компактные фотоаппараты', '', '', 4, '2015-03-23 12:42:21', '2015-03-23 12:42:21', NULL),
(13, 'Ультразум фотоаппараты', 'ultrazum-fotoapparatyi', 'Ультразум фотоаппараты', 'Ультразум фотоаппараты', '', '', 4, '2015-03-23 12:42:38', '2015-03-23 12:42:38', NULL),
(14, 'Объективы', 'obyektivyi', 'Объективы', 'Объективы', '', '', 4, '2015-03-23 12:42:51', '2015-03-23 12:42:51', NULL),
(15, 'Видеорегистраторы', 'videoregistratoryi', 'Видеорегистраторы', 'Видеорегистраторы', '', '', 5, '2015-03-23 12:43:18', '2015-03-23 12:43:18', NULL),
(16, 'Радар-детекторы', 'radar-detektoryi', 'Радар-детекторы', 'Радар-детекторы', '', '', 5, '2015-03-23 12:43:31', '2015-03-23 12:43:31', NULL),
(17, 'Навигаторы', 'navigatoryi', 'Навигаторы', 'Навигаторы', '', '', 5, '2015-03-23 12:43:41', '2015-03-23 12:43:41', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_citys`
--

CREATE TABLE IF NOT EXISTS `skl_citys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `alias` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `skl_citys`
--

INSERT INTO `skl_citys` (`id`, `name`, `alias`) VALUES
(1, 'Админ', 'superuser'),
(5, 'Воронеж', 'voronezh'),
(6, 'Контент', 'content'),
(7, 'Ростов-на-Дону', 'rostov-na-donu');

-- --------------------------------------------------------

--
-- Структура таблицы `skl_images_models`
--

CREATE TABLE IF NOT EXISTS `skl_images_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(45) DEFAULT NULL,
  `alt` varchar(90) DEFAULT NULL,
  `id_models` int(11) DEFAULT NULL,
  `important` int(1) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `skl_images_models`
--

INSERT INTO `skl_images_models` (`id`, `file`, `alt`, `id_models`, `important`, `active`, `created`) VALUES
(1, '1427104704_7koW.png', '', 1, 0, 0, '2015-03-23 12:58:25');

-- --------------------------------------------------------

--
-- Структура таблицы `skl_models`
--

CREATE TABLE IF NOT EXISTS `skl_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `alias` varchar(140) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(140) CHARACTER SET utf8 DEFAULT NULL,
  `short_text` longtext CHARACTER SET utf8,
  `text` longtext CHARACTER SET utf8,
  `in_price` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `complectation` longtext CHARACTER SET utf8,
  `description` longtext CHARACTER SET utf8,
  `keywords` longtext CHARACTER SET utf8,
  `created` datetime DEFAULT NULL,
  `modificated` datetime DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `id_categorys` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `skl_models`
--

INSERT INTO `skl_models` (`id`, `sku`, `name`, `alias`, `title`, `short_text`, `text`, `in_price`, `price`, `complectation`, `description`, `keywords`, `created`, `modificated`, `deleted`, `id_categorys`) VALUES
(1, '0000', 'Asus T100TA Docking', 'asus-t100ta-docking', 'Asus T100TA Docking', '', 'Отличная производительность. В основе модели имеется четырехъядерный процессор Intel Atom Z3740 с тактовой частотой 1,33 ГГц, а поддержка графики осуществляется высокоскоростным видеочипом Intel® HD Graphics. Устройство управляется операционной системой Microsoft Windows 8.1, что дает возможность пользователю находиться в той же среде, что и на работе (за редким исключением).\n\nУдобство просмотра. Сенсорный 10,1-дюймовый TFT-экран снабжен светодиодной подсветкой, которая усиливает выразительность и насыщенность красок изображения. Дисплей емкостного типа моментально реагирует на прикосновения кончиков пальцев. Кроме того, он имеет поддержку технологии Multitouch, что создает для геймера комфорт при использовании современных игровых приложений и при управлении камерой.\n\nДва в одном. Планшет Asus Transformer Book T100TA-DK003H предлагается вместе с клавиатурой, которая идеально сочетается с ним по стилю, дизайну и технологическому исполнению. Это весьма оригинальное решение значительно облегчит пользователю задачу при вводе текстовой информации. Написать письмо, пообщаться в чате или оставить комментарий к фотографии станет намного проще и быстрее. Модель пристегивается к корпусу с помощью док-разъема. При подключении или отсоединении блока кнопок информация на девайсе не теряется и не требуется перезагружать систему.', 14000, 18000, 'Стандартная комплектация устройства\n+\nгарантийный талон магазина BYTE', '', '', '2015-03-23 12:57:54', '2015-03-25 18:32:43', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_models_categorys`
--

CREATE TABLE IF NOT EXISTS `skl_models_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_models` int(11) DEFAULT NULL,
  `id_categorys` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `skl_models_categorys`
--

INSERT INTO `skl_models_categorys` (`id`, `id_models`, `id_categorys`) VALUES
(7, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_orders`
--

CREATE TABLE IF NOT EXISTS `skl_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `complete` int(1) NOT NULL DEFAULT '0',
  `session` varbinary(80) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modificated` datetime DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL,
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `skl_orders`
--

INSERT INTO `skl_orders` (`id`, `date`, `id_users`, `complete`, `session`, `created`, `modificated`, `phone`, `text`) VALUES
(1, '2015-03-26 15:54:23', 1, 0, 'voronezh1427385268w', '2015-03-26 18:54:28', '2015-04-02 13:38:40', '+79515511726', 'Ну типа так'),
(2, '2015-03-26 16:37:22', 1, 1, 'voronezh1427377042m', '2015-03-26 16:37:22', '2015-04-02 13:35:11', '', ''),
(3, '2015-03-26 18:54:57', 1, 0, 'voronezh1427385363Y', '2015-03-26 18:56:03', '2015-04-01 17:56:13', '+79515511726', 'тестовая продажа'),
(4, '2015-04-01 17:55:59', 1, 0, 'voronezh1427385363Y', '2015-03-26 18:56:03', '2015-04-01 17:56:45', '+79515511726', 'тестовая продажа'),
(5, '2015-04-02 14:20:46', 1, 0, 'voronezh1427973646Q', '2015-04-02 14:20:46', '2015-04-02 14:20:46', '', ''),
(6, '2015-04-02 14:23:49', 1, 0, 'voronezh1427973829x', '2015-04-02 14:23:49', '2015-04-02 14:23:49', '', ''),
(7, '2015-04-02 14:24:55', 1, 0, 'voronezh1427973895b', '2015-04-02 14:24:55', '2015-04-02 14:24:55', '', ''),
(8, '2015-04-02 14:25:26', 1, 0, 'voronezh1427973926H', '2015-04-02 14:25:26', '2015-04-02 14:25:32', '', ''),
(9, '2015-04-02 14:25:57', 1, 0, 'voronezh1427973957F', '2015-04-02 14:25:57', '2015-04-02 14:26:07', '', ''),
(10, '2015-04-02 14:26:28', 1, 0, 'voronezh1427973988M', '2015-04-02 14:26:28', '2015-04-02 15:02:22', '', ''),
(11, '2015-04-02 15:18:00', 1, 0, 'voronezh1427977080e', '2015-04-02 15:18:00', '2015-04-02 15:22:49', '', ''),
(12, '2015-04-09 17:21:24', 2, 0, 'voronezh-prodavets1428589284O', '2015-04-09 17:21:24', '2015-04-09 17:21:24', '', ''),
(13, '2015-04-09 17:21:45', 2, 0, 'voronezh-prodavets1428589305J', '2015-04-09 17:21:45', '2015-04-09 17:21:45', '', ''),
(14, '2015-04-09 17:22:09', 2, 0, 'voronezh-prodavets1428589329J', '2015-04-09 17:22:09', '2015-04-09 17:22:09', '', ''),
(15, '2015-04-09 17:22:38', 1, 0, 'voronezh1428589358Y', '2015-04-09 17:22:38', '2015-04-09 17:22:38', '', ''),
(16, '2015-04-09 17:34:01', 2, 0, 'voronezh1428590041Q', '2015-04-09 17:34:01', '2015-04-09 17:34:35', '', ''),
(17, '2015-04-09 17:39:47', 4, 0, 'voronezh1428590387s', '2015-04-09 17:39:47', '2015-04-09 17:43:43', '', ''),
(18, '2015-04-09 17:43:54', 4, 0, 'rostov-na-donu1428590634F', '2015-04-09 17:43:54', '2015-04-09 17:43:54', '', 'test'),
(19, '2015-04-09 17:44:04', 4, 0, 'rostov-na-donu1428590644e', '2015-04-09 17:44:04', '2015-04-09 17:44:04', '', ''),
(20, '2015-04-21 16:12:45', 3, 0, 'content14296219657', '2015-04-21 16:12:45', '2015-04-21 16:12:45', '', ''),
(21, '2015-04-21 16:13:37', 2, 0, 'voronezh1429622017u', '2015-04-21 16:13:37', '2015-04-21 16:13:37', '', ''),
(22, '2015-04-21 16:14:38', 2, 0, 'voronezh1429622078S', '2015-04-21 16:14:38', '2015-04-21 16:14:38', '', ''),
(23, '2015-04-21 16:26:25', 2, 0, 'voronezh1429622785W', '2015-04-21 16:26:25', '2015-04-21 16:26:29', '', ''),
(24, '2015-04-21 16:30:45', 2, 0, 'voronezh1429623045N', '2015-04-21 16:30:45', '2015-04-21 16:41:06', '', ''),
(25, '2015-04-21 16:41:13', 2, 1, 'voronezh1429623673e', '2015-04-21 16:41:13', '2015-04-21 16:41:19', '', ''),
(26, '2015-04-21 17:27:41', 2, 1, 'voronezh14296264612', '2015-04-21 17:27:41', '2015-04-21 17:33:48', '', ''),
(27, '2015-04-21 17:47:35', 2, 0, 'voronezh1429627655a', '2015-04-21 17:47:35', '2015-04-21 17:47:35', '', ''),
(28, '2015-04-22 13:11:29', 2, 0, 'voronezh14296264612', '2015-04-21 17:27:41', '2015-04-22 13:39:51', '', ''),
(29, '2015-04-22 17:11:07', 2, 0, 'voronezh1429711867t', '2015-04-22 17:11:07', '2015-04-22 17:11:13', '', ''),
(30, '2015-04-22 17:12:15', 2, 1, 'voronezh1429711935M', '2015-04-22 17:12:15', '2015-04-23 17:17:53', '', ''),
(31, '2015-04-22 17:23:11', 4, 0, 'rostov-na-donu1429712591V', '2015-04-22 17:23:11', '2015-04-23 15:18:10', '', ''),
(32, '2015-04-23 17:17:27', 2, 1, 'voronezh1429798647r', '2015-04-23 17:17:27', '2015-04-23 17:17:31', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `skl_orders_products`
--

CREATE TABLE IF NOT EXISTS `skl_orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orders` int(11) DEFAULT NULL,
  `id_products` int(11) DEFAULT NULL,
  `price_out` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `skl_orders_products`
--

INSERT INTO `skl_orders_products` (`id`, `id_orders`, `id_products`, `price_out`) VALUES
(16, 26, 4, 18000),
(18, 32, 2, 18000),
(19, 30, 3, 18000);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_products`
--

CREATE TABLE IF NOT EXISTS `skl_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_models` int(11) DEFAULT NULL,
  `sku` varchar(60) DEFAULT NULL,
  `comments` varchar(45) DEFAULT NULL,
  `id_storage` int(11) DEFAULT NULL,
  `out` int(1) NOT NULL DEFAULT '0',
  `date_out` datetime DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `skl_products`
--

INSERT INTO `skl_products` (`id`, `id_models`, `sku`, `comments`, `id_storage`, `out`, `date_out`, `deleted`) VALUES
(1, 1, '4', '', 1, 0, '0000-00-00 00:00:00', 0),
(2, 1, '1', '', 1, 1, '2015-04-23 17:17:29', 0),
(3, 1, '2', '', 1, 1, '2015-04-23 00:00:01', 0),
(4, 1, '3', '', 1, 1, '2015-04-21 17:27:43', 0),
(5, 1, 'rostov1', 'перемещен на основной', 3, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_specifications`
--

CREATE TABLE IF NOT EXISTS `skl_specifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `id_specifications_groups` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `skl_specifications`
--

INSERT INTO `skl_specifications` (`id`, `name`, `deleted`, `id_specifications_groups`, `order`) VALUES
(1, 'Процессор', 0, 1, 0),
(2, 'Кол-во ядер процессора', 0, 1, 0),
(3, 'Частота процессора, МГц', 0, 1, 0),
(4, 'Операционная система', 0, 1, 0),
(5, 'G-сенсор', 0, 1, 0),
(6, 'Основная камера (Мп)', 0, 2, 0),
(7, 'Фронтальная камера (Мп)', 0, 2, 0),
(8, 'Встроенный GPS', 0, 3, 0),
(9, 'Сенсорный дисплей', 0, 4, 0),
(10, 'Тип дисплея', 0, 4, 0),
(11, 'Размер экрана, дюйм', 0, 4, 0),
(12, 'Разрешение дисплея, пикс', 0, 4, 0),
(13, 'Тип сенсорного экрана', 0, 4, 0),
(14, 'Поддержка Multitouch', 0, 4, 0),
(15, 'Видео', 0, 5, 0),
(16, 'Аудио', 0, 5, 0),
(17, 'Фото', 0, 5, 0),
(18, 'Bluetooth', 0, 6, 0),
(19, 'Wi-Fi (802.11)', 0, 6, 0),
(20, 'Встроенный 3G-модем', 0, 6, 0),
(21, 'Оперативная память, Мб', 0, 7, 0),
(22, 'Встроенная память, Гб', 0, 7, 0),
(23, 'Поддержка карт памяти', 0, 7, 0),
(24, 'Тип аккумулятора', 0, 8, 0),
(25, 'Время автономной работы (ч)', 0, 8, 0),
(26, 'Габариты (ВxШxТ), мм', 0, 9, 0),
(27, 'Вес, г', 0, 9, 0),
(28, 'Производитель', 0, 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_specifications_groups`
--

CREATE TABLE IF NOT EXISTS `skl_specifications_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `deleted` int(1) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `skl_specifications_groups`
--

INSERT INTO `skl_specifications_groups` (`id`, `name`, `deleted`, `order`) VALUES
(1, 'Рабочие характеристики', 0, 1),
(2, 'Фотокамера', 0, 2),
(3, 'Мультимедиа', 0, 3),
(4, 'Дисплей', 0, 4),
(5, 'Поддержка форматов', 0, 5),
(6, 'Беспроводная связь', 0, 6),
(7, 'Память', 0, 7),
(8, 'Питание', 0, 8),
(9, 'Габариты', 0, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_specifications_models`
--

CREATE TABLE IF NOT EXISTS `skl_specifications_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_specifications` int(11) DEFAULT NULL,
  `id_models` int(11) DEFAULT NULL,
  `value` varchar(250) DEFAULT NULL,
  `important` int(1) DEFAULT NULL,
  `manual` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modificated` datetime DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `skl_specifications_models`
--

INSERT INTO `skl_specifications_models` (`id`, `id_specifications`, `id_models`, `value`, `important`, `manual`, `created`, `modificated`, `deleted`) VALUES
(1, 1, 1, 'Intel Atom Z3740', 0, 0, '2015-03-23 12:58:54', '2015-03-23 15:00:15', NULL),
(2, 2, 1, '4', 0, 0, '2015-03-23 12:59:06', '2015-03-23 15:00:15', NULL),
(3, 3, 1, '1330', 0, 0, '2015-03-23 12:59:27', '2015-03-23 15:00:15', NULL),
(4, 4, 1, 'Microsoft Windows 8.1', 0, 1, '2015-03-23 12:59:38', '2015-03-23 15:00:15', NULL),
(5, 5, 1, 'есть', 0, 0, '2015-03-23 12:59:47', '2015-03-23 15:00:15', NULL),
(6, 6, 1, 'нет', 0, 0, '2015-03-23 14:44:43', '2015-03-23 15:00:15', NULL),
(7, 7, 1, '1.2', 0, 0, '2015-03-23 14:44:47', '2015-03-23 15:00:15', NULL),
(8, 8, 1, 'нет', 0, 0, '2015-03-23 14:55:03', '2015-03-23 15:00:15', NULL),
(9, 9, 1, 'да', 0, 0, '2015-03-23 14:55:20', '2015-03-23 15:00:16', NULL),
(10, 10, 1, 'TFT', 0, 0, '2015-03-23 14:55:23', '2015-03-23 15:00:16', NULL),
(11, 11, 1, '10.1', 0, 0, '2015-03-23 14:55:26', '2015-03-23 15:00:16', NULL),
(12, 12, 1, '1366x768', 0, 0, '2015-03-23 14:55:29', '2015-03-23 15:00:16', NULL),
(13, 13, 1, 'емкостный', 0, 0, '2015-03-23 14:55:39', '2015-03-23 15:00:16', NULL),
(14, 14, 1, 'да', 0, 0, '2015-03-23 14:55:42', '2015-03-23 15:00:16', NULL),
(15, 15, 1, 'Видео : MP4, 3GP, 3G2, RM, RMVB, ASF, WMV', 0, 0, '2015-03-23 14:56:56', '2015-03-23 15:00:16', NULL),
(16, 16, 1, 'MP3, WMA, WMV, WAV, RA, Ogg, MIDI, 3GP', 0, 0, '2015-03-23 14:57:01', '2015-03-23 15:00:16', NULL),
(17, 17, 1, 'JPEG, GIF, BMP, WBMP, PNG, TIFF', 0, 0, '2015-03-23 14:57:04', '2015-03-23 15:00:16', NULL),
(18, 18, 1, '4.0 + EDR', 0, 0, '2015-03-23 14:57:50', '2015-03-23 15:00:16', NULL),
(19, 19, 1, 'a , b , g , n', 0, 0, '2015-03-23 14:57:53', '2015-03-23 15:00:17', NULL),
(20, 20, 1, 'нет', 0, 0, '2015-03-23 14:57:56', '2015-03-23 15:00:17', NULL),
(21, 21, 1, '2048', 0, 0, '2015-03-23 14:58:34', '2015-03-23 15:00:17', NULL),
(22, 22, 1, '64', 0, 0, '2015-03-23 14:58:39', '2015-03-23 15:00:17', NULL),
(23, 23, 1, 'microSD', 0, 0, '2015-03-23 14:58:44', '2015-03-23 15:00:17', NULL),
(24, 24, 1, 'Li-Pol', 0, 0, '2015-03-23 14:59:23', '2015-03-23 15:00:17', NULL),
(25, 25, 1, '9', 0, 0, '2015-03-23 14:59:28', '2015-03-23 15:00:17', NULL),
(26, 26, 1, '263*171*10,5', 0, 0, '2015-03-23 14:59:32', '2015-03-23 15:00:17', NULL),
(27, 27, 1, '550', 0, 0, '2015-03-23 14:59:36', '2015-03-23 15:00:17', NULL),
(28, 28, 1, 'Asus', 0, 0, '2015-03-23 14:59:39', '2015-03-23 15:00:17', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_storages`
--

CREATE TABLE IF NOT EXISTS `skl_storages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `present` int(1) DEFAULT NULL,
  `id_citys` int(11) DEFAULT NULL,
  `arrive` datetime DEFAULT NULL,
  `transit` int(1) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `skl_storages`
--

INSERT INTO `skl_storages` (`id`, `name`, `present`, `id_citys`, `arrive`, `transit`, `deleted`) VALUES
(1, 'Воронеж Основной', 0, 5, '0000-00-00 00:00:00', 0, 0),
(2, 'Воронеж Транзит', 0, 5, '0000-00-00 00:00:00', 1, 0),
(3, 'Ростов Основной', 0, 7, NULL, 0, 0),
(4, 'Ростов Транзит', 0, 7, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_storages_settings`
--

CREATE TABLE IF NOT EXISTS `skl_storages_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `id_citys` int(11) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `skl_storages_settings`
--

INSERT INTO `skl_storages_settings` (`id`, `from`, `to`, `id_citys`, `deleted`) VALUES
(1, 2, 1, 5, 0),
(2, 3, 2, 5, 0),
(3, 4, 3, 7, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `skl_users`
--

CREATE TABLE IF NOT EXISTS `skl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_citys` int(11) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `lastenter` datetime DEFAULT '0000-00-00 00:00:00',
  `lastip` varchar(20) DEFAULT '0.0.0.0',
  `rights` varchar(10) DEFAULT '',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `skl_users`
--

INSERT INTO `skl_users` (`id`, `id_citys`, `password`, `lastenter`, `lastip`, `rights`, `deleted`) VALUES
(1, 1, '2f23fa3579f3f75175793649115c1b25', '2015-06-01 14:31:20', '127.0.0.1', 'super', 0),
(2, 5, '202cb962ac59075b964b07152d234b70', '2015-06-01 14:29:58', '127.0.0.1', 'sale', 0),
(3, 6, '2f23fa3579f3f75175793649115c1b25', '2015-04-22 18:05:11', '127.0.0.1', 'content', 0),
(4, 7, '2f23fa3579f3f75175793649115c1b25', '2015-04-23 15:17:54', '127.0.0.1', 'sale', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
