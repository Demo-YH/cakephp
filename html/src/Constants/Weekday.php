<?php
declare(strict_types=1);

namespace App\Constants;

/**
 * 曜日選択定義
 * @static
 */
class Weekday
{
    public const SUN = 0;
    public const MON = 1;
    public const TUE = 2;
    public const WED = 3;
    public const THU = 4;
    public const FRI = 5;
    public const SAT = 6;

    public const ISO_MON = 1;
    public const ISO_TUE = 2;
    public const ISO_WED = 3;
    public const ISO_THU = 4;
    public const ISO_FRI = 5;
    public const ISO_SAT = 6;
    public const ISO_SUN = 7;

    public const DAY_WEEK_LIST = [
        self::SUN => '日',
        self::MON => '月',
        self::TUE => '火',
        self::WED => '水',
        self::THU => '木',
        self::FRI => '金',
        self::SAT => '土',
    ];

    public const DAY_WEEK_ISO_LIST = [
        self::ISO_MON => '月',
        self::ISO_TUE => '火',
        self::ISO_WED => '水',
        self::ISO_THU => '木',
        self::ISO_FRI => '金',
        self::ISO_SAT => '土',
        self::ISO_SUN => '日',
    ];

    public const START_DAY_WEEK_NAMES = [
        self::SUN => '日曜日',
        self::ISO_MON => '月曜日',
    ];

    public const START_END_WEEKS = [
        self::SUN => [
            'first' => self::SUN,
            'last' => self::SAT,
        ],
        self::ISO_MON => [
            'first' => self::ISO_MON,
            'last' => self::ISO_SUN,
        ]
    ];

}