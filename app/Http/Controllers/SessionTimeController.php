<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SessionTime;

class SessionTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sessions = SessionTime::with(['cinema', 'movie'])->paginate(5);

        return $sessions;
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if (SessionTime::create($data)) {
            return $this->respond(['type' => 'success', 'message' => 'New Session Time added']);
        }

        return $this->respond(['type' => 'failure', 'message' => 'Failed to add a new session']);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if ($search != '') {
            // Search against cinema names
            $sessions = SessionTime::whereHas('cinema', function($query) use($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })->with(['cinema', 'movie'])->paginate();

            // if nothing is found search against movie titles
            if (!count($sessions)) {
                $sessions = SessionTime::whereHas('movie', function($query) use($search) {
                    $query->where('title', 'like', '%'.$search.'%');
                })->with(['cinema', 'movie'])->paginate();
            }

            // if still nothing is found search against session times
            if (!count($sessions)) {
                $sessions = SessionTime::with(['cinema', 'movie'])->where('session_time', 'like','%'.$search.'%')->paginate(5);
            }

            // if we still found nothing, return a message
            if (!count($sessions)) {
                return $this->respond(['type' => 'failure', 'message' => 'Sorry, no match found for: "'.$search.'"']);
            }

            return $sessions;
        }

        return $this->respond(['type' => 'failure', 'message' => 'Please supply a term to search against']);
    }
}
