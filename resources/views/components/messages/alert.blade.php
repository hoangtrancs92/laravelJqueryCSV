<div>
    @if (session('message'))
    <script>
        Swal.fire('{{ session('message') }}', '', 'success');
    </script>
    @endif
    @if (session('errorMessage'))
    <script>
        Swal.fire('{{ session('errorMessage') }}', '', 'error');
    </script>
    @endif
</div>
