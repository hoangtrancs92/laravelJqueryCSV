@props(['buttons'])

@foreach ($buttons as $button)
<button  {{ $attributes->merge(['class' => 'btn ' .  'btn-'. $button['color'] . ' ' . $attributes['size'] . ' ' . $attributes['space']])  }}
    data-route="{{ $button['data-route'] ?? "" }}" id="{{ $button['id'] ?? "" }}">
    {{ $button['name'] }}
</button>
@endforeach

{{-- Example --}}
{{-- ['name' => 'Search', 'color'=> 'info', 'data-route'=> route('user-search'), 'id' => 'search-button'], --}}

