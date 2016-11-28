<?php

namespace common\components;

use common\models\db\Store;
use common\models\db\SystemCurrency;
use common\models\db\SystemWeightUnit;
use common\models\enu\StoreConfig;
use common\models\service\SiteService;
use Yii;

class TextUtility
{
    public static function setIdentityUser($user)
    {
        $str = $user->id . '@@' . $user->password;
        return base64_encode($str);
    }

    public static function getIdentityUser($key)
    {
        $identity = base64_decode($key);
        return explode('@@', $identity);
    }

    public static function convertWeightCharge($weight, $weightUnitId)
    {
        $currWeight = SystemWeightUnit::findOne(['id' => $weightUnitId]);
        $exWeight = SystemWeightUnit::findOne(['IsMainUnit' => 1]);

        $weight = ($weight * $exWeight->Ratio) / $currWeight->Ratio;
        $range = 1;
        if ($weight % 500 != 0) {
            $range = 1 + (int)(weight / 500);
        } else {
            $range = $weight / 500;
        }
        $weight = $range * 500;

        return $weight;

    }

    public static function roundPrice($price, $storeId)
    {
        $storeData = SiteService::getStoreById($storeId);

        if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopmy']) {
            $price = round($price, 2);
        } elseif (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopsg']) {
            $price = round($price, 2);
        } elseif (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopid']) {
            $price = round($price, 0);
        } elseif (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopph']) {
            $price = round($price, 0);
        } else {
            $price = round($price, 0);
        }

