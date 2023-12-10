// JavaScript code
document.addEventListener("DOMContentLoaded", function () {
  const impactCards = document.querySelectorAll(".impact-card");
  const modal = document.getElementById("myModal");
  const modalTitle = document.getElementById("modal-title");
  const modalContent = document.getElementById("modal-content");
  const closeButton = document.querySelector(".close");
  const modalImage = document.getElementById("modal-image");
  impactCards.forEach(function (card) {
    card.addEventListener("click", function () {
      // Get the title and content of the clicked impact-card
      const title = card.querySelector(".impact-card-title h3").textContent;
      const content = card.querySelector(".plant-needs").innerHTML;
      const imageSrc = card.querySelector(".plant-care img").src;

      // Set the modal title and content
      modalTitle.textContent = title;
      modalContent.innerHTML = content;
      modalImage.src = imageSrc;
      // Display the modal
      modal.style.display = "flex";
    });
  });

  // Close the modal when the close button is clicked
  closeButton.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // Close the modal if the user clicks outside of it
  window.addEventListener("click", function (event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});
