<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RequestReceiptRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Events\LiveChat;
use App\Events\ChatPrivate;
use App\Events\NotifyRequest;
use App\Events\getReceiveId;

class RequestReceiptController extends Controller
{
	private $requestReceiptRepository;
	private $userRepository;

    public function __construct(
        RequestReceiptRepositoryInterface $requestReceiptRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->requestReceiptRepository = $requestReceiptRepository;
        $this->userRepository = $userRepository;
    }
    public function index()
    {
    	return view('users.pages.request-receipt');
    }

    public function create(Request $request)
    {
    	$response = $this->requestReceiptRepository->createRequestReceipt($request);
    	event(new NotifyRequest($response->id, $response->user->name));

    	return response($response);
    }

    public function show($id)
    {
    	$requestReceipt = $this->requestReceiptRepository->find($id);
    	return view('users.pages.requestDetail',compact('requestReceipt'));
    }

    public function liveChat(Request $request)
    {
    	if(!$request->ajax()){
    		return false;
    	}
    	event(new LiveChat($request->name, $request->user_id, $request->content, $request->id));

    	return response($request->all());
    }

    public function chatPrivate(Request $request)
    {
    	if(!$request->ajax()){
    		return false;
    	}
    	event(new ChatPrivate($request->privateMessage,$request->name, $request->receive_id, $request->privateChanel));


    	return response($request->all());
    }

    public function getReceiveId(Request $request)
    {
    	if(!$request->ajax()){
    		return false;
    	}
    	$response = $this->requestReceiptRepository->find($request->id);
    	$response->receive_id = $request->receive_id;
    	$response->save();
    }

    public function listRequest()
    {
    	$listRequests = $this->requestReceiptRepository->all();
    	return view('users.pages.requestAll',compact('listRequests'));
    }
}
