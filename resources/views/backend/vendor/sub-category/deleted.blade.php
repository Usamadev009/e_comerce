@extends('backend.vendor.layouts.common')

@section('title', 'Sub_Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2>All Deleted SubCategory</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                                            <a href="{{'vendor-sub-categorie/re-store/'.$subcategorie['id']}}" class="btn btn-xs btn-primary re-store_subcategory" data-id=""><i >Re-store</i></a>
                                            <a href="{{'vendor-sub-categorie-pr/delete/'.$subcategorie['id']}}" class="btn btn-xs btn-danger delete_subcategory" data-id=""><i>Permanent Delete</i></a>
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
