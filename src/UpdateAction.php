<?php

namespace albertborsos\rest;

use albertborsos\rest\traits\FormActionTrait;
use albertborsos\rest\traits\ServiceActionTrait;
use albertborsos\rest\traits\UpdateActionTrait;

/**
 * Class UpdateAction
 * @package albertborsos\rest\cache
 */
class UpdateAction extends Action
{
    use FormActionTrait, ServiceActionTrait {
        FormActionTrait::init insteadof ServiceActionTrait;
        ServiceActionTrait::init insteadof FormActionTrait;
    }
    use UpdateActionTrait;
}
