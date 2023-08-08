@props([
    'name',
    'value' => null,
    'disabled' => false,
    'span' => null,
    'readonly' => false,
    'required' => false,
    'span' => null,
    'idSelector' => null,
    'role' => [],
    'idUserCompare' => null
    ])

@if($role != [])
    @if(in_array(Auth::user()->position_id, $roles) && Auth::user()->id == $idUserCompare)
    <x-forms.text.text-span-group :span="$span" :name="$name" idSelector="{{ $idSelector }}" :value="$value" :disabled="$disabled" />
    @else
    <x-forms.text.text-span-group :span="$span" :name="$name" idSelector="{{ $idSelector }}" :value="$value" />
    @endif
@else
    <x-forms.text.text-span-group :span="$span" :name="$name" idSelector="{{ $idSelector }}" :value="$value" :disabled="$disabled" />
@endif
