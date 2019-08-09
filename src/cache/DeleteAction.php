<?php

namespace albertborsos\rest\cache;

use albertborsos\rest\DeleteActionTrait;
use albertborsos\rest\FormAndServiceActionTrait;

/**
 * Class DeleteAction
 * @package albertborsos\rest\cache
 */
class DeleteAction extends Action
{
    use FormAndServiceActionTrait;
    use DeleteActionTrait;
}
