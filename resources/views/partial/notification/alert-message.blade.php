@if(! is_null(session('success'))) 
    <input type="checkbox" hidden id="closeMessage">
    <div class="alert {{ session('success') ? 'success' : 'danger' }} mt-3 p-3 mb-2 bg-danger text-white">
        <label for="closeMessage">
            <span class="closebtn mr-3">&times;</span>
        </label>
        @if(is_array(session('message'))) 
            @php
                $messageList = session('message')
            @endphp
            <div class="d-flex flex-column">
                @foreach($messageList as $key => $messages)
                    @if(is_array($messages)) 
                        @foreach($messages as $key => $message) 
                            <span style="width: 100%"> {{ $message }} </span>
                        @endforeach
                    @endif
                @endforeach
            </div> 
        @else
            <span class=""> {{ $message }} </span>
        @endif
    </div>
@endif
