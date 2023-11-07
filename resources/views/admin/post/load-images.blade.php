@if (!empty($data['images']))
    @foreach ($data['images'] as $image)
        <div class="wrap-image-content mb-1">
            <img src="{{ asset($image->file) }}" width="200" height="200" class="rounded float-left object-fit-cover" alt="">
            <div class="content">
                {{ $image->description }}
            </div>
        </div>
    @endforeach
@endif