        return $price;
    }


    public static function convertTimeFormat($time)
    {
        $timestamp = strtotime($time);
        $numberDayWeek = self::getDayByTime($timestamp);
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('Y', $timestamp);

        return RedisLanguage::getLanguageByKey('payment-create-date-label', 'Create Date:') . ' ' . $day . '/' . $month . '/' . $year;
    }

    public static function convertTimeToVN($time)
    {
        $timestamp = strtotime($time);
        $numberDayWeek = self::getDayByTime($timestamp);
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('Y', $timestamp);

        return $numberDayWeek . ', ngày ' . $day . ' tháng ' . $month . ' năm ' . $year;
    }

    public static function getDayByTime($time)
    {
        $dayWeek = date('D', $time);
        $numberDayWeek = 'Thứ 2';
        switch ($dayWeek) {
            case 'Mon' :
                $numberDayWeek = 'Thứ 2';
                break;
            case 'Tue' :
                $numberDayWeek = 'Thứ 3';
                break;
            case 'Wed' :
                $numberDayWeek = 'Thứ 4';
                break;
            case 'Thu' :
                $numberDayWeek = 'Thứ 5';
                break;
            case 'Fri' :
                $numberDayWeek = 'Thứ 6';
                break;
            case 'Sat' :
                $numberDayWeek = 'Thứ 7';
                break;
            case 'Sun' :
                $numberDayWeek = 'Chủ nhật';
                break;
        }
        return $numberDayWeek;
    }

    public static function createBinCodeOrder($orderId, $storeId, $privateKey = 'PS@2016', $result = '')
    {
        if ($orderId && $storeId) {
            $key = md5($orderId . $privateKey . $storeId);
            $key = substr($key, 0, 4);
            $rand = rand(0, 9);
            $result = $key . $orderId . $rand . 'b';
        }
        return $result;
    }

    static function reformatSQLTime($sqlTime, $returnType)
    {
        $time = strtotime($sqlTime);
        return date($returnType, $time);
    }

    static function datetimeByUnixTime($time = null)
    {
        $time = $time == null ? time() : $time;
        return date("Y-m-d H:i:s", $time);
    }

    static function appendYearToCurrentTime($day = 1)
    {
        $current = self::datetimeByUnixTime() . " + " . $day . " years";

        return date("Y-m-d H:i:s", strtotime($current));
    }

    static function validateDate($date, $format = 'd-m-Y H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Get Ip client
     *
     * @return type
     */
    public static function getClientIP()
    {
        if (isset ($_SERVER)) {
            if (isset ($_SERVER ["HTTP_X_FORWARDED_FOR"]))
                return $_SERVER ["HTTP_X_FORWARDED_FOR"];
            if (isset ($_SERVER ["HTTP_CLIENT_IP"]))
                return $_SERVER ["HTTP_CLIENT_IP"];
            return $_SERVER ["REMOTE_ADDR"];
        }
        if (getenv('HTTP_X_FORWARDED_FOR'))
            return getenv('HTTP_X_FORWARDED_FOR');
        if (getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');
        return getenv('REMOTE_ADDR');
    }

    public static function base64Encode($str)
    {
        $str = base64_encode($str);
        $str = str_replace([
            '=',
            '+',
            '/',
            '\\'
        ], [
            'dAUbAwnGf',
            'dAuCOonGj',
            'GAcHjpHaIr',
            'gAcHjTraIs'
        ], $str);
        return $str;
    }

    public static function base64Decode($str)
    {
        $str = str_replace([
            'dAUbAwnGf',
            'dAuCOonGj',
            'GAcHjpHaIr',
            'gAcHjTraIs'
        ], [
            '=',
            '+',
            '/',
            '\\'
        ], $str);
        $str = base64_decode($str);
        return $str;
    }

    static function startsWith($haystack, $needle)
    {
        return strncmp($haystack, $needle, strlen($needle)) === 0;
    }

    static function startWith2($haystack, $needle)
    {
        return 0 === strpos($needle, $haystack);
    }

    static function endsWith($haystack, $needle)
    {
        return $needle === '' || substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }

    public static function is_json($string, $return_data = false)
    {
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : true) : false;
    }

    /**
     *
     * @param type $string
     * @return type
     */
    public static function encode_keyword($string = "")
    {
        $string = trim(self::removeMarks($string));
        $string = preg_replace('/\-/', '+', $string);
        return $string;
    }

    /**
     *
     * @param type $string
     * @return type
     */
    public static function decode_keyword($string = "")
    {
        $string = trim($string);
        $string = preg_replace('/+/', ' ', $string);
        return $string;
    }

    /**
     *
     * @return string
     */
    public static function randomString()
    {
        $validCharacters = "abcdefghijklmnopqrstuxyvwz";
        $validCharNumber = strlen($validCharacters);

        $index = mt_rand(0, $validCharNumber - 1);
        $randomCharacter = $validCharacters [$index];

        return $randomCharacter;
    }

    /**
     *
     * @param type $root
     * @param type $level
     * @param type $genDate
     * @return string
     */
    public static function randomPathfile($root = '', $level = 2, $genDate = true)
    {
        if ($genDate) {
            $date = getdate();
            $root .= $date ["mday"] . '-' . $date ["mon"] . '-' . $date ["year"] . '/' . $date ["hours"] . '/';
        }
        for ($i = 1; $i <= $level; $i++) {
            $root .= self::randomString() . '/';
        }
        $root = strtolower($root);
        if (!file_exists($root)) {
            mkdir($root, 0755, true);
        }
        return $root;
    }

    /**
     * Kiểm tra sự tồn tại của url
     *
     * @param type $uri
     * @return boolean
     */
    public static function exists($uri)
    {
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $code == 200;
    }

    public static function removeUnicodeForSms($in)
    {
        $marTViet = [
            'à',
            'á',
            'ạ',
            'ả',
            'ã',
            'â',
            'ầ',
            'ấ',
            'ậ',
            'ẩ',
            'ẫ',
            'ă',
            'ằ',
            'ắ',
            'ặ',
            'ẳ',
            'ẵ',
            'è',
            'é',
            'ẹ',
            'ẻ',
            'ẽ',
            'ê',
            'ề',
            'ế',
            'ệ',
            'ể',
            'ễ',
            'ì',
            'í',
            'ị',
            'ỉ',
            'ĩ',
            'ò',
            'ó',
            'ọ',
            'ỏ',
            'õ',
            'ô',
            'ồ',
            'ố',
            'ộ',
            'ổ',
            'ỗ',
            'ơ',
            'ờ',
            'ớ',
            'ợ',
            'ở',
            'ỡ',
            'ù',
            'ú',
            'ụ',
            'ủ',
            'ũ',
            'ư',
            'ừ',
            'ứ',
            'ự',
            'ử',
            'ữ',
            'ỳ',
            'ý',
            'ỵ',
            'ỷ',
            'ỹ',
            'đ',
            'À',
            'Á',
            'Ạ',
            'Ả',
            'Ã',
            'Â',
            'Ầ',
            'Ấ',
            'Ậ',
            'Ẩ',
            'Ẫ',
            'Ă',
            'Ằ',
            'Ắ',
            'Ặ',
            'Ẳ',
            'Ẵ',
            'È',
            'É',
            'Ẹ',
            'Ẻ',
            'Ẽ',
            'Ê',
            'Ề',
            'Ế',
            'Ệ',
            'Ể',
            'Ễ',
            'Ì',
            'Í',
            'Ị',
            'Ỉ',
            'Ĩ',
            'Ò',
            'Ó',
            'Ọ',
            'Ỏ',
            'Õ',
            'Ô',
            'Ồ',
            'Ố',
            'Ộ',
            'Ổ',
            'Ỗ',
            'Ơ',
            'Ờ',
            'Ớ',
            'Ợ',
            'Ở',
            'Ỡ',
            'Ù',
            'Ú',
            'Ụ',
            'Ủ',
            'Ũ',
            'Ư',
            'Ừ',
            'Ứ',
            'Ự',
            'Ử',
            'Ữ',
            'Ỳ',
            'Ý',
            'Ỵ',
            'Ỷ',
            'Ỹ',
            'Đ'
        ];

        $marKoDau = [
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'y',
            'y',
            'y',
            'y',
            'y',
            'd',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'I',
            'I',
            'I',
            'I',
            'I',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'Y',
            'Y',
            'Y',
            'Y',
            'Y',
            'D'
        ];
        $in = str_replace($marTViet, $marKoDau, $in);
        return $in;
    }

    public static function removeUnicode($in, $removeSpace = true)
    {
        $marTViet = [
            'à',
            'á',
            'ạ',
            'ả',
            'ã',
            'â',
            'ầ',
            'ấ',
            'ậ',
            'ẩ',
            'ẫ',
            'ă',
            'ằ',
            'ắ',
            'ặ',
            'ẳ',
            'ẵ',
            'è',
            'é',
            'ẹ',
            'ẻ',
            'ẽ',
            'ê',
            'ề',
            'ế',
            'ệ',
            'ể',
            'ễ',
            'ì',
            'í',
            'ị',
            'ỉ',
            'ĩ',
            'ò',
            'ó',
            'ọ',
            'ỏ',
            'õ',
            'ô',
            'ồ',
            'ố',
            'ộ',
            'ổ',
            'ỗ',
            'ơ',
            'ờ',
            'ớ',
            'ợ',
            'ở',
            'ỡ',
            'ù',
            'ú',
            'ụ',
            'ủ',
            'ũ',
            'ư',
            'ừ',
            'ứ',
            'ự',
            'ử',
            'ữ',
            'ỳ',
            'ý',
            'ỵ',
            'ỷ',
            'ỹ',
            'đ',
            'À',
            'Á',
            'Ạ',
            'Ả',
            'Ã',
            'Â',
            'Ầ',
            'Ấ',
            'Ậ',
            'Ẩ',
            'Ẫ',
            'Ă',
            'Ằ',
            'Ắ',
            'Ặ',
            'Ẳ',
            'Ẵ',
            'È',
            'É',
            'Ẹ',
            'Ẻ',
            'Ẽ',
            'Ê',
            'Ề',
            'Ế',
            'Ệ',
            'Ể',
            'Ễ',
            'Ì',
            'Í',
            'Ị',
            'Ỉ',
            'Ĩ',
            'Ò',
            'Ó',
            'Ọ',
            'Ỏ',
            'Õ',
            'Ô',
            'Ồ',
            'Ố',
            'Ộ',
            'Ổ',
            'Ỗ',
            'Ơ',
            'Ờ',
            'Ớ',
            'Ợ',
            'Ở',
            'Ỡ',
            'Ù',
            'Ú',
            'Ụ',
            'Ủ',
            'Ũ',
            'Ư',
            'Ừ',
            'Ứ',
            'Ự',
            'Ử',
            'Ữ',
            'Ỳ',
            'Ý',
            'Ỵ',
            'Ỷ',
            'Ỹ',
            'Đ'
        ];

        $marKoDau = [
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'y',
            'y',
            'y',
            'y',
            'y',
            'd',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'I',
            'I',
            'I',
            'I',
            'I',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'Y',
            'Y',
            'Y',
            'Y',
            'Y',
            'D'
        ];
        $in = str_replace($marTViet, $marKoDau, $in);
        $in = trim(preg_replace("/[^A-Za-z0-9 -]/", '', $in));
        if ($removeSpace) {
            $in = str_replace('  ', '', $in);
            $in = str_replace(' ', '-', $in);
        }
        return $in;
    }

    /**
     * method convert unicode sang không dấu và kí tự đặc biệt
     * Input: string - Doạn chuỗi cần convert
     *
     * @param type $string
     * @return type
     */
    public static function removeMarks($string = "")
    {
        $string = trim($string);
        $string = str_replace('/', ' ', $string);
        $string = self::StripExtraSpace($string);

        $trans = array(
            'Ầ' => '',
            '.' => '',
            '!' => '',
            '&' => '',
            '/' => '',
            '+' => '',
            '?' => '',
            '#' => '',
            "'" => '',
            ':' => '',
            "ế" => "e",
            'è' => 'e',
            'é' => 'e',
            '‘' => '',
            '’' => '',
            '“' => '',
            '”' => '',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ằ' => 'a',
            'ắ' => 'a',
            'ọ' => 'o',
            'ẽ' => 'e',
            'ờ' => 'o',
            'ẹ' => 'e',
            'ặ' => 'a',
            'ề' => 'e',
            'ặ' => 'a',
            'à' => 'a',
            'á' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ẫ' => 'a',
            'ẩ' => 'a',
            'ậ' => 'a',
            'ú' => 'a',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'à' => 'a',
            'á' => 'a',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ê' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ơ' => 'o',
            'ớ' => 'o',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'ư' => 'u',
            'ừ' => 'u',
            'ứ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'đ' => 'd',
            'À' => 'A',
            'Á' => 'A',
            'Ả' => 'A',
            'Ã' => 'A',
            'Ạ' => 'A',
            'Â' => 'A',
            'Ấ' => 'A',
            'À' => 'A',
            'Ẫ' => 'A',
            'Ẩ' => 'A',
            'Ậ' => 'A',
            'Ú' => 'U',
            'Ù' => 'U',
            'Ủ' => 'U',
            'Ũ' => 'U',
            'Ụ' => 'U',
            'Ô' => 'O',
            'Ố' => 'O',
            'Ồ' => 'O',
            'Ổ' => 'O',
            'Ỗ' => 'O',
            'Ộ' => 'O',
            'Ê' => 'E',
            'Ế' => 'E',
            'Ề' => 'E',
            'Ể' => 'E',
            'Ễ' => 'E',
            'Ệ' => 'E',
            'Í' => 'I',
            'Ì' => 'I',
            'Ỉ' => 'I',
            'Ĩ' => 'I',
            'Ị' => 'I',
            'Ơ' => 'O',
            'Ớ' => 'O',
            'Ờ' => 'O',
            'Ở' => 'O',
            'Ỡ' => 'O',
            'Ợ' => 'O',
            'Ư' => 'U',
            'Ừ' => 'U',
            'Ứ' => 'U',
            'Ử' => 'U',
            'Ữ' => 'U',
            'Ự' => 'U',
            'Đ' => 'D',
            'Ý' => 'Y',
            'Ỳ' => 'Y',
            'Ỷ' => 'Y',
            'Ỹ' => 'Y',
            'Ỵ' => 'Y',
            'á' => 'a',
            'à' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'ă' => 'a',
            'ắ' => 'a',
            'ằ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'ặ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ầ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ậ' => 'a',
            'ú' => 'u',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'ư' => 'u',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'ô',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ơ' => 'o',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'đ' => 'd',
            'Đ' => 'D',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            'Á' => 'A',
            'À' => 'A',
            'Ả' => 'A',
            'Ã' => 'A',
            'Ạ' => 'A',
            'Ă' => 'A',
            'Ắ' => 'A',
            'Ẳ' => 'A',
            'Ẵ' => 'A',
            'Ặ' => 'A',
            'Â' => 'A',
            'Ấ' => 'A',
            'Ẩ' => 'A',
            'Ẫ' => 'A',
            'Ậ' => 'A',
            'É' => 'E',
            'È' => 'E',
            'Ẻ' => 'E',
            'Ẽ' => 'E',
            'Ẹ' => 'E',
            'Ế' => 'E',
            'Ề' => 'E',
            'Ể' => 'E',
            'Ễ' => 'E',
            'Ệ' => 'E',
            'Ú' => 'U',
            'Ù' => 'U',
            'Ủ' => 'U',
            'Ũ' => 'U',
            'Ụ' => 'U',
            'Ư' => 'U',
            'Ứ' => 'U',
            'Ừ' => 'U',
            'Ử' => 'U',
            'Ữ' => 'U',
            'Ự' => 'U',
            'Í' => 'I',
            'Ì' => 'I',
            'Ỉ' => 'I',
            'Ĩ' => 'I',
            'Ị' => 'I',
            'Ó' => 'O',
            'Ò' => 'O',
            'Ỏ' => 'O',
            'Õ' => 'O',
            'Ọ' => 'O',
            'Ô' => 'O',
            'Ố' => 'O',
            'Ổ' => 'O',
            'Ỗ' => 'O',
            'Ộ' => 'O',
            'Ơ' => 'O',
            'Ớ' => 'O',
            'Ờ' => 'O',
            'Ở' => 'O',
            'Ỡ' => 'O',
            'Ợ' => 'O',
            'Ý' => 'Y',
            'Ỳ' => 'Y',
            'Ỷ' => 'Y',
            'Ỹ' => 'Y',
            'Ỵ' => 'Y',
            ' ' => '-',
            'ề' => 'e',
            'ờ' => 'o',
            '(' => '',
            ')' => '',
            ',' => '',
            '%' => '',
            'ồ' => 'o',
            '_' => '',
            '=' => '',
            '"' => ''
        );
        $string = strtolower(strtr(trim($string), $trans));
        $string = self::StripExtraSub($string);
        $string = preg_replace('/\W/', '-', $string);
        return $string;
    }

    /**
     * method convert unicode sang không dấu và kí tự đặc biệt
     * Input: string - Doạn chuỗi cần convert
     *
     * @param type $string
     * @return type
     */
    public static function removeMark($string = "")
    {
        $string = trim($string);
        $string = str_replace('/', ' ', $string);
        $string = self::StripExtraSpace($string);

        $trans = array(
            'Ầ' => '',
            '.' => '',
            '!' => '',
            '&' => '',
            '/' => '',
            '+' => '',
            '?' => '',
            '#' => '',
            "'" => '',
            ':' => '',
            "ế" => "e",
            'è' => 'e',
            'é' => 'e',
            '‘' => '',
            '’' => '',
            '“' => '',
            '”' => '',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ằ' => 'a',
            'ắ' => 'a',
            'ọ' => 'o',
            'ẽ' => 'e',
            'ờ' => 'o',
            'ẹ' => 'e',
            'ặ' => 'a',
            'ề' => 'e',
            'ặ' => 'a',
            'à' => 'a',
            'á' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ẫ' => 'a',
            'ẩ' => 'a',
            'ậ' => 'a',
            'ú' => 'a',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'à' => 'a',
            'á' => 'a',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ê' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ơ' => 'o',
            'ớ' => 'o',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'ư' => 'u',
            'ừ' => 'u',
            'ứ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'đ' => 'd',
            'À' => 'A',
            'Á' => 'A',
            'Ả' => 'A',
            'Ã' => 'A',
            'Ạ' => 'A',
            'Â' => 'A',
            'Ấ' => 'A',
            'À' => 'A',
            'Ẫ' => 'A',
            'Ẩ' => 'A',
            'Ậ' => 'A',
            'Ú' => 'U',
            'Ù' => 'U',
            'Ủ' => 'U',
            'Ũ' => 'U',
            'Ụ' => 'U',
            'Ô' => 'O',
            'Ố' => 'O',
            'Ồ' => 'O',
            'Ổ' => 'O',
            'Ỗ' => 'O',
            'Ộ' => 'O',
            'Ê' => 'E',
            'Ế' => 'E',
            'Ề' => 'E',
            'Ể' => 'E',
            'Ễ' => 'E',
            'Ệ' => 'E',
            'Í' => 'I',
            'Ì' => 'I',
            'Ỉ' => 'I',
            'Ĩ' => 'I',
            'Ị' => 'I',
            'Ơ' => 'O',
            'Ớ' => 'O',
            'Ờ' => 'O',
            'Ở' => 'O',
            'Ỡ' => 'O',
            'Ợ' => 'O',
            'Ư' => 'U',
            'Ừ' => 'U',
            'Ứ' => 'U',
            'Ử' => 'U',
            'Ữ' => 'U',
            'Ự' => 'U',
            'Đ' => 'D',
            'Ý' => 'Y',
            'Ỳ' => 'Y',
            'Ỷ' => 'Y',
            'Ỹ' => 'Y',
            'Ỵ' => 'Y',
            'á' => 'a',
            'à' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'ă' => 'a',
            'ắ' => 'a',
            'ằ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'ặ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ầ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ậ' => 'a',
            'ú' => 'u',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'ư' => 'u',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'ô',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ơ' => 'o',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'đ' => 'd',
            'Đ' => 'D',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            'Á' => 'A',
            'À' => 'A',
            'Ả' => 'A',
            'Ã' => 'A',
            'Ạ' => 'A',
            'Ă' => 'A',
            'Ắ' => 'A',
            'Ẳ' => 'A',
            'Ẵ' => 'A',
            'Ặ' => 'A',
            'Â' => 'A',
            'Ấ' => 'A',
            'Ẩ' => 'A',
            'Ẫ' => 'A',
            'Ậ' => 'A',
            'É' => 'E',
            'È' => 'E',
            'Ẻ' => 'E',
            'Ẽ' => 'E',
            'Ẹ' => 'E',
            'Ế' => 'E',
            'Ề' => 'E',
            'Ể' => 'E',
            'Ễ' => 'E',
            'Ệ' => 'E',
            'Ú' => 'U',
            'Ù' => 'U',
            'Ủ' => 'U',
            'Ũ' => 'U',
            'Ụ' => 'U',
            'Ư' => 'U',
            'Ứ' => 'U',
            'Ừ' => 'U',
            'Ử' => 'U',
            'Ữ' => 'U',
            'Ự' => 'U',
            'Í' => 'I',
            'Ì' => 'I',
            'Ỉ' => 'I',
            'Ĩ' => 'I',
            'Ị' => 'I',
            'Ó' => 'O',
            'Ò' => 'O',
            'Ỏ' => 'O',
            'Õ' => 'O',
            'Ọ' => 'O',
            'Ô' => 'O',
            'Ố' => 'O',
            'Ổ' => 'O',
            'Ỗ' => 'O',
            'Ộ' => 'O',
            'Ơ' => 'O',
            'Ớ' => 'O',
            'Ờ' => 'O',
            'Ở' => 'O',
            'Ỡ' => 'O',
            'Ợ' => 'O',
            'Ý' => 'Y',
            'Ỳ' => 'Y',
            'Ỷ' => 'Y',
            'Ỹ' => 'Y',
            'Ỵ' => 'Y',
            ' ' => '-',
            'ề' => 'e',
            'ờ' => 'o',
            '(' => '',
            ')' => '',
            ',' => '',
            '%' => '',
            'ồ' => 'o',
            '_' => '',
            '=' => '',
            '"' => ''
        );
        $string = strtolower(strtr(trim($string), $trans));
        $string = self::StripExtraSub($string);
        $string = preg_replace('/\W/', '', $string);
        return $string;
    }

    /**
     *
     * @param type $s
     * @return type
     */
    private static function StripExtraSpace($s)
    {
        $newstr = "";
        for ($i = 0; $i < strlen($s); $i++) {
            $newstr = $newstr . substr($s, $i, 1);
            if (substr($s, $i, 1) == ' ')
                while (substr($s, $i + 1, 1) == ' ')
                    $i++;
        }
        $newstr = ltrim($newstr);
        $newstr = rtrim($newstr);

        return $newstr;
    }

    /**
     *
     * @param type $s
     * @return type
     */
    private static function StripExtraSub($s)
    {
        $newstr = "";
        for ($i = 0; $i < strlen($s); $i++) {
            $newstr = $newstr . substr($s, $i, 1);
            if (substr($s, $i, 1) == '-')
                while (substr($s, $i + 1, 1) == '-')
                    $i++;
        }
        $newstr = ltrim($newstr);
        $newstr = rtrim($newstr);

        return $newstr;
    }

    /* End removeMarks */
    /*
     * method cắt chuỗi utf8
     * Input: string, độ dài, kí tự nối tiếp vào string, font, ...,..
     */
    public static function mb_truncate($string, $length = 80, $etc = '...', $charset = 'UTF-8', $break_words = false, $middle = false)
    {
        if ($length == 0) {
            return '';
        }

        if (strlen($string) > $length) {
            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', mb_substr($string, 0, $length + 1, $charset));
            }
            if (!$middle) {
                return mb_substr($string, 0, $length, $charset) . $etc;
            } else {
                return mb_substr($string, 0, $length / 2, $charset) . $etc . mb_substr($string, -$length / 2, $charset);
            }
        } else {
            return $string;
        }
    }

    /**
     * Phương thức chuẩn hóa dấu cách
     *
     * @param type $str
     * @return type
     */
    public function spaceStandardized($str)
    {
        while (true) {
            if (strpos($str, '  ') != 0) {
                $str = str_replace('  ', ' ', $str);
            } else {
                break;
            }
        }
        return $str;
    }

    /**
     * Phương thức chuyển từ có chuỗi có dấu sang không dấu
     *
     * @param type $str
     * @return type
     */
    public static function convertToAscii($str)
    {
        $vnCode = array(
            'à',
            'á',
            'ạ',
            'ả',
            'ã',
            'â',
            'ầ',
            'ấ',
            'ậ',
            'ẩ',
            'ẫ',
            'ă',
            'ằ',
            'ắ',
            'ặ',
            'ẳ',
            'ẵ',
            'è',
            'é',
            'ẹ',
            'ẻ',
            'ẽ',
            'ê',
            'ề',
            'ế',
            'ệ',
            'ể',
            'ễ',
            'ì',
            'í',
            'ị',
            'ỉ',
            'ĩ',
            'ò',
            'ó',
            'ọ',
            'ỏ',
            'õ',
            'ô',
            'ồ',
            'ố',
            'ộ',
            'ổ',
            'ỗ',
            'ơ',
            'ờ',
            'ớ',
            'ợ',
            'ở',
            'ỡ',
            'ù',
            'ú',
            'ụ',
            'ủ',
            'ũ',
            'ư',
            'ừ',
            'ứ',
            'ự',
            'ử',
            'ữ',
            'ỳ',
            'ý',
            'ỵ',
            'ỷ',
            'ỹ',
            'đ',
            'À',
            'Á',
            'Ạ',
            'Ả',
            'Ã',
            'Â',
            'Ầ',
            'Ấ',
            'Ậ',
            'Ẩ',
            'Ẫ',
            'Ă',
            'Ằ',
            'Ắ',
            'Ặ',
            'Ẳ',
            'Ẵ',
            'È',
            'É',
            'Ẹ',
            'Ẻ',
            'Ẽ',
            'Ê',
            'Ề',
            'Ế',
            'Ệ',
            'Ể',
            'Ễ',
            'Ì',
            'Í',
            'Ị',
            'Ỉ',
            'Ĩ',
            'Ò',
            'Ó',
            'Ọ',
            'Ỏ',
            'Õ',
            'Ô',
            'Ồ',
            'Ố',
            'Ộ',
            'Ổ',
            'Ỗ',
            'Ơ',
            'Ờ',
            'Ớ',
            'Ợ',
            'Ở',
            'Ỡ',
            'Ù',
            'Ú',
            'Ụ',
            'Ủ',
            'Ũ',
            'Ư',
            'Ừ',
            'Ứ',
            'Ự',
            'Ử',
            'Ữ',
            'Ỳ',
            'Ý',
            'Ỵ',
            'Ỷ',
            'Ỹ',
            'Đ'
        );
        $unsignCode = array(
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'u',
            'y',
            'y',
            'y',
            'y',
            'y',
            'd',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'A',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'E',
            'I',
            'I',
            'I',
            'I',
            'I',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'O',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'U',
            'Y',
            'Y',
            'Y',
            'Y',
            'Y',
            'D'
        );
        return str_replace($vnCode, $unsignCode, $str);
    }

    /**
     * Phương thức chuyển đổi giá
     *
     * @return number
     */
    public static function convertPrice($price, $rate)
    {
        if ($price > 0) {
            $feeShip = $usTax = $feeMore = $coefficient = 0;
            $coefficient = 1.10;

            $price = $price * $coefficient;
            $price += $feeMore + $feeShip + ($price * $usTax / 100);
            if (isset ($rate) && $rate > 0) {
                $price *= $rate;
            }
            $price = $price / 1000;
            $price = round($price);
            $price = $price * 1000;
        }
        return $price;
    }

    /**
     * Phương thức chuyển đổi từ số sang chuỗi
     *
     * @param type $number
     * @param type $count
     * @return string
     */
    public static function convertNumberToString($number, $count)
    {
        $countString = strlen($number);
        $numberString = ( string )$number;
        $divAddNumber = $count - $countString;
        for ($i = 1; $i <= $divAddNumber; $i++) {
            $numberString = '0' . $numberString;
        }
        return $numberString;
    }

    /**
     * Phương thức chuyển đổi sang giờ dễ hiểu
     *
     * @param type $value
     * @return type
     */
    public static function convertTime($value)
    {
        $condition = time() - $value;
        $text = '';
        if ($condition >= 0 && $condition <= 5) {
            $text = 'Vừa xong';
        }
        if ($condition > 5 && $condition <= 60) {
            $text = $condition . ' giây trước';
        }
        if ($condition > 60 && $condition <= 3600) {
            $minute = floor($condition / 60);
            $second = $condition - ($minute * 60);
            $text = $minute . ' phút ' . $second . ' giây trước';
        }
        if ($condition > 3600 && $condition <= 86400) {
            $hour = floor($condition / 3600);
            $minute = floor(($condition - ($hour * 3600)) / 60);
            $text = $hour . ' giờ ' . $minute . ' phút trước';
        }
        if ($condition > 86400 && $condition <= 172800) {
            $text = 'Hôm qua, ' . date('H : i', $value);
        }
        if ($condition > 172800 && $condition <= 259200) {
            $text = 'Hôm kia, ' . date('H : i', $value);
        }
        if ($condition > 259200) {
            $text = date('H:i d/m/Y', $value);
        }
        return $text;
    }

    /**
     *
     * @param unknown $time
     * @return number[]
     */
    public static function timeLeft($time)
    {
        $seconds = $time - time();
        $days = floor($seconds / 86400);
        $seconds %= 86400;

        $hours = floor($seconds / 3600);
        $seconds %= 3600;

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        return array(
            'd' => $days,
            'h' => $hours,
            'm' => $minutes,
            's' => $seconds
        );
    }

    public static function getTimeByDay($time, $day = 0)
    {
        $cal = IntlCalendar::fromDateTime(date('m/d/Y', $time));
        $actualMaximum = $cal->getActualMaximum(IntlCalendar::FIELD_DAY_OF_MONTH);
        $dayOfMonth = $cal->get(IntlCalendar::FIELD_DAY_OF_MONTH) + $day;
        if ($dayOfMonth > $actualMaximum) {
            $dayOfMonth = $dayOfMonth - $actualMaximum;
            $cal->set(IntlCalendar::FIELD_DATE, $dayOfMonth);
            $cal->set(IntlCalendar::FIELD_MONTH, $cal->get(IntlCalendar::FIELD_MONTH) + 1);
        } else {
            $cal->set(IntlCalendar::FIELD_DATE, $dayOfMonth);
        }
        return $cal->getTime() / 1000;
    }

    /*
     * format money
     */
    public static function numberFormat($number, $customFormattingTo = ','){
        if ($customFormattingTo == ',') {
            $checkStore = \Yii::$app->params['checkStore'];
            $storeData = SiteService::getStore($checkStore);
            if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopvn']) {
                $price = $number / 1000;
                $roundPrice = round($price);
                $finalPrice = 1000 * $roundPrice;
                return number_format($finalPrice, 0, ',', '.');
            }else if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopmy']) {
                return number_format($number, 2, '.', ',');
            }else{
                return number_format($number, 0, '.', ',');
            }
        } else {
            if ($customFormattingTo == 0) {
                return number_format($number, 2, ',', '.');
            }else{
                return number_format($number, 2, '.', ',');
            }
        }
    }
    
    public static function numberFormatFull($number, $customFormattingTo = ','){
        if ($customFormattingTo == ',') {
            $checkStore = \Yii::$app->params['checkStore'];
            $storeData = SiteService::getStore($checkStore);
            if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopvn']) {
                return number_format($number, 4, ',', '.');
            }else if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopmy']) {
                return number_format($number, 4, '.', ',');
            }else{
                return number_format($number, 4, '.', ',');
            }
        } else {
            if ($customFormattingTo == 0) {
                return number_format($number, 4, ',', '.');
            }else{
                return number_format($number, 4, '.', ',');
            }
        }
    }
    /*
     * format money
     */
    public static function numberFormatWallet($number, $customFormattingTo = ','){
        if ($customFormattingTo == ',') {
            $checkStore = \Yii::$app->params['checkStore'];
            $storeData = SiteService::getStore($checkStore);
            if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopvn']) {
                return number_format($number, 0, ',', '.');
            }else{
                return number_format($number, 2, ',', '.');
            }
        } else {
            if ($customFormattingTo == ',') {
                return number_format($number, 2, ',', '.');
            }else{
                return number_format($number, 2, '.', ',');
            }
        }
    }
    
    public static function numberFormatEmail($number, $floorNumber = 2) {
        switch ($floorNumber) {
            case 0:
                return number_format($number, 0, '.', ',');
                break;
            case 2:
                return number_format($number, 2, '.', ',');
                break;
            case 1000:
                $price = $number / $floorNumber;
                $roundPrice = round($price);
                $finalPrice = $floorNumber * $roundPrice;
                return number_format($finalPrice, 0, ',', '.');
                break;
        }
    }
    
    public static function numberFormatStore($number) {
        $checkStore = \Yii::$app->params['checkStore'];
        $storeData = SiteService::getStore($checkStore);
        if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopvn']) {
            return number_format($number, 2, ',', '.');                
        }else{
            return number_format($number, 2, '.', ',');
        }
    }
    
    public static function numberRound($number, $floorNumber = 2)
    {
        switch ($floorNumber) {
            case 0:
                return round($number, $floorNumber);
                break;
            case 2:
                return round($number, $floorNumber);
                break;
            case 1000:
                $price = $number / $floorNumber;
                $roundPrice = round($price);
                $finalPrice = $floorNumber * $roundPrice;
                return $finalPrice;
                break;
        }
    }

    /*public static function numberFormatMutil($number, $customFormattingTo = 'vn')
    {
        if ($customFormattingTo == 'vn') {
            return number_format($number, 0, ',', '.');
        } else {
            return number_format($number, 2, '.', ',');
        }
    }*/

    /**
     * format percent
     *
     * @param type $number
     * @return type
     */
    public static function percentFormat($number)
    {
        return ceil($number);
    }

    /**
     * Tính phần trăm giảm giá
     *
     * @param type $startPrice
     * @param type $sellPrice
     * @param type $discount
     * @param type $discountPrice
     * @param type $discountPercent
     * @return type
     */
    public static function calPercent($startPrice = 0, $sellPrice = 0, $discount = false, $discountPrice = 0, $discountPercent = 0)
    {
        $percent = 0;
        if (!$discount && $startPrice > $sellPrice) {
            $percent = ($startPrice - $sellPrice) / $startPrice;
        } else {
            if ($startPrice <= $sellPrice) {
                $startPrice = $sellPrice;
            }
            $price = 0;
            if ($discountPercent > 0) {
                $price = (100 - $discountPercent * 1.0);
                $price = $sellPrice * $price / 100;
            } else {
                $price = $sellPrice - $discountPrice;
            }
            $percent = ($startPrice - $price) / $startPrice;
        }
        $percent *= 100;
        $percent = round($percent);
        return ($percent);
    }

    /**
     * Tính giá gốc
     *
     * @param type $startPrice
     * @param type $sellPrice
     * @param type $discount
     * @return string
     */
    public static function startPrice($startPrice = 0, $sellPrice = 0, $discount = false)
    {
        if (!$discount && $startPrice <= $sellPrice) {
            return "0";
        }
        if ($discount && $startPrice <= $sellPrice) {
            $startPrice = $sellPrice;
        }
        if ($startPrice > 0 && $startPrice >= $sellPrice) {
            return self::numberFormat($startPrice * 1.0);
        }
        return "0";
    }

    /**
     * Tính giá bán
     *
     * @param type $sellPrice
     * @param type $discount
     * @param type $discountPrice
     * @param type $discountPercent
     * @return type
     */
    public static function sellPrice($sellPrice = 0, $discount = false, $discountPrice = 0, $discountPercent = 0)
    {
        if ($discount) {
            if ($discountPercent > 0) {
                $sellPrice = $sellPrice * (100 - $discountPercent) / 100;
            } else {
                $sellPrice = $sellPrice - $discountPrice;
            }
        }
        return self::numberFormat($sellPrice * 1.0);
    }

    /**
     * Tính giá giảm
     *
     * @param type $startPrice
     * @param type $sellPrice
     * @param type $discount
     * @param type $discountPrice
     * @param type $discountPercent
     * @return type
     */
    public static function discountPrice($startPrice = 0, $sellPrice = 0, $discount = false, $discountPrice = 0, $discountPercent = 0)
    {
        if ($discount && $startPrice <= $sellPrice) {
            $startPrice = $sellPrice;
        }
        if ($discount) {
            if ($discountPercent > 0) {
                $sellPrice = $sellPrice * (100 - $discountPercent) / 100;
            } else {
                $sellPrice = $sellPrice - $discountPrice;
            }
        }
        $price = ($startPrice - $sellPrice) * 1.0;
        $price = ($price > 0 ? $price : 0);
        return self::numberFormat($price);
    }

    /**
     * Get html by url
     *
     * @param type $url
     * @param type $timeout
     * @return type
     */
    public static function getHTML($url, $timeout = 30)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    /**
     *
     * @param type $data
     * @return type
     */
    public static function getDomain($data)
    {
        $url = explode('/', $data);
        return isset ($url [2]) ? $url [2] : "";
    }

    /**
     * get base Url
     *
     * @return type
     */
    public static function getBaseUrl()
    {
        return 'http://' . $_SERVER ['HTTP_HOST'] . str_replace("index.php", '', $_SERVER ['SCRIPT_NAME']);
    }
    public static function getCurrentUrl()
    {
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $actual_link = "http://$_SERVER[HTTP_HOST]".$uri_parts[0];
        return $actual_link;
    }

    /**
     *
     * @param type $json
     * @return type
     */
    public static function property($json)
    {
        $rs = null;
        try {
            $rs = json_decode($json, true);
        } catch (Exception $ex) {
        }
        if (empty ($rs)) {
            return null;
        }
        $arr = [];
        foreach ($rs as $key => $value) {
            if (!empty ($value) && self::specifics($key)) {
                $arr [$key] = $value [0];
            }
        }
        return $arr;
    }

    public static function attributes($json)
    {
        $rs = null;
        try {
            $rs = json_decode($json, true);
        } catch (Exception $ex) {
        }
        if (empty ($rs)) {
            return null;
        }
        $arr = [];
        foreach ($rs as $key => $value) {
            $arr [$key] = $value;
        }
        return $arr;
    }

    public static function specifics($key)
    {
        return !in_array($key, [
            'category_link',
            'interpark_disp_no',
            'interpark_disp_nm',
            'siteId',
            'site_domain',
            'site_config',
            'interpark_no',
            'interpark_ord_age_rstr_yn',
            'interpark_ord_rstr_age',
            'interpark_sale_unitcost',
            'interpark_biz_tp',
            'interpark_entr_nm',
            'interpark_entr_seller_nm',
            'interpark_hdelv_mafc_entr_nm',
            'interpark_icn_img_url',
            'interpark_list_img_url',
            'interpark_main_img_url',
            'interpark_main_nm',
            'category',
            'category_path',
            'feeShip',
            'usTax',
            'feeMore',
            'coefficient',
            'rate',
            'ebay_sellerId',
            'ebay_categoryId',
            'ebay_categoryName',
            'ebay_usShipping',
            'ebay_usTax',
            'ebay_condition',
            'ebay_sellPrice',
            'categoryPath',
            'categoryId',
            'categoryName'
        ]);
    }

    /**
     * Tao 1 link excel
     */
    public static function buidLinkExcel($action)
    {
        $url = Yii::$app->request->url;
        $params = explode('?', $url);
        $params = isset ($params [1]) && !empty ($params) ? '?' . $params [1] : '';
        return 'excel/' . $action . '/' . $params;
    }

    /**
     * Tao 1 link xml
     */
    public static function buidLinkXml($action)
    {
        $url = Yii::$app->request->url;
        $params = explode('?', $url);
        $params = isset ($params [1]) && !empty ($params) ? '?' . $params [1] : '';
        return 'xml/' . $action . '/' . $params;
    }

    public static function replacePhone($phone)
    {
        return str_replace([
            '-',
            '.',
            ' '
        ], '', $phone);
    }

    public static function condition($condition)
    {
        if (in_array(strtolower($condition), [
            'new with tags',
            'new'
        ])) {
            return 1;
        }
        return 0;
    }

    public static function nameSplit($name, $charNum)
    {
        $charNum = (!is_numeric($charNum)) ? 0 : $charNum;
        if (strlen($name) < $charNum) {
            return $name;
        }
        return substr($name, 0, $charNum) . ' ...';
    }

    public static function cleanSpecialChars($string)
    {
        $string = str_replace(".", "-", $string);
        $string = str_replace(" ", "-", $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
        $string = addslashes($string);
        $string = preg_replace("/(&|'|\"|#|)/", '', $string);

        return $string;
    }

    public static function spaceAfterUppercase($string)
    {
        return ltrim(preg_replace('/[A-Z]/', ' $0', $string));
    }

    public static function removeDiacritical($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    public static function getUrlAlias($str)
    {
        $str = self::removeDiacritical($str);
        $str = strtolower($str);
        $str = preg_replace("[\W]", "-", $str);
        return $str;
    }

    public static function randChar($num = 10)
    {
        return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", $num)), 0, $num);
    }

    public static function randNumber($num = 10)
    {
        return substr(str_shuffle(str_repeat("0123456789", $num)), 0, $num);
    }

    public static function validEmail($email)
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL) === false ? true : false;
    }

    public static function validPhone($phone)
    {
        return preg_match("/^[0][0-9]{9,10}$/", $phone);
    }

    public static function removeXSS($data)
    {
        // Fix &entity\n;
        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);

