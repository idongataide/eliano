@extends('layouts.user')
@section('title', 'logging activity')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">LOGGING ACTIVITY</span></h2>
        <p>Here is your recent logging activities. you can also clear this log as well..</p>
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

        <table class="data-table activity-table">
        <thead>
            <tr>
                <th class="activity-time"><span>Date</span></th>
                <th class="activity-device"><span>Account</span></th>
                <th class="activity-ip"><span>Location</span></th>
                <th class="activity-browser"><span>Browser</span></th>
                <th class="activity-ip"><span>IP</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td class="activity-time">{{$row->created_at}}</td>
                <td class="activity-device">{{$row->name}}</td>
                <td class="activity-ip">{{$row->location}}</td>
                <td class="activity-browser">{{$row->details}}</td>
                <td class="activity-ip">{{$row->user_ip}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>



</div>
</div>
</div>
@endsection