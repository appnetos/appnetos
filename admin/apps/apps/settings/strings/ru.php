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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Language strings.
$strings = [
    "admin__apps__settings__css_conf" => "CSS был сохранен",
    "admin__apps__settings__js_conf" => "JavaScript сохранен",
    "admin__apps__settings__css_err" => "CSS не удалось спасти",
    "admin__apps__settings__js_err" => "JavaScript не удалось сохранить",
    "admin__apps__settings__warning" => "Будьте осторожны при редактировании. Изменения могут изменить поведение приложения на устойчивой цели. Неправильные изменения могут разрушить приложение, выход и функции.",
    "admin__apps__settings__css_info" => "В редакторе CSS можно редактировать файл CSS приложения. Файл CSS приложения хранится в каталоге приложения. Этот файл CSS автоматически загружается с приложением. Если в приложении нет файла CSS, создается новый файл. Если кэш активен, его необходимо опорожнить, чтобы применить изменения.",
    "admin__apps__settings__js_info" => "В редакторе JavaScript можно редактировать файл JavaScript приложения. Файл JavaScript приложения хранится в каталоге приложения. Этот файл JavaScript автоматически загружается с приложением. Если в приложении нет файла JavaScript, создается новый файл. Если кэш активен, его необходимо опорожнить, чтобы применить изменения.",
    "admin__apps__settings__data_err" => "Данные не удалось сохранить",
    "admin__apps__settings__data_conf" => "Сохранены данные",
    "admin__apps__settings__size_err" => "Размер и ориентация не могли быть сохранены",
    "admin__apps__settings__size_conf" => "Размер и ориентация сохранены",
    "admin__apps__settings__header_col_xl" => "Макет приложения для ширины экрана 1200px",
    "admin__apps__settings__header_col_lg" => "Макет приложения для ширины экрана 992-1200px",
    "admin__apps__settings__header_col_md" => "Макет приложения для ширины экрана 720-992px",
    "admin__apps__settings__header_col_sm" => "Макет приложения для ширины экрана 576-720px",
    "admin__apps__settings__header_col" => "Расположение приложения для ширины экрана .576px",
    "admin__apps__settings__grid_css" => "Bootstrap сетки CSS",
    "admin__apps__settings__size_info" => "Для контейнерных приложений можно редактировать размер и ориентацию. Если приложение контейнера не регулирует размер и ориентацию, оно будет выходом в полной ширине. APPNET OS использует Bootstrap и систему Bootstrap Grid System для своих контейнеров. Сетевая система использует 5 размеров устройств. Каждый размер делится на 12 частей. Размер и ориентация контейнерных приложений могут быть определены этими частями. Если вы размещаете два контейнерных приложения друг с другом и определяете размер с 6 частями каждая, приложения выходят бок о бок в две равные части. Если вы определяете первое приложение в контейнере с 4 частями, а второе с 8 частями, правильное приложение выход в два раза больше, чем левое приложение. Если три приложения определены в контейнере по 4 части каждый, то три приложения выходят бок о бок, в том же размере. Если вы определите 12 частей для первого приложения и 6 частей для следующих двух, первое приложение будет выходом в полной ширине и следующие две, в том числе с половиной ширины. Если приложения правильно определены для каждого размера устройства, вы получите идеальный отзывчивый дизайн.",
    "admin__apps__settings__data_info" => "Если приложение имеет область админ, то к нему можно получить доступ через настройки. Приложения также могут быть загружены в контейнеры вместе с другими приложениями. Это приложение называется контейнер приложений. Контейнерные приложения могут корректировать их размер и ориентацию. Например, если два приложения загружаются в контейнер и размер установлен на 50% для каждого приложения, то они выделяются бок о бок. Теги CSS также могут быть добавлены в контейнер. Это позволяет влиять на внешний вид контейнера с несколькими приложениями. Остерегайтесь, если несколько приложений загружаются в один контейнер и несколько приложений настраивают контейнер CSS, все теги CSS добавляются в контейнер. App CSS позволяет добавлять теги CSS в каждое приложение в контейнере. В экспертном режиме можно даже отсеить CSS и JavaScript приложения. Этот режим должен быть разблокирован в config.inc.php. Но будьте осторожны. Если CSS или JavaScript изменены в экспертном режиме, приложения или даже вся страница могут быть изуродованы или навсегда уничтожены.",
    "admin__apps__settings__menu_header" => "Настройки приложения",
    "admin__apps__settings__admin_area" => "Админ области",
    "admin__apps__settings__description" => "Описание",
    "admin__apps__settings__size_and_align" => "Размер и ориентация",
    "admin__apps__settings__css_container_fluid" => "Контейнерная жидкость CSS",
    "admin__apps__settings__css_container" => "Контейнер CSS",
    "admin__apps__settings__css_app" => "ПРИЛОЖЕНИЕ CSS",
    "admin__apps__settings__edit_css" => "Оторит CSS",
    "admin__apps__settings__edit_js" => "Отодвините JavaScript",
    "admin__apps__settings__management" => "Управление приложениями",
    "admin__apps__settings__app_data" => "Данные приложения",
    "admin__apps__settings__activate" => "Активировать",
    "admin__apps__settings__deactivate" => "Отключить",
    "admin__apps__settings__activated" => "Включен",
    "admin__apps__settings__deactivated" => "Отключен",
    "admin__apps__settings__no_description" => "Нет описания",
    "admin__apps__settings__app_id" => "Идентификатор приложения",
    "admin__apps__settings__properties" => "Вариантов размещения",
    "admin__apps__settings__frontend" => "Frontend",
    "admin__apps__settings__no_content" => "Нет контента",
    "admin__apps__settings__static" => "Статический",
    "admin__apps__settings__not_static" => "Не статичны",
    "admin__apps__settings__size" => "Размер и ориентация",
    "admin__apps__settings__no_container_css" => "Нет контейнера CSS",
    "admin__apps__settings__no_container_fluid_css" => "Нет контейнера жидкости CSS",
    "admin__apps__settings__no_app_css" => "Нет приложения CSS",
    "admin__apps__settings__container_fluid" => "контейнер-жидкость",
    "admin__apps__settings__container" => "Контейнер",
    "admin__apps__settings__apps" => "Приложения",
    "admin__apps__settings__save" => "Сохранить",
    "admin__apps__settings__cache" => "Используйте кэш приложений",
    "admin__apps__settings__js_cache" => "Использование кэша JavaScript",
    "admin__apps__settings__css_cache" => "Использование кэша CSS",
];