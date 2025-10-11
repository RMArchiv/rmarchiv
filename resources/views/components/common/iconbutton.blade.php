@if (isset($href))
    <a {{ $attributes->merge(['type' => 'button']) }} class="p-2 btn btn-secondary d-flex flex-row align-items-center gap-2" href="{{ $href }}">
        <i {{ $attributes->merge(['class' => ' w-auto ' . $icon]) }}></i>
        <span class="{{ (isset($showtextfrom) ? 'd-none' : '') . ' d-' . (isset($showtextfrom) ? $showtextfrom . '-' : '') . 'block' }}">{{ $slot }}</span>
    </a>
@else
    <button  {{ $attributes->merge(['type' => 'button', 'class' => "p-2 btn btn-secondary d-flex flex-row align-items-center gap-2"]) }}>
        <i {{ $attributes->merge(['class' => ' w-auto ' . $icon]) }}></i>
        <span class="{{ (isset($showtextfrom) ? 'd-none' : '') . ' d-' . (isset($showtextfrom) ? $showtextfrom . '-' : '') . 'block' }}">{{ $slot }}</span>
    </button>
@endif
