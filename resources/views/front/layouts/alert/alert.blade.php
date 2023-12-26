<script>
    @if( session()->has('error') )
    Swal.fire({
        icon: 'warning',
        title: '{{ session()->get('error') }}'
    })
    @elseif( session()->has('success'))
    Swal.fire({
        icon: 'success',
        title: '{{ session()->get('success') }}'
    })
    @endif
</script>
