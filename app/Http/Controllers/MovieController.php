<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movie as Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Movie::paginate(5);
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
        if (Movie::create($data)) {
            return $this->respond(['type' => 'success', 'message' => 'New Movie created']);
        }

        return $this->respond(['type' => 'failure', 'message' => 'Failed to create new Movie']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Movie::find($id);
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
        $data = $request->all();
        $movie = Movie::find($id);

        if ($movie->update($data)) {
            return $this->respond(['type' => 'success', 'message' => 'Movie updated']);
        }

        return $this->respond(['type' => 'failure', 'message' => 'Failed to update movie']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Movie::destroy($id)) {
            return $this->respond(['type' => 'success', 'message' => 'Movie deleted']);
        }

        return $this->respond(['type' => 'failure', 'message' => 'Failed to delete movie']);
    }

    /**
     * Get a list of sessions for a given movie
     *
     * @param  Request $request
     * @param  integer $id
     * @return Response
     */
    public function sessions(Request $request, $id)
    {
        $date = $request->get('date');
        $sessions = Movie::find($id)->sessionTimes();

        if ($date) {
            $sessions->where('session_time', 'like','%'.$date.'%');
        }

        return $sessions->paginate();
    }
}
