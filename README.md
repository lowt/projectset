projectset
==========
Проект интернет-магазина по схеме дроп-шиппинг с развитием до дипломной работы "Проектирование и реализация веб системы оптимизации интернет-продаж"
Сейчас на самой площадке:
1)Предусмотрена валидация формы на сервере
2)Реализовна отправка формы на емайл
3)Реализовны фильтры
4)Реализована динамическая обработка фильтров
5)динамическое измениние цены при выборе аксессуаров для фотоаппарата

в процессе:
Отзывы с возможностью комментировать их
Реализация системы, которая будет при наличие большого количества поставщиков, будет во время поступления заявки на продукт будет подбирать поставщика, который возьмется за доставку и при этом за минимально возможную цену для клиента при максимально возможной марже для меня(моей площадки)

Деплой инструкция:

1)Установить локальный хостинг, например Денвер

2)Поставить mysql

3)Скопировать все на диск

4)Создать новую базу и импортировать database.sql(в корне)

5)В файле Configuration.php(в корне) изменить:

  $user=, $db=, $password=, $log_path=, $tmp_path=(пусть любой, но желательно в папку с файлами)
  
6)Запуск
