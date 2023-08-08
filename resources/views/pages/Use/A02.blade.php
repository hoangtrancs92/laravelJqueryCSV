@push('child-stylesheets')
<link rel="stylesheet" href="{{ asset('css/pages/Use/A02.css') }}">
@endpush
@push('child-scripts')
<script type="module" src="{{ asset('js/pages/Use/A02.js') }}"></script>
<script type="module" src="{{ asset('js/pages/Use/A02-delete.js') }}"></script>
@endpush
@php
    $title = '';
    if(isset($results['infoUser']))
    {
        $title = "User Edit";
    } else {
        $title = "User Add";
    }
@endphp
<x-index-layout :title="$title">
    <section class="content d-flex justify-content-center">
        <div class="card mt-4" style="min-height: 35vh;width:97%">
            <div class="card-body">
                <x-forms.base action="" method="POST" id="user-form">
                    <div class="row">
                        <div class="col-6">
                            @if(isset($results['infoUser']))

                            <x-forms.text.text-span-group :isRequired="false" span="ID" value="{{ $results['infoUser']->id  }}" :disabled="true"  />
                            <input type="text" name="userId" value="{{ $results['infoUser']->id  }}" hidden>
                            @else
                            <x-span.base span="ID" />
                            @endif
                        </div>
                        <div class="col-6">
                            @php
                            $DIRECTOR_ROLE = 0;
                            $roles = [
                            'GROUP_LEADER' => 1,
                            'LEADER' => 2,
                            'MEMBER' => 3
                            ]
                            @endphp
                            @if(isset($results['infoUser']))
                            @if(in_array(Auth::user()->position_id, $roles) && Auth::user()->id == $results['infoUser']->id )
                            <x-forms.text.text-span-group  span="User Name" name="name" idSelector="name" value="{{ $results['infoUser']->name  }}" :disabled="true" />
                            @else
                            <x-forms.text.text-span-group :isRequired="true" span="User Name" name="name" idSelector="name" value="{{ $results['infoUser']->name }}" />
                            @endif
                            @else
                            <x-forms.text.text-span-group :isRequired="true" span="User Name" name="name" idSelector="name" value="{{ isset($results['infoUser']) ? $results['infoUser']->name : old('name') }}" />
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            @if(isset($results['infoUser']))
                            @if(in_array(Auth::user()->position_id, $roles) && Auth::user()->id == $results['infoUser']->id )
                            <x-forms.text.text-span-group span="Email" name="email" idSelector="email" value="{{ $results['infoUser']->email }}" :disabled="true" />
                            @else
                            <x-forms.text.text-span-group :isRequired="true" span="Email" name="email" idSelector="email" value="{{ $results['infoUser']->email }}" />
                            @endif
                            @else
                            <x-forms.text.text-span-group :isRequired="true" span="Email" name="email" idSelector="email" value="{{ isset($results['infoUser']) ? $results['infoUser']->email : old('email') }}" />
                            @endif
                        </div>
                        <div class="col-6">
                            @if(isset($results['infoUser']))
                            @if(in_array(Auth::user()->position_id, $roles) && Auth::user()->id == $results['infoUser']->id )
                            <x-forms.text.text-span-group span="Group" name="group" idSelector="group" value="{{ $results['infoUser']->groupName }}" :disabled="true" />
                            @else
                            <x-forms.select-option.select-group :isRequired="true" name="group" label="Group" :selected="$results['infoUser']->groupId" :options="$results['listGroup']" idSelector="group" />
                            @endif
                            @else
                            <x-forms.select-option.select-group :isRequired="true" label="Group" name="group" selected="{{ isset($results['infoUser']) ? $results['infoUser']->groupId : old('group') }}" :options="$results['listGroup']" idSelector="group" />
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            @if(isset($results['infoUser']))
                            @if(in_array(Auth::user()->position_id, $roles) && Auth::user()->id == $results['infoUser']->id )
                            <x-forms.text.text-span-group value="{{ $results['infoUser']->startedDateAttributeDmy }}" span="Started Date" name="startedDate" id="startedDate" :disabled="true" />
                            @else
                            <x-forms.text.text-span-group :isRequired="true" value="{{ $results['infoUser']->startedDateAttributeDmy }}" span="Started Date" name="startedDate" id="startedDate" />
                            @endif
                            @else
                            <x-forms.text.text-span-group :isRequired="true" value="{{ isset($results['infoUser']) ? $results['infoUser']->startedDateAttributeDmy : old('startedDate') }}" span="Started Date" name="startedDate" id="startedDate" />
                            @endif
                        </div>
                        <div class="col-6">
                            @php
                            $results['listPosition'] = [
                            ['id' =>0, 'name' => 'Director'],
                            ['id' =>1, 'name' => 'Group Leader'],
                            ['id' =>2, 'name' => 'Leader'],
                            ['id' =>3, 'name' => 'Member']]
                            @endphp
                            @if(isset($results['infoUser']))
                            @if(in_array(Auth::user()->position_id, $roles) && Auth::user()->id == $results['infoUser']->id )
                            <x-forms.text.text-span-group span="Position" name="position" idSelector="position" value="{{ $results['infoUser']->positionIdAttribute }}" :disabled="true" />
                            @else
                            <x-forms.select-option.select-group :isRequired="true" name="position" label="Position" :selected="$results['infoUser']->position_id" :options="$results['listPosition']" idSelector="position" />
                            @endif
                            @else
                            <x-forms.select-option.select-group :isRequired="true" name="position" label="Position" selected="{{ isset($results['infoUser']) ? $results['infoUser']->position_id : old('position') }}" :options="$results['listPosition']" idSelector="position" />
                            @endif
                        </div>
                    </div>
                    @if(isset($results['infoUser']))
                    <div class="row">
                        <div class="col-6">
                            <x-forms.input.input-span-group type="password" value="" span="Password" name="updatePassword" idSelector="updatePassword" />
                        </div>
                        <div class="col-6">
                            <x-forms.input.input-span-group type="password" value=""  span="Password Confirmation" name="reUpdatePassword" idSelector="reUpdatePassword" />
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-6">
                            <x-forms.input.input-span-group :isRequired="true" type="password" value="" span="Password" name="password" idSelector="password" />
                        </div>
                        <div class="col-6">
                            <x-forms.input.input-span-group :isRequired="true" type="password" value="" span="Password Confirmation" name="rePassword" idSelector="rePassword" />
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        @if(!isset($results['infoUser']) && Auth::user()->position_id == $DIRECTOR_ROLE)
                        <x-button.base type="submit" name="Register" color="success" formaction="{{ route('register-a02') }}" idSelector="register-button" />
                        @endif
                        @if(isset($results['infoUser']) && Auth::user()->position_id == $DIRECTOR_ROLE)
                        <x-button.base name="Update" formaction="{{ route('user-update-a02', ['id' => $results['infoUser']->id ]) }}" idSelector="update-director-button" />
                        <x-button.base data-form-id="{{ $results['infoUser']->id }}" name="Delete" color="warning" idSelector="delete-button" />
                        @endif
                        @if(isset($results['infoUser']) && in_array(Auth::user()->position_id, $roles))
                        <x-button.base name="Update" formaction="{{ route('user-update-a02', ['id' => $results['infoUser']->id ]) }}" idSelector="update-button" />
                        @endif
                        <x-nav-link.base href="/user" name="Cancel" class="btn btn-danger" idSelector="cancel-button" />
                    </div>
                </x-forms.base>

            </div>
        </div>
    </section>
    @if(isset($results['infoUser']))
    <form action="{{ route('user-delete-a02', ['id' => $results['infoUser']->id ]) }}" method="POST" id="delete-form-{{ $results['infoUser']->id }}">
        @method('DELETE')
        @csrf
    </form>
    @endif
</x-index-layout>
