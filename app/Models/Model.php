<?php

namespace Egroup\Models;

use Egroup\Database\MySqlConnection;
use Egroup\Exceptions\TableNotSpecifiedException;

abstract class Model extends MySqlConnection
{
    /** @var  string (database table name) */
    protected $table;

    public function __construct()
    {
        if ( ! $this->table) {
            throw new TableNotSpecifiedException();
        }
        //TODO receive DB connection through DI
    }
}