@props([
    'type',
    'name',
    'value' => null,
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'idSelector' => null,
    ])

<input {{ $attributes->merge([
    'type' => $type,
    'name' => $name,
    'value' => $value,
    'disabled' => $disabled,
    'required' => $required,
    'id' => $idSelector,
    'class' => 'form-control'
    ])
    }} >
