<div>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show overflow-hidden" >
        <div class="overflow-auto custom-scrollbar " style="max-height: 100px;">
            <ul style="list-style-type: none">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
<div>
    @if(session('error_message'))
    <div class="alert alert-danger alert-dismissible fade show overflow-hidden " role="alert">
        <div class="overflow-auto custom-scrollbar " style="max-height: 100px;">
            <ul>
                @foreach(session('error_message')['results'] as $errorMessage)
                <li>{{ $errorMessage }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
