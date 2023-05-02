@extends('backend.vendor.layouts.common')

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
                        <h2>All Deleted Categories</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if(count($categories)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Group Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Icon</th>
                                    <th style="width: 45px">Show / Hide</th>
                                    <th style="width: 240">Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach($categories as $categorie)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$categorie->name}}</td>
                                        <td>{{$categorie->group?$categorie->group->name:''}}</td>
                                        <td>{{$categorie->description}}</td>
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
                                            <a href="{{'vendor-categorie/re-store/'.$categorie['id']}}" class="btn btn-xs btn-primary re-store_category" data-id=""><i>Re-store</i></a>
                                            <a href="{{'vendor-categorie-pr/delete/'.$categorie['id']}}" class="btn btn-xs btn-danger delete_category" data-id=""><i>Permanent Delete</i></a>
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
