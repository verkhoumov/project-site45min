-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 28 2016 г., 04:03
-- Версия сервера: 5.6.33-79.0
-- Версия PHP: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `*_45min`
--

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Автор',
  `title` varchar(100) DEFAULT NULL COMMENT 'Заголовок',
  `description` text COMMENT 'Описание',
  `link` varchar(100) DEFAULT NULL COMMENT 'Ссылка на урок',
  `image` varchar(100) DEFAULT NULL COMMENT 'Превью',
  `video` varchar(200) DEFAULT NULL COMMENT 'Видео',
  `duration` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Длительность в секундах',
  `rating` decimal(3,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Рейтинг',
  `example` varchar(200) DEFAULT NULL COMMENT 'Пример',
  `sources` varchar(200) DEFAULT NULL COMMENT 'Исходники',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата добавления',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Уроки' AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `title`, `description`, `link`, `image`, `video`, `duration`, `rating`, `example`, `sources`, `date`) VALUES
(1, 2, 'Assassin’s Creed', 'Through a revolutionary technology that unlocks his genetic memories, Callum Lynch (Michael Fassbender) experiences the adventures of his ancestor, Aguilar, in 15th Century Spain. Callum discovers he is descended from a mysterious secret society, the Assassins, and amasses incredible knowledge and skills to take on the oppressive and powerful Templar organization in the present day.\r\n\r\nASSASSIN’S CREED stars Academy Award® nominee Michael Fassbender (X-Men: Days of Future Past, 12 Years a Slave) and Academy Award winner Marion Cotillard (The Dark Knight Rises, La Vie en Rose). The film is directed by Justin Kurzel (Snowtown, Macbeth); produced by New Regency, Ubisoft Motion Pictures, DMC Films and Kennedy/Marshall; co-financed by RatPac Entertainment and Alpha Pictures; and distributed by 20th Century Fox. ASSASSIN’S CREED opens in theaters worldwide on December 21st, 2016.', 'assassins-creed', NULL, 'https://www.youtube.com/embed/mCmmzQfOzgU?rel=0', 80, 0.00, 'https://www.youtube.com/watch?v=mCmmzQfOzgU', NULL, '2016-12-10 05:24:17'),
(2, 1, 'War for the Planet of the Apes', 'In War for the Planet of the Apes, the third chapter of the critically acclaimed blockbuster franchise, Caesar and his apes are forced into a deadly conflict with an army of humans led by a ruthless Colonel. After the apes suffer unimaginable losses, Caesar wrestles with his darker instincts and begins his own mythic quest to avenge his kind. As the journey finally brings them face to face, Caesar and the Colonel are pitted against each other in an epic battle that will determine the fate of both their species and the future of the planet.', 'war-for-the-planet-of-the-apes', NULL, 'https://www.youtube.com/embed/UEP1Mk6Un98?rel=0', 130, 5.00, 'https://www.youtube.com/watch?v=UEP1Mk6Un98', NULL, '2016-12-10 05:24:17'),
(3, 3, 'GoPro Cause: Firefighter Stuck Indoors for a Year - ROMP Revival Story', 'After a devastating motorcycle accident, Luisa did not go outside for more than a year. Thanks to the Range of Motion Project, she now feels whole again and can walk and run, and has even returned to serving her community as a firefighter.', 'firefighter-stuck-indoors-for-a-year', NULL, 'https://www.youtube.com/embed/hoWsfU3phOQ?rel=0', 299, 1.00, NULL, 'https://www.youtube.com/watch?v=hoWsfU3phOQ', '2016-12-10 05:30:15'),
(4, 4, 'GoPro Snow: Corrugated Spine Lines with Ralph Backstrom', 'Located deep in the Saint Elias mountains where Alaska, British Columbia, and the Yukon converge, there is a place most skiers and snowboarders only dream of visiting. In this GoPro Perspective, we follow The North Face snowboarder Ralph Backstrom and skiers Hadley Hammer and Sam Anthamatten in their new film by Sherpas Cinema, Tsirku, as they set out to tackle the fabled corrugated spine lines of the Tsirku Glacier.', 'corrugated-spine-lines-with-ralph-backstrom', NULL, 'https://www.youtube.com/embed/vzQiLPGlfds?rel=0', 295, 4.00, 'https://www.youtube.com/watch?v=vzQiLPGlfds', 'https://www.youtube.com/watch?v=vzQiLPGlfds', '2016-12-10 05:30:15'),
(5, 5, 'GoPro: Kids Save the World - The Blockheads', 'Meet the incredible innovators from St. Louis, Missouri, Sindhu Bala, Sydney Gralike, Julianna Jones, Reagan Mattison, and Christina Yepez, of Girl Scout Troop #1484 aka "The Blockheads." With the desire to solve an environmental riddle of disposing Styrofoam cups from a local retirement community (where 20,000 cups were being used and disposed of every month), these inventors developed what they call an “Eco Bin” which helps dissolve Styrofoam when mixed with a special concoction, enabling households, landfills and businesses to reduce their waste. Eureka! The gooey sticky bi-product is a strong effective adhesive aka "GlOo". These creations have earned the young girls local, state and and national accolades earning them a trip to the White House.', 'kids-save-the-world', NULL, 'https://www.youtube.com/embed/OfZv5izbjSc?rel=0', 841, 5.00, 'https://www.youtube.com/watch?v=OfZv5izbjSc', NULL, '2016-12-10 05:33:00'),
(6, 6, 'GoPro: Wild Animal Dental Surgery with Kevin Richardson', 'You might not think of a dental procedure as dangerous, but when the operation takes place on lions, leopards and hyenas, the stakes are raised. Watch as, over the course of a week, one of the most ambitious wild animal dental operations takes place on Kevin Richardson''s sanctuary in South Africa.', 'wild-animal-dental-surgery', NULL, 'https://www.youtube.com/embed/l6acqFJuLGU?rel=0', 736, 4.00, NULL, NULL, '2016-12-10 05:33:00'),
(7, 7, 'Красавица держалась до последнего #16', 'Автор: Афоня TV.', 'krasavica-derjalas-do-poslednego-16', NULL, 'https://www.youtube.com/embed/eGzZ4M0HzgE?rel=0', 1276, 0.00, 'https://www.youtube.com/watch?v=eGzZ4M0HzgE&t=0s', NULL, '2016-12-10 05:36:16'),
(8, 8, 'Компьютер для веб-разработки и дизайна: какое железо выбрать? Мое рабочее место. Рекомендации.', 'Всем привет! Сегодня мы поговорим о том, какой должен быть компьютер для веб-разработки, какую ОС лучше использовать Windows или OS X, выберем бюджетное железо для комфортной работы над средними и большими проектами, я расскажу, какую клавиатуру и мышь выбрал я в результате долгих изысканий. Поговорим о мониторах, я расскажу о своем опыте выбора мониторов и железа для работы. Кроме того, мы рассмотрим несколько простых лайфхаков, которые ускорят работу вашей системы.', 'computer-for-a-work', NULL, 'https://www.youtube.com/embed/PqXb0dmXaBc?rel=0', 1070, 4.00, NULL, 'https://www.youtube.com/watch?v=PqXb0dmXaBc&t=139s', '2016-12-10 05:46:40'),
(9, 9, 'Кем стать - дизайнером или программистом?', 'Один из самых часто задаваемых вопросов начинающих веб-разработчиков: Кем стать - программистом или дизайнером? Перед молодыми людьми стоит нелегкий выбор, ведь решение данного вопроса повлияет на всю дальнейшую жизнь и профессиональное развитие.', 'designer-or-programmer', NULL, 'https://www.youtube.com/embed/hxuwRacrTbs?rel=0', 500, 0.00, 'https://www.youtube.com/watch?v=hxuwRacrTbs&t=327s', 'https://www.youtube.com/watch?v=hxuwRacrTbs&t=327s', '2016-12-10 05:46:40'),
(10, 10, 'Sass для самых маленьких — подробное руководство', 'Привет, друзья! Это подробное руководство по препроцессору Sass для начинающих. Здесь мы познакомимся с препроцессором Sass, его преимуществами, синтаксисом и рассмотрим возможности использования на примерах.', 'sass-for-children', NULL, 'https://www.youtube.com/embed/H4cG4tbc-xQ?rel=0', 2151, 0.00, NULL, NULL, '2016-12-10 05:49:18'),
(11, 11, 'Как правильно и быстро верстать сайты?', 'Всем привет, друзья. Сегодня мы затронем очень важную тему - быстрая и правильная HTML верстка макетов. Углубимся в проблему, разберем все возможные способы ускорения верстки без потери в качестве на всех этапах. Данный вопрос интересует очень многих веб-разработчиков, интересовал и меня, когда я уже углублялся более серьезно в веб-разработку. Теперь, я с радостью поделюсь накопленными знаниями, хитростями и фишками скоростной верстки, чтобы вы, дорогие мои друзья, смогли заработать больше денег за единицу времени.', 'html-for-web-site', NULL, 'https://www.youtube.com/embed/jr-bg5HCSr4?rel=0', 1500, 0.00, 'https://www.youtube.com/watch?v=jr-bg5HCSr4&t=783s', NULL, '2016-12-10 05:49:18'),
(12, 12, 'Посадка типовой секции Landing Page на MODx с использованием MIGX (добавляемые поля)', 'Всем привет, друзья! Сегодня мы рассмотрим посадку типовой секции Landing Page на MODx. Данный урок является одним из базовых уроков по посадке Landing Pages или страниц по типу Landing Page на MODx. В данном уроке мы создадим что-то вроде Page Builder секции для MODx. MIGX - плагин для MODx, благодаря которому можно создавать добавляемые поля в MODx Revolution.', 'landing-page-for-modx', NULL, 'https://www.youtube.com/embed/IMiUR_7wqtg?rel=0', 2400, 0.00, 'https://www.youtube.com/watch?v=IMiUR_7wqtg', 'https://www.youtube.com/watch?v=IMiUR_7wqtg', '2016-12-10 05:51:39'),
(13, 13, 'Создание шрифтового Icon Pack с использованием сервиса Fontello', 'Всем привет, друзья! Сегодня мы рассмотрим создание шрифтового Icon Pack вашего проекта с использованием сервиса Fontello.', 'icon-pack-with-fontello', NULL, 'https://www.youtube.com/embed/xE2NgrQo1fM?rel=0', 768, 0.00, 'https://www.youtube.com/watch?v=xE2NgrQo1fM', NULL, '2016-12-10 05:51:39'),
(14, 14, 'Как сделать мультилендинг на MODx', 'Привет, друзья! Сегодня мы научимся создавать мультилендинг на MODx Revolution. Мультилендинг - это эффективный инструмент для увеличения конверсии Landing Page. Смысл данного инструмента в том, что вы можете настраивать вывод контента или части контента, в зависимости от поискового запроса или URL. Сегодня мы изучим базовые возможности создания мультилендинга на простом примере, а также настроим удобную админку по управлению мультилендингом для контент-менеджера, который сможет с легкостью заполнять уникальные торговые предложения (УТП) для каждого поискового запроса.', 'modx-multi-landing-page', NULL, 'https://www.youtube.com/embed/1uxdU7eFFe0?rel=0', 752, 0.00, NULL, 'https://www.youtube.com/watch?v=1uxdU7eFFe0', '2016-12-10 06:01:04'),
(15, 15, 'Gulp для самых маленьких — подробное руководство', 'Всем привет, друзья! Сегодня мы подробно рассмотрим, что такое Gulp и как с его помощью можно автоматизировать работу Front-end разработчика. В результате урока мы соберем серьезное и внушительное рабочее Front-end окружение для веб-разработки с использованием Gulp.', 'gulp-for-a-children', NULL, 'https://www.youtube.com/embed/vW51JUVT66w?rel=0', 6170, 0.00, 'https://www.youtube.com/watch?v=vW51JUVT66w&t=2128s', 'https://www.youtube.com/watch?v=vW51JUVT66w&t=2128s', '2016-12-10 06:01:04'),
(16, 16, 'XAMPP окружение в Mac OS X: Установка, настройка виртуальных хостов, установка MODx', 'Всем привет. Сегодня мы установим Apache+MySQL+PHP окружение (XAMPP) в системе OS X (El Capitan), настроим пользовательский виртуальный хост и установим CMF MODx.', 'xampp-for-mac-os-x', NULL, 'https://www.youtube.com/embed/WO9qmfIPpKE?rel=0', 896, 0.00, NULL, NULL, '2016-12-10 06:03:43'),
(17, 17, 'Адаптивная верстка сайта юридической компании', 'Сегодня мы сверстаем полоску тизеров и основные категории сайта с картинками.', 'adaptive-html-for-site', NULL, 'https://www.youtube.com/embed/rbNUdL3KRE8?rel=0', 4493, 0.00, 'https://www.youtube.com/watch?v=rbNUdL3KRE8', 'https://www.youtube.com/watch?v=rbNUdL3KRE8', '2016-12-10 06:03:43'),
(18, 18, 'Все CSS селекторы в одном уроке', 'Привет, друзья! Сегодня мы рассмотрим все существующие CSS селекторы для более грамотной выборки HTML элементов при стилизации.', 'all-css-selectors-by-one-course', NULL, 'https://www.youtube.com/embed/WH7BNFo3A2s?rel=0', 2891, 0.00, 'https://www.youtube.com/watch?v=WH7BNFo3A2s', NULL, '2016-12-10 06:05:50'),
(19, 19, 'Стартовый шаблон для верстки сайтов _optimized_gulp_sass (запуск, решение проблем, описание)', 'Привет, друзья! Сегодня мы рассмотрим работу со стартовым шаблоном _optimized_gulp_sass. Рассмотрим решение проблем, которые могут у вас возникнуть, рассмотрим работу данного шаблона.', 'optimized-gulp-sass', NULL, 'https://www.youtube.com/embed/4e7_zaNNIlU?rel=0', 934, 0.00, 'https://www.youtube.com/watch?v=4e7_zaNNIlU&t=58s', NULL, '2016-12-10 06:05:50'),
(20, 20, 'Самый простой способ сделать 3D просмотр товара на сайте', 'Всем привет, друзья! Сегодня мы научимся делать 3D просмотр товара на сайте.', '3d-cart-on-site', NULL, 'https://www.youtube.com/embed/0toq8HsNKfA?rel=0', 942, 0.00, 'https://www.youtube.com/watch?v=0toq8HsNKfA', NULL, '2016-12-10 06:08:31'),
(21, 1, 'Как скачать сайт целиком с картинками из CSS и шрифтами', 'Всем привет. Сегодня рассмотрим как скачать сайт целиком со всеми картинками, картинками из CSS, картинками из тегов img, шрифтами, скриптами, библиотеками и всем остальным, в том виде, в котором его разрабатывали.', 'upload-web-site-with-css-and-images', NULL, 'https://www.youtube.com/embed/qe8yUPwHJEU?rel=0', 513, 3.00, 'https://www.youtube.com/watch?v=qe8yUPwHJEU', 'https://www.youtube.com/watch?v=qe8yUPwHJEU', '2016-12-10 06:08:31'),
(22, 14, 'Как получить адаптивную сетку Bootstrap нужной ширины', 'Всем привет, сегодня вы узнаете, как можно сделать сетку Bootstrap нужной ширины, отличной от стандартного значения в 1140px.', 'bootstrap-adaptive-html', NULL, 'https://www.youtube.com/embed/7j2MnoFeHJg?rel=0', 256, 0.00, NULL, NULL, '2016-12-10 06:11:14'),
(23, 7, 'Быстрое создание красивых сайтов на WordPress — Layers StyleKit на реальном примере', 'Создадим сайт на WordPress (StyleKit) с использованием WordPress Layers Framework.', 'wordpress-with-layers-stylekit', NULL, 'https://www.youtube.com/embed/A6NyYxqcfFg?rel=0', 13601, 0.00, 'https://www.youtube.com/watch?v=A6NyYxqcfFg', 'https://www.youtube.com/watch?v=A6NyYxqcfFg', '2016-12-10 06:11:14'),
(24, 2, 'Как увеличить скорость загрузки сайта (оптимизация фронтенда для Google PageSpeed)', 'Рассмотрим всестороннюю оптимизацию загрузки сайта и повышение показателей для Google PageSpeed.', 'google-pagespeed', NULL, 'https://www.youtube.com/embed/p-Sdyj9qnmY?rel=0', 1388, 0.00, 'https://www.youtube.com/watch?v=p-Sdyj9qnmY', 'https://www.youtube.com/watch?v=p-Sdyj9qnmY', '2016-12-10 06:13:25'),
(25, 1, 'Как подключить и использовать шрифтовые иконки Font Awesome', 'Научимся подключать и использовать в своей работе векторные шрифтовые иконки Font Awesome и подобные.', 'font-awesome-for-your-site', NULL, 'https://www.youtube.com/embed/m5Ub-MXKMgA?rel=0', 301, 2.00, 'https://www.youtube.com/watch?v=m5Ub-MXKMgA', 'https://www.youtube.com/watch?v=m5Ub-MXKMgA', '2016-12-10 06:13:25');

