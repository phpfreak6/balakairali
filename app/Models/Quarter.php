<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter extends Model {

    use HasFactory;

    public static function previousTerm() {
        $year = date('Y');
        $month = date('m');
        $terms = self::get();
        $id = '';
        foreach ($terms as $key => $term) {
            if (($term->name == '1st') && $month < date('m', strtotime($year . '-' . $term->end_date))) {
                $year = date('Y');
            }
            $start = date('m', strtotime($year . '-' . $term->start_date));
            $end = date('m', strtotime($year . '-' . $term->end_date));
            if ($month >= $start && $month <= $end) {
                if (($term->name == '1st') && $month < $end) {
                    $data = self::latest()->first();
                    $id = $data->id;
                } elseif ($term->name == '2nd') {
                    $data = self::where('name', '1st')->latest()->first();
                    $id = $data->id;
                } elseif ($term->name == '3rd') {
                    $data = self::where('name', '2nd')->latest()->first();
                    $id = $data->id;
                } elseif ($term->name == '4th') {
                    $data = self::where('name', '3rd')->latest()->first();
                    $id = $data->id;
                }
            }
            return ['id' => $id, 'year' => $year];
        }
    }

    public static function getCurrTerm() {
        $year = date('Y');
        $month = date('m');
        $terms = self::get();
        $id = '';
        foreach ($terms as $key => $term) {
            $start = date('m', strtotime($year . '-' . $term->start_date));
            $end = date('m', strtotime($year . '-' . $term->end_date));
            if ($month >= $start && $month <= $end) {
                $id = $term->id;
            }
        }
        return $id;
    }

}
