<figure class="image {{ $classes }}" role="group" aria-label="{{ $caption }}">
    <div class="image-wrapper">
        <img src="{{ rtrim(env('APP_URL'),'/').$file['url'] }}" alt="{{ $caption }}">
        @if (!empty($caption))
            <figcaption>{{ $caption }}</figcaption>
        @endif
    </div>
</figure>
