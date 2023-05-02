@extends('backend.admin.layouts.common')

@section('title', 'Users')

@section('header')
    @parent
@endsection

@section('content')

    <div class="admin-content-container container-fluid ">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2 style="margin-bottom: -15px">All Users</h2>
                        <h5 class="btn btn-info" style="margin-left: 350px; margin-top: -15px;">
                            @php $u_total = "0"; @endphp
                            @foreach ($users as $user)
                                @php
                                    if ($user->isUserOnline())
                                    {
                                        $u_total = $u_total + 1;
                                    }
                                @endphp
                            @endforeach
                            Online Users: {{ $u_total }}
                        </h5>
                        <a class="add-new pull-right ml-2" style="margin-top: -15px" href="{{url('user/create')}}">Add New</a>
                        <a class="btn btn-danger pull-right" style="margin-top: -15px" href="{{url('deleted-user')}}">Deleted Old</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class='row scrollmenu'>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{session('status')}}
                                </div>
                            @endif
                            @if(count($users)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Availability</th>
                                    <th style="width: 120px">Action</th>
                                </thead>
                                <tbody>
                                    <?php $i=1 ?>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            <img src="{{ asset($user->image?$user->image:'') }}" alt="" width="50px" height="50px"/>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>
                                            @if($user->status==0)
                                                <span class="label" style="background-color:#04AA6D;color:white;padding:5px;border-radius:18px">Unblock</span>
                                            @else
                                                <span class="label" style="background-color:#f6c23e;color:white;padding:5px;border-radius:18px">Block</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->isUserOnline())
                                                <label class="py-2 px-3 badge btn-success">Online</label>
                                            @else
                                                <label class="py-2 px-3 badge btn-warning">Offline</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{'user/edit/'.$user['id']}}"><i class="btn btn-xs btn-primary fa fa-edit"></i></a>
                                            <a href="{{route('user.show', [$user->id])}}" class="btn btn-xs btn-success" ><i class="fa fa-eye"></i></a>
                                            <a href="{{'user/'.$user['id']}}" class="btn btn-xs btn-danger delete_user" data-id=""><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>

                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="not-found clearfix">!!! No Users Found !!!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="user-detail" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
        $('#datatable1').DataTable();
        } );
    </script>
@endsection
