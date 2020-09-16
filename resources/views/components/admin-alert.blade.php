@if(session()->has($message))
<div class="alert alert-{{ session()->has('type') ? session('type') : $type }} fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="icon-remove"></i>
    </button>
    <strong>{{ session()->has('status') ? session('status') : $status }}</strong> {{ session('message') }}

</div>
@endif