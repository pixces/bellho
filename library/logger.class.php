<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 12/05/15
 * Time: 10:51 PM
 */

class Logger {

    const INFO = 'info';
    const DEBUG = 'debug';
    const API = 'api';
    const ERROR = 'error';
    const NOTICE = 'notice';
    const WARNING = 'waring';
    const ALERT = 'alert';

    /**
     * @param $message
     * @param string $priority
     * @return int
     */
    public static function log($message,$priority=self::INFO)
    {
        $appEnv = "development";

        if ($appEnv == 'development'){
            $logPath = ROOT . '/tmp/' . 'application_' . date('Ymd') . '.log';
        } else {
            $logPath = ROOT . '/tmp/' . $priority . '_' . date('Ymd') . '.log';
        }

        $logText = sprintf("%s\t%s\t%s\n",date('c'), strtoupper($priority), json_encode($message));
        return file_put_contents($logPath, $logText, FILE_APPEND | LOCK_EX);
    }
} 