-- --------------------------------------------------------

--
-- Структура таблицы `courses_techs`
--

CREATE TABLE IF NOT EXISTS `courses_techs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `course_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Урок',
  `tech_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Технология',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Технологии в уроке' AUTO_INCREMENT=144 ;

--
-- Дамп данных таблицы `courses_techs`
--

INSERT INTO `courses_techs` (`id`, `course_id`, `tech_id`) VALUES
(1, 1, 29),
(2, 1, 21),
(3, 1, 5),
(4, 1, 46),
(5, 1, 41),
(6, 1, 33),
(7, 1, 1),
(8, 2, 3),
(9, 2, 10),
(10, 2, 20),
(11, 3, 40),
(12, 3, 39),
(13, 3, 16),
(14, 3, 25),
(15, 3, 4),
(16, 3, 3),
(17, 3, 8),
(18, 4, 27),
(19, 4, 23),
(20, 4, 24),
(21, 4, 40),
(22, 4, 19),
(23, 5, 10),
(24, 5, 45),
(25, 5, 21),
(26, 5, 24),
(27, 5, 15),
(28, 5, 12),
(29, 5, 2),
(30, 5, 6),
(31, 5, 16),
(32, 5, 38),
(33, 6, 22),
(34, 6, 26),
(35, 6, 13),
(36, 7, 1),
(37, 7, 2),
(38, 7, 9),
(39, 7, 44),
(40, 7, 43),
(41, 8, 42),
(42, 8, 41),
(43, 8, 11),
(44, 8, 31),
(45, 8, 36),
(46, 8, 15),
(47, 8, 3),
(48, 8, 20),
(49, 8, 30),
(50, 9, 40),
(51, 9, 5),
(52, 10, 14),
(53, 10, 19),
(54, 10, 28),
(55, 10, 39),
(56, 10, 43),
(57, 10, 6),
(58, 10, 21),
(59, 11, 1),
(60, 11, 3),
(61, 11, 8),
(62, 11, 12),
(63, 11, 14),
(64, 11, 32),
(65, 11, 46),
(66, 11, 20),
(67, 12, 43),
(68, 12, 18),
(69, 12, 16),
(70, 12, 25),
(71, 13, 4),
(72, 13, 3),
(73, 13, 30),
(74, 14, 39),
(75, 14, 19),
(76, 14, 17),
(77, 14, 12),
(78, 14, 4),
(79, 14, 27),
(80, 14, 35),
(81, 14, 46),
(82, 14, 45),
(83, 15, 44),
(84, 15, 43),
(85, 15, 28),
(86, 15, 1),
(87, 16, 1),
(88, 16, 31),
(89, 16, 32),
(90, 17, 26),
(91, 17, 40),
(92, 17, 37),
(93, 17, 34),
(94, 17, 7),
(95, 17, 22),
(96, 17, 15),
(97, 17, 38),
(98, 17, 44),
(99, 18, 33),
(100, 18, 11),
(101, 18, 1),
(102, 18, 2),
(103, 18, 3),
(104, 18, 5),
(105, 19, 10),
(106, 19, 19),
(107, 19, 24),
(108, 20, 37),
(109, 20, 7),
(110, 20, 34),
(111, 20, 46),
(112, 20, 45),
(113, 20, 23),
(114, 20, 35),
(115, 20, 18),
(116, 21, 16),
(117, 21, 4),
(118, 22, 7),
(119, 22, 5),
(120, 22, 39),
(121, 22, 20),
(122, 22, 13),
(123, 22, 3),
(124, 23, 40),
(125, 23, 8),
(126, 23, 9),
(127, 23, 12),
(128, 23, 25),
(129, 24, 29),
(130, 24, 45),
(131, 24, 31),
(132, 24, 36),
(133, 24, 38),
(134, 25, 44),
(135, 25, 14),
(136, 25, 24),
(137, 25, 34),
(138, 25, 4),
(139, 25, 6),
(140, 25, 26),
(141, 25, 36),
(142, 25, 16),
(143, 2, 47);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) DEFAULT NULL COMMENT 'Имя Фамилия',
  `from` varchar(50) DEFAULT NULL COMMENT 'От кого',
  `to` varchar(50) DEFAULT NULL COMMENT 'Кому',
  `theme` varchar(100) DEFAULT NULL COMMENT 'Тема',
  `message` varchar(200) DEFAULT NULL COMMENT 'Сообщение',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата отправления',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Сообщения через форму обратной связи' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `techs`
--

CREATE TABLE IF NOT EXISTS `techs` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` varchar(20) DEFAULT NULL COMMENT 'Код',
  `name` varchar(20) DEFAULT NULL COMMENT 'Название',
  `link` varchar(100) DEFAULT NULL COMMENT 'Личный сайт',
  `description` text COMMENT 'Описание',
  `image` varchar(100) DEFAULT NULL COMMENT 'Изображение',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата добавления',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Технологии' AUTO_INCREMENT=48 ;

