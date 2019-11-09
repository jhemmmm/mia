<?php
namespace App;
use Carbon\Carbon;
use App\Book;

class Helper{

    public static function getNotificationCount()
    {
        return Book::where('notification_status', 1)->where('status', 1)->count();
    }

    public static function getRefundNotificationCount()
    {
        return Book::where('notification_status', 2)->where('status', 1)->count();
    }
    
    public static function getStatus($time, $status)
    {
        if($status == 5)
            return [
                'code' => 5,
                'status' => 'text-danger',
                'message' => 'Canceled',
            ];
        
        if(Carbon::now()->timestamp < $time->timestamp)
            return [
                'code' => 1,
                'status' => 'text-warning',
                'message' => 'Quieing',
            ];
        else if(Carbon::now()->timestamp >= $time->timestamp)
        {
            if(Carbon::now()->timestamp <= $time->addMinutes(15)->timestamp)
                return [
                    'code' => 2,
                    'status' => 'text-primary',
                    'message' => 'Waiting',
                ];
        }
         return [
                    'code' => 3,
                    'status' => 'text-secondary',
                    'message' => 'Completed',
                ];
    }
}