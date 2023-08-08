
@props([
    'action' => null,
    'method',
    'id',
    'paramsId' => null,
    'enctype' => null
])
<form action="{{ isset($action) == false ? route($action) : '' }}" method="{{ $method }}" id="{{ $id }}" class="form-horizontal" enctype="{{ $enctype }}">
    @csrf
    @method($method)
    {{ $slot }}
</form>
