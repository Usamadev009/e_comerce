@extends('layouts.common')

@section('title', 'Change Password')

@section('header')
    @parent
@endsection
@section('content')
    <div id="user_profile-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-offset-3 col-md-6">
                    <div class="signup_form">
                        <h2>Change Password</h2>
                            <!-- Form -->
                            <form id="modify-password" method="POST">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" disabled value="" requried/>
                                </div>
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" name="old_pass" class="form-control old_pass" placeholder="Enter Old Password" requried/>
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_pass" class="form-control new_pass" placeholder="Enter Old Password" requried/>
                                </div>
                                    <input type="submit" name="submit" class="btn" value="Submit"/>
                            </form>
                            <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection