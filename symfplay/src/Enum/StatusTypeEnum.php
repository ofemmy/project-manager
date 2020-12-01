<?php


    namespace App\Enum;


    abstract class StatusTypeEnum
    {
    const STATUS_ONGOING="ongoing";
    const STATUS_DONE="done";
    const STATUS_OVERDUE="overdue";
    
    /**@var array user friendly status name*/
    protected static $statusName = [
        self::STATUS_ONGOING=>"Ongoing",
        self::STATUS_DONE=>"Done",
        self::STATUS_OVERDUE=>"Overdue",
    ];
        /**
         * @param  string $statusShortName
         * @return string
         */
        public static function getStatusName($statusShortName)
        {
            if (!isset(static::$statusName[$statusShortName] )){
                return "Unknown type ($statusShortName)";
            }
            return static::$statusName[$statusShortName];
        }
        /**
        * @return array<string>
         **/
        public static function getAvalableStatusTypes()
        {
            return [
                self::STATUS_OVERDUE,
                self::STATUS_DONE,
                self::STATUS_ONGOING
            ];
        }
    }