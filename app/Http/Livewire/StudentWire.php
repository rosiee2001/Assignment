<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentWire extends Component
{
    use LivewireAlert, WithPagination;

    public $savedCount = 0;
    public $removedCount;
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

        return view('livewire.student-wire', [
            'students' => $students,
        ]);
    }


    public function delete($id)
    {
        $delete = Student::where('id', $id)->delete();
        if($delete)
            $this->alert('success','Successfully deleted!');
            $this->savedCount = Student::count();
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
    
    public function saveStudent()
    {
        $validatedData = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'placeofbirth' => 'required',
            'civilstatus' => 'required',
        ]);

        $this->searchTerm = '';

        if ($this->forUpdate) {
            $student = Student::find($this->forUpdate);
            if (!$student) {
                $this->alert('success', 'Student Successfully Updated');
                return;
            }
        } else {
            $student = new Student;
            $student->StudentNo = strtoupper(uniqid());
        }

        $student->firstname = $this->firstname;
        $student->lastname = $this->lastname;
        $student->middlename = $this->middlename;
        $student->extension = $this->extension;
        $student->dob = $this->dob;
        $student->placeofbirth = $this->placeofbirth;
        $student->civilstatus = $this->civilstatus;

        $student->save();

        if ($this->forUpdate) {
            $this->alert('success', 'Student Successfully Updated');
        } else {
            $this->alert('success', $this->firstname.' '.$this->lastname.' has been added', ['toast' => false, 'position' => 'center']);
        }
        $this->savedCount = Student::count();
        $this->reset(['firstname', 'middlename', 'lastname', 'extension', 'dob', 'placeofbirth', 'civilstatus']);
    }

   

    public function mount()
    {
        $this->savedCount = Student::count(); // Update the count based on your data logic
    }

}
