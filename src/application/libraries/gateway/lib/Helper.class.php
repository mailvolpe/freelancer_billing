<?php

/***
 * Helper functions
 */
class Helper
{

    /***
     * @param $date
     * @return bool|string
     */
    public static function formatDate($date)
    {
        $format = DateTime::ATOM;
        if ($date instanceof DateTime) {
            $d = $date->format($format);
        } elseif (is_numeric($date)) {
            $d = date($format, $date);
        } else {
            $d = (string) $date;
        }
        return $d;
    }

    /***
     * @param $value
     * @return string
     */
    public static function intFormat($value)
    {
        if (is_float($value)) {
            $value = (float) $value;
            $value = floor($value * 100) / 100;
            $value = (string) number_format($value, 2, '.', '');
        }
        return str_replace(".", "", $value);
    }	
	
    /***
     * @param $value
     * @return string
     */
    public static function decimalFormat($value)
    {
        if (is_float($value)) {
            $value = (float) $value;
            $value = floor($value * 100) / 100;
            $value = (string) number_format($value, 2, '.', '');
        }
        return $value;
    }

    /***
     * @param $date
     * @param $days
     * @return bool|string
     */
    public static function subDays($date, $days)
    {
        $d = self::formatDate($date);
        $d = date_parse($d);
        $d = mktime($d['hour'], $d['minute'], $d['second'], $d['month'], $d['day'] - $days, $d['year']);
        return self::formatDate($d);
    }

    /***
     * @param $var
     * @param null $dump
     */
    public static function printError($var, $dump = null)
    {
        if (is_array($var) || is_object($var)) {
            echo "<pre>";
            if ($dump) {
                var_dump($var);
            } else {
                print_r($var);
            }
            echo "</pre>";
        }
    }

    /***
     * Remove left, right and inside extra spaces in string
     * @param string $string
     * @return string
     */
    public static function removeStringExtraSpaces($string)
    {
        return trim(preg_replace("/( +)/", " ", $string));
    }

    /***
     * Perform truncate of string value
     * @param string $string
     * @param int $limit
     * @param mixed $endchars
     * @return string
     */
    public static function truncateValue($string, $limit, $endchars = '...')
    {

        if (!is_array($string) && !is_object($string)) {

            $stringLength = strlen($string);
            $endcharsLength = strlen($endchars);

            if ($stringLength > (int) $limit) {
                $cut = (int) ($limit - $endcharsLength);
                $string = substr($string, 0, $cut) . $endchars;
            }
        }
        return $string;
    }

    /***
     * Return formatted string to send in request
     * @param string $string
     * @param int $limit
     * @param mixed $endchars
     * @return string
     */
    public static function formatString($string, $limit, $endchars = '...')
    {
        $string = Helper::removeStringExtraSpaces($string);
        return Helper::truncateValue($string, $limit, $endchars);
    }

    /***
     * Check if var is empty
     * @param string $value
     * @return boolean
     */
    public static function isEmpty($value)
    {
        return (!isset($value) || trim($value) == "");
    }

    /***
     * Check if notification post is empty
     * @param array $notification_data
     * @return boolean
     */
    public static function isNotificationEmpty(array $notification_data)
    {
        $isEmpty = true;

        if (isset($notification_data['notificationCode']) && isset($notification_data['notificationType'])) {
            $isEmpty = (Helper::isEmpty($notification_data['notificationCode']) ||
                            Helper::isEmpty($notification_data['notificationType'])
                       );
        }

        return $isEmpty;
    }

    /***
     * Remove all non digit character from string
     * @param string $value
     * @return string
     */
    public static function getOnlyNumbers($value)
    {
        return preg_replace('/\D/', '', $value);
    }
}