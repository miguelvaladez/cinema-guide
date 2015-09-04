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
}
