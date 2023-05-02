@extends('backend.admin.layouts.common')

@section('title', 'Add Banner')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <h2 class="admin-heading mb-1">Add New Banner</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{route('banner.update',[$banner->id])}}" class="add-post-form row" method="post" enctype="multipart/form-data">
                            @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" class="form-control title" name="title" value="{{$banner->title}}" placeholder="Title" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea class="form-control description" name="description"  requried>{{$banner->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mt-5">
                                        <label for="">Featured Image</label>
                                        <input type="file" class="product_image" name="photo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img id="image" src="{{asset($banner->photo)}}" style="width:250px;height:150px"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control status" name="status">
                                            <option value="Publish" {{(($banner->status=='Publish')? 'selected' : '')}}>Publish</option>
                                            <option value="Draft" {{(($banner->status=='Draft')? 'selected' : '')}}>Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn add-new" name="submit" value="Submit">
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#category').on('change',function(e){
            console.log(e);
            var cat_id = e.target.value;
            //ajax
            $.get('/ajax-subcat?cat_id=' + cat_id, function(data){
                //success data
                $('#sub_category').empty();
                $.each(data, function(index, subcatObj){
                    $('#sub_category').append('<option value="'+subcatObj.id+'">'subcatObj.name+'</option>');
                })
            });
        });
    </script>
@endsection
