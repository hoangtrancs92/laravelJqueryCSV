@props([
    'span' => null,
    'idSelector' => null,
    'isRequired' => false
])

<span class="{{ $attributes['class'] }} input-group-text" style="width:32%; border-radius: 0" id="{{ $idSelector }}">
    {{ $span }}
    @if ($isRequired)
    <span class="text-danger">*</span>
    @endif
</span>
