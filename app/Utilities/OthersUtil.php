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
    public static function meta_info(Request $request)
    {
        $data = [
            'meta_title' => $request->input('meta_title') ?? '',
            'meta_keywords' => $request->input('meta_keywords') ?? '',
            'meta_description' => $request->input('meta_description') ?? '',
            'meta_image' => $request->input('meta_image') ?? '',
            'meta_tags' => $request->input('meta_tags') ?? '',
        ];

        return $data;
    }

    public static function user_notification($data) {
        $data = json_decode($data);
        $userInfo = User::where('id', $data->user_id)->first(['id', 'name']);
        if(is_null($userInfo)) {
            return false;
        }
        $notification = new UserNotifications();
        $notification->user_id = $data->user_id ?? null;
        $notification->description = $data->description ?? '';
        $notification->link = $data->link ?? null;
        $notification->link_text = $data->link_text ?? null;
        $notification->created_date = now();
        $notification->is_seen = 0;
        $notification->save();

        $truncatedDescription = strlen($data->description) > 100 
                                ? substr($data->description, 0, 100) . '...' 
                                : $data->description;
                                
        broadcast(new PrivateMessage($data->user_id, $truncatedDescription));
        return true;
    }

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