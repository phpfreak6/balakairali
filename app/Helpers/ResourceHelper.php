<?php

use Hashids\Hashids;
use Illuminate\Support\Facades\Crypt;
use App\Models\LoginRecord;

if (!function_exists('states')) {

    function states() {
        return array('New South Wales', 'Queensland', 'Australian Capital Territory', 'Victoria', 'South Australia', 'Western Australia', 'Tasmania', 'Northern Territory');
    }

}

if (!function_exists('pr')) {

    function pr($dataArr, $die = TRUE) {
        echo '<pre>';
        print_r($dataArr);
        if ($die == TRUE) {
            die;
        }
    }

}

if (!function_exists('getDropdownList')) {

    function getDropdownList($dataArr, $key, $value) {
        $returnArr = [];
        $returnArr[''] = 'Please Select';
        foreach ($dataArr as $data) {
            $returnArr[$data[$key]] = $data[$value];
        }
        return $returnArr;
    }

}

if (!function_exists('getDropdown')) {

    function getDropdown($dataArr, $key, $value) {
        $returnArr = [];
        foreach ($dataArr as $data) {
            $returnArr[$data[$key]] = $data[$value];
        }
        return $returnArr;
    }

}

if (!function_exists('encodeId')) {

    function encodeId($id) {
        $hashids = new Hashids('hflc', 10);
        return $hashids->encode($id);
    }

}

if (!function_exists('decodeId')) {

    function decodeId($id) {
        $hashids = new Hashids('hflc', 10);
        if (!empty($hashids->decode($id)[0])) {
            return $hashids->decode($id)[0];
        }
        return NULL;
    }

}

if (!function_exists('getDatatableResources')) {

    function getDatatableResources() {
        return '<script src="' . url('assets/theme/js/dataTables/jquery.dataTables.js') . '"></script>
		<script src="' . url('assets/theme/js/dataTables/jquery.dataTables.bootstrap.js') . '"></script>';
    }

}

if (!function_exists('getTotalDaysTakenDropdown')) {

    function getTotalDaysTakenDropdown() {
        $returnListArr = [];
        $returnListArr[''] = 'Please Select';
        $times = 100;
        $value = 0;
        while ($times !== 0) {
            $value = $value + 0.5;
            $returnListArr[(string) $value] = $value;
            $times--;
        }
        return $returnListArr;
    }

}

if (!function_exists('invoiceId')) {

    function invoiceId($id) {
        return 'BKINV000' . $id;
    }

}

if (!function_exists('encryptID')) {

    function encryptID($id) {
        return Crypt::encryptString($id);
    }

}

if (!function_exists('loginOrLogout')) {

    function loginOrLogout($userid) {
        $record = LoginRecord::where('user_id', $userid)->whereDate('login_time', date('Y-m-d'))->first();
        if (!empty($record->logout_time)) {
            return 'Sign-in';
        } elseif (empty($record)) {
            return 'Sign-in';
        } else {
            return 'Sign-out';
        }
    }

}


if (!function_exists('loginOrLogoutStatus')) {

    function loginOrLogoutStatus($userid) {
        $record = LoginRecord::where('user_id', $userid)->whereDate('login_time', date('Y-m-d'))->first();
        if (!empty($record->logout_time)) {
            return '';
        } elseif (empty($record)) {
            return '';
        } else {
            return 'Signed-in - ';
        }
    }

}


if (!function_exists('draw_calendar')) {

    function draw_calendar($month, $year, $holidays, $selCounter) {
        if (!empty($holidays)) {
            $aryHolidays = explode(',', $holidays);
        }
        /* draw table */
        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
        /* table headings */
        $headings = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        $calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';
        /* days and weeks vars now ... */
        $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();
        /* row for week one */
        $calendar .= '<tr class="calendar-row">';
        /* print "blank" days until the first of the current week */
        for ($x = 0; $x < $running_day; $x++):
            $calendar .= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;
        /* keep going with days.... */
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $dateString = $year . '-' . $month . '-' . (($list_day < 10) ? '0' . $list_day : $list_day);
            $isHoliday = '';
            $isSunday = '';
            if (date('N', strtotime($dateString)) > 6) {
                $isSunday = ' is_sunday';
            }
            if (isset($aryHolidays) && in_array($dateString, $aryHolidays)) {
                $isHoliday = ' holiday_selected';
            }
            $calendar .= '<td class="calendar-day' . $isHoliday . $isSunday . '">';
            /* add in the day number */
            $calendar .= '<div class="day-number chkAll' . $selCounter . '" dte="' . $dateString . '">' . $list_day . '</div>';
            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! * */
            $calendar .= str_repeat('<p> </p>', 2);
            $calendar .= '</td>';
            if ($running_day == 6):
                $calendar .= '</tr>';
                if (($day_counter + 1) != $days_in_month):
                    $calendar .= '<tr class="calendar-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        endfor;
        /* finish the rest of the days in the week */
        if ($days_in_this_week < 8):
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar .= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;
        /* final row */
        $calendar .= '</tr>';
        /* end the table */
        $calendar .= '</table>';
        /* all done, return result */
        return $calendar;
    }

}

if (!function_exists('to_csv')) {

    function to_csv($data, $fileName) {
        $f = fopen('public/uploads/csv/' . $fileName, "w");
        foreach ($data as $line) {
            fputcsv($f, $line);
        }
        fclose($f);
        return $fileName;
    }

}

if (!function_exists('to_xls')) {

    function to_xls($data, $filename) {
        $fp = fopen($filename, "w+");
        $str = pack(str_repeat("s", 6), 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); // s | v
        fwrite($fp, $str);
        if (is_array($data) && !empty($data)) {
            $row = 0;
            foreach (array_values($data) as $_data) {
                if (is_array($_data) && !empty($_data)) {
                    if ($row == 0) {
                        foreach (array_keys($_data) as $col => $val) {
                            _xlsWriteCell($row, $col, $val, $fp);
                        }
                        $row++;
                    }
                    foreach (array_values($_data) as $col => $val) {
                        _xlsWriteCell($row, $col, $val, $fp);
                    }
                    $row++;
                }
            }
        }
        $str = pack(str_repeat("s", 2), 0x0A, 0x00);
        fwrite($fp, $str);
        fclose($fp);

        return $filename;
    }

}

if (!function_exists('_xlsWriteCell')) {

    function _xlsWriteCell($row, $col, $val, $fp) {
        if (is_float($val) || is_int($val)) {
            $str = pack(str_repeat("s", 5), 0x203, 14, $row, $col, 0x0);
            $str .= pack("d", $val);
        } else {
            $l = strlen($val);
            $str = pack(str_repeat("s", 6), 0x204, 8 + $l, $row, $col, 0x0, $l);
            $str .= $val;
        }
        fwrite($fp, $str);
    }

}




