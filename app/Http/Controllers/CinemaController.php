<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cinema as Cinema;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cinemas = Cinema::paginate(5);
        return $cinemas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (Cinema::create($data)) {
            return $this->respond(['type' => 'success', 'message' => 'New Cinema created']);
        }

        return $this->respond(['type' => 'failure', 'message' => 'Failed to save new Cinema']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $cinema = Cinema::find($id);
        return $cinema;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $cinema = Cinema::find($id);
        $data =  $request->all();

        if ($cinema->update($data)) {
            return $this->respond(['type' => 'success', 'message' => 'Cinema updated']);
        }

        return $this->respond(['type' => 'failure', 'message' => 'Failed to update cinema']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Cinema::destroy($id)) {
            return $this->respond(['type' => 'success', 'message' => 'Cinema destoyed']);
        }

        return $this->respond(['type' => 'failure', 'message' => 'Failed to destroy Cinema']);
    }

    /**
     * Show the session times for a given cinema
     *
     * @param  Request $request
     * @param  integer  $id
     * @return Response
     */
    public function sessions(Request $request, $id)
    {
        $date = $request->get('date');
        $sessions = Cinema::find($id)->sessionTimes();

        if ($date) {
            $sessions->where('session_time', 'like','%'.$date.'%');
        }

        return $sessions->paginate();
    }
}
