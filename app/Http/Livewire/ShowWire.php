<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowWire extends Component
{
    use LivewireAlert, WithPagination;

    public $searchTerm;
    public $civilstatus, $firstname, $middlename, $lastname, $extension, $dob, $placeofbirth, $forUpdate;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $query = Student::orderBy('id', 'DESC');

        if ($this->searchTerm) {
            $query->where('firstname', 'LIKE', '%'.$this->searchTerm.'%')
                ->orWhere('lastname', 'LIKE', '%'.$this->searchTerm.'%')
                ->orWhere('middlename', 'LIKE', '%'.$this->searchTerm.'%')
                ->orWhere('placeofbirth', 'LIKE', '%'.$this->searchTerm.'%');
        }

        $students = $query->paginate(5);

        return view('livewire.show-wire', [
            'students' => $students,
        ]);
    }


    public function delete($id)
    {
        $delete = Student::where('id', $id)->delete();
        if($delete)
            $this->alert('success','Successfully deleted!');
    }
 
    public function update($id)
    {
        $this->forUpdate = $id;
    
        $student = Student::find($id);
    
        $this->firstname = $student->firstname;
        $this->middlename = $student->middlename;
        $this->lastname = $student->lastname;
        $this->extension = $student->extension;
        $this->dob = $student->dob;
        $this->placeofbirth = $student->placeofbirth;
        $this->civilstatus = $student->civilstatus;
    }
    
}
