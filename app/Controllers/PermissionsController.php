<?php namespace Egroup\Controllers;

use Egroup\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * @param $username
     * @param $module_part
     * @return bool
     * @throws \Egroup\Exceptions\ParametersNotSetException
     */
    public function checkPermissions($username, $module_part)
    {
        $permission = new Permission();
        $permission->setUserNameAndModulePartSlug($username, $module_part);
        return $permission->granted();
    }
}