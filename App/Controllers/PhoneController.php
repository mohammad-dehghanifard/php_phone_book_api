<?php

namespace App\Controllers;

use App\Traits\ResponseTrait;
use App\Database\QueryBuilder;

class PhoneController
{
    use ResponseTrait;

    protected $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = new  QueryBuilder();
    }

    public function index()
    {
        $phones = $this->queryBuilder->table("phones")->getAll()->execute();
        return $this->sendResponse(data: $phones,message: "phone list");
    }
}