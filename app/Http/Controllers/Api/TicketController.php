<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\TicketStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;


class TicketController extends Controller
{
    protected ResponseHelper $rh;

    public function __construct(ResponseHelper $rh) 
    {
        $this->rh = $rh;
    }

    public function getTicketStatusAndCategory(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $ticket_categories = Categories::get(['id', 'name']);
        $ticket_status = TicketStatus::orderBy('serial', 'ASC')->get(['id', 'name', 'serial', 'color']);
        
        return $this->rh->sendResponse(
            isSuccess: true,
            statusCode: 200,
            errorMessage: '',
            responseData: [
                'ticketCategories' => $ticket_categories,
                'ticketStatus' => $ticket_status
            ]
        );
    }





}
