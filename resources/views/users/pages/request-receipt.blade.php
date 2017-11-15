@extends("welcome")

@section("content")

    <link href="{{ asset('users/Content/tao-cong-thuc.css') }}" rel="stylesheet" type="text/css"/>
    <div class="container">
        <div class="row">
            <section>
                <div class="wizard" style="width:70%;">
                    <h1>{{ trans('sites.submitRequest') }} {{ trans('sites.createReceipt') }}</h1>
                    <form role="form" action="{{ route('addReceiptCate') }}" method="post" id="frm-receipt"
                          enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <div class="receipt-form">
                                    <div class="col-md-6 left">
                                        <h3><i class='fa fa-paper-plane'></i> {{ trans('sites.inform') }}</h3>
                                        <hr>
                                        <label>{{ trans("sites.nameFood") }}</label>
                                        <input type="text" class="form-control" id="nameReceipt" name="nameReceipt"
                                               value="{{ isset($receipt->name)?$receipt->name:'' }}"/>
                                        <br>

                                        <label>{{ trans("sites.ration") }}</label>
                                        <input type="number" class="form-control" id="rationReceipt"
                                               name="rationReceipt" value="{{ isset($receipt->ration)?$receipt->ration:'' }}"/>
                                        <br>
                                        <label>{{ trans("sites.description") }}</label>
                                        <textarea class="form-control" id="descReceipt"
                                                  name="descReceipt">{{ isset($receipt->description)?$receipt->description:'' }}</textarea>
                                    </div>


                                    <div class="col-md-6 right">
                                        <h3><i class="fa fa-picture-o"></i> {{ trans("sites.avatar") }}(*)</h3>
                                        <hr>
                                        <label class="btn btn-default">
                                            <input type="file" class="form-control" id="imageReceipt" name="imageReceipt">
                                        </label>
                                        <div class="clearfix"></div>
                                        <br>
                                        <div class="avatarReceipt">
                                            <img src="{{ isset($receipt->image)?asset('upload/images/'.$receipt->image):'' }}"/>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="control" style="text-align: center;margin:0.5em;">
                                <button type="button" class="btn btn-default btn-ms" id="create-request">    {{ trans('sites.submitRequest') }}
                                </button>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section("script")
    {{ Html::script("users/js/createReceipt.js") }}
@endsection
