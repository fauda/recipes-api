<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParsedRequest;
use App\Http\Response\BasicCollectionResponseGenerator;
use App\Http\Response\FractalItemResponseBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception as HttpException;

abstract class ApiController extends Controller
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getItemResponseBuilder() : FractalItemResponseBuilder
    {
        return $this->app->make(FractalItemResponseBuilder::class);
    }

    public function getBasicListResponse(array $list, ParsedRequest $parsedRequest) : Response
    {
        return $this->app->make(BasicCollectionResponseGenerator::class)
            ->generateCollectionResponse(
                $list,
                $parsedRequest
            );
    }

    public function getStoreResponse($object, $location) : Response
    {
        $response = $this->getItemResponseBuilder()->build($object)
            ->setStatusCode(Response::HTTP_CREATED);

        $response->headers->add(['Location' => $location]);

        return $response;
    }

    public function getItemResponse($object) : Response
    {
        if (is_null($object)) {
            return $this->notFound();
        }

        return $this->getItemResponseBuilder()->build($object);
    }

    public function getStoreArrayResponse(array $array) : Response
    {
        /** @var Response $response */
        $response = $this->app->make(Response::class);

        $response
            ->setStatusCode(Response::HTTP_CREATED)
            ->setContent($array);

        return $response;
    }

    public function notFound($message = 'Not Found')
    {
        throw new HttpException\NotFoundHttpException($message);
    }
}
