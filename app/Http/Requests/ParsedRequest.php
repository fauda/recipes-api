<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class ParsedRequest
{
    //Available parameters
    const PARAM_CURSOR_AFTER = 'after';
    const PARAM_MAX_RESULTS = 'max_results';

    /**
     * @var Request
     */
    private $request;

    /**
     * RequestParser constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array|string
     */
    public function getAfter()
    {
        return $this->request->input(self::PARAM_CURSOR_AFTER, 0);
    }

    /**
     * @return array|string
     */
    public function getMaxResults()
    {
        return $this->request->input(self::PARAM_MAX_RESULTS, 5);
    }

    /**
     * @return Request
     */
    public function getRequest() : Request
    {
        return $this->request;
    }
}