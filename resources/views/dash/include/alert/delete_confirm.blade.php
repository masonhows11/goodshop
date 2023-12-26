<script type="text/javascript">
    $(document).ready(function () {

        let className = '{{ $className }}'
        let element = $('.' + className);

        element.on('click', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            });
        })
    });
</script>
