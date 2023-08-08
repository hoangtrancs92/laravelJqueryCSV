@props([
    'type' => null,
    'name',
    'isDisabled' => false,
    'dataRoute' => null,
    'color' => 'primary',
    'idSelector' => null,
    'dataFormId' => null
])

<button
    {{ $attributes->merge([
        'type' => $type,
        'class' => 'btn btn-' . $color,
        'disabled' => $isDisabled,
        'id' => $idSelector,
        'data-form-id' => $dataFormId
    ]) }} data-route = {{ $dataRoute }}>
    {{ $name }}
</button>
