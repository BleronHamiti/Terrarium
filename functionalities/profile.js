const editButton = document.getElementById("editButton");
const fileModal = document.getElementById("fileModal");
const modalFileInput = document.getElementById("modalFileInput");
const modalSaveButton = document.getElementById("modalSaveButton");
const profileImage = document.getElementById("profileImage");

editButton.addEventListener("click", function () {
  // Show the file modal when the Edit button is clicked
  fileModal.style.display = "flex";
});

// Close the modal when the user clicks on the close button (×)
const closeBtn = document.querySelector(".close");
closeBtn.addEventListener("click", function () {
  fileModal.style.display = "none";
});

// Close the modal when the user clicks outside the modal
window.addEventListener("click", function (event) {
  if (event.target === fileModal) {
    fileModal.style.display = "none";
  }
});

const fileSelectedMessage = document.getElementById("fileSelectedMessage"); // Add this line

// ... (your existing event listeners) ...

modalFileInput.addEventListener("change", function () {
  // Display the selected file name or a confirmation message
  const selectedFileName = modalFileInput.files[0]
    ? modalFileInput.files[0].name
    : "";
  fileSelectedMessage.textContent = `Selected file: ${selectedFileName}`;
});

modalSaveButton.addEventListener("click", function () {
  const file = modalFileInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      profileImage.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  // Close the modal after selecting a file
  fileModal.style.display = "none";
  // Reset the file input and selected file message
  modalFileInput.value = ""; // Clear the selected file
  fileSelectedMessage.textContent = ""; // Clear the file selected message
});
