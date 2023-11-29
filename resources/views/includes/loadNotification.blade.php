@if (!is_null(session('message')))
    @php
        $classForNotification = 'bg-danger';
        if (!is_null(session('success')) && session('success')) {
            $classForNotification = 'bg-success';
        }
    @endphp
    <script>
        $('#toast-body').text("{{ session('message') }}")
        $('#toast-body').addClass("{{ $classForNotification }}")
        $('#wrap-toast').addClass('open-toast')

        $("#toast").toast('show');

        $('#toast').on('hidden.bs.toast', function() {
            $('#toast-body').text('')
            $('#toast-body').removeClass("{{ $classForNotification }}")
            $('#wrap-toast').removeClass('open-toast')
        })
    </script>
@endif
