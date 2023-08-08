@props([
    'name' => null,
    'value' => null,
    'disabled' => false,
    'span' => null,
    'readonly' => false,
    'required' => false,
    'span' => null,
    'idSelector' => null,
    'isRequired' => false
    ])


<div class="input-group mb-4">
        @if (isset($span))
        <x-span.base :span="$span"  :isRequired="$isRequired"/>
        @endif
        <input type="text" {{ $attributes->merge([
            'value' => $value,
            'disabled' => $disabled,
            'required' => $required,
            'id' => $idSelector,
            'class' => 'form-control',
            'aria-label' => 'Sizing example input',
            'aria-describedby' => 'inputGroup-sizing-default'
            ])
            }} name="{{ $name }}" value='{{ $value }}' style="width: 68%" > <br>
  </div>
