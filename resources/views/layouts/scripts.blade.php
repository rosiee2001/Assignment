    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="{{ asset('vendor/livewire/livewire.js') }}"></script>

    @livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <x-livewire-alert::scripts />
 <x-livewire-alert::flash />

 <script>
    // Listen to the "fileUploaded" event emitted by the Livewire component
    Livewire.on('fileUploaded', () => {
        // Refresh the Livewire component to update the file list
        Livewire.emit('refreshFiles');
    });

    // Listen to the "refreshFiles" event emitted by the Livewire component
    Livewire.on('refreshFiles', () => {
        // Refresh the Livewire component to update the file list
        Livewire.emit('refresh');
    });
</script>
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('refreshComponent', function () {
            Livewire.emit('refresh');
        });
    });
</script>