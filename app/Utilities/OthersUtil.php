<?php

namespace App\Utilities;

use App\Events\PrivateMessage;
use App\Events\PrivateNotificationEvent;
use App\Events\SendNotification;
use App\Models\MessageGroup;
use App\Models\User;
use App\Models\UserNotifications;
use Illuminate\Http\Request;


class OthersUtil {
    

    public static function generateCode() {
        $characters = '123456789abcdefghijklmnopqstuvwxyz';
        $code = '';
        for ($i = 0; $i < 11; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $code .= $characters[$randomIndex];
        }

        $check = MessageGroup::where('code', $code)->first(['id', 'code']);
        if(!is_null($check)) {
            $code = self::generateCode();
        }
        return $code;
    }

    public static function createMessageGroup($data) {
        $data = json_decode($data);
        $messageGroup = new MessageGroup;

        $messageGroup->code = self::generateCode();
        $messageGroup->sender_id = $data->sender_id;
        $messageGroup->receiver_id  = $data->receiver_id ;
        $messageGroup->property_code = $data->property_code;
        $messageGroup->property_info = $data->property_info ?? '';
        //$messageGroup->last_message = $data->last_message ?? '';
        $messageGroup->not_seen_user_id = $data->receiver_id;
        $messageGroup->is_seen = 0;
        $status = $messageGroup->save();

        return $messageGroup;
    }

    


}