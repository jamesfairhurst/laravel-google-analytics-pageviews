@if($enabled)
    <script>
        window.addEventListener("load",function(e){var t=new XMLHttpRequest;t.open("POST","{{ route($route) }}",!0),t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send("{!! $query !!}")});
    </script>
@endif