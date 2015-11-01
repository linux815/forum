-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 20 2015 г., 21:13
-- Версия сервера: 5.6.25-0ubuntu0.15.04.1
-- Версия PHP: 5.6.4-4ubuntu6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `forum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id_categ` bigint(20) NOT NULL,
  `id_news_media` bigint(20) NOT NULL DEFAULT '0',
  `name_caterory` varchar(255) NOT NULL,
  `id_user` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_categ`, `id_news_media`, `name_caterory`, `id_user`) VALUES
(1, 0, 'Игры', 1),
(2, 0, 'Политика', 1),
(3, 0, 'Развлекательный канал', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
`id_forums` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_forum_id` bigint(20) NOT NULL DEFAULT '0',
  `forum_name` char(255) CHARACTER SET cp1251 NOT NULL,
  `icon_img` char(255) CHARACTER SET cp1251 NOT NULL DEFAULT 'user.gif',
  `description` char(255) CHARACTER SET cp1251 NOT NULL,
  `id_last_author` bigint(20) NOT NULL,
  `last_author` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `last_post` datetime NOT NULL,
  `id_thread_last` bigint(20) NOT NULL DEFAULT '0',
  `threads_quantity` bigint(20) NOT NULL DEFAULT '0',
  `posts_quantity` bigint(20) DEFAULT '0',
  `prison` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forums`
--

INSERT INTO `forums` (`id_forums`, `subject_id`, `parent_forum_id`, `forum_name`, `icon_img`, `description`, `id_last_author`, `last_author`, `last_post`, `id_thread_last`, `threads_quantity`, `posts_quantity`, `prison`) VALUES
(1, 0, 0, 'Основной форум', 'user.gif', 'Основной форум, все самые основные темы', 1, 'ivan.bazhenov@gmail.com', '2011-03-02 12:33:00', 35, 2, 13, b'0'),
(13, 0, 0, 'Проверка', 'user.gif', 'тест', 1, 'Иван', '2011-03-02 09:12:03', 46, 1, 9, b'0'),
(15, 0, 1, 'ПРОВЕРКА', 'user.gif', '!!!', 0, '', '2011-03-02 11:58:18', 47, 0, 0, b'0'),
(17, 0, 13, 'лорол', 'user.gif', 'лорлор', 1, 'Иван', '2011-03-02 06:50:48', 0, 1, 0, b'0'),
(18, 0, 17, 'роп', 'user.gif', 'орпорп', 1, 'Иван', '2011-03-02 06:51:30', 0, 0, 0, b'0'),
(23, 0, 22, 'lkjh', 'user.gif', 'kljh', 1, 'Иван', '2011-03-02 11:51:51', 0, 0, 0, b'0'),
(34, 0, 0, 'dfs', 'user.gif', 'dsfs', 1, 'Иван', '2011-03-15 07:57:56', 0, 0, 0, b'0'),
(25, 0, 21, 'bvc', 'user.gif', 'vbc', 1, 'Иван', '2011-03-02 11:54:57', 0, 0, 0, b'0'),
(26, 0, 23, 'hgf', 'user.gif', 'ghf', 1, 'Иван', '2011-03-02 12:21:45', 0, 0, 0, b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
`id_posts` bigint(20) NOT NULL,
  `forum_thread_id` bigint(20) NOT NULL DEFAULT '0',
  `header` char(255) CHARACTER SET cp1251 NOT NULL,
  `post_date` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `post_text` text CHARACTER SET cp1251 NOT NULL,
  `first_message` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_posts`
--

