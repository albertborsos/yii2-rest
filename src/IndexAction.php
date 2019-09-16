<?php

namespace albertborsos\rest;

use albertborsos\rest\traits\IndexActionTrait;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;

/**
 * Class IndexAction
 * @package albertborsos\rest\cache
 */
class IndexAction extends Action
{
    use IndexActionTrait;

    /**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     * @throws \yii\base\InvalidConfigException
     */
    protected function prepareDataProvider()
    {
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        if ($this->prepareDataProvider !== null) {
            return call_user_func($this->prepareDataProvider, $this, $requestParams);
        }

        throw new InvalidConfigException('Search is not implemented in ' . get_class($this->getRepository()));
    }
}
