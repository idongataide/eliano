@extends('layouts.user')
@section('title', 'security')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">CHANGE PASSWORD</span></h2>
        <p>Account password and Security Questions.</p>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('danger'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('danger') }}
            </div>
        @endif




<form  action="{{route('user.security') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
<div class="row">
    <div class="col-lg-12">
        <div class="input-item input-with-label">
            <label for="swalllet" class="input-item-label">Old Password</label>
            <input class="input-bordered" type="password" name="oldpassword" value="">
        </div><!-- .input-item -->
    </div><!-- .col -->
</div><!-- .row -->
<div class="row">
    <div class="col-lg-6">
        <div class="input-item input-with-label">
            <label for="date-of-birth" class="input-item-label">New Password</label>
            <input class="input-bordered" type="password" name="newpassword">
        </div><!-- .input-item -->
    </div><!-- .col -->
    <div class="col-lg-6">
        <div class="input-item input-with-label">
            <label for="date-of-birth" class="input-item-label">Confirm New Password</label>
            <input class="input-bordered" type="password" name="changedpassword">
        </div><!-- .input-item -->
    </div><!-- .col -->

<div class="col-lg-12">
<div class="input-item input-with-label">
    <label for="gender" class="input-item-label">Security Question</label>
    <select class="country-select" name="question_id" id="question_id" required>
        <option value="">--select question--</option>

        @foreach($securityquestion as $row)
        <option {{ ($row->id == $user->security_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    </select>
</div><!-- .input-item -->
</div><!-- .col -->

<div class="col-md-12">
<div class="input-item input-with-label">
    <label for="address-line-1" class="input-item-label">Security Answer</label>
    <textarea class="input-bordered" name="security_answer" id="security_answer" required>{{$user->security_answer}}</textarea>
</div><!-- .input-item -->
</div><!-- .col -->
                                    


</div>

<div class="d-sm-flex justify-content-between align-items-center">
    <button class="btn btn-primary">Update</button>
    <div class="gaps-2x d-sm-none"></div>
</div>






</form><!-- form -->



</div>
</div>
</div>
@endsection