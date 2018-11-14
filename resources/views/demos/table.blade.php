<table class="table table-responsive" id="demos-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Website</th>
        <th>Company Name</th>
        <th>Product Name</th>
        <th>Product Url</th>
        <th>Callback Url</th>
        <th>Qrcode Path</th>
        <th>Amount</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($demos as $demo)
        <tr>
            <td>{!! $demo->user_id !!}</td>
            <td>{!! $demo->website !!}</td>
            <td>{!! $demo->company_name !!}</td>
            <td>{!! $demo->product_name !!}</td>
            <td>{!! $demo->product_url !!}</td>
            <td>{!! $demo->callback_url !!}</td>
            <td>{!! $demo->qrcode_path !!}</td>
            <td>{!! $demo->amount !!}</td>
            <td>{!! $demo->status !!}</td>
            <td>
                {!! Form::open(['route' => ['demos.destroy', $demo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('demos.show', [$demo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('demos.edit', [$demo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>