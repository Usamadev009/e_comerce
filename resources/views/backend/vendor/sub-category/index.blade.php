@extends('backend.vendor.layouts.common')

@section('title', 'Sub-Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2 style="margin-bottom: -15px">All SubCategory</h2>
                        <a class="add-new pull-right ml-2" style="margin-top: -15px" href="{{url('vendor-sub-categorie/create')}}">Add New</a>
                        <a class="btn btn-danger pull-right" style="margin-top: -15px" href="{{url('vendor-deleted-sub-categorie')}}">Deleted Old</a>
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
                        @if(count($subcategories)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Show/Hide</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1?>
                                @foreach($subcategories as $subcategorie)


                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$subcategorie->name}}</td>
                                        <td>{{$subcategorie->category?$subcategorie->category->name:''}}</td>
                                        <td>
                                            <img src="{{ asset($subcategorie->image?$subcategorie->image:'') }}" alt="" width="60px" height="60px"/>
                                        </td>
                                        <td>
                                            <input type="checkbox" {{ $subcategorie->status == '1' ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <a href="{{'vendor-sub-categorie/edit/'.$subcategorie['id']}}"><i class="btn btn-xs btn-primary fa fa-edit"></i></a>
                                            <a href="{{'vendor-sub-categorie/delete/'.$subcategorie['id']}}" class="btn btn-xs btn-danger delete_subcategorie" data-id=""><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="not-found">!!! No Sub Categories Available !!!</div>
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
