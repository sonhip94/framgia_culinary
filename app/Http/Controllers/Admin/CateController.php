<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;

class CateController extends Controller
{
    public function getList()
    {
        $cate = Category::select("*")->get();

        return view("admin.cate.cate_list", compact("cate"));
    }

    public function postAdd(Request $request)
    {
        if ($request->ajax()) {

            return response(Category::create($request->all()));
        }
    }

    public function postEdit(Request $request)
    {
        if ($request->ajax()) {
            $cate = Category::GetID($request->input("id"));
            if ($cate) {
                $cate->name = $request->input("name_cate");
                $cate->parent_id = $request->input("sltCategory");
                $cate->status = $request->input("sltStatus");
            }
            $cate->save();

            return response($cate);
        }
    }

    public function getDelete($id)
    {
        $parent = Category::ParentID($id)->count();
        if ($parent == 0) {
            $cate = Category::GetID($id);
            $cate->delete();

            return redirect()->route('getListCate')
                ->with([
                    'flash_message' => 'Xóa thành công!',
                    'flash_level' => 'success'
                ]);
        } else {
            notify("Bạn không thể xóa thể loại này", "getListCate");
        }
    }
}
