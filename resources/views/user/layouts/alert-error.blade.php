@if (session('messageError'))
    <div class="alert alert-danger alert-dismissible wrap-alert-message-error" id="alert-error-public" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong class="text-white">{{ session('messageError') }}</strong>
    </div>
@endif
