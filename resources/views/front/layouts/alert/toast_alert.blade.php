<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    window.addEventListener('show-result', ({detail: {type, message}}) => {
        Toast.fire({
            icon: type,
            title: message
        })
    })
    @if( session()->has('warning') )
    Toast.fire({
        icon: 'warning',
        title: '{{ session()->get('warning') }}'
    })
    @elseif( session()->has('success'))
    Toast.fire({
        icon: 'success',
        title: '{{ session()->get('success') }}'
    })
    @endif
</script>
