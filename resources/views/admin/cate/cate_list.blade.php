@extends("admin.master")

@section("controller", trans('sites.cate_ingre') )

@section("action", trans('sites.list') )

@section("content")

    <button type="button" class="btn btn-primary btn-ms" data-toggle="modal"
            data-target="#addCate">{{ trans("sites.add") }}
        {{ trans("sites.category") }}
    </button><br><br>
    <div id="addCate" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm thể loại</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('postAddCate') }}" id="frm-cate-add">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!} "/>
                        <label>Tên thể loại</label>
                        <input type="text" class="form-control" id="name_cate" value=""/>
                        <label>Chọn thể loại cha</label>
                        <select id="sltCategory" name="sltCategory" class="form-control">
                            <option value="0">None</option>
                            {{ cate_parent($cate) }}
                        </select>
                        <br>
                        <label>{{ trans("sites.status") }}</label>
                        <select id="sltStatus" name="sltStatus" class="form-control">
                            <option value="1">{{ trans("sites.active") }}</option>
                            <option value="0">{{ trans("sites.unactive") }}</option>
                        </select><br>
                        <button type="submit" name="addCategory" id="addCategory"
                                class="btn btn-default">{{ trans("sites.add") }}</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!--  -->
    <div id="editCate" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans("sites.edit") }} {{ trans("sites.category") }}</h4>
                </div>

                <div class="modal-body">
                    <form method="post" action="{{ route('postEditCate') }}" id="frm-cate-edit">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!} "/>
                        <input type="hidden" name="id" id="idCate" value=""/>
                        <label>Tên thể loại</label>
                        <input type="text" class="form-control" name="name_cate" id="name_cate" value=""/>
                        <label>Chọn thể loại cha</label>
                        <select id="sltCategory" name="sltCategory" class="form-control">
                            <option value="0">None</option>
                            {{ cate_parent($cate) }}
                        </select>
                        <br>
                        <label>{{ trans("sites.status") }}</label>
                        <select id="sltStatus" name="sltStatus" class="form-control">
                            <option value="1">{{ trans("sites.active") }}</option>
                            <option value="0">{{ trans("sites.unactive") }}</option>
                        </select><br>
                        <button type="submit" name="editCategory" id="editCategory"
                                class="btn btn-default">{{ trans("sites.edit") }}</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!--  -->
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th>STT</th>
            <th>{{ trans('sites.name') }}</th>
            <th>{{ trans('sites.cate_ingre') }} {{ trans('sites.parent') }}</th>
            <th>{{ trans('sites.active') }}</th>
            <th>{{ trans('sites.delete') }}</th>
            <th>{{ trans('sites.edit') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 0;
        ?>
        @foreach($cate as $item)
            <?php $stt = $stt + 1; ?>
            <tr class="odd gradeX rows{{ $item->id }}" align="center">
                <td>{{ $stt }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    @if($item->parent_id == 0)
                        {!! "None" !!}
                    @else
                        <?php
                        $parent = DB::table('categories')
                            ->where('id', $item->parent_id)
                            ->first();
                        echo $parent->name;
                        ?>
                    @endif
                </td>
                <td>
                    @if($item->status == 1)
                        Hoạt động
                    @else
                        Không hoạt động
                    @endif
                </td>
                <td class="center"><a onclick="return xacNhanXoa('Bạn có chắc chắn muốn xóa?')"
                                      href="{{ route('getDeleteCate',$item->id) }}">
                        <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-trash-o  fa-fw"></i>
                        </button>
                    </a></td>
                <td class="center">
                    <button data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                            data-parentID="{{ $item->parent_id }}" data-status="{{ $item->status }}" type="button"
                            class="btn btn-danger btn-xs btnEditCate" data-toggle="modal" data-target="#editCate"><i
                                class="fa fa-pencil fa-fw"></i> </i></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section("script")
    {{ Html::script("admin/js/cate.js") }}
@endsection
