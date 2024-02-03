const calendar = document.getElementById("calendar");
const monthYearDisplay = document.getElementById("monthYear");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const wateringDaysCountDisplay = document.getElementById("wateringDaysCount");

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let wateringDaysCount = 0;
let needswatering = 0;
wateringDates = window.wateringDates || [];
const calendarContainer = document.querySelector(".calendar-container");
let plantId;
console.log(wateringDates);

if (calendarContainer) {
  plantId = calendarContainer.dataset.plantId;
  console.log(plantId);
} else {
  console.log("Calendar container not found");
}

function updateCalendar() {
  function createCalendar(month, year) {
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfMonth = new Date(year, month, 1).getDay();

    let date = 1;
    let calendarHTML = "<tr>";
    const daysOfWeek = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];

    let daysOfWeekRow = "<tr>";
    for (let day of daysOfWeek) {
      daysOfWeekRow += `<th>${day}</th>`;
    }
    daysOfWeekRow += "</tr>";

    date = 1;
    calendarHTML = daysOfWeekRow + "<tr>";
    for (let i = 0; i < firstDayOfMonth; i++) {
      calendarHTML += "<td></td>";
    }

    for (let i = 0; i < daysInMonth; i++) {
      if (i !== 0 && (firstDayOfMonth + i) % 7 === 0) {
        calendarHTML += "</tr><tr>";
      }

      const isWateringDay = wateringDates.includes(
        `${year}-${(month + 1).toString().padStart(2, "0")}-${date
          .toString()
          .padStart(2, "0")}`
      );

      if (isWateringDay) {
        calendarHTML += `<td><div class="needs-watering">${date}</div></td>`;
      } else {
        calendarHTML += `<td><div>${date}</div></td>`;
      }

      date++;
    }

    calendarHTML += "</tr>";
    calendar.innerHTML = calendarHTML;
    const cells = calendar.getElementsByTagName("td");
  }

  createCalendar(currentMonth, currentYear);
  monthYearDisplay.textContent = `${getMonthName(currentMonth)} ${currentYear}`;
  wateringDaysCountDisplay.textContent = `Number of Watering Days: ${wateringDaysCount}`;
}

function getMonthName(month) {
  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  return monthNames[month];
}

updateCalendar();

prevBtn.addEventListener("click", function () {
  currentMonth -= 1;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear -= 1;
  }
  updateCalendar();
});

nextBtn.addEventListener("click", function () {
  currentMonth += 1;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear += 1;
  }
  updateCalendar();
  drawPieChart(0, 0);
});
const canvas = document.getElementById("pieChart");
const ctx = canvas.getContext("2d");

function drawPieChart(wateredDays, totalDays) {
  const centerX = canvas.width / 2;
  const centerY = canvas.height / 2;
  const radius = canvas.width / 3;
  const startAngle = -Math.PI / 2; // Start angle at 270 degrees (or -π/2 radians)
  const endAngle = startAngle + 2 * Math.PI * (wateredDays / totalDays);

  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Draw the full circle as a light gray stroke
  ctx.beginPath();
  ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
  ctx.strokeStyle = "#e1eed9";
  ctx.lineWidth = 20; // Line width for the full circle background
  ctx.stroke();

  // Draw watered days as a green line on top of the background circle
  ctx.beginPath();
  ctx.arc(centerX, centerY, radius, startAngle, endAngle, false);
  ctx.strokeStyle = "#619949";
  ctx.lineWidth = 20; // Line width for the green line
  ctx.stroke();
}
drawPieChart(0, 1);

function updateWateringDaysCount() {
  const cells = calendar.getElementsByTagName("td");
  wateringDaysCount = 0;
  needswatering = 0; // Reset the needswatering count
  for (let i = 0; i < cells.length; i++) {
    if (cells[i].classList.contains("watering-day")) {
      wateringDaysCount++;
      console.log("wertyuio");
    }
    const div = cells[i].querySelector(".needs-watering"); // Find the div with class needs-watering inside the cell
    if (div) {
      needswatering++;
    }
  }
  wateringDaysCountDisplay.textContent = `Number of Watering Days: ${wateringDaysCount}`;
  drawPieChart(wateringDaysCount, needswatering); // Update the pie chart every time wateringDaysCount changes
  const currentDate = new Date();
  const currentDay = currentDate.getDate();

  // Find if the current day is marked for watering
  const isWateringDay = Array.from(cells).some((cell) => {
    const div = cell.querySelector("needs-watering");

    return div && parseInt(div.textContent) === currentDay;
  });

  // Get the message element
  const messageElement = document.getElementById("watering-message");

  // Update the message based on whether it's a watering day or not
  if (isWateringDay) {
    messageElement.textContent = "Today you watered!";
    console.log(isWateringDay);
  } else {
    messageElement.textContent = "Please water your plant today.";
    console.log(isWateringDay);
  }
}
updateCalendar(); // Initialize the calendar
updateWateringDaysCount();
calendar.addEventListener("click", function (event) {
  let clickedCell;
  if (event.target.tagName === "TD") {
    clickedCell = event.target;
  } else if (event.target.parentElement.tagName === "TD") {
    clickedCell = event.target.parentElement;
  } else {
    return; // If neither TD nor its child div is clicked, do nothing
  }

  if (clickedCell) {
    const date = clickedCell.textContent.trim();
    const index = wateringDates.indexOf(date);

    if (clickedCell.classList.contains("watering-day")) {
      clickedCell.classList.remove("watering-day");
      if (index !== -1) {
        wateringDates.splice(index, 1);
      }
    } else {
      clickedCell.classList.add("watering-day");
      if (index === -1) {
        wateringDates.push(date);
      }
    }

    updateWateringDaysCount();

    // Send updated wateringDates array to the backend
    updateWateringInDatabase(wateringDates);
  }
});

// function updateWateringInDatabase(updatedWateringDates) {
//   const plantId = calendarContainer.dataset.plantId;

//   // Get the last watered date from the calendar
//   const lastWateredDateCell = document.querySelector(".watering-day");
//   const lastWateredDate = lastWateredDateCell
//     ? lastWateredDateCell.textContent.trim()
//     : null;

//   // Make an asynchronous request to the backend to update watering information
//   fetch(`../structure/plant.php?plant_id=${plantId}`, {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json",
//     },
//     body: JSON.stringify({
//       wateringDates: updatedWateringDates,
//       lastWateredDate: lastWateredDate,
//     }),
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       // Handle the response from the backend if needed
//       console.log("Watering information updated in the database:", data);
//     })
//     .catch((error) => {
//       console.error("Error updating watering information:", error);
//     });

//   // Update the last watered date separately
//   fetch(
//     `../structure/plant.php?action=updateLastWateredDate&plant_id=${plantId}`,
//     {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify({
//         lastWateredDate: lastWateredDate,
//       }),
//     }
//   )
//     .then((response) => response.json())
//     .then((data) => {
//       // Handle the response from the backend if needed
//       console.log("Last watered date updated in the database:", data);
//     })
//     .catch((error) => {
//       console.error("Error updating last watered date:", error);
//     });
// }
