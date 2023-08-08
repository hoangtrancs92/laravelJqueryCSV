@props(['label' => null, 'isRequired' => false])

<label class="{{ $attributes['class'] }}" style="font-weight: unset">
    {{ $label }}
    @if ($isRequired)
        <span class="text-danger">*</span>
    @endif
</label>
