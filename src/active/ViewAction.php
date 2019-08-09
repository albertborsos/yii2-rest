<?php

namespace albertborsos\rest\active;

use albertborsos\ddd\interfaces\EntityInterface;
use albertborsos\rest\ViewActionTrait;
use yii\web\NotFoundHttpException;

/**
 * Class ViewAction
 * @package albertborsos\rest\active
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

        $model = $this->getRepository()->find()->with($relations)->where($this->getPrimaryKeyCondition($id))->one();

        if (isset($model)) {
            return $this->getRepository()->hydrate($model);
        }

        throw new NotFoundHttpException("Object not found: $id");
    }
}
