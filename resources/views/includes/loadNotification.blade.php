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

        $("#toast").toast({
                animation: true,
                autohide: true,
                delay: 5000
            })
            .toast('show');

        $('#toast').on('hidden.bs.toast', function() {
            $('#toast-body').text('')
            $('#toast-body').removeClass("{{ $classForNotification }}")
        })
    </script>
@endif
