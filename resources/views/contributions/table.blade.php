<div class="table-responsive">
<table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Contributor</th>
                <th>Bank</th>
                <th>Payment Method</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Amount</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1  ?>
            @foreach($data as $user)
            <tr>
                <td>{!! $i++ !!}</td>
                <td>{!! $user->payment_date !!}</td>
                <td>{!! \App\Models\user::where('id',$user->contributor_id)->orwhere('reg_no',$user->member_id)->select('name')->pluck('name')->first() !!}</td>
                <td>{!! \App\Models\bank::where('id',$user->bank_id)->select('name')->pluck('name')->first() !!}</td>
                <td>{!! \App\Models\payment_method::where('id',$user->payment_method_id)->select('name')->pluck('name')->first() !!}</td>
                <td>{!! $user->remark !!}</td>
               
                @if($user->status == 1)
                <td><span class="badge bg-info">Pending</span></td>
                @elseif($user->status == 2)
                <td><span class="badge bg-success">Approved</span></td>
                @else
                <td><span class="badge bg-danger">Deleted</span></td>
                @endif
                <td>{!! number_format($user->amount,2) !!}</td>
                <td>
                    {!! Form::open(['route' => ['contributions.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('contributions.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure, you want to delete this contribution?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
            <tr>
                <th>Total</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>{{number_format($total,0)}}</th>
                <th></th>
            </tr>
        </tbody>
    </table>
</div>
