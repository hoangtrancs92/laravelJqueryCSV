@props([
'name' => null,
'options' => [],
'label' => null,
'idSelector' => null,
'selected' => null,
'disabled' => false,
'valueHidden' => null,
'isRequired' => false,
])
<div class="input-group mb-3" style="width: 100%">

    @if (isset($label))
    <div class="input-group-prepend" style="width:32%">
        <x-forms.label.base :label="$label" class="input-group-text w-100" :isRequired="$isRequired"/>
    </div>
    @endif
    <select class="custom-select form-control" name="{{ $name }}" id="{{ $idSelector }}" style="width: 68%">
        <option value=""></option>
        @foreach ( $options as $value )
        <option value="{{ $value['id']}}" {{ $value['id'] == $selected ? 'selected' : '' }}> {{ $value['name'] }} </option>
        @endforeach
  </select> <br>
</div>