// we are done...
        return $data;
//        return strip_tags(HtmlPurifier::process($text));
    }

    public static function timeDisplayToDBTime($input)
    {
        $date = \DateTime::createFromFormat('m/d/Y', $input);
        return $date->format('Y-m-d');
    }

    public static function timeTimeDBToDisplayTime($input)
    {
        if ($input == null) {
            return '';
        }
        $date = \DateTime::createFromFormat('Y-m-d', $input);
        return $date->format('m/d/Y');
    }

    public static function convertTimeType($inputType, $input, $output)
    {
        $date = \DateTime::createFromFormat($inputType, $input);
        return $date->format($output);
    }

    static function isImage($fileName)
    {
        $Extension = strrev(substr(strrev($fileName), 0, strpos(strrev($fileName), '.')));
        if (preg_match('/png|jpg|jpeg|gif/', $Extension)) {
            return true;
        } else {
            return false;
        }
    }


    static function isAttractment($fileName)
    {
        $Extension = strrev(substr(strrev($fileName), 0, strpos(strrev($fileName), '.')));
        if (preg_match('/pdf|doc|docx|png|jpg|jpeg|tmp/', $Extension)) {
            return true;
        } else {
            return false;
        }
    }

    static $currency = [];

    static function priceByCurrency($price, $currencyId = null)
    {
        $currencyId = $currencyId != null ? $currencyId : 'null';
        if (!isset(static::$currency[$currencyId])) {
            if ($currencyId == 'null') {
                $store = Store::find()->where(['id' => \Yii::$app->params['storeId']])->one();
            } else {
                $store = true;
            }
            if ($store != false) {
                $currency = SystemCurrency::find()->where(['id' => $currencyId == 'null' ? $store->CurrencyId : $currencyId])->one();
                if ($currency != false) {
                    static::$currency[$currencyId] = $currency->CurrencyCode;
                } else {
                    static::$currency[$currencyId] = ' ';
                }
            } else {
                static::$currency[$currencyId] = ' ';
            }
        }
        return static::numberFormat($price) . ' ' . static::$currency[$currencyId];
    }

    static function getCurrencyCode($currencyId = null)
    {

        $currencyId = $currencyId != null ? $currencyId : 'null';
        if (!isset(static::$currency[$currencyId])) {
            if ($currencyId == 'null') {
                $store = Store::find()->where(['id' => \Yii::$app->params['storeId']])->one();
            } else {
                $store = true;
            }
            if ($store != false) {
                $currency = SystemCurrency::find()->where(['id' => $currencyId == 'null' ? $store->CurrencyId : $currencyId])->one();
                if ($currency != false) {
                    static::$currency[$currencyId] = $currency->CurrencyCode;
                } else {
                    static::$currency[$currencyId] = ' ';
                }
            } else {
                static::$currency[$currencyId] = ' ';
            }
        }
        return static::$currency[$currencyId];
    }

    public static function formatPriceCrawler($price)
    {
        $price = preg_replace("/&#?[a-z0-9]+;/i", "", $price);
        $price = preg_replace("/[^\.\,0-9]/", "", $price);
        return $price;
    }

    public static function changeCategoryName($cat1, $portal = null, $storeData = null)
    {
        if (empty($portal)) {
            $portal = 'ebay';
        }
        $storeId = StoreConfig::WESHOP_GLOBAL;
        if (!empty($storeData)) {
            $storeId = $storeData->id;
        } else {
            $checkStore = \Yii::$app->params['checkStore'];
            $storeData = SiteService::getStore($checkStore);
        }
        if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopmy']) {
            $cat1name = isset($cat1->name) && !empty($cat1->name) && $portal ? $cat1->name : $cat1->originName;
        } elseif (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopsg']) {
            $cat1name = isset($cat1->name) && !empty($cat1->name) && $portal ? $cat1->name : $cat1->originName;
        } elseif (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopid']) {
            $cat1name = isset($cat1->name) && !empty($cat1->name) && $portal ? $cat1->name : $cat1->originName;
        } elseif (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopph']) {
            $cat1name = isset($cat1->name) && !empty($cat1->name) && $portal ? $cat1->name : $cat1->originName;
        } else {
            $cat1name = isset($cat1->name) && !empty($cat1->name) && $portal ? $cat1->name : $cat1->originName;
        }
        return $cat1name;
    }
    public static function formatPriceCurrency($price,$currencySymbol,$currencyPosition = 1){
        if($currencyPosition == 1){
            return ($price.' '.$currencySymbol);
        }else{
            return($currencySymbol.' '.$price);
        }

    }
    public static function passLogin($link){
        $arrayLink = array(
            'account/wallet/active.html',
            'wallet/active.html',
            'account/wallet/captcha'
        );
        if(in_array($link, $arrayLink)){
            return true;
        }else{
            return false;
        }
    }
}