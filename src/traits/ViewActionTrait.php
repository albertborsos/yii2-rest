<?php

namespace albertborsos\rest\traits;

/**
 * Trait ViewActionTrait
 * @package albertborsos\rest
 */
trait ViewActionTrait
{
    /**
     * Displays a model.
     * @param string $id the primary key of the model.
     * @return \albertborsos\ddd\interfaces\EntityInterface|null the model being displayed
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id)
    {
        $entity = $this->findEntity($id);
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $entity);
        }

        return $entity;
    }
}
