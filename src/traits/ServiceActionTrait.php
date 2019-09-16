<?php

namespace albertborsos\rest\traits;

use albertborsos\ddd\interfaces\RepositoryInterface;
use albertborsos\ddd\interfaces\EntityInterface;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;

/**
 * Trait FormAndServiceActionTrait
 * @package albertborsos\rest
 */
trait ServiceActionTrait
{
    /**
     * Classname of the service which executes the business logic.
     * @var string
     */
    public $serviceClass;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (empty($this->serviceClass)) {
            throw new InvalidConfigException(get_class($this) . '::$serviceClass must be set.');
        }
    }
}
