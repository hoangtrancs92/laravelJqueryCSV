@props([
    'name',
    'value',
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'idSelector' => null,
    ])

<input type="checkbox" {{ $attributes->merge([
    'name' => $name,
    'value' => $value,
    'disabled' => $disabled,
    'required' => $required,
    'id' => $idSelector,
    'class' => 'checkbox-input'
    ]) }} >
<span class="checkbox-custom">{{ $slot }} </span>
