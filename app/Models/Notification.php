<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    public static function checkForNotifications() {
        // $notification = json_decode(Storage::disk('local')->get('json/notification.json'), true)[0];

        $notification = Notification::first();

        $mytime = Carbon::now('Asia/Tokyo');

        if($mytime >= $notification->startTime && $mytime <= $notification->endTime && $notification->url != "") {
            return $notification->url;
        } else {
            return null;
        }
        // if($mytime >= $notification['startTime'] && $mytime <= $notification['endTime']) {
        //     return $notification['url'];
        // } else {
        //     return null;
        // }

    }
}
