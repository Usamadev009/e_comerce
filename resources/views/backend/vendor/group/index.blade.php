@extends('backend.vendor.layouts.common')

@section('title', 'Groups')

@section('header')
    @parent
@endsection
@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2 style="margin-bottom: -15px">All Groups</h2>
                        <a class="add-new pull-right ml-2" style="margin-top: -15px" href="{{url('vendor-group/create')}}">Add New</a>
                        <a class="btn btn-danger pull-right" style="margin-top: -15px" href="{{url('deleted-vendor-group')}}">Deleted Old</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <div class="card-body">
                        @if(count($groups)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Show / Hide</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach($groups as $group)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$group->name}}</td>
                                            <td>{{$group->description}}</td>
                                            <td>
                                                <input type="checkbox" {{ $group->status == '1' ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a href="{{'vendor-group/edit/'.$group['id']}}"><i class="btn btn-xs btn-primary fa fa-edit"></i></a>
                                                <a href="{{'vendor-group/delete/'.$group['id']}}" class="btn btn-xs btn-danger delete_brand" data-id=""><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="not-found">!!! No Groups Found !!!</div>
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
