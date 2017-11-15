<div class="container">
    <div class="top-today-recipes">
        @if($slider)
            @foreach($slider as $item)
                <div class="today-recipe">
                    <a target="_blank" class="item" href="{{ route('detail',$item->id) }}">
                        <img src="{{ asset('upload/images/'.$item->image) }}">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    <div class="search_slider" style="width:100%;position:absolute;top:50px">
        <div class="search_slider2" style="max-width:800px;margin:0 15%">
            <div class="title">
                <h1 class="mt2 mb1 center">{{ trans("sites.today") }}</h1>
            </div>
            <div class=search-container><span class="fa fa-search"></span>
                <form action="{{ route('search') }}" method="get" class="form">
                    <input id="home-search-input" name="keyword" type="text" class="form-control"
                           placeholder="ví dụ: cupcake, soup, mojito, sinh tố...">
                </form>
            </div>
            <div class="trending-link">
                <ul>
                    @foreach($slider as $item)
                        <li><a href="{{ route('detail', $item->id) }}" target=_blank>{{ $item->name }} </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
