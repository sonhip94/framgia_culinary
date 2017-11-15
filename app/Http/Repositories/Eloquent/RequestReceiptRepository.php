<?php

namespace App\Repositories\Eloquent;

use App\Models\RequestReceipt;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\RequestReceiptRepositoryInterface;
use Auth;
class RequestReceiptRepository extends Repository implements RequestReceiptRepositoryInterface
{
    public function model()
    {
        return RequestReceipt::class;
    }

    public function createRequestReceipt($request)
    {
    	$file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(config('custom.image.url'), $file_name);
        $receipt = $this->model->create([
            'name' => $request->name,
            'ration' => $request->ration,
            'description' => $request->description,
            'image' => $file_name,
            'status' => config('const.unActive'),
            'user_id' => Auth::user()->id
        ]);
        return $receipt;
    }
}
