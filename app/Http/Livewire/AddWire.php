<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AddWire extends Component
{
    use WithFileUploads;

    public $file;

    public function uploadFile()
    {
        $this->validate([
            'file' => 'required|file|max:10240', // Adjust the maximum file size as needed
        ]);

        // Store the uploaded file
        $uploadedFile = $this->file->store('public');

        // After the file is uploaded, you can emit an event
        $this->emit('fileUploaded', $uploadedFile);

        // Reset the file input field
        $this->file = null;
    }

    public function removeFile($file)
    {
        // Handle the file removal logic here
    
        // Delete the file from storage
        Storage::delete($file);
    
        // Emit the "refreshFiles" event to update the file list
        $this->emit('refreshFiles');
    }
    

    public function render()
    {
        $files = Storage::files('public');

        return view('livewire.add-wire', compact('files'));
    }
}
