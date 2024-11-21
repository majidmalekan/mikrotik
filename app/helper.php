<?php

use Illuminate\Http\JsonResponse;
use Morilog\Jalali\CalendarUtils;

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     *
     * @return string
     */
    function config_path(string $path = ''): string
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('generate_otp')) {
    /**
     * Generate random OTP
     *
     * @param int $length
     *
     * @return string
     */
    function generate_otp(int $length = 6): string
    {
        $pool = '0123456789';

        do {
            $code = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        } while (strlen((string)((int)$code)) < $length);

        return $code;
    }
}

if (!function_exists('success')) {
    /**
     * Return successful response from the application.
     *
     * @param string $message
     * @param null $object
     * @param int $status
     *
     * @return JsonResponse
     */
    function success(string $message = '', $object = null, int $status = 200): JsonResponse
    {
        return response()->json(['success' => true, 'message' => $message, 'data' => $object], $status);
    }
}

if (!function_exists('failed')) {
    /**
     * Return failed response from the application.
     *
     * @param string $message
     * @param int $status
     *
     * @return JsonResponse
     */
    function failed(string $message = '', int $status = 500): JsonResponse
    {
        return response()->json(['success' => false, 'message' => $message, 'statusCode' => $status], $status);
    }
}



if (!function_exists('convertPersianDateToLatin')) {
    /**
     * @param string $date
     * @return string
     */
    function convertPersianDateToLatin(string $date): string
    {
        return CalendarUtils::createCarbonFromFormat('Y-m-d', $date)
            ->format('Y-m-d');
    }
}


if (!function_exists('arabicToPersian')) {
    /**
     * @param $string
     * @return array|string
     */

    //Convert arabic tp persian word
    function arabicToPersian($string): array|string
    {
        $characters = [
            'ك' => 'ک',
            'دِ' => 'د',
            'بِ' => 'ب',
            'زِ' => 'ز',
            'ذِ' => 'ذ',
            'شِ' => 'ش',
            'سِ' => 'س',
            'ى' => 'ی',
            'ي' => 'ی',
            '١' => '۱',
            '٢' => '۲',
            '٣' => '۳',
            '٤' => '۴',
            '٥' => '۵',
            '٦' => '۶',
            '٧' => '۷',
            '٨' => '۸',
            '٩' => '۹',
            '٠' => '۰',
        ];
        return str_replace(array_keys($characters), array_values($characters), $string);
    }
}
