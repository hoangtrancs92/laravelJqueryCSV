@props([
    'name',
    'href' => null,
    'idSelector'
])
<a href="{{ $href }}" id="{{ $idSelector }}" {{ $attributes->merge([ 'class' => 'text-decoration-none' ]) }}>{{ $name }}</a>

