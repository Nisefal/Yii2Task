SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


--
-- Структура таблицы `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(250) NOT NULL,
  PRIMARY KEY (`brand_id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Dell'),
(2, 'Asus'),
(3, 'Acer'),
(4, 'Sony'),
(5, 'Apple');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `parent_category_id`) VALUES
(1, 'Компьютеры и ноутбуки', 0),
(2, 'Компьютеры', 1),
(3, 'Ноутбуки', 1),
(4, 'Планшеты', 1),
(5, 'Бытовая техника', 0),
(6, 'Холодильники ', 5),
(7, 'Телевизоры', 5),
(8, 'Ж/К телевизоры', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `category_products`
--

CREATE TABLE IF NOT EXISTS `category_products` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_products`
--

INSERT INTO `category_products` (`category_id`, `product_id`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  PRIMARY KEY (`comment_id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comment_id`, `product_id`, `user_id`, `comment_text`) VALUES
(1, 2, 3, 'comment1'),
(2, 2, 4, 'comment2'),
(3, 3, 2, 'comment3'),
(4, 3, 5, 'comment4'),
(5, 1, 4, 'comment5'),
(6, 2, 3, 'comment6'),
(7, 3, 2, 'comment7'),
(8, 2, 4, 'comment8'),
(9, 3, 1, 'comment9'),
(10, 6, 5, 'comment10'),
(11, 3, 2, 'comment11'),
(12, 2, 3, 'comment12');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(250) NOT NULL,
  PRIMARY KEY (`image_id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`image_id`, `product_id`, `image_path`) VALUES
