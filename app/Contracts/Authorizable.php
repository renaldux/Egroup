<?php namespace Egroup\Contracts;

interface Authorizable
{

    /**
     * @param $username
     * @param $module_part
     */
    public function setUserNameAndModulePartSlug($username, $module_part);

    /**
     * @return bool
     * @throws ParametersNotSetException
     */
    public function granted();

}