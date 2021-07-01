<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentDetail;
use Carbon\Carbon;

class LoginRecord extends Model {

    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function loginLogoutResponse($userid) {
        $user = User::find($userid);
        if ($user->status == '0') {
            return response()->json(['status' => 'inactive', 'id' => $userid, 'text' => 'Sign-in']);
        }
        $record = self::where('user_id', $userid)->whereDate('login_time', date('Y-m-d'))->first();
        if (!empty($record->logout_time)) {
            return response()->json(['status' => 'logout', 'id' => $userid, 'text' => 'Sign-in']);
        }
        if ($record) {
            $should_be_time = Carbon::parse($record->login_time)->addMinutes(15);
            $current_time = Carbon::now();
            $diff_in_minutes = $current_time->diffInMinutes($should_be_time);
            if ($should_be_time > $current_time) {
                return response(['status' => 'time-bounded', 'logout' => false, 'id' => $userid, 'text' => 'Sign-in', 'message' => "Please wait for $diff_in_minutes minutes to logout."]);
            }
            $record->logout_time = Carbon::now();
            $record->save();
            return response()->json(['status' => 'logged-out', 'logout' => false, 'id' => $userid, 'text' => 'Sign-in']);
        } else {
            $student = StudentDetail::where('user_id', $userid)->first();
            $record = new self();
            $record->user_id = $userid;
            $record->parent_mobile = $student->p1_mobile;
            $record->login_time = Carbon::now();
            $record->save();
            return response()->json(['status' => '', 'logout' => false, 'id' => $userid, 'text' => 'Sign-out']);
        }
    }

    public static function childCount() {
        return StudentDetail::where('p1_mobile', auth()->user()->student->p1_mobile)->count();
    }

}
