@extends("welcome")

@section("content")
@section("style")
    {{ Html::style('users/bundles/blog8caf.css') }}
@endsection
<div class="article-wrapper">
    <div class="featured-wrapper wide-box">
        <div class="container">
            <h1 class="pull-left nom">{{ trans('sites.listRequest') }}</h1>
            <div class="clearfix"></div>
            <br>
            <div class="blog-featured-list row10">
                @foreach($listRequests as $key => $item)
                    <div class="blog-featured-item">
                        <article>
                            <a href="{{ route('showRequest', $item->id) }}" class="photo">
                                <img width="100" height="250" src="{{ asset('upload/images/'.$item->image) }}">
                            </a>
                            <section class="blog-snippet-container clearfix">
                                <div class="overlay-box"></div>
                                <section class="blog-content">
                                    <a class="sub-cate" href="{{ route('showRequest', $item->id) }}">{{ $item->name }}</a>
                                    <h2 class="title">
                                        <a href="{{ route('showRequest', $item->id) }}">
                                            {{ $item->description }}
                                        </a>
                                    </h2>
                                    <span style="color:white;">Đăng bởi: <a href='{{ route("myProfile", $item->user_id) }}'>{{ $item->user->name }}</a></span>
                                </section>
                            </section>
                        </article>
                    </div>
                    @if(++$key % 4 == 0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
