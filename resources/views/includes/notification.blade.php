@if (session('success'))
    <script type="text/javascript">
        toastr.success('{{ session("success") }}');
    </script>
@elseif (session('error'))
    <script type="text/javascript">
        toastr.error('{{ session("error") }}');
    </script>
@endif