(1, 1, '/1/dell_inspiron_DIM503P3602320B_2888990.jpg'),
(2, 1, '/1/dell_inspiron_DIM503P3602320B_2888978.jpg'),
(3, 1, '/1/dell_inspiron_DIM503P3602320B_2888966.jpg'),
(4, 1, '/1/dell_inspiron_DIM503P3602320B_2888954.jpg'),
(5, 2, '/2/copy_dell_inspiron_DI5010I3803500B_4d513b2c57212_2889677.jpg'),
(6, 2, '/2/copy_dell_inspiron_DI5010I3803500B_4d513b2c57212_2889665.jpg'),
(7, 2, '/2/copy_dell_inspiron_DI5010I3803500B_4d513b2c57212_2889653.jpg'),
(8, 2, '/2/copy_dell_inspiron_DI5010I3803500B_4d513b2c57212_2889642.jpg'),
(9, 2, '/2/copy_dell_inspiron_DI5010I3803500B_4d513b2c57212_2889629.jpg'),
(10, 3, '/3/acer_emachines_e725_452g25mikk_2777195.jpg'),
(11, 3, '/3/acer_emachines_e725_452g25mikk_2777183.jpg'),
(12, 3, '/3/acer_emachines_e725_452g25mikk_2777171.jpg'),
(13, 3, '/3/acer_emachines_e725_452g25mikk_2777159.jpg'),
(14, 3, '/3/acer_emachines_e725_452g25mikk_2777147.jpg'),
(15, 4, '/4/acer_travelmate_tm8572g-333g25mnkk_lxty0c001_3064474.jpg'),
(16, 4, '/4/acer_travelmate_tm8572g-333g25mnkk_lxty0c001_2372317.jpg'),
(17, 4, '/4/acer_travelmate_tm8572g-333g25mnkk_lxty0c001_2372305.jpg'),
(18, 4, '/4/acer_travelmate_tm8572g-333g25mnkk_lxty0c001_2372293.jpg'),
(19, 4, '/4/acer_travelmate_tm8572g-333g25mnkk_lxty0c001_2372281.jpg'),
(20, 5, '/5/1819535.jpg'),
(21, 5, '/5/1819524.jpg'),
(22, 5, '/5/1819513.jpg'),
(23, 6, '/6/Apple-MacBook-Pro-(MC024RSA)_5.jpg'),
(24, 6, '/6/Apple-MacBook-Pro-(MC024RSA)_4.jpg'),
(25, 6, '/6/Apple-MacBook-Pro-(MC024RSA)_3.jpg'),
(26, 6, '/6/Apple-MacBook-Pro-(MC024RSA)_2.jpg'),
(27, 6, '/6/Apple-MacBook-Pro-(MC024RSA)_1.jpg'),
(28, 7, '/7/2719576.jpg'),
(29, 7, '/7/2719563.jpg'),
(30, 7, '/7/2719552.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `rate` int(1) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  PRIMARY KEY (`product_id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `brand_id`, `name`, `description`, `rate`, `price`) VALUES
(1, 1, 'Inspiron M5030 (DIM503P3602320B) Black', 'Экран 15.6" (1366x768) LED / AMD Athlon II Dual-Core P360 (2.3 ГГц) / RAM 2 ГБ / HDD 320 ГБ / ATI Radeon HD4250 / DVD+/-RW / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 2.65 кг', 0, 3408),
(2, 1, 'Inspiron N5010 (DI5010I4804500B) Black', 'Экран 15.6" (1366x768) LED / AMD Athlon II Dual-Core P360 (2.3 ГГц) / RAM 2 ГБ / HDD 320 ГБ / ATI Radeon HD4250 / DVD+/-RW / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 2.65 кг', 0, 6072),
(3, 3, 'eMachines E725-452G25Mikk (LX.N780C.061)', 'Экран 15.6" HD (1366x768) / Intel Pentium Dual Core T4500 (2,30 ГГц) / RAM 2 ГБ / HDD 250 ГБ / Intel GMA 4500M / DVD SuperMulti / Lan / Wi-Fi / веб-камера / Linux / 2.7 кг', 0, 2952),
(4, 3, 'TravelMate 8572G-333G25Mnkk (LX.TYY0C.001)', 'Экран 15.6'''' (1366x768) LED матовый / Intel Core i3-330M (2.13 ГГц) / RAM 3 ГБ / HDD 250 ГБ / NVIDIA GeForce 310M, 512 МБ / DVD Super Multi / LAN / факс-модем / Wi-Fi / веб-камера / Linux / 2.6 кг\r\n', 0, 4312),
(5, 5, 'MacBook (MC516RS/A)', 'Экран 13.3", 1280х800, LED / Intel Core 2 Duo (2.4 ГГц) / RAM 2 ГБ / HDD 250 ГБ / NVIDIA GeForce 320M / DVD Super Multi / Wi-Fi / Bluetooth / веб-камера / Mac OS X 10.6 Snow Leopard / Вес 2.13 кг', 0, 10952),
(6, 5, 'MacBook Pro (Z0M1000VX)', 'Экран 15.4" (1280x800) LED, матовый / Intel Core i7 2.3 ГГц / RAM 4 ГБ / HDD 750 ГБ / Intel HD Graphics 3000 / DVD Super Multi DL / Wi-Fi / Bluetooth / веб-камера / кардридер SD / Mac OS X 10.6.6 Snow Leopard / 2.54 кг\r\n', 0, 27912),
(7, 5, 'MacBook Air (Z0JH000TE) ', 'Экран 13.3" (1440x900) LED / Intel Core 2 Duo P7450 (2.13 ГГц) / RAM 4 ГБ / SSD 256 ГБ / NVIDIA GeForce 320M / Wi-Fi / Bluetooth / веб-камера / Mac OS X 10.6 Snow Leopard / 1.32 кг', 0, 21592);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(250) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`) VALUES
(1, 'User1', '6b908b785fdba05a6446347dae08d8c5', '0'),
(2, 'User2', 'a09bccf2b2963982b34dc0e08d8b582a', '0'),
(3, 'User3', 'e5d2ad241ec44cf155bc78ae8d11f715', '0'),
(4, 'User4', '5ad55d96abf0e50647d6de116530d6df', '0'),
(5, 'User5', '50c22602b70659dde2893f3a2ba0ab82', '0');
