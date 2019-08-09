<?php

namespace albertborsos\rest\active;

use albertborsos\rest\DeleteActionTrait;
use albertborsos\rest\FormAndServiceActionTrait;

/**
 * Class DeleteAction
 * @package albertborsos\rest\active
 */
class DeleteAction extends Action
{
    use FormAndServiceActionTrait;
    use DeleteActionTrait;
}
