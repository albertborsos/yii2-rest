<?php

namespace albertborsos\rest\active;

use albertborsos\ddd\interfaces\ActiveRepositoryInterface;
use yii\base\InvalidConfigException;

/**
 * Class Controller
 * @package albertborsos\rest\active
 */
class Controller extends \albertborsos\rest\Controller
{
    /**
     * @return ActiveRepositoryInterface
     * @throws InvalidConfigException
     */
    public function getRepository(): ActiveRepositoryInterface
    {
        return \Yii::createObject($this->repositoryInterface);
    }
}
