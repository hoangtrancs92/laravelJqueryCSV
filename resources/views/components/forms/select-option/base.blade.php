@props([
    'name',
    'idSelector' => null
    'options',
    'selected' => null
])

<select {{ $attributes->merge([ 'name' => $name, 'id' => $idSelector ]) }}>
    @foreach ( $options as $key => $value )
    <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}> {{ $key }} </option>
    @endforeach
</select>
