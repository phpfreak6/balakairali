<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Mail;

class Attendance extends Model {

    use HasFactory;

    public function user() {

        return $this->belongsTo(User::class);
    }

    public static function isPresent($user, $class, $centre, $date) {

        if (!empty($date)) {
            return self::where(['user_id' => $user, 'classes_id' => $class, 'centre_id' => $centre])->where('attendance_date', date('Y-m-d', strtotime($date)))->count();
        } else {
            return self::where(['user_id' => $user, 'class_id' => $class, 'centre_id' => $centre])->whereDate('attendance_date', Carbon::today())->count();
        }
    }

    public static function isAttended($class, $centre, $date) {


        return self::where(['classes_id' => $class, 'centre_id' => $centre])->where('attendance_date', date('Y-m-d', strtotime($date)))->count();
    }

    public static function classAttendCount($start, $end, $user_id) {

        $totalClasses = Classes::totalClasses($start, $end);

        $total = self::where(function ($q) use ($start, $end, $user_id) {
                    $q->whereDate('attendance_date', '>=', $start);
                    $q->whereDate('attendance_date', '<=', $end);
                    $q->where('user_id', $user_id);
                })->count();

        $percentage = ($total / $totalClasses) * 100;
        return ['total' => $total, 'percentage' => number_format($percentage, 2)];
    }

    public static function attendanceMail($start, $end, $data) {
        $excelFileData = array(array('Record No.', 'Student ID', 'Student Name', 'DOB', 'Centre', 'Class', 'No. of classes attended', 'Percentage'));
        $counter = 1;
        foreach ($data as $student) {
            $attendClasses = self::classAttendCount($start, $end, $student->id)['total'];
            $percentage = self::classAttendCount($start, $end, $student->id)['percentage'];
            $excelFileData[] = array(
                $counter,
                $student->id,
                $student->first_name . ' ' . $student->last_name,
                $student->dob,
                $student->student->centres->name,
                $student->student->studentclasses->name,
                $attendClasses,
                $percentage
            );
            $counter++;
        }
        $unlink = public_path('/uploads/csv/Attendance_report.csv');
        if (file_exists($unlink)) {
            unlink($unlink);
        }
        $csv = to_csv($excelFileData, 'Attendance_report.csv');
        $file = public_path('/uploads/csv/' . $csv);
        $bodytext = 'Report Date: ' . date('d/m/Y') . PHP_EOL . PHP_EOL;
        $bodytext .= 'Sent by: ' . auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $adminEmail = Setting::where('name', 'admin_email')->first()->settings['email'];
        Mail::send('emails.mail_csv', ['report_by' => $bodytext], function($message)use($adminEmail, $csv) {
            $message->to($adminEmail, 'User')
                    ->subject('Attendance Report');
            $message->attach('uploads/csv/' . $csv);
        });
        if (Mail::failures()) {
            return 'error';
        }
        return 'success';
    }

}
