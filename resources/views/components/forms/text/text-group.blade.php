@props([
    'name',
    'value' => null,
    'disabled' => false,
    'readonly' => false,
    'required' => false,
    'isRequired' => false,
    'label' => null,
    'idSelector' => null,
    ])

<div class="form-group" style="width: 100%">
    @if (isset($label))
        <x-forms.label.base :label="$label" :isRequired="$isRequired" class="form-label" />
    @endif
        <input type="text" {{ $attributes->merge([
            'value' => $value,
            'disabled' => $disabled,
            'required' => $required,
            'id' => $idSelector,
            'class' => 'form-control'
            ])
            }} name="{{ $name }}"  value="{{ old($name) }}">
</div>
