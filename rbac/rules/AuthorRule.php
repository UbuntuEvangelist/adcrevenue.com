<?php
namespace app\rbac\rules;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params.
 * Not used by default since 2.3.0 version.
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';


    public function execute($user, $item, $params)
    {
        return isset($params['model']) ? $params['model']->createdBy == $user : false;
    }
}