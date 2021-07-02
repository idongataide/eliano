@section('title', 'manage bonus type')

<div class="panel panel-default">
    <div class="panel-body">
    <div class="table-responsive">
    <table id="example1" name="example1" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Last updated at</th>
            <th>edit</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
            @foreach($data as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ App\Models\bonuscategory::where('code',$row->category)->select('name')->pluck('name')->first() }}</td>
                    <td>{{ number_format($row->amount,2)  }}</td>
                    <td>{{ $row->updated_at }}</td>
                    <td><a href="{!! route('managebonustype.edit', [$row->id])  !!}" class='btn btn-default btn-xs' title="Edit Info"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
            @endforeach

        </tbody>
                
    </table>   
</div>
</div>
</div>


