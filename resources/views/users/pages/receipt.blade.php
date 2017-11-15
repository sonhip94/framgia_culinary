@extends("welcome")

@section("content")
@section('style')
    {{ Html::style('users/css/default.css') }}
    {{ Html::style('users/css/style.css') }}
@endsection
    <div class="container full-container" id="server-view">
        <div>
            <div class="result-box">
                <div class="result-box-inner" style="position: relative;">
                    <div class="result-headline">
                        <div>
                            <div class="result-container">
                                <h1>{{ trans("sites.receiptAll") }}</h1>
                                <div class="desc">
                                    <strong class="text-highlight">{{ $receiptAll->count() }}</strong>
                                    {{ trans("sites.receipt") }}
                                    <span class="text-red text-bold">""</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="tab_container">
                        
                        <!-- <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1"><span>Chuyên mục</span></label>

                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2"><span>Nguyên liệu</span></label> -->
                        <form action="{{ route('sort') }}" method="get" class="form">
                        <div class="sort">
                            <select id="sltSort" name='sltSort' style="float:right;width: 10%;height: 100%;" class='form-control' onchange="this.form.submit()">
                                <option value='desc' @if(isset($value) && $value=='desc') selected @endif>Gần nhất</option>
                                <option value='asc' @if(isset($value) && $value=='asc') selected @endif>Lâu hơn</option>
                            </select>
                            <noscript><input type="submit" value="Submit"></noscript>
                        </div>
                    </form>
                    
                        <!-- <section id="content1" class="tab-content">
                            <form action="{{ route('filter') }}" method="get" class="form">
                            @if(isset($foodies))
                                @foreach($foodies as $key => $item)
                                        @foreach($item->childs as $key => $item2)
                                        <div class='col-md-2'>
                                            <input type='checkbox' name='checkBox1' onchange="this.form.submit()" value='{{ $item2->id }}'/>{{ $item2->name }}
                                        </div>
                                        @endforeach
                                        @if(++$key % 6 == 0)
                                        <div class="clearfix"></div>
                                        @endif
                                        <div class="clearfix"></div>
                                @endforeach
                            @endif
                        </form>
                        </section>

                        <section id="content2" class="tab-content">
                            <form action="{{ route('filter') }}" method="get" class="form">
                           @foreach($categories as $key => $item)
                                <div class='col-md-2'>
                                <input type='checkbox' name='checkBox2' onchange="this.form.submit()" value='{{ $item->id }}'/>{{ $item->name }}
                            </div>
                            @if(++$key % 6 == 0)
                                <div class="clearfix"></div>
                                @endif
                            @endforeach
                        </form>
                        </section> -->
                    </div>
                    <div class="clearfix"></div>
                    <div class="result-list recipe-list row10">
                        @foreach($receiptAll as $key => $item)
                            <div class="result-recipe-wrapper">
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" href="{{ route('detail',$item->id) }}" target="_blank">
                                                <img class="photo img-responsive"
                                                     src="{{ asset('upload/images/'.$item->image) }}"
                                                     alt="{{ $item->name }}"/>
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h3>
                                                        <a rel="alternate" href="{{ route('detail',$item->id) }}"
                                                           title="{{ $item->name }}"
                                                           target="_blank">{{ $item->name }}</a>
                                                    </h3>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span class="stats-count">{{ $item->time }}</span><span
                                                                        class="stats-text">{{ trans("sites.hour") }}</span>
                                                            </li>
                                                            <li class="stats-item"><span
                                                                        class="fa fa-bolt stats-ico"></span> <span
                                                                        class="stats-text stats-count">
                                                            @if($item->complex == 1)
                                                                        {{ trans("sites.easy")}}
                                                                    @elseif($item->complex == 2)
                                                                        {{ trans("sites.normal") }}
                                                                    @else
                                                                        {{ trans("sites.hard") }}
                                                                    @endif
                                                        </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    @foreach($item->receiptIngredients as $value)
                                                        <span> {{ $value->ingredient->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="../thanh-vien/belun.html" target="_blank">
                                                        <img class="circle"
                                                             src="{{ asset('upload/images/'.$item->user->avatar) }}"/>
                                                        {{ $item->user->name }}
                                                    </a>
                                                </div>
                                                <div class="recipe-acts">
                                                    <div class="btn-group">
                                                        <a href="javascript:void(0)" class="btn btn-danger">
                                                            <span class="fa fa-star text-orange"></span>
                                                            <span>{{ $item->rate_point }} </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                @if(++$key % 4 == 0)
                    <div class='clearfix'></div>
                @endif
                        @endforeach
                    </div>
                </div>
                <div class="text-center">{{ $receiptAll->links() }}</div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{ Html::script('users/js/receipt.js') }}
@endsection