@if ( session('error'))
    <div class="alert alert-danger alert-dive">
           {{ session('error') }}
    </div>
@endif
@if ( session('success'))
    <div class="alert alert-success alert-div">
            {{ session('success') }}
    </div>
@endif


