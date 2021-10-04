-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Окт 02 2021 г., 02:52
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gb1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `product_id` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`, `product_id`) VALUES
(333, 'Сергей', 'Отличный магазин!', 1),
(334, 'Наталья', 'Привет!', 2),
(335, 'Марта Бэкк', 'Привет', 1),
(340, 'Админ1', 'Проверка связи', 1),
(343, 'Светлана', 'Очень вкусный кофе', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int UNSIGNED NOT NULL,
  `views` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `size`, `views`) VALUES
(22, '01.jpg', 111456, 3),
(23, '02.jpg', 70076, 0),
(24, '03.jpg', 70215, 0),
(25, '04.jpg', 61733, 0),
(26, '05.jpg', 160617, 0),
(27, '06.jpg', 89871, 0),
(28, '07.jpg', 99418, 0),
(30, '08.jpg', 103775, 0),
(31, '09.jpg', 81022, 0),
(32, '10.jpg', 97127, 0),
(33, '11.jpg', 98579, 0),
(35, '12.jpg', 139286, 0),
(36, '13.jpg', 113016, 5),
(37, '14.jpg', 151814, 0),
(38, '15.jpg', 112488, 0),
(44, '01f3394d-b45a-40a4-911e-9af521add4cf.jpg', 90762, 0),
(45, '01f3394d-b45a-40a4-911e-9af521add4cf.jpg', 90762, 0),
(46, '_1458-589 (1).jpg', 194378, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `likes` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `likes`) VALUES
(1, 'В Ростовской области стартовал финал конкурса \"Учитель года России\"', 'Финал всероссийского конкурса \"Учитель года России\" стартовал в Ростовской области, сообщает правительство региона.\r\n\"Губернатор Ростовской области Василий Голубев поприветствовал участников финала всероссийского конкурса \"Учитель года России\" 2021 года\", - говорится в сообщении.\r\nПроведение в Ростове-на-Дону главного для педагогов профессионального конкурса страны стало возможно благодаря победе ростовского учителя Михаила Гурова в минувшем году.', 0),
(2, 'Звезда советского кино пожаловалась на низкую пенсию', 'МОСКВА, 26 сентября/ Радио Sputnik.Советскую и российскую актрису Елену Проклову не устраивает размер пенсии. Несмотря на все регалии, артистка получает 18 тысяч рублей, передает Life.\r\nВ разговоре с порталом Day.ru Проклова отметила, что о накоплениях на старость надо было думать раньше. Сейчас актриса надеется, что поддержки от государства ей хватит.', 1),
(5, 'Путин определил глав профильных комиссий \"Единой России\"', 'МОСКВА, 27 сен — РИА Новости. Президент Владимир Путин поздравил \"пятерку\" списка \"Единой России\" с убедительной победой на выборах в Госдуму и распределил между ними внутрипартийные должности.\r\n\"Хочу <...> поблагодарить именно как лидеров предвыборного списка партии за достойный результат избирательной кампании\", — сказал глава государства на встрече, добавив, что это отражает высокий уровень доверия и к самой партии, и к ее конкретным делам.', 0),
(6, 'Организатор восхождения на Эльбрус написал явку с повинной', 'МОСКВА, 27 сен — РИА Новости. Организатор восхождения на Эльбрус, во время которого погибли альпинисты, написал явку с повинной и дал признательные показания, сообщил СК.\r\nСледствие будет ходатайствовать о его аресте.\r\nУчения МЧС в Приэльбрусье - РИА Новости, 1920, 26.09.2021\r\nВчера, 17:31\r\nТела трех альпинистов спустили с Эльбруса на высоту 5100 метров\r\nНа прошлой неделе на Эльбрусе на высоте 5,4 тысячи метров группа из 19 альпинистов из-за ухудшения погодных условий попросила о помощи. Спасти удалось только 14 из них, 11 пострадавших доставили в республиканскую клиническую больницу в Нальчике, семерых позже выписали.', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Товары';

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Пицца', 'С сыром и грибами', '200.00', 'pizza.jpg'),
(2, 'Чай', 'Цейлонский чай', '150.00', 'tea.png'),
(3, 'Кофе', 'Кофе молотый', '250.00', 'coffee.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
