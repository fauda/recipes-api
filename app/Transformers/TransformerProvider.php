<?php

namespace App\Transformers;

use App\Exceptions\TransformerNotFoundException;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use League\Fractal\TransformerAbstract;

/**
 * Class TransformerProvider
 */
class TransformerProvider
{

    const CONFIG_TRANSFORMER = 'transformers.%s';

    /**
     * @var Repository
     */
    private $config;

    /**
     * @var array
     */
    private $transformers = [];

    /**
     * @var Application
     */
    private $application;

    /**
     * TransformerProvider constructor.
     * @param Repository $config
     * @param Application $application
     */
    public function __construct(Repository $config, Application $application)
    {
        $this->config = $config;
        $this->application = $application;
    }

    public function registerTransformers(array $transformers)
    {
        if(empty($transformers)) {
            return;
        }

        foreach($transformers as $alias => $transformer) {
            $transformerInstance = new $transformer;
            $this->registerTransformer($transformerInstance, $alias);
        }
    }

    /**
     * @param $transformer
     * @return TransformerAbstract
     * @throws TransformerNotFoundException
     */
    public function getTransformer($transformer)
    {
        $identifier = sprintf(self::CONFIG_TRANSFORMER, $transformer);
        if(!$this->hasTransformer($transformer) && !$this->config->has($identifier)) {
            throw new TransformerNotFoundException(
                "Could not load {$identifier}.It is possible this needs to be registered in app/config/transformers.php"
            );
        }

        if($this->hasTransformer($transformer)) {
            return $this->transformers[$transformer];
        }

        $transformerClass = $this->config->get($identifier);

        $transformerInstance = $this->application->make($transformerClass);

        $this->registerTransformer($transformerInstance, $transformer);

        return $transformerInstance;
    }

    /**
     * @param TransformerAbstract $transformer
     * @param $alias
     */
    public function registerTransformer(TransformerAbstract $transformer, $alias)
    {
        if(!$this->hasTransformer($alias)) {
            $this->transformers[$alias] = $transformer;
        }
    }

    /**
     * @param $transformer
     * @return mixed
     */
    public function hasTransformer($transformer)
    {
        return array_key_exists($transformer, $this->transformers);
    }
}