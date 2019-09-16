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
trait FormActionTrait
{
    /**
     * Classname of the form model which validates the request.
     * @var string
     */
    public $formClass;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (empty($this->formClass)) {
            throw new InvalidConfigException(get_class($this) . '::$formClass must be set.');
        }
    }
}
