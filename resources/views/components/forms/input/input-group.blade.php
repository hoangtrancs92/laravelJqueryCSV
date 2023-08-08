@props([
    'type',
    'name',
    'value' => null,
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'isRequired' => false,
    'label' => null,
    'idSelector' => null,
    'pattern' => null
    ])

<div class="form-group" style="width: 100%">
    @if (isset($label))
        <x-forms.label.base :label="$label" :isRequired="$isRequired" class="form-label" />
    @endif
        <input {{ $attributes->merge([
            'type' => $type,
            'value' => $value,
            'disabled' => $disabled,
            'required' => $required,
            'id' => $idSelector,
            'pattern' => $pattern,
            'class' => 'form-control'
            ])
            }} name="{{ $name }}" >
</div>
