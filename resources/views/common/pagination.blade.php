@section('pagination')
    @php
        $currentPage = $results->currentPage();
        $total = $results->total();
    @endphp
    @if($total > 10)
    <div class="card-tools">
        <ul class="pagination pagination-sm float-right">
            @php
                $paginationUrl = $results->appends(request()->except('page'));
                $lastPage = $results->lastPage();
                $startPage = max(1, $results->currentPage() - 2);
                $endPage = min($startPage + 4, $results->lastPage());
            @endphp
            <li class="page-item {{ $results->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $results->onFirstPage() ? '#' : $paginationUrl->url(1) }}">最初</a>
            </li>
            <li class="page-item {{ $results->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $results->previousPageUrl() }}">前へ</a>
            </li>
            @if ($results->lastPage() > 5)
                @if ($results->currentPage() > 3)
                    <li class="page-item disabled ">
                        <a href="{{ $results->url($currentPage - 2) }}" class="page-link" >...</a>
                    </li>
                @endif
                @for ($i = $startPage; $i <= $endPage; $i++)
                    @if ($endPage - $startPage <= 2)
                        @for ($i = $startPage - 2; $i <= $endPage; $i++)
                            <li class=" page-item {{ $results->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $results->url($i) }}" class="page-link {{ $results->currentPage() == $i ? 'disabled' : '' }}    ">{{ $i }}</a>
                            </li>
                        @endfor
                    @elseif($endPage - $startPage <= 3)
                        @for ($i = $startPage - 1; $i <= $endPage; $i++)
                            <li class=" page-item {{ $results->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $results->url($i) }}" class="page-link {{ $results->currentPage() == $i ? 'disabled' : '' }} ">{{ $i }}</a>
                            </li>
                        @endfor
                    @else
                        <li class=" page-item {{ $results->currentPage() == $i ? 'active' : '' }}">
                            <a href="{{ $results->url($i) }}" class="page-link {{ $results->currentPage() == $i ? 'disabled' : '' }}" >{{ $i }}</a>
                        </li>
                    @endif
                @endfor
                @if ($results->currentPage() < $results->lastPage() - 2)
                    <li class="page-item disabled "><a class="page-link">...</a></li>
                @endif
            @else
                @for ($i = 1; $i <= $results->lastPage(); $i++)
                <li class=" page-item {{ $results->currentPage() == $i ? 'active' : '' }}">
                    <a href="{{ $results->url($i) }}" class="page-link {{ $results->currentPage() == $i ? 'disabled' : '' }} ">{{ $i }}</a>
                </li>
                @endfor
            @endif
            <li class="page-item {{ $results->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $results->nextPageUrl() }}">次へ</a>
            </li>
            <li class="page-item {{ $results->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $paginationUrl->url($lastPage) }}">最終</a>
            </li>
        </ul>
    </div>
    @else
    @endif
    @endsection
