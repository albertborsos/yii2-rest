<?php

namespace albertborsos\rest\active;

use albertborsos\rest\CreateActionTrait;
use albertborsos\rest\FormAndServiceActionTrait;

/**
 * Class CreateAction
 * @package albertborsos\rest\active
 */
class CreateAction extends Action
{
    use FormAndServiceActionTrait;
    use CreateActionTrait;
}
