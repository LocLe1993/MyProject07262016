<?php

namespace WiredBeans\KenankanCRM\Core;

class CalendarCheck
{
    public function calendarFormatCheck(&$date = null)
    {
        if (is_null($date)) {
            return '';
        }
        $first = substr($date, 0, 6);
        $year = $month = $day = '';
        switch ($first) {
            case '平成':
                sscanf($date, "平成%d年%d月%d日", $year, $month, $day);
                $year += 1988;
                break;
            case '昭和':
                sscanf($date, "昭和%d年%d月%d日", $year, $month, $day);
                $year += 1925;
                break;
            case '大正':
                sscanf($date, "大正%d年%d月%d日", $year, $month, $day);
                $year += 1911;
                break;
            case '明治':
                sscanf($date, "明治%d年%d月%d日", $year, $month, $day);
                $year += 1867;
                break;
            default:
                break;
        }
        $valid = false;
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $day = str_pad($day, 2, '0', STR_PAD_LEFT);
        if (checkdate(intval($month), intval($day), intval($year))) {
            $valid = true;
            $date = $year.'-'.$month.'-'.$day;
        }
        return $valid;
    }
}
