<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:process-crawler')
    ->everySixHours()->when(function () {
        $today = date_create('now')->format('d.m.Y');
        return in_array($today, config('radiosendungen.events')) ;
    });
;
