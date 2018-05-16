@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Well done: </strong> {!! Session::get('success') !!}
    </div>
@endif

@if(Session::has('failed'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Warning: </strong> {!! Session::get('failed') !!}
    </div>
@endif

@if($errors->all())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Warning: </strong> Please check the form carefully for errors!
    </div>
@endif