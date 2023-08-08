@push('child-stylesheets')
<link rel="stylesheet" href="{{ asset('css/pages/Gro/A01.css') }}">
@endpush
@push('child-scripts')
<script type="module" src="{{ asset('js/pages/Gro/A01.js') }}"></script>
@endpush
<x-index-layout title="Group List">
    @php
    $users = session('users');
    $userCurrent = Auth::user();
    $role = $userCurrent->position_id;
    $position = ['generalDirector' => 0, 'departmentLeader'=> 1, 'teamLeader' => 2, 'teamMember' => 3]
    @endphp

    <section class="content d-flex justify-content-center">
        <div id="myModal" class="modal" style="z-index: 2000;">
            <div class="modal-content ">
                <span class="close">&times;</span>
                <form action="{{ route('csv-import-a01') }}" method="post" enctype="multipart/form-data" id="csv-import">
                    @csrf
                    <div class="text-center">
                        <input type="file" name="csvFile" class="mt-2"  style="width:90%" id="csv-file">
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Upload" class="mt-4 btn btn-success align-center">
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4" style="width:97%">
            @if(!empty($groups))
            @if($groups->count() > 0)
            <div class="card-header">
                @include('common.pagination', ['results' => $groups])
                @yield('pagination')
            </div>
            @endif
            @endif
            <div class="card-body">
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Group Name</th>
                            <th>Group Note</th>
                            <th>Group Leader</th>
                            <th>Floor Number</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>Deleted Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($groups->count() == 0)
                        <tr>
                            <td colspan="8" class="text-center">No Group Found</td>
                        </tr>
                        @else
                        @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->convertGroupNameAttribute }}</td>
                            <td>{!! $group->noteAttribute !!}</td>
                            <td>{{ $group->convertGroupLeaderAttribute }}</td>
                            <td>{{ $group->group_floor_number }}</td>
                            <td>{{ $group->createdDateAttribute }}</td>
                            <td>{{ $group->updatedDateAttribute }}</td>
                            <td>{{ $group->deletedDateAttribute }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer" style="background-color:#fff">
                <x-button.base name="Import CSV" color="success" idSelector="import-button" dataRoute="/" />
            </div>
        </div>

    </section>

</x-index-layout>
