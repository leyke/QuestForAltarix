# QuestForAltarix
В качестве локального сервера использовал Open Server 5.2.2

Cron реализовал через средство "Планировщик заданий" в Open Server

Использовал следующее:
Время: */30 * * *
Путь: %progdir%\modules\php\%phpdriver%\php-win.exe -c %progdir%\modules\php\%phpdriver%\php.ini -q -f %sitedir%\foraltarix.ru\WSDLRequestSenderController.php

в Данный момент занимаюсь "причёсыванием" этого Проекта
