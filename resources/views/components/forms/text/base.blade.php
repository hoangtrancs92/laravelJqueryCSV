@props([
    'name',
    'value' => null,
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'idSelector' => null,
    ])

<input type="text" {{ $attributes->merge([
    'name' => $name,
    'value' => $value,
    'disabled' => $disabled,
    'required' => $required,
    'id' => $idSelector,
    'class' => 'form-control'
    ])
    }} >
