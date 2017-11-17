<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ReceiptRepositoryInterface;
use App\Repositories\Contracts\FoodyRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Models\Receipt;

class ReceiptController extends Controller
{
    private $receiptRepository;
    private $foodyRepository;
    private $categoryRepository;

    public function __construct(
        ReceiptRepositoryInterface $receiptRepository,
        FoodyRepositoryInterface $foodyRepository,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->receiptRepository = $receiptRepository;
        $this->foodyRepository = $foodyRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $receiptAll = $this->receiptRepository->getAllReceipt([], '*', [1], 16);
        return view("users.pages.receipt", compact("receiptAll"));
    }

    public function search(Request $request)
    {
        $word = $request->input("keyword");
        $keyword = "%" . $word . "%";
        $value = $this->receiptRepository->searchNormal($keyword);
        $pagination = $value->appends(array(
            "keyword" => $request->input("keyword")
        ));

        $countValue = $value->count();
        return view("users.pages.search", compact("value", "pagination", "word", "countValue"));
    }

    public function sort(Request $request)
    {
        $value = $request->input("sltSort");

        if($value == 'asc'){
            $receiptAll = $this->receiptRepository->getAllReceipt([], '*', [1], 16);
            return view('users.pages.receipt',compact('receiptAll','value'));
        }
        else if($value == 'desc'){
         $receiptAll=Receipt::orderBy('id','DESC')->where('status',1)->paginate(16);
         return view('users.pages.receipt',compact('receiptAll','value'));
        }
         
    }

    // public function filter(Request $request)
    // {
    //     $value = $request->input("checkBox1");
    //     $value2 = $request->input('checkBox2');

    //     $receiptAll=Receipt::orderBy('id','DESC')->where('status',1)->paginate(16);
    //     return view('users.pages.receipt',compact('receiptAll','value'));

        
    // }

    public function foody($id)
    {
        $foody = $this->foodyRepository->find($id);
        return view("users.pages.recFoody",compact("foody"));
    }

    public function ingredient($id)
    {
        $category = $this->categoryRepository->find($id);
        return view("users.pages.recIngre",compact("category"));
    }
}
