@extends('backend.admin.layouts.common')

@section('title', 'Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2 style="margin-bottom: -15px">All Categories</h2>
                        <a class="add-new pull-right ml-2" style="margin-top: -15px" href="{{url('category/create')}}">Add New</a>
                        <a class="btn btn-danger pull-right" style="margin-top: -15px" href="{{url('deleted-categories')}}">Deleted Old</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <div class="card-body">
                        @if(count($categories)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Group Name</th>
                                    <th>Image</th>
                                    <th>Icon</th>
                                    <th style="width: 45px">Show / Hide</th>
                                    <th style="width: 70px">Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach($categories as $categorie)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$categorie->name}}</td>
                                        <td>{{$categorie->group?$categorie->group->name:''}}</td>
                                        <td>
                                            <img src="{{ asset($categorie->image?$categorie->image:'') }}" alt="" width="60px" height="60px"/>
                                        </td>
                                        <td>
                                            <img src="{{ asset($categorie->icon?$categorie->icon:'') }}" alt="" width="60px" height="60px"/>
                                        </td>
                                        <td>
                                            <input type="checkbox" {{ $categorie->status == '1' ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <a href="{{'category/edit/'.$categorie['id']}}"><i class="btn btn-xs btn-primary fa fa-edit"></i></a>
                                            <a href="{{'category/delete/'.$categorie['id']}}" class="btn btn-xs btn-danger delete_category" data-id=""><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="not-found">!!! No Category Available !!!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
        $('#datatable1').DataTable();
        } );
    </script>
@endsection
