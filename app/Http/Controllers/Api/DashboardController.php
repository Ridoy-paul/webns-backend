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
use App\Models\Tickets;


class DashboardController extends Controller
{
    protected ResponseHelper $rh;

    public function __construct(ResponseHelper $rh) 
    {
        $this->rh = $rh;
    }

    public function getDashboardData(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $totalTickets = Tickets::when($user->type == 'user', function ($query) use ($user) {
                            return $query->where('user_id', $user->id);
                        })
                        ->count();

        $statusByTickets = [];

        $ticketStatus = TicketStatus::orderBy('serial', 'ASC')->get();
        foreach ($ticketStatus as $status) {
            $count = Tickets::where('status_id', $status->id)
                        ->when($user->type == 'user', function ($query) use ($user) {
                            return $query->where('user_id', $user->id);
                        })
                        ->count();

            $statusByTickets[] = [
                'status' => $status->name,
                'count' => $count,
            ];
        }

        return $this->rh->sendResponse(
            isSuccess: true,
            statusCode: 200,
            errorMessage: '',
            responseData: [
                'total_tickets' => $totalTickets,
                'status_by_tickets' => $statusByTickets
            ],
        );
    }






}
