<?php

namespace albertborsos\rest;

use albertborsos\ddd\interfaces\EntityInterface;
use albertborsos\rest\traits\ViewActionTrait;

/**
 * Class ViewAction
 * @package albertborsos\rest\cache
 */
class ViewAction extends Action
{
    use ViewActionTrait;


    public function findEntity($id): ?EntityInterface
    {
        if ($this->findEntity !== null) {
            return call_user_func($this->findEntity, $id, $this);
        }

        $expand = \Yii::$app->request->getQueryParam('expand');

        if (empty($expand)) {
            return parent::findEntity($id);
        }

        $relations = explode(',', $expand);

        $entity = $this->getRepository()->findById($id);

        if (!isset($entity)) {
            throw new NotFoundHttpException("Object not found: $id");
        }

        return $entity;
    }
}
