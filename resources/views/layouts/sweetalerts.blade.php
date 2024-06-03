@if (session('error'))
<script>
    Swal.fire({
        icon: "error",
        title: "Gagal",
        timer: 4000,
        text: "{{ session('error') }}",
    });
</script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        icon: "success",
        title: "Sukses",
        timer: 4000,
        text: "{{ session('success') }}",
    });
</script>
@endif
