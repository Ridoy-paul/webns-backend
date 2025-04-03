<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatGroup;
use App\Models\Chats;
use App\Models\User;
use App\Events\NewChatMessage;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use App\Models\Tickets;


class ChatController extends Controller
{

    protected ResponseHelper $rh;

    public function __construct(ResponseHelper $rh) 
    {
        $this->rh = $rh;
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $ticketInfo = Tickets::where('id', $request->ticket_id)
                    ->when($user->type == 'user', function ($query) use ($user) {
                        return $query->where('user_id', $user->id);
                    })
                    ->first();

        if($ticketInfo === null) {
            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 200,
                errorMessage: 'Invalid Ticket Access',
                responseData: ''
            );
        }


        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $chatGroup = ChatGroup::firstOrCreate([
            'ticket_id' => $validated['ticket_id'],
            'user_id' => $validated['user_id'],
        ]);

        $chat = Chats::create([
            'chat_group_id' => $chatGroup->id,
            'ticket_id' => $validated['ticket_id'],
            'user_id' => $validated['user_id'],
            'message' => $validated['message'],
        ]);

        broadcast(new NewChatMessage($chat));

        return response()->json($chat, 201);
    }

    public function getMessages($ticket_id)
    {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $ticketInfo = Tickets::where('id', $ticket_id)
                    ->when($user->type == 'user', function ($query) use ($user) {
                        return $query->where('user_id', $user->id);
                    })
                    ->first();

        if($ticketInfo === null) {
            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 200,
                errorMessage: 'Invalid Ticket Access',
                responseData: ''
            );
        }

        $chats = Chats::where('ticket_id', $ticket_id)->get();
        return response()->json($chats);
    }
}
