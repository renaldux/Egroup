<?php namespace Egroup\Models;

use Egroup\Contracts\Authorizable;
use Egroup\Traits\AuthorizableTrait;

class Permission extends Model implements Authorizable
{
    use AuthorizableTrait;

    /** @var string */
    protected $table = 'permissions';
    
    /** @var string $username */
    private $username;
    
    /** @var string $module_part_slug */
    private $module_part_slug;

    /**
     * @param $username
     * @param $module_part
     */
    public function setUserNameAndModulePartSlug($username, $module_part)
    {
        $this->username = $username;
        $this->module_part_slug = $module_part;
    }
}