--
-- Дамп данных таблицы `techs`
--

INSERT INTO `techs` (`id`, `code`, `name`, `link`, `description`, `image`, `date`) VALUES
(1, 'css3', 'CSS3', 'https://ru.wikipedia.org/wiki/CSS', 'CSS — формальный язык описания внешнего вида документа, написанного с использованием языка разметки.', 'css3.png', '2016-12-04 14:46:58'),
(2, 'html5', 'HTML5', 'https://www.w3.org/TR/html5/', 'Язык для структурирования и представления содержимого всемирной паутины. Это пятая версия HTML. Хотя стандарт был завершён только в 2014 году, ещё с 2013 года браузерами оперативно осуществлялась поддержка, а разработчиками - использование рабочего стандарта. Цель разработки HTML5 - улучшение уровня поддержки мультимедиа-технологий с одновременным сохранением обратной совместимости, удобочитаемости кода для человека и простоты анализа для парсеров.', 'html5.png', '2016-12-04 14:46:58'),
(3, 'javascript', 'JavaScript', NULL, 'Прототипно-ориентированный сценарный язык программирования. Является реализацией языка ECMAScript. JavaScript обычно используется как встраиваемый язык для программного доступа к объектам приложений.', 'js.png', '2016-12-04 14:49:34'),
(4, 'php5', 'PHP5', 'http://php.net/', 'Скриптовый язык общего назначения, интенсивно применяемый для разработки веб-приложений. В настоящее время поддерживается подавляющим большинством хостинг-провайдеров и является одним из лидеров среди языков, применяющихся для создания динамических веб-сайтов.', 'php.png', '2016-12-04 14:49:34'),
(5, 'php7', 'PHP7', 'http://php.net/', 'Скриптовый язык общего назначения, интенсивно применяемый для разработки веб-приложений. В настоящее время поддерживается подавляющим большинством хостинг-провайдеров и является одним из лидеров среди языков, применяющихся для создания динамических веб-сайтов.', 'php.png', '2016-12-04 14:49:44'),
(6, 'mysql', 'MySQL', 'http://www.mysql.com/', 'Свободная реляционная система управления базами данных. Разработку и поддержку MySQL осуществляет корпорация Oracle, получившая права на торговую марку вместе с поглощённой Sun Microsystems, которая ранее приобрела шведскую компанию MySQL AB. Продукт распространяется как под GNU General Public License, так и под собственной коммерческой лицензией. Помимо этого, разработчики создают функциональность по заказу лицензионных пользователей. Именно благодаря такому заказу почти в самых ранних версиях появился механизм репликации.', 'mysql.png', '2016-12-04 14:50:48'),
(7, 'mongodb', 'MongoDB', 'http://www.mongodb.com/', 'Документоориентированная система управления базами данных с открытым исходным кодом, не требующая описания схемы таблиц. Написана на языке C++.', 'mongodb.png', '2016-12-04 14:50:48'),
(8, 'postgresql', 'PostgreSQL', 'https://www.postgresql.org/', 'Свободная объектно-реляционная система управления базами данных. Существует в реализациях для множества UNIX-подобных платформ, включая AIX, различные BSD-системы, HP-UX, IRIX, Linux, Mac OS X, Solaris/OpenSolaris, Tru64, QNX, а также для Microsoft Windows.', 'postgresql.png', '2016-12-04 14:51:25'),
(9, 'sqlite', 'SQLite', 'https://sqlite.org/', 'Компактная встраиваемая реляционная база данных. Исходный код библиотеки передан в общественное достояние. В 2005 году проект получил награду Google-O’Reilly Open Source Awards.', 'sqlite.png', '2016-12-04 14:53:10'),
(10, 'oracledb', 'Oracle RDBMS', 'https://www.oracle.com/database/index.html', 'Объектно-реляционная система управления базами данных компании Oracle.', 'oracledb.png', '2016-12-04 14:53:10'),
(11, 'github', 'GitHub', 'https://github.com/', 'GitHub — крупнейший веб-сервис для хостинга IT-проектов и их совместной разработки. Основан на системе контроля версий Git и разработан на Ruby on Rails и Erlang компанией GitHub, Inc (ранее Logical Awesome).', 'github.png', '2016-12-04 14:54:05'),
(12, 'bitbucket', 'Bitbucket', 'https://bitbucket.org/', 'Bitbucket — веб-сервис для хостинга проектов и их совместной разработки, основанный на системе контроля версий Mercurial и Git. По назначению и предлагаемым функциям аналогичен GitHub (однако GitHub не предоставляет бесплатные приватные репозитории, в отличие от Bitbucket), который поддерживает Git и Subversion.', 'bitbucket.png', '2016-12-04 14:54:05'),
(13, 'angularjs', 'AngularJS', 'https://angularjs.org/', 'JavaScript-фреймворк с открытым исходным кодом. Предназначен для разработки одностраничных приложений. Его цель - расширение браузерных приложений на основе MVC-шаблона, а также упрощение тестирования и разработки.', 'angularjs.png', '2016-12-04 14:55:49'),
(14, 'jquery', 'jQuery', 'https://jquery.com/', 'Библиотека JavaScript, фокусирующаяся на взаимодействии JavaScript и HTML. Библиотека jQuery помогает легко получать доступ к любому элементу DOM, обращаться к атрибутам и содержимому элементов DOM, манипулировать ими. Также библиотека jQuery предоставляет удобный API для работы с AJAX. Сейчас разработка jQuery ведётся командой jQuery во главе с Джоном Резигом.', 'jquery.png', '2016-12-04 14:55:49'),
(15, 'nodejs', 'Node.js', 'https://nodejs.org/', 'Node или Node.js — программная платформа, основанная на движке V8 (транслирующем JavaScript в машинный код), превращающая JavaScript из узкоспециализированного языка в язык общего назначения. Node.js добавляет возможность JavaScript взаимодействовать с устройствами ввода-вывода через свой API (написанный на C++), подключать другие внешние библиотеки, написанные на разных языках, обеспечивая вызовы к ним из JavaScript-кода. Node.js применяется преимущественно на сервере, выполняя роль веб-сервера, но есть возможность разрабатывать на Node.js и десктопные оконные приложения (при помощи NW.js, AppJS или Electron для Linux, Windows и Mac OS) и даже программировать микроконтроллеры (например, tessel и espruino). В основе Node.js лежит событийно-ориентированное и асинхронное (или реактивное) программирование с неблокирующим вводом/выводом.', 'nodejs.png', '2016-12-04 14:57:08'),
(16, 'gulp', 'Gulp', 'http://gulpjs.com/', 'Gulp – инструментарий, облегчающий жизнь веб-разработчика, с его помощью можно задавать различные задачи. Часто используется для таких front-end задач как: поднятие сервера, автоматическое обновление страницы браузера в любой момент сохранения файла, использование препроцессоров как Sass или LESS, оптимизация CSS, JavaScript и изображений.', 'gulp.png', '2016-12-04 14:57:08'),
(17, 'python', 'Python', 'https://www.python.org/', 'Высокоуровневый язык программирования общего назначения, ориентированный на повышение производительности разработчика и читаемости кода. Синтаксис ядра Python минималистичен. В то же время стандартная библиотека включает большой объём полезных функций.', 'python.png', '2016-12-04 14:58:07'),
(18, 'ruby', 'Ruby', 'https://www.ruby-lang.org/ru/', 'Динамический, рефлективный, интерпретируемый высокоуровневый язык программирования. Язык обладает независимой от операционной системы реализацией многопоточности, строгой динамической типизацией, сборщиком мусора и многими другими возможностями. По особенностям синтаксиса он близок к языкам Perl и Eiffel, по объектно-ориентированному подходу - к Smalltalk. Также некоторые черты языка взяты из Python, Lisp, Dylan и Клу.', 'ruby.png', '2016-12-04 14:58:07'),
(19, 'django', 'Django', 'https://www.djangoproject.com/', 'Свободный программный каркас для веб-приложений на языке Python, использующий шаблон проектирования MVC. Проект поддерживается организацией Django Software Foundation.', 'django.png', '2016-12-04 14:59:08'),
(20, 'rubyonrails', 'Ruby on Rails', 'http://rubyonrails.org/', 'Фреймворк, написанный на языке программирования Ruby, реализует архитектурный шаблон Model-View-Controller для веб-приложений, а также обеспечивает их интеграцию с веб-сервером и сервером баз данных. Является открытым программным обеспечением и распространяется под лицензией MIT.', 'rubyonrails.png', '2016-12-04 14:59:08'),
(21, 'yii1', 'Yii 1', 'http://www.yiiframework.com/', 'Объектно-ориентированный компонентный фреймворк, написанный на PHP и реализующий парадигму MVC.', 'yii.png', '2016-12-04 15:00:04'),
(22, 'yii2', 'Yii 2', 'http://www.yiiframework.com/', 'Объектно-ориентированный компонентный фреймворк, написанный на PHP и реализующий парадигму MVC.', 'yii.png', '2016-12-04 15:00:04'),
(23, 'bootstrap', 'Bootstrap', 'http://getbootstrap.com/', 'Свободный набор инструментов для создания сайтов и веб-приложений. Включает в себя HTML- и CSS-шаблоны оформления для типографики, веб-форм, кнопок, меток, блоков навигации и прочих компонентов веб-интерфейса, включая JavaScript-расширения.', 'bootstrap.png', '2016-12-04 15:01:52'),
(24, 'symfony', 'Symfony', 'https://symfony.com/', 'Свободный фреймворк, написанный на PHP, который использует паттерн Model-View-Controller. Symfony предлагает быструю разработку и управление веб-приложениями, позволяет легко решать рутинные задачи веб-программиста.', 'symfony.png', '2016-12-04 15:01:52'),
(25, 'kohana', 'Kohana', 'http://kohanaframework.org/', 'Kohana — PHP5 веб-фреймворк с открытым кодом, который использует архитектурную модель HMVC (Hierarchical Model View Controller — Иерархические Модель-Контроллер-Вид). Его цели — быть безопасным, лёгким и простым в использовании.', 'kohana.png', '2016-12-04 15:02:56'),
(26, 'codeigniter3', 'CodeIgniter 3', 'http://www.codeigniter.com/', 'Популярный MVC фреймворк с открытым исходным кодом, написанный на языке программирования PHP, для разработки полноценных веб-систем и приложений. Разработан компанией EllisLab, а также Риком Эллисом и Полом Бурдиком.', 'codeigniter.png', '2016-12-04 15:02:56'),
(27, 'flask', 'Flask', 'http://flask.pocoo.org/', 'Flask — микрофреймворк для создания веб-приложений на языке программирования Python, использующий набор инструментов Werkzeug, а также шаблонизатор Jinja2.', 'flask.png', '2016-12-04 15:03:45'),
(28, 'modx', 'MODx', 'https://modx.com/', 'Система управления содержимым с открытым исходным кодом и открытой лицензией. Написана на языке программирования PHP, использует для хранения данных СУБД MySQL или MS SQL.', 'modx.png', '2016-12-04 15:03:45'),
(29, 'drupal', 'Drupal', 'https://www.drupal.org/', 'Система управления содержимым, используемая также как каркас для веб-приложений, написанная на языке PHP и использующая в качестве хранилища данных реляционную базу данных. Drupal является свободным программным обеспечением, защищённым лицензией GPL, и развивается усилиями энтузиастов со всего мира.', 'drupal.png', '2016-12-04 15:04:39'),
(30, 'joomla', 'Joomla', 'https://www.joomla.org/', 'Система управления содержимым, написанная на языках PHP и JavaScript, использующая в качестве хранилища базы данных СУБД MySQL или другие стандартные промышленные реляционные СУБД. Является свободным программным обеспечением, распространяемым под лицензией GNU GPL.', 'joomla.png', '2016-12-04 15:04:39'),
(31, 'wordpress', 'WordPress', 'https://wordpress.org/', 'Система управления содержимым сайта с открытым исходным кодом; написана на PHP; сервер базы данных - MySQL; выпущена под лицензией GNU GPL версии 2. Сфера применения - от блогов до достаточно сложных новостных ресурсов и интернет-магазинов. Встроенная система «тем» и «плагинов» вместе с удачной архитектурой позволяет конструировать проекты широкой функциональной сложности.', 'wordpress.png', '2016-12-04 15:05:34'),
(32, 'backbonejs', 'Backbone.js', 'http://backbonejs.org/', 'Backbone — JavaScript-библиотека, основанная на шаблоне проектирования Model-View-Presenter (MVP), предназначена для разработки веб-приложений с поддержкой RESTful JSON интерфейса. Backbone — очень лёгкая библиотека (упакованная и gzip-сжатая по величине ~6.3 Кб), но для работы необходима библиотека Underscore.js, а для поддержки REST API и работы с DOM элементами рекомендуется подключить jQuery-подобную библиотеку: jQuery или Zepto. Backbone.js создан Джереми Ашкенасом, который известен также как создатель CoffeeScript.', 'backbonejs.png', '2016-12-04 15:05:34'),
(33, 'laravel', 'Laravel', 'https://laravel.com/', 'Бесплатный веб-фреймворк с открытым кодом, предназначенный для разработки с использованием архитектурной модели MVC. Laravel выпущен под лицензией MIT. Исходный код проекта размещается на GitHub.', 'lavarel.png', '2016-12-04 15:06:25'),
(34, 'zendframework', 'Zend Framework', 'https://framework.zend.com/', 'Свободный программный каркас на PHP для разработки веб-приложений, разрабатываемый компанией Zend. Основывается на принципах MVC.', 'zend.png', '2016-12-04 15:06:25'),
(35, 'underscorejs', 'Underscore.js', 'http://underscorejs.org/', 'Библиотека JavaScript, реализующая дополнительную функциональность для работы с массивами, объектами и функциями, изначально отсутствующую в javascript, но имеющую аналоги в других языках. Библиотека умеет делегировать вызовы, если какая-то функциональность реализована разработчиками браузеров.', 'underscorejs.png', '2016-12-04 15:09:28'),
(36, 'coffeescript', 'CoffeeScript', 'http://coffeescript.org/', 'Язык программирования, транслируемый в JavaScript. CoffeeScript добавляет синтаксический сахар в духе Ruby, Python, Haskell и Erlang для того, чтобы улучшить читаемость кода и уменьшить его размер. CoffeeScript позволяет писать более компактный код по сравнению с JavaScript. JavaScript-код, получаемый трансляцией из CoffeeScript, полностью проходит проверку JavaScript Lint.', 'coffeescript.png', '2016-12-04 15:09:28'),
(37, 'extjs', 'Ext JS', 'https://www.sencha.com/products/extjs/', 'Библиотека JavaScript для разработки веб-приложений и пользовательских интерфейсов, изначально задуманная как расширенная версия Yahoo! UI Library, однако преобразовавшаяся затем в отдельный фреймворк. До версии 4.0 использовала адаптеры для доступа к библиотекам Yahoo! UI Library, jQuery или Prototype/script.aculo.us, начиная с 4-й версии адаптеры отсутствуют. Поддерживает технологию AJAX, анимацию, работу с DOM, реализацию таблиц, вкладок, обработку событий и все остальные новшества Web 2.0.', 'extjs.png', '2016-12-04 15:10:30'),
(38, 'emberjs', 'Ember.js', 'http://emberjs.com/', 'Свободный JavaScript каркас веб-приложений, реализующий MVC шаблон, предназначенный для упрощения создания масштабируемых одностраничных веб-приложений. Фреймворк используется такими компаниями как TED, Yahoo!, Twitch.tv и Groupon.', 'ember.png', '2016-12-04 15:10:30'),
(39, 'reactjs', 'React', 'https://facebook.github.io/react/', 'Open-source JavaScript library for data rendered as HTML. It is maintained by Facebook, Instagram and a community of individual developers and corporations.', 'react.png', '2016-12-04 15:11:37'),
(40, 'socketio', 'Socket.IO', 'http://socket.io/', 'avaScript-библиотека для веб-приложений и обмена данными в реальном времени. Состоит из двух частей: клиентской, которая запускается в браузере и серверной для node.js. Оба компонента имеют похожее API. Подобно node.js, Socket.IO событийно-ориентированная.', 'socketio.png', '2016-12-04 15:11:37'),
(41, 'bower', 'Bower', 'https://bower.io/', NULL, 'bower.png', '2016-12-10 02:59:19'),
(42, 'npm', 'NPM', 'https://www.npmjs.com/', 'Менеджер пакетов, входящий в состав Node.js.', 'npm.png', '2016-12-10 02:59:19'),
(43, 'java', 'Java', 'https://www.java.com/ru/', 'Строго типизированный объектно-ориентированный язык программирования, разработанный компанией Sun Microsystems. Приложения Java обычно транслируются в специальный байт-код, поэтому они могут работать на любой компьютерной архитектуре, с помощью виртуальной Java-машины.', 'java.png', '2016-12-10 03:00:08'),
(44, 'perl', 'Perl', 'https://www.perl.org/', 'Высокоуровневый интерпретируемый динамический язык программирования общего назначения, созданный Ларри Уоллом, лингвистом по образованию. Название языка представляет собой аббревиатуру, которая расшифровывается как Practical Extraction and Report Language - «практический язык для извлечения данных и составления отчётов». Первоначально аббревиатура состояла из пяти символов и в таком виде в точности совпадала с английским словом pearl. Но затем стало известно, что такой язык существует, и букву «a» убрали. Символом языка Perl является верблюд - не слишком красивое, но очень выносливое животное, способное выполнять тяжёлую работу.', 'perl.png', '2016-12-10 03:00:08'),
(45, 'dle', 'DataLife Engine', 'http://dle-news.ru/', 'Коммерческая система управления контентом, разработанная российской компанией «Софтньюс Медиа Групп». Система написана на языке PHP и использует MySQL в качестве базы данных. Разработка была начата в 2004 году, за основу была взята система CutePHP. Продукт позиционируется его разработчиками как средство для организации собственных средств массовой информации и блогов. Основной язык системы - русский, так же существуют английская и украинская локализации.', 'dle.png', '2016-12-10 03:01:21'),
(46, 'rust', 'Rust', 'https://www.rust-lang.org/ru-RU/', 'Rust — мультипарадигмальный компилируемый язык программирования общего назначения, спонсируемый Mozilla Research, поддерживающий функциональное программирование, модель акторов и процедурное программирование. Объектно-ориентированное программирование как таковое языком не поддерживается, но язык позволяет реализовать большинство понятий ООП при помощи других абстракций, например, типажей.', 'rust.png', '2016-12-10 03:01:21'),
(47, 'mustachejs', 'Mustache.js', 'https://github.com/janl/mustache.js', 'Мультиязычный шаблонизатор. Работает на Ruby, JavaScript, Python, Erlang, node.js, PHP, Perl, Perl6, Objective-C, Java, C#/.NET, Android, C++, CFEngine, Go, Lua, ooc, ActionScript, ColdFusion, Scala, Clojure[Script], Fantom, CoffeeScript, D, Haskell, XQuery, ASP, Io, Dart, Haxe, Delphi, Racket, Rust, OCaml, Swift, Bash, Julia, R, Crystal, Common Lisp, Nim, Smalltalk, и на Tcl.', NULL, '2016-12-10 18:46:37');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(50) DEFAULT NULL COMMENT 'Имя Фамилия',
  `city` varchar(30) DEFAULT NULL COMMENT 'Город',
  `about` text COMMENT 'Обо мне',
  `avatar` varchar(200) DEFAULT NULL COMMENT 'Ссылка на аватар',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата регистрации',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Пользователи' AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `city`, `about`, `avatar`, `date`) VALUES
