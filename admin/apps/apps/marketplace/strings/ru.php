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
 * @description     APPNET OS Marketplace.
 */

// Language strings.
$strings = [
    "admin__apps__marketplace__downloads" => "мои-приложения",
    "admin__apps__marketplace__cart" => "kорзину",

    "admin__apps__marketplace__menu_header" => "Рынке",
    "admin__apps__marketplace__marketplace" => "Рынке",
    "admin__apps__marketplace__info" => "Вы ищете конкретное приложение или приложение для вашего веб-приложения. На рынке APPNET OS вы найдете приложения для каждого случая использования. Вы еще не зарегистрированы. Зарегистрируйтесь бесплатно на www.appnetos.com сегодня и воспользоваться многими преимуществами. Просматривайте рынок APPNET OS непосредственно из области администрирования. Установка новых приложений и обновление уже установленных приложений.",
    "admin__apps__marketplace__search" => "Поиск",
    "admin__apps__marketplace__all_categories" => "Все категории",
    "admin__apps__marketplace__default" => "Стандартный",
    "admin__apps__marketplace__name_up" => "Имя восходящее",
    "admin__apps__marketplace__name_down" => "Название нисходящей",
    "admin__apps__marketplace__price_up" => "Цена растет",
    "admin__apps__marketplace__price_down" => "Снижение цен",
    "admin__apps__marketplace__rating_up" => "Рейтинг восходящего",
    "admin__apps__marketplace__rating_down" => "Рейтинг нисходящей",
    "admin__apps__marketplace__sign_in" => "Войти",
    "admin__apps__marketplace__sign_out" => "Выйти из системы",
    "admin__apps__marketplace__sign_up" => "Зарегистрировать",
    "admin__apps__marketplace__my_apps" => "Мои приложения",
    "admin__apps__marketplace__my_cart" => "Корзину",
    "admin__apps__marketplace__close" => "Закрыть",
    "admin__apps__marketplace__email_or_username" => "Электронная почта или имя пользователя",
    "admin__apps__marketplace__password" => "Пароль",
    "admin__apps__marketplace__sign_in_info" => "Учетные данные",
    "admin__apps__marketplace__sign_in_err_user" => "Пожалуйста, введите имя пользователя",
    "admin__apps__marketplace__sign_in_err_pass" => "Пожалуйста, введите пароль",
    "admin__apps__marketplace__err_connection" => "Подключение APPNET OS не удалось",
    "admin__apps__marketplace__access_denied" => "Доступ отказано",
    "admin__apps__marketplace__no_apps" => "Нет доступных приложений",
    "admin__apps__marketplace__not_signed_in" => "Вы не вошли в систему в APPNET OS",
    "admin__apps__marketplace__download_and_install" => "Скачать и установить",
    "admin__apps__marketplace__download_and_update" => "Скачать и обновить",
    "admin__apps__marketplace__update" => "Обновление",
    "admin__apps__marketplace__err_zip_extension" => "Расширение PHP .zip не присутствует",
    "admin__apps__marketplace__err_zip_open" => "Файл .zip не может быть открыт",
    "admin__apps__marketplace__err_file" => "Ошибка в файле установки",
    "admin__apps__marketplace__warning" => "Предупреждение об установке",
    "admin__apps__marketplace__installed" => "Установлены",
    "admin__apps__marketplace__app_id" => "Идентификатор приложения",
    "admin__apps__marketplace__consisting_version" => "Установленная версия",
    "admin__apps__marketplace__unknown" => "Неизвестный",
    "admin__apps__marketplace__version" => "Версия",
    "admin__apps__marketplace__size" => "Размер",
    "admin__apps__marketplace__warning_installed _no_data" => "Приложение уже загружено и установлено. Информации о рынке нет. Обновление может уничтожить приложение безвозвратно.",
    "admin__apps__marketplace__consisting_filesystem_installer" => "Уже есть файловая система приложения и установщик приложения. Загрузка перезаписывает существующую файловую систему",
    "admin__apps__marketplace__consisting_filesystem" => "Существует уже файловая система приложения, но не установщик приложения. Загрузка перезаписывает существующую файловую систему",
    "admin__apps__marketplace__install_text" => "Важное примечание. AppNET OS Marketplace Apps тщательно проверяются. Тем не менее, мы рекомендуем вам создать резервную базу данных перед установкой или обновлением приложения APPNET OS и xtrose Media Studio, не нанеся никакой ответственности за ущерб, причиненный установками и обновлениями приложений. За технической помощью обратитесь в службу поддержки разработчика.",
    "admin__apps__marketplace__installation" => "Установки",
    "admin__apps__marketplace__please_wait" => "Подождите",
    "admin__apps__marketplace__next" => "Следующий",
    "admin__apps__marketplace__conf_install" => "Установка завершена",
    "admin__apps__marketplace__conf_update" => "Обновление завершено",
    "admin__apps__marketplace__download_status_higher" => "Доступна новая версия",
    "admin__apps__marketplace__download_status_lower" => "Доступна более старая версия",
    "admin__apps__marketplace__download_status_same" => "Эта версия доступна",
    "admin__apps__marketplace__download_available_version" => "Существующая версия",
    "admin__apps__marketplace__download_status_unknown" => "Неизвестная версия доступна",
    "admin__apps__marketplace__download_status_none" => "Недоступно",
    "admin__apps__marketplace__install_status_false" => "Не установлено",
    "admin__apps__marketplace__install_status_true" => "Установлены",
    "admin__apps__marketplace__info_install" => "Установка с установкой приложений",
    "admin__apps__marketplace__description" => "Описание",
    "admin__apps__marketplace__developer" => "Разработчик",
    "admin__apps__marketplace__versions_licenses" => "Версии и лицензии",
    "admin__apps__marketplace__rating" => "Отзыв",
    "admin__apps__marketplace__no_rating" => "Пока нет рейтинга",
    "admin__apps__marketplace__tax_include" => "С включая НДС",
    "admin__apps__marketplace__add_to_cart" => "Добавить в корзину",
    "admin__apps__marketplace__add_to_cart_sign_in" => "Подпишитесь на тележку",
    "admin__apps__marketplace__open_in_marketplace" => "Открыто на рынке",
    "admin__apps__marketplace__err_not_signed_in" => "Вы не подписаны в",
    "admin__apps__marketplace__conf_add_to_cart" => "Приложение было добавлено в корзину",
    "admin__apps__marketplace__cart_empty" => "Ваша тележка пуста",
    "admin__apps__marketplace__conf_remove_from_cart" => "Приложение было удалено из корзины",
    "admin__apps__marketplace__conf_edit_cart" => "Корзина была обновлена",
    "admin__apps__marketplace__button_checkout" => "Оформления заказа",
    "admin__apps__marketplace__refresh" => "Фактическое",
    "admin__apps__marketplace__refresh_text" => "После завершения покупки корзина изменилась.",
    "admin__apps__marketplace__download_and_overwrite" => "Скачать и перезаписать",
    "admin__apps__marketplace__warning_overwrite" => "Приложение имеет тот же номер версии, но другое состояние. При установке существующее приложение перезаписано.",
    "admin__apps__marketplace__download_status_other" => "Версия с другой доступен состояние мгновесвоера версии",
];