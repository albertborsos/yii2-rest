<?php

namespace albertborsos\rest;

use albertborsos\rest\traits\DeleteActionTrait;
use albertborsos\rest\traits\FormActionTrait;
use albertborsos\rest\traits\ServiceActionTrait;

/**
 * Class DeleteAction
 * @package albertborsos\rest\cache
 */
class DeleteAction extends Action
{
    use ServiceActionTrait;
    use DeleteActionTrait;
}
