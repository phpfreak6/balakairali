<?php

namespace App\Helpers;


class Helper
{
    public function prefix(){
        if(auth()->user()->isAdmin()){
           return 'admin';
        }else{
           return 'teacher'; 
        }
    }
}