(1, 'Дмитрий Верхоумов', 'Санкт-Петербург', 'FullStack Web Developer.', 'https://pp.vk.me/c638816/v638816896/d000/aScCUSK8A3c.jpg', '2016-12-04 15:19:58'),
(2, 'Анна Чернышова', 'Санкт-Петербург', 'Учусь в медицинском, люблю кодить. Опыт разработки веб-сервисов на Node.js 5 лет.', 'https://pp.vk.me/c638316/v638316178/10081/FXcidEZQvn4.jpg', '2016-12-09 21:29:51'),
(3, 'Эдуард Николаев', 'Москва', '"Господи, помоги мне стать таким, каким меня видит моя собака!" — Janusz Leon Wiśniewski.', 'https://pp.vk.me/c628420/v628420404/e2c6/pPlCk_xpgt4.jpg', '2016-12-09 21:29:51'),
(4, 'Роман Доколин', 'Москва', 'Если и есть что-то в нашей стране уебищнее города Пензы, то это, определенно, Самара. В этом прекрасном месте Расее великолепно отражается духовность и стабильность по многим параметрам, к примеру, торжественным открытием тротуара среди трущоб.', 'https://pp.vk.me/c636218/v636218248/3bd64/DSkN76NC3Y8.jpg', '2016-12-09 21:35:15'),
(5, 'Yarik Markov', 'Санкт-Петербург', 'Человек только воображает, что беспредельно властвует над вещами. Иногда самая невзрачная вещица вотрётся в жизнь, закрутит ее и перевернет всю судьбу не в ту сторону, куда бы ей надлежало идти.', 'https://pp.vk.me/c411117/v411117480/8c10/OeTUJOtP77w.jpg', '2016-12-09 21:35:15'),
(6, 'Руслан Барашкин', 'Казахстан', 'Сегодня готов порадовать совместной работой с рэпером Slimz. Атмосферный трек, с хорошей смысловой нагрузкой. О чувствах, не молчат.', 'https://pp.vk.me/c636017/v636017243/1fc5a/THdvV-5dg04.jpg', '2016-12-09 21:40:55'),
(7, 'Санёк Бондаренко', 'Санкт-Петербург', NULL, 'https://pp.vk.me/c628217/v628217695/61e8/RQfqCqF2U7M.jpg', '2016-12-09 21:40:55'),
(8, 'Андрей Кузарев', 'Череповец', 'Окончил СПбГИЭУ (ИНЖЭКОН) (ЧФ) ''16.', 'https://pp.vk.me/c637321/v637321421/8e48/FZ92Rg1C3QA.jpg', '2016-12-09 21:43:40'),
(9, 'Денис Мирный', 'Калининград', NULL, 'https://pp.vk.me/c626316/v626316199/48017/1RgN9eFT7YA.jpg', '2016-12-09 21:43:40'),
(10, 'Дарья Дудина', 'Санкт-Петербург', 'Не накрашенные, уставшие, хотим спать, и это все после бассейна.', 'https://pp.vk.me/c9988/u00952/a_b5887182.jpg', '2016-12-09 21:46:17'),
(11, 'Alisha Kozubenko', 'Ейск', 'Ты можешь быть бесконечно прав, но какой в этом толк, если твоя девушка медик и она может убить тебя так, что никто не догадается?', 'https://pp.vk.me/c637329/v637329409/1c91f/53GqZuTwvlY.jpg', '2016-12-09 21:46:17'),
(12, 'Сергей Маслов', 'Москва', 'У нас есть для вас шпаргалка, имеющая все основные правила английского в удобной и простой форме. Запомните её — и можете считать, что знаете английский. Останется только расширить словарный запас.', 'https://pp.vk.me/c10578/u01000/a_2de0bcce.jpg', '2016-12-09 21:51:24'),
(13, 'Мария Баранова', 'Санкт-Петербург', NULL, 'https://pp.vk.me/c623417/v623417032/16d33/TuNXOB3EBw4.jpg', '2016-12-09 21:51:24'),
(14, 'Андрей Трусов', 'Гомель', 'Что мне в жизни никогда не надоест, так это печь яблочные пироги.', 'https://pp.vk.me/c418627/v418627632/8929/IegNhQiP2mY.jpg', '2016-12-09 21:53:33'),
(15, 'Максим Сибиряков', 'Санкт-Петербург', NULL, 'https://pp.vk.me/c636623/v636623699/36494/Fhgq2SiKGcE.jpg', '2016-12-09 21:53:33'),
(16, 'Глеб Буров', 'Санкт-Петербург', NULL, 'https://pp.vk.me/c619917/v619917843/144ef/aMqmRm8jwOQ.jpg', '2016-12-09 21:55:09'),
(17, 'Женя Аксютин', 'Гомель', '"Бывают дороги, по которым не идут; бывают армии, на которые не нападают; бывают крепости, за которые не борются; бывают местности, из-за которых не сражаются; бывают повеления государя, которые не выполняют" — Сунь Цзы.', 'https://pp.vk.me/c630323/v630323867/3fb0e/3qKiORko7BY.jpg', '2016-12-09 21:55:09'),
(18, 'Анастасия Зарецкая', 'Пятигорск', 'Если принять усилия за единицу и возвести в степень 365 – количество дней одного года, то результат получается именно таким. Делайте чуть-чуть меньше, чем можете – и результат практически нулевой. Делайте немного больше, чем делаете обычно – и результат увеличивается многократно. С математикой не поспоришь. С жизнью тоже.', 'https://pp.vk.me/c408829/v408829212/4ad9/8dAdKEzvTIU.jpg', '2016-12-09 21:57:00'),
(19, 'Антон Долгунов', 'Санкт-Петербург', 'В связи с появлением новых проектов, приглашаем на позицию Java-разработчика!', 'https://pp.vk.me/c624322/v624322554/6eb8/DVtOsC-wBj8.jpg', '2016-12-09 21:57:00'),
(20, 'Любовь Смирнова', 'Санкт-Петербург', 'Петербургский коллектив Shortparis замешал музыкальный андеграунд с поп-культурой, выступив на показе бренда Saint-Tokyo в рамках Mercedez-Benz Fashion Week Russia.', 'https://pp.vk.me/c638922/v638922586/9d1c/DquL6CcC8NM.jpg', '2016-12-09 21:57:57');

