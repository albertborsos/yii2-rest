<?php

namespace albertborsos\rest;

use albertborsos\rest\traits\CreateActionTrait;
use albertborsos\rest\traits\FormActionTrait;
use albertborsos\rest\traits\ServiceActionTrait;

/**
 * Class CreateAction
 * @package albertborsos\rest\cache
 */
class CreateAction extends Action
{
    use FormActionTrait, ServiceActionTrait {
        FormActionTrait::init insteadof ServiceActionTrait;
        ServiceActionTrait::init insteadof FormActionTrait;
    }
    use CreateActionTrait;
}
