@props([
        'name',
        'options',
        'url' => null,
        'label' => null,
        'isRequired' => false
    ])

<div class="form-group" style="width: 100%">
    @if (isset($label))
        <x-forms.label.base :label="$label" :isRequired="$isRequired" class="form-label" />
    @endif
    @foreach ($options as $key => $value)
        <input type="checkbox" name="{{ $name }}" value="{{ $value }}"
            {{ $attributes->merge(['class' => 'checkbox-input']) }}
            {{ in_array($value, old(substr($name, 0, -2) ?? '', [])) || Request::is($url ?? '') ? 'checked' : '' }}>
        <span class="checkbox-custom">{{ $key }}</span>

    @endforeach
</div>
