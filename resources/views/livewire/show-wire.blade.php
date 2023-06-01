<div>
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
        <th>Full Name</th>
      </thead>
      <tbody>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->firstname }} {{ $student->middlename }}{{ $student->lastname }} {{ $student->extension }}</td>
        <td class="text-right">
            <button class="btn btn-primary btn-view-saved-data" data-firstname="{{ $student->firstname }}" data-middlename="{{ $student->middlename }}" data-lastname="{{ $student->lastname }}" data-extension="{{ $student->extension }}" data-dob="{{ $student->dob }}" data-placeofbirth="{{ $student->placeofbirth }}" data-civilstatus="{{ $student->civilstatus }}">View</button>
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

