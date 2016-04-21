<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Route;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractRequest extends BaseRequest
{
    /** @var array */
    protected $defaultMessages;

    /** @var array */
    protected $messages;

    /**
     * Validation rules
     * @return array
     */
    public abstract function rules() : array;

    /**
     * Authorization check
     * @return bool
     */
    public abstract function authorize() : bool;

    /**
     * @return mixed
     */
    public abstract function getDeserializedContent();

    /**
     * @return Route
     */
    public function getRoute() : Route
    {
        return $route = $this->container->make(Route::class);
    }

    /**
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors) : JsonResponse
    {
        return new JsonResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Validate the class instance.
     * @return void
     */
    public function validate()
    {
        /** @var Validator $instance */
        $instance = $this->getValidatorInstance();
        
        if (!$this->passesAuthorization()) {
            $this->failedAuthorization();
        } elseif (!$instance->passes()) {
            $this->failedValidation($instance);
        }
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        $messages = $this->getDefaultMessages();
        
        if ($this->messages !== null) {
            array_merge($messages, $this->container->make('config')->get($this->messages));
        }
        
        return $messages;
    }

    /**
     * @return array
     */
    public function getDefaultMessages() : array
    {
        if ($this->defaultMessages === null) {
            $this->defaultMessages = $this->container->make('config')->get('messages.default');
        }
        
        return $this->defaultMessages;
    }

    /**
     * @param array $defaultMessages
     * @return $this
     */
    public function setDefaultMessages(array $defaultMessages)
    {
        $this->defaultMessages = $defaultMessages;
        
        return $this;
    }
}