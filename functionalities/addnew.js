document.addEventListener("DOMContentLoaded", function () {
  const plantNameInput = document.getElementById("plant-name");
  const plantFamilyInput = document.getElementById("plant-family");
  const lightRequirementsInput = document.getElementById("light-requirements");
  const wateringNeedsInput = document.getElementById("watering-needs");
  const humidityLevelsInput = document.getElementById("humidity-levels");
  const plantForm = document.getElementById("plant-form");

  // Plant data (you can replace this with data from your database)
  const plantData = {
    "Peace Lily": {
      family: "Araceae",
      lightRequirements: "Low-light, indirect",
      wateringNeeds: "Every 3 days",
      humidityLevels: "70%",
    },
    // Add more plant data as needed
  };

  plantNameInput.addEventListener("input", function () {
    const selectedPlant = plantNameInput.value;
    if (plantData[selectedPlant]) {
      plantFamilyInput.value = plantData[selectedPlant].family;
      lightRequirementsInput.value = plantData[selectedPlant].lightRequirements;
      wateringNeedsInput.value = plantData[selectedPlant].wateringNeeds;
      humidityLevelsInput.value = plantData[selectedPlant].humidityLevels;
    } else {
      // Clear other fields if plant name is not found
      plantFamilyInput.value = "";
      lightRequirementsInput.value = "";
      wateringNeedsInput.value = "";
      humidityLevelsInput.value = "";
    }
  });

  plantForm.addEventListener("submit", function (event) {
    event.preventDefault();

    // Get form data and handle form submission here
    const formData = {
      plantName: plantNameInput.value,
      plantFamily: plantFamilyInput.value,
      lightRequirements: lightRequirementsInput.value,
      wateringNeeds: wateringNeedsInput.value,
      humidityLevels: humidityLevelsInput.value,
      lastWatered: document.getElementById("last-watered").value,
    };

    // You can handle the form data as needed, such as sending it to the server or storing it in a database
    console.log(formData);

    // Reset the form fields after submission
    plantForm.reset();
  });
});