-- --------------------------------------------------------

--
-- Структура таблицы `users_contacts`
--

CREATE TABLE IF NOT EXISTS `users_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Пользователь',
  `link` varchar(100) DEFAULT NULL COMMENT 'Информация',
  `name` varchar(50) DEFAULT NULL COMMENT 'Имя ссылки',
  `type` enum('link','email','skype','personal') NOT NULL DEFAULT 'link' COMMENT 'Тип',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Контактные данные пользователей' AUTO_INCREMENT=55 ;

--
-- Дамп данных таблицы `users_contacts`
--

INSERT INTO `users_contacts` (`id`, `user_id`, `link`, `name`, `type`) VALUES
(1, 1, 'verkhoumov', NULL, 'skype'),
(2, 1, 'verkhoumov@yandex.ru', NULL, 'email'),
(3, 1, 'https://vk.com/verkhoumov', 'verkhoumov', 'link'),
(4, 1, 'https://github.com/verkhoumov', 'verkhoumov', 'link'),
(5, 1, 'http://itmo.dverkh.com/', 'Портфолио', 'personal'),
(6, 2, 'https://vk.com/chernyshovaaaaaa', NULL, 'link'),
(7, 2, 'https://www.instagram.com/chernyshovaa/', NULL, 'link'),
(8, 2, 'a.chernyshova@yandex.ru', NULL, 'email'),
(9, 3, 'https://vk.com/dima_ar', NULL, 'link'),
(10, 3, 'https://github.com/dimkaar', NULL, 'link'),
(11, 4, 'dokole@mail.ru', NULL, 'email'),
(12, 3, 'dimkar', NULL, 'skype'),
(13, 5, 'https://c9.io/davydova_anastasiia', NULL, 'link'),
(14, 5, 'justcause@list.ru', NULL, 'email'),
(15, 3, 'dimkaar1102@gmail.com', NULL, 'email'),
(16, 5, 'https://vk.com/nastushka5', NULL, 'link'),
(17, 6, 'https://vk.com/ruslan8b', NULL, 'link'),
(18, 6, 'ruslan8b@mail.ru', NULL, 'email'),
(19, 6, 'http://haphol.ru/', 'Организация праздников', 'personal'),
(20, 7, 'bondarenko@gmail.com', NULL, 'email'),
(21, 7, 'https://vk.com/id218172695', NULL, 'link'),
(22, 8, 'https://twitter.com/csgomama', NULL, 'link'),
(23, 8, 'http://csgomama.ru/', 'CSGOMama.ru', 'personal'),
(24, 8, 'https://vk.com/id173883421', NULL, 'link'),
(25, 8, 'kuzareff35', NULL, 'skype'),
(26, 2, 'achernyshova2307', NULL, 'skype'),
(27, 10, 'https://vk.com/id19331365', NULL, 'link'),
(28, 11, 'https://vk.com/alishakozubenko', NULL, 'link'),
(29, 11, 'kozuberman@mail.ru', NULL, 'email'),
(30, 12, 'https://vk.com/id1154974', NULL, 'link'),
(31, 13, 'jessy@yandex.ru', NULL, 'email'),
(32, 13, 'https://vk.com/billikota', NULL, 'link'),
(33, 13, 'http://mysite.com/', NULL, 'personal'),
(34, 14, 'tsalko2000', NULL, 'skype'),
(35, 14, 'https://vk.com/tsobako', NULL, 'link'),
(36, 14, 'http://ask.fm/tsobako', NULL, 'link'),
(37, 15, 'https://vk.com/very_strange_situation', NULL, 'link'),
(38, 15, ' dn_egor_94', NULL, 'skype'),
(39, 15, 'babybornr@yandex.ru', NULL, 'email'),
(40, 15, 'http://deryabin.com/', NULL, 'personal'),
(41, 16, 'https://vk.com/gosuinside', NULL, 'link'),
(42, 17, 'https://vk.com/id174497869', NULL, 'link'),
(43, 17, ' http://sprashivai.ru/pcnjkz', NULL, 'link'),
(44, 17, 'oklahomacity@yandex.ru', NULL, 'email'),
(45, 18, 'https://vk.com/psevdo_neferet', NULL, 'link'),
(46, 18, 'Psevdo_Neferet', NULL, 'skype'),
(47, 18, 'http://twitter.com/Psevdo_Neferet', NULL, 'link'),
(48, 18, 'https://www.facebook.com/nataly.katrysheva', NULL, 'link'),
(49, 18, 'http://kiber-shkola.ru/', 'Кибершкола "ЩИТ"', 'personal'),
(50, 20, 'https://www.instagram.com/cuttlefox/', NULL, 'link'),
(51, 20, 'heyguys@yandex.ru', NULL, 'email'),
(52, 18, 'magic@gmail.com', NULL, 'email'),
(53, 19, 'mydefaultemail@gmail.com', NULL, 'email'),
(54, 19, 'https://github.com/irinkaS', NULL, 'link');

-- --------------------------------------------------------

--
-- Структура таблицы `users_techs`
--

CREATE TABLE IF NOT EXISTS `users_techs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Пользователь',
  `tech_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Навык',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Навыки пользователей' AUTO_INCREMENT=142 ;

--
-- Дамп данных таблицы `users_techs`
--

INSERT INTO `users_techs` (`id`, `user_id`, `tech_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 14),
(9, 1, 15),
(10, 1, 16),
(11, 1, 23),
(12, 1, 26),
(13, 1, 40),
(14, 1, 41),
(15, 1, 42),
(16, 2, 7),
(17, 2, 21),
(18, 2, 33),
(19, 2, 34),
(20, 2, 24),
(21, 2, 9),
(22, 2, 39),
(23, 2, 40),
(24, 2, 5),
(25, 2, 12),
(26, 3, 27),
(27, 3, 3),
(28, 3, 36),
(29, 3, 21),
(30, 3, 33),
(31, 4, 34),
(32, 4, 39),
(33, 4, 32),
(34, 4, 42),
(35, 4, 22),
(36, 4, 12),
(37, 4, 3),
(38, 4, 19),
(39, 4, 15),
(40, 5, 23),
(41, 5, 37),
(42, 5, 26),
(43, 5, 42),
(44, 5, 41),
(45, 6, 1),
(46, 6, 2),
(47, 6, 32),
(48, 6, 8),
(49, 6, 11),
(50, 6, 16),
(51, 6, 24),
(52, 6, 33),
(53, 6, 36),
(54, 6, 41),
(55, 6, 6),
(56, 7, 45),
(57, 7, 37),
(58, 7, 35),
(59, 7, 28),
(60, 7, 29),
(61, 7, 4),
(62, 8, 43),
(63, 8, 2),
(64, 8, 3),
(65, 9, 7),
(66, 9, 10),
(67, 9, 15),
(68, 9, 29),
(69, 9, 30),
(70, 9, 20),
(71, 9, 41),
(72, 9, 43),
(73, 9, 38),
(74, 10, 39),
(75, 10, 37),
(76, 10, 35),
(77, 10, 22),
(78, 10, 20),
(79, 10, 7),
(80, 10, 4),
(81, 10, 32),
(82, 10, 17),
(83, 10, 16),
(84, 10, 19),
(85, 10, 42),
(86, 10, 40),
(87, 11, 46),
(88, 11, 44),
(89, 11, 11),
(90, 11, 1),
(91, 11, 5),
(92, 11, 23),
(93, 11, 39),
(94, 12, 43),
(95, 12, 45),
(96, 13, 13),
(97, 13, 9),
(98, 13, 19),
(99, 14, 14),
(100, 14, 5),
(101, 14, 18),
(102, 14, 46),
(103, 14, 31),
(104, 14, 39),
(105, 14, 27),
(106, 14, 25),
(107, 15, 38),
(108, 15, 29),
(109, 15, 5),
(110, 15, 1),
(111, 15, 2),
(112, 16, 6),
(113, 16, 7),
(114, 16, 10),
(115, 16, 1),
(116, 16, 17),
(117, 16, 16),
(118, 16, 13),
(119, 16, 44),
(120, 16, 37),
(121, 16, 33),
(122, 16, 28),
(123, 17, 2),
(124, 17, 4),
(125, 17, 9),
(126, 17, 16),
(127, 17, 31),
(128, 17, 34),
(129, 17, 39),
(130, 17, 46),
(131, 18, 2),
(132, 18, 3),
(133, 18, 8),
(134, 19, 40),
(135, 20, 30),
(136, 20, 20),
(137, 20, 28),
(138, 20, 18),
(139, 20, 13),
(140, 20, 4),
(141, 20, 33);

-- --------------------------------------------------------

--
-- Структура таблицы `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `course_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Урок',
  `value` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Оценка',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата голосования',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Оценки уроков' AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `votes`
--

INSERT INTO `votes` (`id`, `course_id`, `value`, `date`) VALUES
(1, 2, 5, '2016-12-10 05:42:19'),
(2, 21, 3, '2016-12-11 00:54:40'),
(3, 25, 2, '2016-12-11 00:54:48'),
(4, 8, 4, '2016-12-12 19:52:03'),
(5, 6, 4, '2016-12-23 09:39:56'),
(6, 3, 1, '2016-12-25 14:24:24'),
(7, 5, 5, '2016-12-27 02:34:35'),
(8, 4, 4, '2016-12-27 02:42:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
