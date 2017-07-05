<?php

include_once "config.php";


$sql = "CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `flag` bit(1) DEFAULT b'0',
  `dt` date DEFAULT NULL
)";

mysqli_query($link1, $sql);

$sql2 = "REPLACE INTO `book` (`id`, `name`, `email`, `comment`, `flag`, `dt`) VALUES
(1, 'Пётр', 'peterburg@yandex.ru', 'Всё было на уровне!', b'1', '2017-06-01'),
(2, 'Dubanin Sergey', 'sdub@yandex.ru', 'Непередаваемые эмоции. \r\nКаждому стоит попробовать.', b'1', '2017-06-02'),
(3, 'Шмагаренко Александр', 'admin@mail.ru', 'Огромное спасибо! \r\nБыло восхитительно!', b'1', '2017-06-03'),
(4, 'Булаков Филипп', 'ddso@vjlink.ru', 'Это лучшая приставка на сегодняшний день! \r\nШикарный джойстик со своими фишками (динамик в нем просто сказка, в некоторых играх прям эффект 4D или 5D, как правильно). \r\nТихая! Чуть шумнее мне показалось во время Ведьмака, но всё равно тихо, а игра зачетная и графически очень современно и круто выглядит. \r\nЭксклюзивы. Купил соню перед НГ, а на самом деле всё ради весеннего выхода Uncharted 4, одного из лучших эксклюзивов только на эту приставку. Дожить до рассвета - ещё один маст хев! С женой были в восторге. У конкурентов со своими типа эксклюзивами дела обстоят хуже. \r\nПО. Отличная начинка с богатейшим функционалом. Сами всё поймёте ))', b'1', '2016-06-04'),
(5, 'Zinich Mikhail', 'mria@ya.ru', 'главное впечатление - одноразовость и сервисная игла уверенно шагает по миру. батарея несъемная и крошечная (это видно, когда до неё таки доберешься), что для многих будет подразумевать покупку нового компа после её скорой смерти, или, как минимум поход в сервис с последующей отдачей $. \r\nк слову, вообще всё оборудование под одной крышкой, так что само стартовое сочетание вин8 и 2гб оперативки как бэ намекает: хочешь добавить памяти? - неси нас в сервис! у меня 2 самсунга ещё есть - 1 винт и ты у оперативки. на ленове - 26 винтов, снять клаву и половину корпуса, которые крепятся на пластмассовых микрозастежках.', b'1', '2016-06-05'),
(6, 'Филиппов Женя', 'filipp@mail.ru', 'главное достоинство этой экшн-камеры - это наличие сенсорно дисплея. В предыдущих версиях этого не было. У меня был выбор между покупкой 4 сильвер и 4 блеки, специально брал сильвер,очень удобно когда видишь , что ты записываешь. Ненужно тратить время на вывод видео через вай-фай допустим на телефон.', b'1', '2016-06-06'),
(7, 'Клеванец Игорь', 'igor@mail.ru', '- чистейший звук - через провод \r\n- не давят, не жмут, мягонько сидят на голове \r\n- мои большие уши помещаются в амбрюшоны (а вот маленьким девочкам могут оказаться великоваты) \r\n- батарея держит неплохо: не засекал с секундомером, но раз в пару дней поставить их заряжаться - не проблема \r\n- микрофон хороший - звук немного глуховат, но собеседник меня слышит', b'1', '2016-06-07'),
(8, 'Sychugov Anton', 'anton@mail.ru', '- Звучание! (при наличии нормального источника, конечно). Все ровно - и верхние и средние и низкие. Прекрасная детализация.\r\n- Удобство. На работе сижу в них целый день и уши почти никогда не болят.\r\n- NFC - очень удобно, когда лень искать кнопку включения. Просто подношу телефон к левому уху и наушники сами включаются и подрубатся к смарту.\r\n- Возможность подключить по проводу. Просто необходима, т.к. нередко забываю зарядить.\r\n- Стабильность и дальнобойность синезуба (зависит от источника). С nexus 5 спокойно хожу по всей квартире. Пробивает через две стены. С SGS 5 mini после второй стены начинает периодически заикаться.', b'1', '2016-06-08'),
(9, 'Гончаренко Александр', 'alex@mail.ru', 'Дизайн, сборка на 5, органы управления удобные, выглядят достойно, работают от провода 3,5мм (заряд аккумулятора не играет роли), есть AptX-стандарт высококачественной передачи звука.', b'1', '2016-06-09'),
(10, 'forspam397', 'spam@inbox.ru', 'Хороший внешний вид, приличное качество сборки, большое время работы, качественный проводок в комплекте.\r\nШумоподавление действительно работает, хорошо фильтрует низкие частоты (гул вентиляции, шум трамвая и т.д). Речь частично приглушает, высокочастотные звуки не фильтрует вообще (хотя они пассивно фильтруются).\r\n', b'1', '2016-06-10'),
(11, 'Заморенов Олег', 'oleg@mail.ru', 'Купил 6 января 2016 успел ещё за 6400 рублей, о чем радовался. Звук довольно мягкий и приятный как все sony. \r\nХороший объемный звук. \r\nДолго держат заряд. Очень легкие, так и просятся в самолет.', b'1', '2016-06-11'),
(12, 'Павлов Юрий', 'yuriy@mail.ru', 'Неплохой звук для своей стоимости. \r\nОчень удобные, отлично сидят на голове. \r\nСделаны качественно, выглядят хорошо. \r\nЕсть поддержка AptX.', b'1', '2016-06-12')";

mysqli_query($link1, $sql2);


$sql3 = "ALTER TABLE `book`
  ADD PRIMARY KEY (`id`)";

mysqli_query($link1, $sql3);

$sql4 = "ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13";

mysqli_query($link1, $sql4);    

?>