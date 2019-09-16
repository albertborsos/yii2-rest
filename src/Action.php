<?php

namespace albertborsos\rest;

use albertborsos\ddd\interfaces\EntityInterface;
use albertborsos\ddd\interfaces\RepositoryInterface;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;

/**
 * Class Action
 * @package mito\cms\core\rest\admin
 *
 * @property \mito\cms\core\rest\Controller $controller
 */
abstract class Action extends \yii\base\Action
{
    /**
     * @var string
     */
    public $repositoryInterface;

    /**
     * @var callable a PHP callable that will be called to return the entity corresponding
     * to the specified primary key value. If not set, [[findEntity()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($id, $action) {
     *     // $id is the primary key value. If composite primary key, the key values
     *     // will be separated by comma.
     *     // $action is the action object currently running
     * }
     * ```
     *
     * The callable should return the entity found, or throw an exception if not found.
     */
    public $findEntity;

    /**
     * @var callable a PHP callable that will be called when running an action to determine
     * if the current user has the permission to execute the action. If not set, the access
     * check will not be performed. The signature of the callable should be as follows,
     *
     * ```php
     * function ($action, $entity = null) {
     *     // $entity is the requested entity instance.
     *     // If null, it means no specific entity (e.g. IndexAction)
     * }
     * ```
     */
    public $checkAccess;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if (!$this->controller instanceof Controller && empty($this->repositoryInterface)) {
            throw new InvalidConfigException(get_class($this) . '::$repositoryInterface must be set.');
        }

        if (empty($this->repositoryInterface)) {
            $this->repositoryInterface = $this->controller->repositoryInterface;
        }
    }


    /**
     * Returns the data model based on the primary key given.
     * If the data model is not found, a 404 HTTP exception will be raised.
     * @param string $id the ID of the model to be loaded. If the model has a composite primary key,
     * the ID must be a string of the primary key values separated by commas.
     * The order of the primary key values should follow that returned by the `primaryKey()` method
     * of the model.
     * @return EntityInterface the model found
     * @throws NotFoundHttpException if the model cannot be found
     * @throws InvalidConfigException
     */
    public function findEntity($id): ?EntityInterface
    {
        if ($this->findEntity !== null) {
            return call_user_func($this->findEntity, $id, $this);
        }

        $entity = $this->getRepository()->findById($this->getPrimaryKeyCondition($id));

        if (isset($entity)) {
            return $entity;
        }

        throw new NotFoundHttpException("Object not found: $id");
    }

    /**
     * @return RepositoryInterface
     * @throws InvalidConfigException
     */
    public function getRepository(): RepositoryInterface
    {
        return $this->controller->getRepository();
    }

    protected function getPrimaryKeyCondition($id)
    {
        $keys = $this->getRepository()->newEntity()->getPrimaryKey();
        $keys = is_array($keys) ? $keys : [$keys];
        if (count($keys) > 1) {
            $values = explode(',', $id);
            if (count($keys) === count($values)) {
                return array_combine($keys, $values);
            }
        } elseif ($id !== null) {
            return $id;
        }

        return false;
    }
}
