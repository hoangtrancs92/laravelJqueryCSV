@props([
'title' => null,
])
<aside class="main-sidebar sidebar-d-primary elevation-4">
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        </div>
        <nav class="mt-5">
            <div>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item text-center">
                        <a href="{{ route('render-use-a01')}}" id="" class="nav-link  {{ (request()->is('user*') || request()->is('/')) ? 'active' : '' }} " style="z-index: 100">
                            <i class=""></i>
                            <p>User List</p>
                        </a>
                    </li>
                    @php
                    $user = Auth::user();
                    $role = $user->position_id ?? null;
                    $position = ['generalDirector' => 0, 'departmentLeader'=> 1, 'teamLeader' => 2, 'teamMember' => 3]
                    @endphp
                    @if(empty($users))
                        @if($role === $position['generalDirector'])
                        <li class="nav-item text-center">
                            <a href="{{ route('render-gro-a01') }}" id="" class="nav-link  {{ request()->is('group*') ? 'active' : '' }}">
                                <i class=""></i>
                                <p>Group List</p>
                            </a>
                        </li>
                        @endif
                    @endif
                </ul>
            </div>

        </nav>
    </div>
</aside>
