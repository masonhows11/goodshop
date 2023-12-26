@if ( session('error'))
    <div class="alert d-flex justify-content-between alert-danger alert-div">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@elseif ( session('success'))
    <div class="alert d-flex justify-content-between alert-success alert-div">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
