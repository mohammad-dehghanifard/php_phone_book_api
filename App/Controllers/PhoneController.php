<?php

namespace App\Controllers;

use App\Traits\ResponseTrait;
use App\Database\QueryBuilder;
use App\Validations\ValidateData;

class PhoneController
{
    use ResponseTrait;
    use ValidateData;

    protected $queryBuilder;
    protected  $phoneTable = "phones";
    public function __construct()
    {
        $this->queryBuilder = new  QueryBuilder();
    }

    public function getAll()
    {
        $phones = $this->queryBuilder->table($this->phoneTable)->getAll()->execute();
        if(count($phones) < 1) return $this->sendResponse(data: $phones,message: "لیست مخاطبین شما خالی است!");
        return $this->sendResponse(data: $phones,message: "phone list");
    }

    public function getPhoneById($id)
    {
        $phone = $this->queryBuilder->table($this->phoneTable)->get()->where("id","=",$id)->execute();

        if(!$phone) return $this->sendResponse(data: $phone,message: "شماره تلفنی پیدا نشد",error: true,status: HTTP_BadREQUEST);
        return $this->sendResponse(data: $phone,message: "شماره تلفن مورد نظر با موفقیت پیدا شد");
    }

    public function createPhone($request)
    {
        $validate = $this->validate(
            fields: [
                'username||min:3|max:15',
                'phone'
            ],
            request: $request
        );

        if($validate)
        {
            $newPhone = $this->queryBuilder->table($this->phoneTable)->insert([
                "username" => $request->username,
                "phone" => $request->phone
            ])->execute();

            return $this->sendResponse(data: $newPhone,message: "شماره تلفن با موفقیت ایجاد شد!");
        }



    }

    public function updatePhone($id,$request)
    {
        $updatePhone = $this->queryBuilder->table($this->phoneTable)->update([
            "username" => $request->username,
            "phone" => $request->phone
        ])->where("id","=",$id)->execute();
        return $this->sendResponse(data: $updatePhone,message: "شماره تلفن با موفقیت اپدیت شد!");
    }

    public function deletePhone($id)
    {
        $deletedPhone = $this->
        queryBuilder->table($this->phoneTable)
            ->delete()->where("id","=",$id)->execute();

        return $this->sendResponse(data: $deletedPhone,message: "شماره مورد نظر حذف شد!");
    }
}