<?php
namespace app\rbac\helpers;

use app\models\User;
use app\rbac\models\Role;
use Yii;

class RbacHelper
{    
    public static function assignRole($id)
    {        
        if (YII_ENV_PROD) {
            return true;
        }

        $usersCount = User::find()->count();

        if ($usersCount != 1) {
            return true;
        }

        $auth = Yii::$app->authManager;
        $role = $auth->getRole('theCreator');
        $info = $auth->assign($role, $id);
        
        return ($info->roleName == "theCreator") ? true : false ;
    }
}

