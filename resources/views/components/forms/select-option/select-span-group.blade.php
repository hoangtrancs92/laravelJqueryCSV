@props([
    'name',
    'idSelector' => null
    'options' => null,
    'span' => null,
    'selected' => null,
    'disabled' => false
])

<div class="form-group" style="width: 100%">
    @if (isset($span))
    <x-span.base :span="$span"  />
    @endif
    <select {{ $attributes->merge([ 'name' => $name, 'id' => $idSelector ]) }} style="width: 68%">
        @foreach ( $options as $key => $value )
        <option value="{{ $value }}" {{ $value == $selected ? 'selected' : ''  }} {{ $disabled == true ? 'disabled' : '' }}> {{ $key }} </option>
        @endforeach
    </select> <br>
</div>
