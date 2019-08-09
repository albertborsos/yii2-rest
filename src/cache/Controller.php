<?php

namespace albertborsos\rest\cache;

use albertborsos\ddd\interfaces\CacheRepositoryInterface;
use yii\base\InvalidConfigException;

/**
 * Class Controller
 * @package albertborsos\rest\cache
 */
class Controller extends \albertborsos\rest\Controller
{
    /**
     * @return CacheRepositoryInterface
     * @throws InvalidConfigException
     */
    public function getRepository(): CacheRepositoryInterface
    {
        return \Yii::createObject($this->repositoryInterface);
    }
}
