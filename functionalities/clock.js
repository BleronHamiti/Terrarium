function updateClock() {
  const currentTimeElement = document.getElementById("current-time");
  const currentTime = new Date();
  const hours = currentTime.getHours();
  const minutes = currentTime.getMinutes();
  const seconds = currentTime.getSeconds();

  const formattedTime = `${hours < 10 ? "0" : ""}${hours}:${
    minutes < 10 ? "0" : ""
  }${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
  currentTimeElement.textContent = formattedTime;
}

updateClock();

setInterval(updateClock, 1000);
