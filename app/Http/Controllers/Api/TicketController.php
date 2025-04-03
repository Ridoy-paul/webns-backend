<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\TicketStatus;
use App\Models\Tickets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\DB;


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

    public function getTicketList(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $ticketList = Tickets::with([
                        'user_info' => function($query) {
                            $query->select('id', 'name');
                        },
                        'status_info' => function($query) {
                            $query->select('id', 'name');
                        },
                        'category_info' => function($query) {
                            $query->select('id', 'name');
                        },
                        'attachments' => function($query) {
                            $query->select('id', 'tickets_id', 'file_path', 'file_name');
                        },

                    ])
                    ->orderBy('id', 'DESC')
                    ->when($user->type === 'user', function ($query) use ($user) {
                        return $query->where('user_id', $user->id);
                    })
                    ->get(['id', 'user_id', 'category_id', 'subject', 'priority', 'status_id', 'is_active', 'created_at']);
        
        return $this->rh->sendResponse(
            isSuccess: true,
            statusCode: 200,
            errorMessage: '',
            responseData: $ticketList
        );
    }

    public function getTicketItem(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $ticket_id = $request->ticket_id ?? null;

        $ticketInfo = Tickets::with([
                        'user_info' => function($query) {
                            $query->select('id', 'name');
                        },
                        'status_info' => function($query) {
                            $query->select('id', 'name');
                        },
                        'category_info' => function($query) {
                            $query->select('id', 'name');
                        },
                        'attachments' => function($query) {
                            $query->select('id', 'tickets_id', 'file_path', 'file_name');
                        },

                    ])
                    ->where('id', $ticket_id)
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
        
        return $this->rh->sendResponse(
            isSuccess: true,
            statusCode: 200,
            errorMessage: '',
            responseData: $ticketInfo
        );
    }



    public function saveTicketData(Request $request) {
        
        DB::beginTransaction();
        
        try {
            $user = Auth::user();
            if ($user === null) {
                return $this->rh->sendResponse(
                    statusCode: 401,
                    errorMessage: 'No authenticated user found',
                );
            }

            $validatedData = $request->validate([
                'subject' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|integer|exists:categories,id',
                'priority' => 'required|string|in:Low,Medium,High',
                'status_id' => 'nullable|integer|exists:ticket_statuses,id',
                'attachments' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:10240',
            ]);

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                if (!$file->isValid()) {
                    return $this->rh->sendResponse(
                        isSuccess: false,
                        statusCode: 400,
                        errorMessage: 'Uploaded file is not valid.',
                        responseData: ''
                    );
                }
            }

            $ticket_id = $request->ticket_id ?? null;
            if ($ticket_id !== null) {
                $ticket = Tickets::where('id', $ticket_id)
                            ->when($user->type == 'user', function ($query) use ($user) {
                                return $query->where('user_id', $user->id);
                            })
                            ->first();


                if ($ticket === null) {
                    return $this->rh->sendResponse(
                        isSuccess: false,
                        statusCode: 200,
                        errorMessage: 'Invalid ticket access!',
                        responseData: ''
                    );
                }

                $ticket->status_id = $validatedData['status_id'];

            } else {
                $ticket = new Tickets();
                $ticket->user_id = $user->id;
                $ticket->status_id = (TicketStatus::orderBy('serial', 'ASC')->first(['id']))->id;
                $ticket->is_active = true;
            }

            $ticket->subject = $validatedData['subject'];
            $ticket->description = $validatedData['description'];
            $ticket->category_id = $validatedData['category_id'];
            $ticket->priority = $validatedData['priority'];
            $ticket->save();


            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
                $image = $request->file('attachment');
                $imageName = time() . rand(10000, 99999) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('attachments/');
                $image->move($destinationPath, $imageName);

                $ticket->attachments()->create([
                    'file_path' => 'attachments/' . $imageName,
                    'file_name' => $image->getClientOriginalName(),
                ]);
            }


            DB::commit();

            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: '',
                responseData: $ticket
            );

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Ticket creation failed: ' . $e->getMessage());

            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 500,
                errorMessage: 'An error occurred while saving the ticket data.',
                responseData: ''
            );
        }
    }

    public function deleteTicketItem(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        if ($user->type <> 'admin') {
            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 200,
                errorMessage: 'You cannot delete Ticket Info.',
            );
        }

        $ticket_id = $request->ticket_id ?? null;

        $ticketInfo = Tickets::with([
                        'attachments' => function($query) {
                            $query->select('id', 'tickets_id', 'file_path', 'file_name');
                        },
                        'comments'
                    ])
                    ->where('id', $ticket_id)
                    ->first();

        if ($ticketInfo === null) {
            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 200,
                errorMessage: 'Invalid Ticket Access',
                responseData: ''
            );
        }

        try {
            
            if ($ticketInfo->attachments->isNotEmpty()) {
                foreach ($ticketInfo->attachments as $attachment) {
                    if (file_exists($attachment->file_path)) {
                        unlink($attachment->file_path);
                    }
                    $attachment->delete();
                }
            }

            if ($ticketInfo->comments->isNotEmpty()) {
                $ticketInfo->comments()->delete();
            }

            $ticketInfo->delete();

            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: '',
                responseData: 'Ticket and associated data successfully deleted.'
            );

        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                isSuccess: false,
                statusCode: 500,
                errorMessage: 'An error occurred while deleting the ticket. Please try again later.',
                responseData: $e->getMessage()
            );
        }
    }










}
