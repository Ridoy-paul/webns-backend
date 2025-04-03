<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\TicketStatus;
use App\Models\Tickets;
use App\Models\Comments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\DB;

class TicketCommentController extends Controller
{

    protected ResponseHelper $rh;

    public function __construct(ResponseHelper $rh) 
    {
        $this->rh = $rh;
    }

    public function getTicketComment(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $ticket_id = $request->ticket_id ?? null;
        $ticketInfo = Tickets::where('id', $ticket_id)
                    ->when($user->type == 'user', function ($query) use ($user) {
                        return $query->where('user_id', $user->id);
                    })
                    ->first(['id', 'user_id']);


        if($ticketInfo === null) {
            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 200,
                errorMessage: 'Invalid Ticket Comment Access',
                responseData: ''
            );
        }

        $comments = Comments::with([
            'user_info' => function($query) {
                $query->select('id', 'name');
            },
        ])->where('ticket_id', $ticket_id)->get();

        return $this->rh->sendResponse(
            isSuccess: true,
            statusCode: 200,
            errorMessage: '',
            responseData: $comments
        );
    }

    public function saveTicketComment(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $ticket_id = $request->ticket_id ?? null;
        $ticketInfo = Tickets::where('id', $ticket_id)
                    ->when($user->type == 'user', function ($query) use ($user) {
                        return $query->where('user_id', $user->id);
                    })
                    ->first(['id', 'user_id']);


        if($ticketInfo === null) {
            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 200,
                errorMessage: 'Invalid Ticket Access to Store Comment.',
                responseData: ''
            );
        }

        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);

        $commentStore = new Comments();
        $commentStore->ticket_id = $ticket_id;
        $commentStore->user_id = $user->id;
        $commentStore->message = $validatedData['comment'];
        $commentStore->save();



        return $this->rh->sendResponse(
            isSuccess: true,
            statusCode: 200,
            errorMessage: '',
            responseData: ''
        );
    }


    

}
