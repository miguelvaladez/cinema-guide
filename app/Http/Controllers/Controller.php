<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Store the status code
     * @var integer
     */
    protected $status = 200;

    /**
     * Get the current status code
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set a new status code
     * @param integer $code
     */
    public function setStatus($code)
    {
        $this->status = $code;

        return $this;
    }

    /**
     * Return a custom json data response
     * @param  array $data    [required]
     * @param  array $headers [optional]
     * @return array json
     */
    public function respond($data, $headers = [])
    {
    	return response()->json($data, $this->getStatus(), $headers);
    }
}
