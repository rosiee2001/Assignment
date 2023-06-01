<div>
  <div class="container-fluid px-4">
    <section class="section">
      <h1 class="section-header"></h1>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card card-sm-3">
            <div class="card-wrap">
              <div class="card-header">
                <h4>Saved</h4>
              </div>
              <div class="card-body">
                {{ $savedCount }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="card-body">
    @if($forUpdate)
    <h5>Update Student</h5>
    @else
    <h5>Add New Students</h5>
    @endif
    <form wire:submit.prevent="saveStudent">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <div class="form-label">First Name</div>
            <input type="" wire:model="firstname" class="form-control" value="{{ $firstname?? '' }}">
            @error('firstname')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <div class="form-label">Middle Name</div>
            <input type="" wire:model="middlename" class="form-control">
            @error('middlename')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="form-label">Last Name</div>
            <input type="" wire:model="lastname" class="form-control">
            @error('lastname')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <div class="form-label">Extension</div>
            <input type="" wire:model="extension" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="form-label">Date of Birth</div>
            <input type="date" wire:model="dob" class="form-control">
            @error('dob')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="form-label">Civil status</div>
            <select wire:model="civilstatus" class="form-control">
              <option value="">--Select Status--</option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Separated">Separated</option>
              <option value="Widow">Widow</option>
            </select>
            @error('civilstatus')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="form-label">Place of birth</div>
            <input type="" wire:model="placeofbirth" class="form-control">
            @error('placeofbirth')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="d-flex justify-content-end">
          @if($forUpdate)
          <button class="btn btn-primary">Update</button>
          @else
          <button class="btn btn-primary">Save</button>
          @endif
        </div>
      </div>
    </form>
  </div>

  <hr>

  <div class="card mb-4">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <i class="fas fa-table me-1"></i>
          Saved List
        </div>
        <div>
          <input type="text" wire:model="searchTerm" placeholder="Search..." class="form-control">
        </div>
      </div>
    </div>
    <table class="table">
      <thead>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Extension</th>
        <th>DOB</th>
        <th>Place of birth</th>
        <th>Civil status</th>
        <th>Action</th>
      </thead>
      <tbody>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->firstname }}</td>
        <td>{{ $student->middlename }}</td>
        <td>{{ $student->lastname }}</td>
        <td>{{ $student->extension }}</td>
        <td>{{ $student->dob }}</td>
        <td>{{ $student->placeofbirth }}</td>
        <td>{{ $student->civilstatus }}</td>
        <td>
            <button class="btn btn-info btn-sm" wire:click="update('{{ $student->id }}')">Edit</button>
            <button class="btn btn-primary btn-view-saved-data" data-firstname="{{ $student->firstname }}" data-middlename="{{ $student->middlename }}" data-lastname="{{ $student->lastname }}" data-extension="{{ $student->extension }}" data-dob="{{ $student->dob }}" data-placeofbirth="{{ $student->placeofbirth }}" data-civilstatus="{{ $student->civilstatus }}">View Saved Data</button>
            <button class="btn btn-danger btn-sm" wire:click="delete('{{ $student->id }}')">Delete</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="card-footer">
        {{ $students->links() }}
    </div>
    </hr>
   
  </div>

  <!-- Define the modal structure -->
  <div class="modal fade" id="savedDataModal" tabindex="-1" aria-labelledby="savedDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="savedDataModalLabel">Saved Data</h5>
        
      </div>
        <div class="modal-body">
          <!-- Render the saved data in the modal body -->
          <table class="table">
            <p><strong>Name:</strong> ${selectedData.firstname} ${selectedData.middlename} ${selectedData.lastname} ${selectedData.extension}</p>
            <p><strong>Date of Birth:</strong> ${selectedData.dob}</p>
            <p><strong>Place of Birth:</strong> ${selectedData.placeofbirth}</p>
            <p><strong>Civil Status:</strong> ${selectedData.civilstatus}</p>
        </div>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
 // Wait for the document to load
document.addEventListener("DOMContentLoaded", function() {
  // Get the "View Saved Data" buttons
  var viewButtons = document.querySelectorAll(".btn-view-saved-data");

  // Get the modal and modal instance
  var modal = document.getElementById("savedDataModal");
  var modalInstance = new bootstrap.Modal(modal);

  // Loop through each button and add a click event listener
  viewButtons.forEach(function(button) {
    button.addEventListener("click", function() {
      // Get the data associated with the clicked button
      var firstname = button.getAttribute("data-firstname");
      var middlename = button.getAttribute("data-middlename");
      var lastname = button.getAttribute("data-lastname");
      var extension = button.getAttribute("data-extension");
      var dob = button.getAttribute("data-dob");
      var placeofbirth = button.getAttribute("data-placeofbirth");
      var civilstatus = button.getAttribute("data-civilstatus");

      // Set the selected data in an object
      var selectedData = {
        firstname: firstname,
        middlename: middlename,
        lastname: lastname,
        extension: extension,
        dob: dob,
        placeofbirth: placeofbirth,
        civilstatus: civilstatus
      };

      // Show the modal and pass the selected data
      modalInstance.show();

      // Set the selected data in the modal body
      var modalBody = modal.querySelector(".modal-body");
      modalBody.innerHTML = `
        <table class="table">
          <p><strong>Name:</strong> ${selectedData.firstname} ${selectedData.middlename} ${selectedData.lastname} ${selectedData.extension}</p>
          <p><strong>Date of Birth:</strong> ${selectedData.dob}</p>
          <p><strong>Place of Birth:</strong> ${selectedData.placeofbirth}</p>
          <p><strong>Civil Status:</strong> ${selectedData.civilstatus}</p>
        </table>
      `;
    });
  });

  // Add a click event listener to the modal close button
  var modalCloseButton = modal.querySelector(".btn-secondary");
  modalCloseButton.addEventListener("click", function() {
    modalInstance.hide();
  });
});
</script>

