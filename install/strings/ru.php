<?php
/**
 * START LICENSE HEADER
 *
 * The license header may not be removed.
 *
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * @copyright       (C) xtrose Media Studio 2019
 * @author          Moses Rivera
 *                  Im Wiesengrund 24
 *                  73540 Heubach
 * @mail            media.studio@xtrose.de
 *
 * END LICENSE HEADER
 *
 * @description     install/strings/ru.php ->    Russian language strings for APPNETOS installer.
 */

// Strings.
$strings = [
    "installer__language_header" => "Язык во время установки",
    "installer__language" => "язык",
    "installer__license" => "Лицензии",
    "installer__select" => "выбрать",
    "installer__install" => "устанавливать",
    "installer__accept_checkbox" => "Я принимаю условия лицензии",
    "installer__accept_error" => "Вы должны принять условия лицензии",
    "installer__accept" => "принимать",
    "installer__back" => "назад",
    "installer__version_error" => "Невероятная версия PHP. ОС APPNET требует PHP версии 7.0.0 или выше.",
    "installer__pdo_error" => "Расширение базы данных PDO не активно. ОС APPNET требуется расширение базы данных PHP PDO.",
    "installer__database" => "база данных",
    "installer__db_type" => "Тип базы данных",
    "installer__db_host" => "Хост базы данных",
    "installer__db_port" => "Порт базы данных",
    "installer__db_name" => "Имя базы данных",
    "installer__db_user" => "Имя пользователя базы данных",
    "installer__db_pass" => "Пароль базы данных",
    "installer__next" => "более",
    "installer__connect_error" => "Не удалось подключиться к базе данных.",
    "installer__prefix" => "Datanbank Prefix",
    "installer__prefix_info" => "APPNET OS использует префикс для всех таблиц базы данных. Это запускает несколько установок с одной базой данных.",
    "installer__url" => "URL (без \"/index.php\" в конце)",
    "installer__dir" => "Каталог установки (без \"/index.php\" в конце)",
    "installer__cache_dir" => "Каталог кэша (начиная с каталога установки)",
    "installer__tmp_dir" => "Временный каталог (начиная с установочного каталога)",
    "installer__log_dir" => "Каталог файлов журнала (начиная с каталога установки)",
    "installer__compile_dir" => "Каталог компиляции (начиная с каталога установки)",
    "installer__config_dir" => "Каталог конфигурации (начиная с каталога установки)",
    "installer__extend" => "Расширенные настройки",
    "installer__basic_settings" => "основные настройки",
    "installer__prefix_error" => "Пожалуйста, введите префикс.",
    "installer__prefix_error_1" => "Префикс должен состоять из 3 строчных букв (a-z).",
    "installer__prefix_error_2" => "Префикс базы данных уже используется.",
    "installer__system_warning" => "Изменения этих настроек не могут быть проверены и могут привести к ошибкам. Эти настройки можно настроить позже в файле \"confic.inc.php\".",
    "installer__directory" => "Установка и настройки каталога",
    "installer__developer" => "Настройки разработчика",
    "installer__cache" => "Настройки кэша",
    "installer__app_cache" => "Кэш приложения",
    "installer__file_cache" => "Файловый кеш",
    "installer__js_cache" => "Кеш JavaScript",
    "installer__css_cache" => "CSS кеш",
    "installer__cache_expire" => "Время истечения срока действия кэша приложения в секундах",
    "installer__error_count" => "Количество неверных входов в систему, пока пользователи не заблокированы",
    "installer__minify" => "Минимизируйте CSS и JavaScript",
    "installer__expert" => "Режим эксперта админки",
    "installer__cookie_lock" => "Используйте APPNET OS Cookie Blocker",
    "installer__user" => "Пользователь (администратор)",
    "installer__pass" => "пароль",
    "installer__pass_2" => "повторить пароль",
    "installer__mail" => "Адрес электронной почты",
    "installer__user_name" => "имя пользователя",
    "installer__user_min" => "Минимальная проверка пользователя (проверять только, если имя пользователя было введено)",
    "installer__pass_min" => "Проверка минимального пароля (Проверяйте только, если пароль был введен)",
    "installer__mail_min" => "Минимальная проверка электронной почты (просто проверьте, был ли введен адрес электронной почты)",
    "installer__err_user_enter" => "Пожалуйста, введите имя пользователя",
    "installer__err_user_valid" => "Имя пользователя не допускается",
    "installer__err_pass_enter" => "Пожалуйста, введите пароль",
    "installer__err_pass_compare" => "Пароль и повтор пароля не идентичны",
    "installer__err_pass_valid" => "Пароль не допускается",
    "installer__err_pass_usable" => "Пароль не может быть использован",
    "installer__err_mail_enter" => "Пожалуйста, введите адрес электронной почты",
    "installer__err_mail_valid" => "Электронная почта не разрешена",
    "installer__install_header" => "установка",
    "installer__install_text" => "APPNET OS готова к установке.",
    "installer__install_end" => "Установка ОС APPNET завершена. Теперь вы можете войти в админку.",
    "installer__directory_cache" => "Строковый кеш.",
    "installer__string_cache" => "Кеш каталога",
    "installer__permissions" => "Права доступа",
    "installer__permissions_info" => "APPNET OS не может получить доступ к файловой системе. Крайне важно, чтобы операционная система APPNET имела доступ к файловой системе. Предоставьте разрешения APPNET OS на чтение, запись и выполнение в каталоге APPNET OS со всеми подкаталогами и повторите попытку.",
    "installer__err_access" => "Доступ закрыт",
    "installer__try_again" => "Попробуйте снова",
    "installer__languages" => "Админка Языки",
    "installer__languages_info" => "Поддерживаемые языки области администрирования ОС APPNET",
    "installer__languages_global" => "Global (английский) (перевод xtrose Media Studio)",
    "installer__languages_de" => "Немецкий (deutsch) (перевод xtrose Media Studio)",
    "installer__languages_en" => "Английский (english) (перевод xtrose Media Studio)",
    "installer__languages_es" => "Испанский (español) (машинный перевод)",
    "installer__languages_fr" => "Французский (français) (машинный перевод)",
    "installer__languages_it" => "Итальянский (italiano) (машинный перевод)",
    "installer__languages_ru" => "Русский (русский) (машинный перевод)",
    "installer__additional" => "Расширенная Лицензия",
    "installer__security_settings" => "Настройки безопасности",
    "installer__pass_expire" => "Время, пока ссылка для сброса пароля истекает в считанные секунды",
    "installer__groups_application" => "Деактивировать группы секций приложений",
    "installer__groups_admin" => "Группы секций администрирования отключения",
    "installer__authenticator_lifetime" => "Время, пока пользователь не отойтся в считанные секунды, когда он сохраняет учетные данные",
    "installer__session_application" => "Время сеанса приложения за считанные секунды",
    "installer__session_admin" => "Время сеанса администрирования в секундах",
    "installer__compression" => "Сжатия",
    "installer__html_compression" => "Сожмить исходный код HTML",
    "installer__debug" => "Режим отладки",
];