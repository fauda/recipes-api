<?php

namespace App\Http\Response;

use App\Http\Requests\ParsedRequest;
use App\Models\Recipe;
use Illuminate\Http\Request;
use League\Fractal\Pagination\Cursor;
use Illuminate\Http\Response;

class BasicCollectionResponseGenerator
{
    /**
     * @var FractalCollectionResponseBuilder
     */
    protected $fractalResponseBuilder;

    /**
     * @var Cursor
     */
    protected $cursor;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param FractalCollectionResponseBuilder $fractalResponseBuilder
     * @param Cursor $cursor
     * @param Request $request
     */
    public function __construct(
        FractalCollectionResponseBuilder $fractalResponseBuilder,
        Cursor $cursor,
        Request $request
    ) {
        $this->fractalResponseBuilder = $fractalResponseBuilder;
        $this->cursor = $cursor;
        $this->request = $request;
    }

    public function generateCollectionResponse(array $list, ParsedRequest $parsedRequest) : Response
    {
        $this->cursor
            ->setCurrent($this->request->getRequestUri())
            ->setPrev($this->getPrevious($list, $parsedRequest))
            ->setNext($this->getNext($list))
            ->setCount(count($list));

        return $this->fractalResponseBuilder->build($list, $this->cursor);
    }

    public function getPrevious(array $list, ParsedRequest $parsedRequest)
    {
        if (empty($list)) {
            return null;
        } else {
            /** @var Recipe $firstRecipe */
            $firstRecipe = $list[0];
            max($firstRecipe->getId() - $parsedRequest->getMaxResults(), 0);
        }
    }


    public function getNext(array $list)
    {
        if (empty($list)) {
            return null;
        } else {
            /** @var Recipe $lastRecipe */
            $lastRecipe = end($list);
            return $lastRecipe->getId() + 1;
        }
    }

}