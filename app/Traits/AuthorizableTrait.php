<?php namespace Egroup\Traits;

use Egroup\Exceptions\ParametersNotSetException;

trait AuthorizableTrait
{
    /**
     * @return bool
     * @throws ParametersNotSetException
     */
    public function granted()
    {
        if (!$this->module_part_slug || !$this->username) {
            throw new ParametersNotSetException();
        }
        if ($this->userCan()) {
            return true;
        } elseif ($this->groupCan()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    private function userCan()
    {
        $sql = "SELECT `module_user`.`username`, `part_user`.`username` FROM `modules` AS `part`
                    LEFT JOIN `user_permissions` AS `part_permission` ON `part`.`id` = `part_permission`.`module_id`
                    LEFT JOIN `user_permissions` AS `module_permission` ON `part`.`parent_id` = `module_permission`.`module_id`
                    LEFT JOIN `users` AS `part_user` ON `part_user`.`id` = `part_permission`.`user_id`
                    LEFT JOIN `users` AS `module_user` ON `module_user`.`id` = `module_permission`.`user_id`
                    
                    WHERE `part`.`slug` = :module_part_slug
                    AND (`part_user`.`username` = :username OR `module_user`.`username` = :username);";
        $result = $this->fetchOne($sql, [
            'username' => $this->username,
            'module_part_slug' => $this->module_part_slug
        ]);

        return boolval($result);
    }

    /**
     * @return bool
     */
    private function groupCan()
    {
        $sql = "SELECT `module_user`.`username`, `part_user`.`username` FROM `modules` AS `part`
                    LEFT JOIN `group_permissions` AS `part_group_permissions` ON `part`.`id` = `part_group_permissions`.`module_id`
                    LEFT JOIN `group_permissions` AS `module_group_permissions` ON `part`.`parent_id` = `module_group_permissions`.`module_id`
                    LEFT JOIN `users` AS `part_user` ON `part_user`.`group_id` = `part_group_permissions`.`group_id`
                    LEFT JOIN `users` AS `module_user` ON `module_user`.`group_id` = `module_group_permissions`.`group_id`
                    
                WHERE `part`.`slug` = :module_part_slug
                AND (`part_user`.`username` = :username OR `module_user`.`username` = :username)";
        $result = $this->fetchOne($sql, [
            'username' => $this->username,
            'module_part_slug' => $this->module_part_slug
        ]);
        return boolval($result);
    }
}