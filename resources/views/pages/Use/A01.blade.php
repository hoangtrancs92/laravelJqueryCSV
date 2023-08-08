@push('child-scripts')
<script type="module" src="{{ asset('js/pages/Use/A01.js') }}"></script>
@endpush
<x-index-layout title="User List">
    @if (session('errorMessage') == null)
    <section class="content d-flex justify-content-center">
        <div class="card mt-4" style="min-height: 35vh;width:97%">
            <div class="card-body" style="margin-top: 3%">
                <x-forms.base action="handle-search-a01" method="GET" id="search-form">
                    <div class="row">
                        <div class="col-6">
                            <x-forms.text.text-span-group :isRequired="false" value="{{ old('name') }}" span="User Name" name="name" id="name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <x-forms.text.text-span-group :isRequired="false" value="{{ Old('startDateFrom') }}" span="Started Date From" name="startDateFrom" id="start-date-from" />
                        </div>
                        <div class="col-6">
                            <x-forms.text.text-span-group :isRequired="false" value="{{ Old('startDateTo') }}" span="Started Date To" name="startDateTo" id="start-date-to" />
                        </div>

                    </div>
            </div>
            <div class="card-footer text-right" style="background-color:#fff">
                <x-button.base type="button" name="Clear" color="danger" idSelector="clear-button" style="mr-3" />
                <x-button.base type="submit" name="Search" formaction="{{ route('handle-search-a01') }}" dataRoute=" {{ route('handle-search-a01') }}" idSelector="search-button" />
            </div>
            </x-forms.base>
        </div>
    </section>
    @php
    $userCurrent = Auth::user();
    $role = $userCurrent->position_id;
    $position = ['generalDirector' => 0, 'departmentLeader'=> 1, 'teamLeader' => 2, 'teamMember' => 3]
    @endphp
    <section class="content d-flex justify-content-center">
        <div class="card mt-4" style="width:97%">
            @if(!empty($users))
            @if($users->count() > 0)
            <div class="card-header">
                @include('common.pagination', ['results' => $users])
                @yield('pagination')
            </div>
            @endif
            @endif
            @if(!empty($users))
            <div class="card-body">
                <table class="table table-striped mt-4">
                    @if($users->count() > 0)
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Group Name</th>
                            <th>Started Date</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    @endif
                    <tbody>
                        @if($users->count() == 0)
                        <tr>
                            <td colspan="7" class="text-center">No User Found</td>
                        </tr>
                        @else
                        @foreach ($users as $user)
                        <tr>

                            <td> <a href="{{  route('render-use-info-a02', ['id' => $user->id]) }}"> {{ $user->convertNameAttribute }}</a></td>
                            <td>{{ $user->converEmailAttribute }}</td>
                            <td>{{ $user->convertGroupNameAttribute }}</td>
                            <td>{{ $user->startedDateAttributeYmd }}</td>
                            <td>{{ $user->positionIdAttribute }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @endif
            @if($userCurrent->position_id === $position['generalDirector'])
            <div class="card-footer" style="background-color:#fff">
                <x-nav-link.base name="Add New" href="/user/AddEditDelete" idSelector="newUserA02" class="btn btn-warning" />
                @if(isset($users))
                @if($users->count() > 0)

                <x-button.base name="Export CSV" color="success" idSelector="export-button" formaction="{{ route('csv-export-a01') }}" dataRoute="/user/csvExport" />
                @endif
                @endif
            </div>
            @endif
        </div>
    </section>
    @endif
    <form action="" id="export-form" method="post" hidden>
        @csrf
        @method('POST')
        <input type="text" value="{{ old('name') }}" name="name">
        <input type="text" value="{{ Old('startDateFrom') }}" name="startDateFrom">
        <input type="text" value="{{ Old('startDateTo') }}" name="startDateTo">
    </form>

</x-index-layout>
