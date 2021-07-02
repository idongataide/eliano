@extends('layouts.user')
@section('title', 'manage payment')
@section('content')
    <div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">NEW PAYMENT</span></h2>
        
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

        <div class="user-kyc">
        <form  action="{{route('managepayment.store') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}

                @include('managepayment.fields')


        </form>
        </div>
</div>
</div>
</div>                  
@endsection
