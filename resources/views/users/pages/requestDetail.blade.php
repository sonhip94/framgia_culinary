@extends('welcome')

@section('content')
@section('style')
    {{ Html::style('users/css/requestDetail.css') }}
@endsection
<div class="pr-home">
    <div class="wide-box">
        <div class="container">
            <div class="topic-list">
                <div class="topic-list-inner row10">
                    <div class="item review-item topic-item">
                        <div class="item-inner">
                            <div class="header">
                                <div class="user-info">
                                    <div class="avt">
                                        <a href="{{ route('myProfile', $requestReceipt->user_id) }}" title="{{ $requestReceipt->user->name }}" target="_self">
                                            <img src="{{ asset('upload/images/'.$requestReceipt->user->avatar) }}"/>
                                        </a>
                                    </div>
                                    <div class="profile">
                                        <a href="{{ route('myProfile', $requestReceipt->user_id) }}" class="name cooky-user-link"><span> {{ $requestReceipt->user->name }}</span></a>
                                        <span class="user-stats">
                                            <span class="stats-item">
                                                <span class="stats-count">{{ count($requestReceipt->user->receipts) }}</span>
                                                <span class="stats-text"> {{ trans('sites.receipt') }}</span>
                                            </span>
                                            <span class="stats-item">
                                                <span class="stats-count">{{ count($requestReceipt->user->follows) }}</span>
                                                <span class="stats-text"> {{ trans('sites.follow') }}</span>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="rating">
                                        @if(Auth::check())
                                            @if(Auth::user()->id != $requestReceipt->user->id)
                                            <input type='hidden' value='{{ $requestReceipt->id }}' id='id_request_receipt' />
                                            <input type='hidden' value='{{ Auth::user()->id }}' id='receive_id'/>
                                            <input type='hidden' value='{{ Auth::user()->name }}' id='nameUser'/>
                                                <button class="text-gray" id='receive{{ $requestReceipt->id }}{{ Auth::user()->id }}'>
                                                        <i class="fa fa-get-pocket" title="Nhận" aria-hidden="true"></i>
                                                </button>
                                                <div id="myModal{{ $requestReceipt->id }}{{ Auth::user()->id }}" class="modal">
                                                  <div class="modal-content">
                                                    <button class="close{{ $requestReceipt->id }}{{ Auth::user()->id }}">&times;</button>
                                                    <div class="private-chat">
                                                        <ul class="show-message" data-user_id='{{ Auth::user()->id }}' class="list-group">
                        
                                                        </ul>
                                                    </div>
                                                    <br>
                                                    <textarea class='pri-message' id='private-message{{ $requestReceipt->id }}{{ Auth::user()->id }}'
                                                        data-user_id='{{ Auth::user()->id }}'></textarea>
                                                  </div>
                                                </div>
                                            @else
                                            <input type='hidden' value='{{ $requestReceipt->id }}' id='id_request_receipt' />
                                            <input type='hidden' value='{{ $requestReceipt->receive_id }}' id='receive_id'/>
                                            <input type='hidden' value='{{ $requestReceipt->user->name }}' id='nameUser'/>
                                                <div id="myModal{{ $requestReceipt->id }}{{ $requestReceipt->receive_id }}" class="modal">
                                                  <div class="modal-content">
                                                    <button class="close{{ $requestReceipt->id }}{{ $requestReceipt->receive_id }}">&times;</button>
                                                    <div class="private-chat">
                                                        <ul class="show-message" class="list-group">
                        
                                                        </ul>
                                                    </div>
                                                    <br>
                                                    <textarea class='pri-message' id='private-message{{ $requestReceipt->id }}{{ $requestReceipt->receive_id }}' data-user_id='{{ Auth::user()->id }}'></textarea>
                                                  </div>
                                                </div>
                                            @endif
                                        @endif
                                        <span class="date-time rated-date">
                                            <span>
                                                {!!  \Carbon\Carbon::createFromTimestamp(strtotime($requestReceipt->created_at))->diffForHumans() !!}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pr-content">
                                <div class="pr-title">
                                    <h3>{{ $requestReceipt->name }}</h3>
                                </div>
                                <div class="pr-opts opts">
                                    <div class="opt"><span class="text">{{ trans('sites.amount') }}:</span> {{ $requestReceipt->ration }}</div>
                                </div>
                                <div class="content">
                                    {{ $requestReceipt->description }}
                                </div>
                            </div>

                            <div class="thumbnail">
                                <img src="{{ asset('upload/images/'.$requestReceipt->image) }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="top-community">
                <h1>{{ trans('sites.chatRoom') }}</h1>
                @if(Auth::check())
                <div class="chat">
                    <ul class="show-all-messages" class="list-group">
                        
                    </ul>
                </div>
                <div class="clearfix"></div><br>
                <textarea placeholder="Nhập nội dung..." id="input-message" data-user_id="{{ Auth::user()->id }}" data-name_user='{{ Auth::user()->name }}' data-id = '{{ $requestReceipt->id }}'></textarea>
                @else
                    <a href="{{ route('login') }}">{{ trans('sites.login') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
