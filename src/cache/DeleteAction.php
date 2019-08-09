<?php

namespace albertborsos\ddd\rest\cache;

use albertborsos\ddd\rest\DeleteActionTrait;
use albertborsos\ddd\rest\FormAndServiceActionTrait;

/**
 * Class DeleteAction
 * @package albertborsos\ddd\rest\cache
 * @since 2.0.0
 */
class DeleteAction extends Action
{
    use FormAndServiceActionTrait;
    use DeleteActionTrait;
}