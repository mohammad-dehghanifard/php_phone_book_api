<?php

namespace App\Controllers;

use App\Traits\ResponseTrait;
use App\Database\QueryBuilder;

class PhoneController
{
    use ResponseTrait;

    protected $queryBuilder;
    protected  $phoneTable = "phones";
    public function __construct()
    {
        $this->queryBuilder = new  QueryBuilder();
    }

    public function getAll()
    {
        $phones = $this->queryBuilder->table($this->phoneTable)->getAll()->execute();
        return $this->sendResponse(data: $phones,message: "phone list");
    }

    public function getPhoneById($id)
    {
        $phone = $this->queryBuilder->table($this->phoneTable)->get()->where("id","=",$id)->execute();
        $message = "شماره تلفن مورد نظر با موفقیت پیدا شد";
        $error = false;
        if(!$phone)
        {
            $message = "شماره تلفنی پیدا نشد!";
            $error = true;
        }

        return $this->sendResponse(data: $phone,message: $message,error: $error);
    }
}