INSERT INTO `forum_posts` (`id_posts`, `forum_thread_id`, `header`, `post_date`, `user_id`, `post_text`, `first_message`) VALUES
(76, 10, '', '2011-02-20 10:53:13', 3, '[php]echo "hello"; function hello() { return 0; }[/php] [list=1]\r\n[*]kjkljklj \r\n[*]klj  \r\n[*]lkj\r\n[/list]\r\n[list]\r\n[*]lkj\r\n[/list] [url]http://localhost/microblog/index.php[/url]\r\n[quote]jkhkjhkjh[/quote]\r\n[code]kjlkjlkj[/code]\r\n\r\n[u]kl;kl;[/u]', b'0'),
(75, 10, '', '2011-02-20 10:20:06', 3, '<b>Привет</b>[b]пРИВЕТ[/b]', b'0'),
(38, 10, '', '2011-02-18 11:40:21', 1, '{message}', b'0'),
(36, 10, '', '2011-02-18 07:44:19', 1, 'Проверка на последнее сообщение', b'0'),
(37, 10, '', '2011-02-18 10:40:14', 1, '{message}', b'0'),
(96, 46, '', '2011-02-28 18:31:48', 1, 'Проверка [b]на проверку[/b]', b'0'),
(94, 46, '', '2011-02-28 17:52:42', 3, 'kjg', b'0'),
(95, 46, '', '2011-02-28 18:28:31', 1, 'Привет мой повелитель', b'0'),
(97, 46, '', '2011-03-01 04:34:29', 1, 'А если еще раз проверить?', b'0'),
(98, 46, '', '2011-03-01 04:36:17', 1, 'Ghbdtn', b'0'),
(100, 10, '', '2011-03-01 05:38:44', 1, '[size=1]оп[/size]', b'0'),
(101, 35, '', '2011-03-01 06:53:03', 6, 'kjlkj', b'0'),
(103, 46, '', '2011-03-01 14:30:26', 1, '[quote=Иван]Проверка [b]на проверку[/b][/quote]\r\n', b'0'),
(104, 46, '', '2011-03-01 14:30:50', 1, '[quote=Иван]Проверка [b]на проверку[/b][/quote]\r\n[quote=Иван]Привет мой повелитель[/quote]\r\n[quote=User]kjg[/quote]\r\n', b'0'),
(105, 35, '', '2011-03-01 14:33:03', 1, '[quote=837yphj jdfh3if  khklюю.ю...\\\\]kjlkj[/quote]\r\n', b'0'),
(107, 10, '', '2011-03-02 06:57:09', 1, '[quote=Иван]Проверка на последнее сообщение[/quote]\r\n[quote=Иван]Проверка на последнее сообщение[/quote]\r\n[quote=Иван]Проверка на последнее сообщение[/quote]\r\n[quote=Иван]Проверка на последнее сообщение[/quote]\r\n[quote=Иван]Проверка на последнее сообщение[/quote]\r\n', b'0'),
(108, 35, '', '2011-03-02 07:00:08', 1, '[quote=837yphj jdfh3if  khklюю.ю...\\\\]kjlkj[/quote]\r\n[quote=837yphj jdfh3if  khklюю.ю...\\\\]kjlkj[/quote]\r\n', b'0'),
(109, 35, '', '2011-03-02 07:06:12', 1, '[quote=Иван][quote=837yphj jdfh3if  khklюю.ю...\\\\\\\\]kjlkj[/quote]\r\n[quote=837yphj jdfh3if  khklюю.ю...\\\\\\\\]kjlkj[/quote]\r\n[/quote]\r\n \r\n', b'0'),
(111, 35, '', '2011-03-02 08:51:59', 1, '[quote=Иван][quote=837yphj jdfh3if  khklюю.ю...\\\\\\\\]kjlkj[/quote]\r\n[quote=837yphj jdfh3if  khklюю.ю...\\\\\\\\]kjlkj[/quote]\r\n[/quote] \r\n', b'0'),
(112, 46, '', '2011-03-02 09:06:18', 1, '[quote=Иван]Привет мой повелитель[/quote]\r\n[quote=User]kjg[/quote]\r\n[quote=User]kjg[/quote]\r\n \r\n', b'0'),
(113, 46, '', '2011-03-02 09:12:03', 1, '[quote=Иван]Ghbdtn[/quote]\r\n[quote=Иван]А если еще раз проверить?[/quote]\r\n[quote=Иван]А если еще раз проверить?[/quote]\r\n \r\n', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
`id_thread` bigint(20) NOT NULL,
  `forum_id` bigint(20) NOT NULL,
  `thread_name` char(255) CHARACTER SET cp1251 NOT NULL,
  `title` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `text` text CHARACTER SET cp1251 NOT NULL,
  `date` datetime NOT NULL,
  `posts_quantity` bigint(20) DEFAULT '0',
  `author_user_id` bigint(20) NOT NULL,
  `id_last_author` bigint(20) NOT NULL,
  `last_author` varchar(255) CHARACTER SET cp1251 NOT NULL,
  `last_post` datetime NOT NULL,
  `description` char(255) CHARACTER SET cp1251 NOT NULL,
  `hits_quantity` bigint(20) DEFAULT '0',
  `priority` smallint(6) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_threads`
--

INSERT INTO `forum_threads` (`id_thread`, `forum_id`, `thread_name`, `title`, `text`, `date`, `posts_quantity`, `author_user_id`, `id_last_author`, `last_author`, `last_post`, `description`, `hits_quantity`, `priority`) VALUES
(10, 1, 'Название темы', '', 'Сообщение', '2011-02-25 16:40:11', 8, 3, 1, 'Иван', '2011-03-02 06:57:09', 'описание', 190, 1),
(35, 1, 'Тема', '', '[b]Привет, как ваши [s]дела[/s]?[/b]', '2011-02-25 17:09:24', 5, 1, 1, 'Иван', '2011-03-02 08:51:59', 'тестовая тема', 252, 0),
(46, 13, 'Привет', '', 'олрлор', '2011-02-28 17:48:43', 9, 1, 1, 'Иван', '2011-03-02 09:12:03', 'проверка', 473, 0),
(48, 17, 'лорлор', '', 'лор', '2011-03-02 06:51:09', 0, 1, 1, 'Иван', '2011-03-02 06:51:09', 'лорлор', 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id_message` int(255) NOT NULL,
  `id_user_send` int(255) DEFAULT NULL,
  `id_user_take` int(255) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '...',
  `send_count` int(255) NOT NULL DEFAULT '1',
  `take_count` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id_message`, `id_user_send`, `id_user_take`, `date`, `content`, `title`, `send_count`, `take_count`) VALUES
(19, 1, 3, '2011-02-27 09:50:58', 'Как дела?', 'Привет', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news_media`
--

CREATE TABLE IF NOT EXISTS `news_media` (
`id_media` bigint(20) NOT NULL,
  `media_source_id` bigint(20) NOT NULL DEFAULT '0',
  `article_header` varchar(255) NOT NULL,
  `image_preview` varchar(255) NOT NULL,
  `cost` double NOT NULL,
  `publish_date` datetime NOT NULL,
  `hits` bigint(20) NOT NULL DEFAULT '0',
  `user_author_id` bigint(20) NOT NULL,
  `news_text` text NOT NULL,
  `text` text NOT NULL,
  `categ` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `news_media`
--

INSERT INTO `news_media` (`id_media`, `media_source_id`, `article_header`, `image_preview`, `cost`, `publish_date`, `hits`, `user_author_id`, `news_text`, `text`, `categ`) VALUES
(1, 1, 'Ливийская оппозиция "подкупила" Францию', '1.jpg', 100, '2011-03-15 13:26:02', 46, 1, 'Франция продолжит бороться с войсками Муамара Каддафи в Ливии, чувствуя себя обязанной повстанцам, которые подняли над Бенгази французский "триколор", пишет РИА Новости . Выступая перед депутатами Национального собрания (нижней палаты парламента) Франции, премьер-министр Франсуа Фийон пояснил: ', '', 'Игры'),
(2, 3, 'Д.Медведев: РФ готова быть посредником в разрешении кризиса в Ливии ', '2.jpg', 300, '2011-03-20 13:26:22', 35, 1, 'Президент РФ Дмитрий Медведев принял в подмосковной резиденции министра обороны США Роберта Гейтса, сообщает пресс-служба главы Российского государства. С российской стороны во встрече также приняли участие министр обороны России Анатолий Сердюков и помощник президента РФ Сергей Приходько', '', 'Развлекательный канал'),
(3, 1, 'Путин надеется на развитие межпарламентского сотрудничества со Словенией ', '1.jpg', 100, '2011-03-15 13:26:02', 23, 1, 'ЛЮБЛЯНА, 22 мар - РИА Новости. Премьер-министр РФ Владимир Путин высоко оценил уровень межпарламентского сотрудничества между Россией и Словенией и высказался за его дальнейшее развитие. "Для нас работа на межпарламентском треке очень важна, так как в парламентах представлен весь спектр обществ ', '', 'Игры'),
(4, 3, 'Превышение радиационных норм зафиксировано в ряде продуктов в Японии', '2.jpg', 300, '2011-03-20 13:26:22', 10, 1, 'МОСКВА, 22 мар - РИА Новости. Концентрация радиоактивных элементов, превышающая предельно допустимую норму, была обнаружена в капусте брокколи в префектуре Фукусима, а также в сыром молоке в префектуре Ибараки, сообщило агентство Киодо. Ранее на этой неделе появилась информация о том', '', 'Развлекательный канал'),
(5, 1, 'Проба сил в тандеме перед выборами-2012', '1.jpg', 300, '2011-03-20 13:41:30', 3, 1, 'Заочный спор президента Дмитрия Медведева и премьера Владимира Путина по поводу бомбардировки Ливии взбудоражил российскую политэлиту. Эксперты, опрошенные «НГ», высказывают прямо противоположные точки зрения относительно резких высказываний первых лиц государства', '', 'Игры'),
(6, 2, 'С.Собянин призвал единороссов "проревизировать" свои обещания ', '3.jpg', 150, '2011-03-21 01:44:40', 0, 1, 'Мэр Москвы Сергей Собянин поручил московским единороссам "проревизировать" свои предвыборные обещания и не забывать их. С соответствующим призывом столичный мэр выступил в ходе заседания президиума регионального политсовета московского регионального отделения партии "Единая Россия",', '', 'Политика'),
(7, 2, 'РФ может увеличить поставки газа в Европу для отправки СПГ в Японию ', '3.jpg', 150, '2011-03-21 01:44:40', 0, 1, 'ЛЮБЛЯНА, 22 мар - РИА Новости. "Газпром" готов поставлять дополнительно в Европу до 70 миллионов кубометров природного газа в рамках российского предложения по перенаправлению сжиженного природного газа с европейского на японский рынок, сообщил глава холдинга Алексей Миллер. "Мы дополнительно ', '', 'Политика'),
(8, 3, 'Антиэкстремистский робот ', '3.jpg', 150, '2011-03-21 01:44:40', 0, 1, 'Роскомнадзор устал от мониторинга интернета вручную и заказывает за 15 миллионов рублей специальную программу для поиска экстремистских публикаций и заведомо ложных сведений о госслужащих. Скорее всего, программный комплекс будет создан на основе уже существующих программ для мониторинга СМИ', '', 'Развлекательный канал'),
(9, 1, 'Планшет Blackberry PlayBook появится через месяц ', '3.jpg', 150, '2011-03-21 01:44:40', 2, 1, 'Планшет Blackberry PlayBook уже доступен для предварительного заказа в США и Канаде. Модели с 16 ГБ, 32 ГБ и 64 ГБ встроенной памяти стоят $499, $599 и $699 соответственно. В первой модификации из беспроводных возможностей предусмотрены лишь Wi-Fi 802.11 a/b/g/n и Bluetooth 2.1+EDR', '', 'Игры'),
(10, 2, 'Новая версия мессенджера QIP получила интеграцию с Facebook ', '3.jpg', 150, '2011-03-21 01:44:40', 0, 1, 'МОСКВА, 22 мар - РИА Новости, Илья Илембитов. Разработчики популярных мессенджеров QIP Infium интегрировали их в социальную сеть Facebook, вследствие чего пользователи QIP могут подключать свою учетную запись Facebook и обмениваться сообщениями с другими пользователями социальной сети, ', '', 'Политика'),
(11, 3, '12', 'Шесть стран выразили желание принять ЧМ по фигурному катанию ', 12, '2011-03-23 01:19:41', 0, 1, 'Россия оказалась не единственной страной, желающей принять чемпионат мира по фигурному катанию. Кроме Москвы заявки на проведение турнира подали Канада (Ванкувер), США (Колорадо-Спрингс), Финляндия (Турку), Хорватия (скорее всего, Загреб), Австрия (скорее всего, Грац)', '', 'Развлекательный канал'),
(12, 1, 'Никита Михалков вышел из категории опущенный лузер в ЖЖ ', '1945997_0_0_64007ddaf2XSJYEEQ_31835_d3c53b61e3_tlog.jpg', 120, '2011-03-22 19:30:50', 4, 1, 'Новорождённый блогер глава российского Союза кинематографистов Никита Михалков доволен тому успеху, который в блогосфере имеет его блог в "Живом журнале"... Напомним, Никита Михалков, как он сам признался ранее, решил дать бой тем фальшивым юзерам, которые выступают в блогосфере под его именем и .', '', 'Игры'),
(13, 2, 'h', '1962260_0_0_l_135518_tlog.jpg', 200, '2011-03-23 06:59:00', 3, 1, 'vc', 'vcvbcvbc', 'Политика'),
(19, 1, 'HELLLO', 'Avril Lavigne 026.jpg', 1200, '2011-03-28 14:27:57', 1, 1, '[b][i][u][s]HE<LLO[/s][/u][/i][/b]', 'оч оч интересно', 'Игры');

-- --------------------------------------------------------

--
-- Структура таблицы `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
`id_notice` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `read` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `notice`
--

INSERT INTO `notice` (`id_notice`, `id_user`, `title`, `text`, `date`, `read`) VALUES
(3, 0, 'В «Ашане» найден восьмимесячный ребенок', 'В торговом центре «Ашан» на 65-м километре МКАД был найден ребенок в возрасте около восьми месяцев, сообщает Сити-ФМ. Во вторник днем администрация супермаркета обратилась в ГУВД Красногорского района с сообщением об оставленном в торговом зале младенце. ', '2011-03-18 19:00:02', b'0'),
(4, 0, 'Президент рассказал, какой должна быть полиция', 'Дмитрий Медведев внёс в Госдуму законопроект «О социальных гарантиях сотрудникам органов внутренних дел». Новый документ, помимо прочего, определяет порядок денежных выплат полицейским, а также обеспечение их жильем. Изменения, в том числе коснутся пенсий', '2011-03-18 13:04:05', b'0'),
(5, 0, 'Одиннадцать человек пострадали при аварии маршрутки в Москве ', 'Водитель маршрутки, двигавшейся по Сколковскому шоссе, заснул за рулем, после чего микроавтобус врезался в железобетонное ограждение и перевернулся. Из восьми госпитализированных после аварии двое находятся в тяжелом состоянии. Троим пассажирам микроавтоб', '2011-03-19 08:12:42', b'0'),
(6, 0, 'Госдума разрешила совмещать сроки индексации социальных пенсий', 'МОСКВА, 22 марта. Госдума приняла в первом чтении и в целом законопроект, позволяющий совмещать периоды индексации социальных пенсий. Как передает корреспондент «Росбалта», по действующему закону пенсии индексируются дважды в год – 1 апреля и 1 июля. Прич', '2011-03-19 13:02:50', b'0'),
(7, 0, 'О новом деле в процессе о казино в Подмосковье адвокатам не известно', 'МОСКВА, 22 мар - РИА Новости. Защитники ничего не знают о новом уголовном деле в отношении Ивана Назарова, обвиняемого в организации сети нелегальных казино в 15 городах Подмосковья, сообщил Российскому агентству правовой и судебной информации (РАПСИ) оди', '2011-03-20 10:23:58', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `pro_articles`
--

CREATE TABLE IF NOT EXISTS `pro_articles` (
`id_article` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `pro_articles`
--

INSERT INTO `pro_articles` (`id_article`, `title`, `content`) VALUES
(9, 'Привет Мир', 'дА ДА))'),
(13, 'Опа-па', 'Кто здесь? :)'),
(14, 'Привет', 'Как дела?'),
(15, 'Проверка на длину статьи', 'ооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооооо влллллллллллллллллллллллллллллллллллллллллллллл ыввввввввввввввввввв ыыыыыыыыыыыыыыыыыыыыыыыыыы лллллллллллллллллллллллллд  дддддддддддддддддддддддддддддддддд жжжжжжжжжжжжжжжжжжжжжжжжжжжжжж ддддддддддддддддд ццццццццццццццц щщщщщщщщщщщщщщщщщ зззззззззззззззззззз хххххххххххххххххх ъъъъъъъъъъъъъъъъъъ гггггггггггггггг 99999999999999999 00000000000000 оооооооооооооооиииииииии ттттттттттттт ннннннннннннннн вввввввввввв кккккккккккк уууууу'),
(16, 'Че?', 'выавапвврваренкгооаиманоивака пр вапрвапрпопап рорапппаропопропроропрооропроароаророап рпооаке6756757657765 667657547476прапрапрап прврапрапрапрвапрапрвапрвапрвапрвапрвпаисмисексм павывапывкноглвпаиппрпнлгнлкарарврварваравравправ апрвварварварвраправрварвпрвапрогллблвава ваерыруоуеноуоуерук');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id_role` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
`id_session` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_last` datetime NOT NULL,
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=357 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id_session`, `id_user`, `sid`, `time_start`, `time_last`, `online`) VALUES
(355, 1, 'GHyQMgUhui', '2015-10-20 20:48:33', '2015-10-20 21:08:42', 'online'),
(356, 1, 'B88v1Q4U8u', '2015-10-20 21:11:40', '2015-10-20 21:12:42', 'online');

-- --------------------------------------------------------

--
-- Структура таблицы `subject_documents`
--

CREATE TABLE IF NOT EXISTS `subject_documents` (
`id_doc` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `changes_date` datetime NOT NULL,
  `document_text` text NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `document_type` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `subject_documents`
--

INSERT INTO `subject_documents` (`id_doc`, `subject_id`, `document_name`, `creation_date`, `changes_date`, `document_text`, `parent_id`, `document_type`) VALUES
(38, 1, 'kjhkhkjh', '2011-03-22 16:16:03', '2011-03-22 16:16:03', 'nghjg', 0, 'index.php?c=media&media=2'),
(39, 1, 'Привет', '2011-03-22 16:22:53', '2011-03-22 16:22:53', 'рваорывлорыва лаылоа ывло лоывра лыро ывлоа ыаывл арывлоа ывлароы влаыор лаовыраыларылваылваоылоылылоывр лвло рало арыл раыл арылв аылора ыло аырл ыорало ыралы ор', 0, 'index.php?c=media&media=1'),
(40, 1, 'Документ', '2011-03-22 21:02:23', '2011-03-22 21:02:23', 'Демонстрация загрузки документов', 0, 'upload/p21.txt'),
(41, 1, 'hkj', '2011-03-22 21:50:09', '2011-03-22 21:50:09', 'jkh', 0, 'upload/1945997_0_0_64007ddaf2XSJYEEQ_31835_d3c53b61e3_tlog.jpg'),
(42, 1, 'Никита Михалков вышел из категории опущенный лузер в ЖЖ ', '2011-03-23 13:02:55', '2011-03-23 13:02:55', 'Новорождённый блогер глава российского Союза кинематографистов Никита Михалков доволен тому успеху, который в блогосфере имеет его блог в "Живом журнале"... Напомним, Никита Михалков, как он сам признался ранее, решил дать бой тем фальшивым юзерам, которые выступают в блогосфере под его именем и .', 0, 'index.php?c=media&media=12'),
(43, 1, 'Планшет Blackberry PlayBook появится через месяц ', '2011-03-23 13:28:20', '2011-03-23 13:28:20', '', 0, 'index.php?c=media&media=9'),
(48, 1, 'h', '2011-03-28 14:32:59', '2011-03-28 14:32:59', 'vcvbcvbc', 13, 'index.php?c=media&media=13'),
(49, 1, 'HELLLO', '2011-03-28 14:41:34', '2011-03-28 14:41:34', 'оч оч интересно', 19, 'index.php?c=media&media=19');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `notice` int(1) NOT NULL DEFAULT '0',
  `money` double NOT NULL DEFAULT '500'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `id_role`, `name`, `surname`, `avatar`, `notice`, `money`) VALUES
(1, 'ivan.bazhenov@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'Иван', 'Баженов', '1.jpg', 1, -3869),
(2, 'linux_oid@list.ru', 'c81e728d9d4c2f636f067f89cc14862c', NULL, 'Linux815', NULL, '2.jpg', 0, 500),
(3, 'm@mail.ru', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'User', NULL, '3.jpg', 0, 500),
(5, 'mail@mail.ru', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'mail', NULL, '3.jpg', 0, 500),
(6, 'lin@lin.ru', '202cb962ac59075b964b07152d234b70', NULL, '837yphj jdfh3if  khklюю.ю...\\', NULL, '3.jpg', 0, 500);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id_categ`);

--
-- Индексы таблицы `forums`
--
ALTER TABLE `forums`
 ADD PRIMARY KEY (`id_forums`);

--
-- Индексы таблицы `forum_posts`
--
ALTER TABLE `forum_posts`
 ADD PRIMARY KEY (`id_posts`);

--
-- Индексы таблицы `forum_threads`
--
ALTER TABLE `forum_threads`
 ADD PRIMARY KEY (`id_thread`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id_message`);

--
-- Индексы таблицы `news_media`
--
ALTER TABLE `news_media`
 ADD PRIMARY KEY (`id_media`);

--
-- Индексы таблицы `notice`
--
ALTER TABLE `notice`
 ADD PRIMARY KEY (`id_notice`);

--
-- Индексы таблицы `pro_articles`
--
ALTER TABLE `pro_articles`
 ADD PRIMARY KEY (`id_article`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id_role`), ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
 ADD PRIMARY KEY (`id_session`), ADD UNIQUE KEY `sid` (`sid`);

--
-- Индексы таблицы `subject_documents`
--
ALTER TABLE `subject_documents`
 ADD PRIMARY KEY (`id_doc`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`), ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
MODIFY `id_categ` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `forums`
--
ALTER TABLE `forums`
MODIFY `id_forums` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `forum_posts`
--
ALTER TABLE `forum_posts`
MODIFY `id_posts` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT для таблицы `forum_threads`
--
ALTER TABLE `forum_threads`
MODIFY `id_thread` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
MODIFY `id_message` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `news_media`
--
ALTER TABLE `news_media`
MODIFY `id_media` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `notice`
--
ALTER TABLE `notice`
MODIFY `id_notice` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `pro_articles`
--
ALTER TABLE `pro_articles`
MODIFY `id_article` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
MODIFY `id_role` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
MODIFY `id_session` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=357;
--
-- AUTO_INCREMENT для таблицы `subject_documents`
--
ALTER TABLE `subject_documents`
MODIFY `id_doc` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
