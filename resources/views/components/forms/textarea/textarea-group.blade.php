@props([
    'name',
    'cols',
    'rows',
    'idSelector' => null,
    'isRequired' => false,
    'label' => null
])

<div class="form-group">
    @if (isset($label))
        <x-forms.label.base :label="$label" :isRequired="$isRequired" />
    @endif
    <textarea name="{{ $name }}" {{ $attributes->merge([
        'rows' => $rows,
        'cols' => $cols,
        'class' => 'form-control',
        'id' => $idSelector,
    ]) }} >{{ $value }}</textarea>
</div>
