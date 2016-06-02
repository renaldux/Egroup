<?php namespace Egroup\Tests;

use PHPUnit_Framework_TestCase;
use Egroup\Controllers\PermissionsController;

class MyTests extends PHPUnit_Framework_TestCase
{
    /**
     * @var array $modules
     */
    protected $modules = [
        'gardening' => [
            'plant.seeds',
            'grow.vegetables'
        ],
        'construction' => [
            'build.house',
            'carry.bricks'
        ],
        'cook' => [
            'make.soup'
        ]
    ];

    /**
     * @var array $usersAndGroups
     */
    protected $usersAndGroups = [
        'jonas' => 'Gardener',
        'petras' => 'Builder'
    ];

    /**
     * @var array $groupPermissions
     */
    protected $groupPermissions = [
        'Gardener' => ['gardening'],
        'Builder' => ['construction']
    ];

    /**
     * @var array $usersPermissions
     */
    protected $usersPermissions = [
        'jonas' => ['build.house'],
        'petras' => [
            'grow.vegetables',
            'cook'
        ]
    ];    
    
    /**
     * @param $module_part
     * @param $myGroupPermissionsArray
     * @param $module
     * @return bool
     */
    protected function userGroupHasPermissionToModule($module_part, $myGroupPermissionsArray, $module)
    {
        //check if user group has permission to module part
        if(in_array($module_part, $myGroupPermissionsArray)){
            return true;
        }
        //check if user group has permission to all module parts
        foreach ($myGroupPermissionsArray as $groupPermission){
            if(array_key_exists($groupPermission, $this->modules) && in_array($module_part, $this->modules[$groupPermission])) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $myPersonalPermissionsArray
     * @param $module_part
     * @return bool
     */
    protected function userHasPermissionToModulePart($myPersonalPermissionsArray, $module_part)
    {
        //check if user has permission to module part
        if (in_array($module_part, $myPersonalPermissionsArray)) {
            return true;
        }
        //check if user has permission to module
        foreach ($myPersonalPermissionsArray as $permission) {
            if (array_key_exists($permission, $this->modules) && in_array($module_part, $this->modules[$permission])) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $user
     * @param $module_part
     * @return boolean
     */
    protected function checkPermissions($user, $module_part)
    {
        $controller = new PermissionsController;
        return $controller->checkPermissions($user, $module_part);
    }
}