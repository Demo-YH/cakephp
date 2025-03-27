<?php
declare(strict_types=1);

namespace App\const;

/**
 * 曜日選択定義
 * @static
 */
class Weekday
{
    public const START_SUN = 0;
    public const START_MON = 1;

    public const END_SAT = 6;
    public const END_SUN = 7;

    public const START_DAY_WEEK_LIST = [
        self::START_SUN => '日曜日',
        self::START_MON => '月曜日',
    ];

    public const START_DAY_WEEK_SUN = [
        'first' => self::START_SUN,
        'last' => self::END_SAT,
    ];

    public const START_DAY_WEEK_MON = [
        'first' => self::START_MON,
        'last' => self::END_SUN,
    ];
}