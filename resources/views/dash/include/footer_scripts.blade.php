<script src="{{ asset('dash/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dash/js/scripts.bundle.js') }}"></script>

{{--<script src="{{ asset('dash/plugins/toastify/toastify-js.js') }}"></script>--}}

<livewire:scripts/>
<script type="text/javascript">
    $(document).ready(function () {
        $('.alert-div').delay(3000).fadeOut();
    })
</script>
<script>
    $(document).ready(function () {
        let notificationDropDown = document.getElementById('notification-section');
          notificationDropDown.addEventListener('click', function () {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  url: '{{ route('admin.notification.read.all') }}',
                  method: 'GET',
                  data: {}
              }).done(function(data) {
                  console.log(data['data']);
              })
        })
    })

</script>

