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
 * @description     Allows other apps to send messages through the set-up mailmail mailboxes. Creates logs for advanced
 *                  information and a widget for the dashboard.
 */

// Strings.
$strings = [
    "appnetos__mailer__widget_header" => "Remitente",
    "appnetos__mailer__widget_sent" => "Expedido",
    "appnetos__mailer__widget_failed" => "Ha fallado",
    "appnetos__mailer__widget_last_sent" => "Último registro de confirmación",
    "appnetos__mailer__widget_last_failed" => "Último registro de errores",
    "appnetos__mailer__widget_datetime" => "Fecha y hora",
    "appnetos__mailer__widget_address" => "Dirección de correo electrónico",
    "appnetos__mailer__widget_message" => "Mensaje",
    "appnetos__mailer__widget_word_info" => "Información",
    "appnetos__mailer__widget_blacklist" => "Coincidencia de lista negra",
    "appnetos__mailer__widget_mailbox" => "Buzón",
    "appnetos__mailer__widget_ip" => "IP",
    "appnetos__mailer__widget_not_defined" => "Indefinido",
    "appnetos__mailer__widget_logs" => "Registros de Mailer",
    "appnetos__mailer__widget_reset_counter" => "Restablecer contador",
    "appnetos__mailer__widget_conf_counter_reset" => "El contador se ha restablecido",
    "appnetos__mailer__error_id_set" => "La identificación del remitente no está establecida",
    "appnetos__mailer__error_mailbox_set" => "Buzón no configurado",
    "appnetos__mailer__error_to_addr_set" => "Dirección de correo electrónico del destinatario no establecida",
    "appnetos__mailer__error_body_set" => "Contenido no establecido",
    "appnetos__mailer__error_id_match" => "La identificación del remitente no coincide",
    "appnetos__mailer__error_to_addr" => "La dirección de correo electrónico del destinatario es incorrecta",
    "appnetos__mailer__error_mailbox_ex" => "Buzón no existe",
    "appnetos__mailer__error_phpmailer" => "Error de PHP Mailer",
    "appnetos__mailer__error_email_in_blacklist" => "La dirección de correo electrónico está en la lista negra",
    "appnetos__mailer__error_email_to_blacklist" => "Demasiadas solicitudes de correo electrónico. La dirección de correo electrónico se ha establecido en la lista negra",
    "appnetos__mailer__error_email" => "Email",
    "appnetos__mailer__error_limit" => "Límite",
    "appnetos__mailer__error_no_settings" => "No hay configuración de correo disponible.",
    "appnetos__mailer__error_no_mailboxes" => "No hay buzones de correo.",
    "appnetos__mailer__error_ip_in_blacklist" => "La dirección IP está en la lista negra",
    "appnetos__mailer__error_ip_to_blacklist" => "Demasiadas solicitudes de correo electrónico. La dirección IP ha sido incluida en la lista negra",
];