<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-upload me-1"></i>
        File Upload
    </div>
    <div class="card-body">
        <form wire:submit.prevent="uploadFile" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Choose File</label>
                <input type="file" class="form-control" wire:model="file">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-file-alt me-1"></i>
            Uploaded Files
        </div>
        <div class="card-body">
            @if (empty($files))
                <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                    <p class="text-center">No Files Uploaded</p>
                </div>
            @else
                <ul>
                    @foreach ($files as $file)
                        <li>
                            <a href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</a>
                            <div class="text-right">
                                <button class="btn btn-danger btn-sm" wire:click="removeFile('{{ $file }}')">Remove</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>


@push('scripts')
<script>
    Livewire.on('fileUploaded', (uploadedFile) => {
        console.log('File uploaded:', uploadedFile);
        Livewire.emit('refreshFiles');
    });
    Livewire.on('refreshFiles', () => {
        Livewire.reload();
    });
</script>
@endpush