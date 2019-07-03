<?php

namespace albertborsos\ddd\interfaces;

use albertborsos\ddd\factories\EntityFactory;
use yii\base\Model;

/**
 * Interface CacheRepositoryInterface
 * @package albertborsos\ddd\interfaces
 */
interface CacheRepositoryInterface
{
    public function get($key);

    public function set($key, $value, $duration = null, $dependency = null);

    public function delete($key);

    /**
     * @param EntityInterface $model
     * @return EntityInterface|null
     */
    public function findByEntity(EntityInterface $model): ?EntityInterface;

    /**
     * @param string $key
     * @return EntityInterface|null
     */
    public function findEntityByKey(string $key): ?EntityInterface;

    /**
     * @param EntityInterface $model
     * @param null $duration
     * @param null $dependency
     */
    public function storeEntity(EntityInterface $model, $duration = null, $dependency = null);
}
