@extends('layouts.user')
@section('title', 'Contributors')
@section('content')

<div class="user-content">
    <div class="user-panel">
        <h2 class="user-panel-title"><span class="status-text">CONTRIBUTORS</span></h2>
        <p>Invite your friends and family</p>
        <p><strong>Each member recives a unique referral link to share with friends and family.</strong></p>
        <p>The referral link may be used during a registration</p>
        
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

        <h6>My unique invite link</h6>
        <div class="refferal-info">
                            <span class="refferal-copy-feedback copy-feedback"></span>
                            <em class="fas fa-link"></em>
                            <input type="text" class="refferal-address" value="{{ route('refer.register',auth::user()->username) }}" disabled>
                            <button class="refferal-copy copy-clipboard" data-clipboard-text="{{ route('refer.register',auth::user()->username) }}"><em class="ti ti-files"></em></button>
                        </div><!-- .refferal-info --> <!-- @updated on v1.0.1 -->
                        <div class="gaps-2x"></div>
                        <ul class="share-links">
                            <li>Share with : </li>
                            <li><a href="https://twitter.com/intent/tweet?url={{ route('refer.register',auth::user()->username) }}&amp;text={{auth::user()->name}}"><em class="fab fa-twitter"></em></a></li>
                            <li><a href="http://www.facebook.com/share.php?u={{ route('refer.register',auth::user()->username) }}&amp;title={{auth::user()->name}}"><em class="fab fa-facebook-f"></em></a></li>
                            <li><a href="https://wa.me/?text={{ route('refer.register',auth::user()->username) }}"><em class="fab fa-whatsapp"></em></a></li>
                        </ul><!-- .share-links -->
                        
                        <h4>Contributor's List</h4>
                        <table class="data-table refferal-table">
                            <thead>
                                <tr>
                                    <th class="refferal-name"><span>Code</span></th>
                                    <th class="refferal-tokens"><span>Name</span></th>
                                    <th class="refferal-bonus"><span>Phone Number</span></th>
                                    <th class="refferal-date"><span>Plan</span></th>
                                    <th class="refferal-channel"><span>Status</span></th>
                                    <th class="refferal-amount"><span>Amount</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                <tr>
                                    <td class="refferal-name">{{ $row->reg_no }}</td>
                                    <td class="refferal-tokens">{{ $row->name }}</td>
                                    <td class="refferal-bonus">{{ $row->phonenumber }}</td>
                                    <td class="refferal-date">{{$row->plan_name}}</td>
                                    <td class="refferal-channel">
                                    @if($row->status == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                    </td>
                                    <td>{{\App\Models\contribution::where('contributor_id',$row->id)->where('status',2)->sum('amount') }}</td>
                                </tr>   
                                @endforeach                                               
                            </tbody>
                        </table>
                        
                    </div><!-- .user-panel -->
                </div><!-- .user-content -->
            </div><!-- .d-flex -->
            </div>
</div>
</div>
</div>
@endsection