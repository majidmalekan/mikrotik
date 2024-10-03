<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Completed()
 * @method static self Pending()
 * @method static self Progress()
 * @method static self Checking()
 * @method static self Failed()
 * @method static self Checking_background_color()
 * @method static self Failed_background_color()
 * @method static self Checking_text_color()
 * @method static self Failed_text_color()
 * @method static self Completed_background_color()
 * @method static self Progress_background_color()
 * @method static self Completed_text_color()
 * @method static self Progress_text_color()
 * @method static self Pending_background_color()
 * @method static self Pending_text_color()
 */
final class OrderStatusEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function values(): array
    {
        return [
            'Completed' => lcfirst('Completed'),
            'Pending' => lcfirst('Pending'),
            'Checking' => lcfirst('Checking'),
            'Progress' => lcfirst('Progress'),
            'Failed' => lcfirst('Failed'),
        ];
    }

    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'Completed_background_color' => '#E9FAEE',
            'Completed_text_color' => '#2CA562',
            'Completed' => __('enums.order_status.Completed'),

            'Pending' => __('enums.order_status.Pending'),
            'Pending_background_color' => '#F4F5F6',
            'Pending_text_color' => '#858E97',

            'Checking' => __('enums.order_status.Checking'),
            'Checking_background_color' => '#FFF6E9',
            'Checking_text_color' => '#FFA63E',

            'Progress' => __('enums.order_status.Progress'),
            'Progress_background_color' => '#EDF5FF',
            'Progress_text_color' => '#318DFF',

            'Failed' => __('enums.order_status.Failed'),
            'Failed_background_color' => '#FFEEEE',
            'Failed_text_color' => '#F5455B',
        ];
    }
}
