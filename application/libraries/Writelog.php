<?php

/**
 * @package 写日志的综合类
 * @author tom
 * @since 2014-04-23
 */
class Writelog {

    /**
     *
     * @param type $logFileName log文件名字
     * @param type $text log内容
     * @param type $path 指定路径，不要用/结尾
     */
    public static function normal($logfilename, $text, $path = '.') {
        $path = dirname(BASEPATH) . "/application/logs/" . $path . '/';
        $file = $path . $logfilename; //在NAS服务器上面的目录，节约点117的空间
        file_put_contents($file, date('Y-m-d H:i:s') . "\t" . $text, FILE_APPEND);
    }

    /**
     * 按天或按月记录的日志，有利于缩减单文件体积
     *
     * @param type $type 日志种类，日志文件名以种类开头再加上年月日
     * @param type $message 日志内容
     */
    public static function daily($type, $message, $path = '.', $month = false) {
        if ($month) {
            $date = date('Ym');
        } else {
            $date = date('Ymd');
        }
        $logFileName = $type . '.' . $date . '.log';
        self::normal($logFileName, $message, $path);
    }

}

?>
