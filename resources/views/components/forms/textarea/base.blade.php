@props([
'name',
'cols',
'rows',
'idSelector' => null,
'valueHidden' => null,
])
<textarea name="{{ $name }}" {{ $attributes->merge([
        'rows' => $rows,
        'cols' => $cols,
        'class' => 'form-control',
        'id' => $idSelector,
    ]) }}>{{ $value }}</textarea>
