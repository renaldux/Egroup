<?php namespace Egroup\Tests;

class PermissionsTest extends MyTests
{
    public function testAvailablePermissions()
    {
        //loop through users
        foreach ($this->usersAndGroups as $user => $group) {

            $myGroupPermissionsArray = $this->groupPermissions[$group];
            $myPersonalPermissionsArray = $this->usersPermissions[$user];
            //loop through all modules
            foreach ($this->modules as $module => $module_part_array) {

                //loop through all module parts
                foreach ($module_part_array as $module_part) {
                    
                    //call a method with username and module part
                    $result = $this->checkPermissions($user, $module_part);

                    if ($this->userGroupHasPermissionToModule($module_part, $myGroupPermissionsArray, $module)) {
                        $this->assertTrue($result);
                    } elseif ($this->userHasPermissionToModulePart($myPersonalPermissionsArray, $module_part)) {
                        $this->assertTrue($result);
                    } else {

                        $this->assertFalse($result);
                    }
                }
            }
        }
    }

    public function testFailsOnBogusData()
    {
        $this->assertFalse($this->checkPermissions('someBogusUser', 'bogus.module.part'));
        $this->assertFalse($this->checkPermissions('jonas', 'bogus.module.part'));
        $this->assertFalse($this->checkPermissions('bogus.user', 'construction'));

        $this->assertTrue($this->checkPermissions('jonas', 'plant.seeds'));
    }

}