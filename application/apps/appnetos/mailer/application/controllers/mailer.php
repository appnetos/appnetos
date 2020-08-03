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

// Namespace.
namespace appnetos;

// Use.
use core\objects;
use PHPMailer\PHPMailer\PHPMailer;

// Controller "appnetos\mailer"
class mailer
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Mailer unique ID must be set by the app that sends the mail and match with the mailer session->id.
     *
     * @var string.
     */
    public $id = null;

    /**
     * Mailer mailbox name to send.
     *
     * @var string.
     */
    public $mailbox = null;

    /**
     * Recipient mail address.
     *
     * @var string.
     */
    public $toAddress = null;

    /**
     * Sender mail address.
     *
     * @var string.
     */
    public $fromAddress = null;

    /**
     * Sender name.
     *
     * @var string.
     */
    public $fromName = null;

    /**
     * Subject.
     *
     * @var string.
     */
    public $subject = null;

    /**
     * Body.
     *
     * @var string.
     */
    public $body = null;

    /**
     * Is HTML mail.
     *
     * @var bool.
     */
    public $isHtml = true;

    /**
     * Charset.
     *
     * @var string.
     */
    public $charset = 'UTF-8';

    /**
     * Error message.
     *
     * @var string.
     */
    public $message = null;

    /**
     * Mailer SESSION parameters as \stdClass.
     *
     * @var \stdClass.
     */
    protected $session = null;

    /**
     * Model "appnetos\mailer__settings".
     *
     * @var object.
     */
    protected $_mailerSettings = null;

    /**
     * Model "appnetos\mailer__mailboxes_list".
     *
     * @var object.
     */
    protected $_mailerMailboxesList = null;

    /**
     * Controller "core/extensions".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * mailer constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Get model "appnetos/mailer__settings".
        $this->_mailerSettings = objects::get('appnetos/mailer__settings');
        $this->_mailerSettings->init();

        // Get model "appnetos/mailer__mailboxes_list".
        $this->_mailerMailboxesList = objects::get('appnetos/mailer__mailboxes_list');
        $this->_mailerMailboxesList->init();

        // Get model "appnetos/mailer__mailboxes_list".
        $this->_mailerMailboxesList = objects::get('appnetos/mailer__mailboxes_list');
        $this->_mailerMailboxesList->init();

        // Prepare parameters.
        $this->session = new \stdClass();

        // Get SESSION parameters.
        $session = objects::get('session')->get('APPNETOS_MAILER');
        if ($session) {
            $this->session = json_decode($session);
        }
        else {
            $this->session->id = $this->generateUuid();
            objects::get('session')->set('APPNETOS_MAILER', json_encode($this->session));
        }
    }

    /**
     * Send mail.
     *
     * @return bool.
     * @throws \PHPMailer\PHPMailer\Exception.
     * @throws \core\exception.
     */
    public function send()
    {
        // Get objects.
        $this->_extensions = objects::get('extensions');
        $strings = objects::get('strings');

        // If models not set.
        if (!$this->_mailerSettings) {
            return $this->error('appnetos__mailer__error_no_settings');
        }
        if (!$this->_mailerMailboxesList) {
            return $this->error('appnetos__mailer__error_no_mailboxes');
        }

        // Check if parameters exists.
        if (!$this->id) {
            return $this->error('appnetos__mailer__error_id_set');
        }
        if (!$this->toAddress) {
            return $this->error('appnetos__mailer__error_to_addr_set');
        }
        if (!$this->body or $this->body === '') {
            return $this->error('appnetos__mailer__error_body_set');
        }

        // Check mailbox.
        if (!$this->mailbox) {
            $this->mailbox = $this->_mailerSettings->defaultMailbox;
        }
        if (!$this->mailbox) {
            return $this->error('appnetos__mailer__error_mailbox_set');
        }
        $mailbox = null;
        foreach ($this->_mailerMailboxesList->mailboxesList as $mailerMailbox) {
            if ($mailerMailbox->uuid === $this->mailbox) {
                $mailbox = $mailerMailbox;
                break;
            }
        }
        if (!$mailbox) {
            return $this->error('appnetos__mailer__error_mailbox_ex');
        }

        // Check parameters.
        if ($this->id !== $this->session->id) {
            return $this->error('appnetos__mailer__error_id_match');
        }
        if (!filter_var($this->toAddress, FILTER_VALIDATE_EMAIL)) {
            return $this->error('appnetos__mailer__error_to_addr');
        }

        // Get model "appnetos/mailer__blacklist_list".
        $blacklistList = objects::get('appnetos/mailer__blacklist_list');
        $blacklistList->init();

        // Check firewall.
        if ($mailbox->firewall) {
            $checkBlacklist = $blacklistList->check($this->toAddress);
            if ($checkBlacklist !== true) {
                return $this->error($checkBlacklist);
            }
        }

        // Prepare parameters.
        if (!$this->subject || $this->subject === '') {
            $this->subject = $strings->get('appnetos__mailer__standard');
        }
        if (!$this->fromAddress || $this->fromAddress === '') {
            $this->fromAddress = $mailbox->address;
        }
        if (!$this->fromName || $this->fromName === '') {
            if ($mailbox->fromName) {
                $this->fromName = $mailbox->fromName;
            }
            else {
                $this->fromName = "APPNET OS";
            }
        }
        $bodyHtml = $this->body;
        $bodyText = strip_tags(str_replace(['<br>', "\n", "\r"], "\n", $this->body));

        // Include PHP Mailer.
        include_once ('core/components/phpmailer/PHPMailer.php');
        include_once ('core/components/phpmailer/Exception.php');
        include_once ('core/components/phpmailer/SMTP.php');
        include_once ('core/components/phpmailer/POP3.php');
        include_once ('core/components/phpmailer/OAuth.php');
        $PHPMailer = new PHPMailer();
        $PHPMailer->Host = $mailbox->host;
        $PHPMailer->Port = $mailbox->port;
        $PHPMailer->Username = $mailbox->user;
        $PHPMailer->Password = $mailbox->pass;
        $PHPMailer->Timeout = $mailbox->timeout;
        if ($mailbox->smtp) {
            $PHPMailer->isSMTP();
            if ($mailbox->smtpAuthentication) {
                $PHPMailer->SMTPAuth = true;
            }
            if ($mailbox->smtpSecure) {
                $PHPMailer->SMTPSecure = $mailbox->smtpSecure;
            }
            else {
                $PHPMailer->SMTPSecure = null;
            }
        }
        $PHPMailer->setFrom($this->fromAddress, $this->fromName);
        $PHPMailer->CharSet = $this->charset;
        $PHPMailer->addAddress($this->toAddress);
        $PHPMailer->Subject = $this->subject;
        if ($this->isHtml) {
            $PHPMailer->isHTML(true);
            $PHPMailer->Body = $bodyHtml;
            $PHPMailer->AltBody = $bodyText;
        }
        else {
            $PHPMailer->isHTML(false);
            $PHPMailer->Body = $bodyText;
            $PHPMailer->AltBody = $bodyText;
        }

        // Send Mail.
        try {
            $PHPMailer->send();
        } catch(\Exception $e) {
            throw new exception($e->getMessage());
        }

        // If PHPMailer error.
        if ($PHPMailer->isError()) {
            return $this->error('appnetos__mailer__error_phpmailer', $PHPMailer->ErrorInfo);
        }

        // Generate mailer confirm log.
        $mailerLogsList = objects::get('appnetos/mailer__logs_list');
        $mailerLogConfirm = objects::getNew('appnetos/mailer__log_confirm');

        // Get IP address.
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $mailerLogConfirm->ip = $ip;
        $mailerLogConfirm->address = $this->toAddress;
        $mailerLogConfirm->mailboxUuid = $this->mailbox;
        $mailerLogConfirm->timestamp = time();
        $mailerLogsList->addConfirm($mailerLogConfirm);

        // Raise mailbox confirm count.
        $this->_mailerMailboxesList->raiseConfirmCount($this->mailbox);

        // Raise widget confirm count.
        $logCount = $this->_extensions->get('varchar', 7, 'appnetos/mailer');
        if ($logCount) {
            $logCount = json_decode($logCount);
            $logCount->confirm++;
            $this->_extensions->set(json_encode($logCount) ,'varchar', 7, 'appnetos/mailer');
        }
        else {
            $this->_extensions->set('{"error":0,"confirm":1}' ,'varchar', 7, 'appnetos/mailer');
        }

        // Generate new mailer ID.
        $this->newId();

        // Return.
        return true;
    }

    /**
     * Generate mailer error log.
     *
     * @param string $key objects "core\strings" key.
     * @param string $errorInfo PHP Mailer error info.
     * @return bool.
     * @throws \core\exception.
     */
    private function error($key, $errorInfo = null)
    {
        // Generate mailer confirm log.
        $mailerLogsList = objects::get('appnetos/mailer__logs_list');
        $mailerLogsList->init();
        $mailerLogError = objects::getNew('appnetos/mailer__log_error');

        // Get IP address.
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $mailerLogError->ip = $ip;
        $mailerLogError->address = $this->toAddress;
        $mailerLogError->mailboxUuid = $this->mailbox;
        $mailerLogError->timestamp = time();
        $mailerLogError->message = $key;
        $mailerLogError->phpMailerInfo = $errorInfo;
        $mailerLogsList->addError($mailerLogError);

        // Raise mailbox error count.
        $this->_mailerMailboxesList->raiseErrorCount($this->mailbox);

        // Raise widget error count.
        $logCount = $this->_extensions->get('varchar', 7, 'appnetos/mailer');
        if ($logCount) {
            $logCount = json_decode($logCount);
            $logCount->error++;
            $this->_extensions->set(json_encode($logCount) ,'varchar', 7, 'appnetos/mailer');
        }
        else {
            $this->_extensions->set('{"error":1,"confirm":0}' ,'varchar', 7, 'appnetos/mailer');
        }

        // Generate new mailer ID.
        $this->newId();

        // Return false.
        return false;
    }

    /**
     * Generate new mailer ID.
     */
    protected function newId()
    {
        $this->session->id = $this->generateUuid();
        objects::get('core\session')->set('appnetos__mailer', json_encode($this->session));
    }

    /**
     * Generate UUID.
     *
     * return string.
     */
    protected function generateUuid()
    {
        return strtoupper(
            sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0fff ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            ));
    }

    /**
     * Get mailer unique ID.
     *
     * @return string.
     */
    public function getId()
    {
        // Get mailer unique ID.
        if (isset($this->session->id)) {
            return $this->session->id;
        }
    }
}