const sunImage = document.getElementById("sunImage");
const servicesCardHolder = document.querySelector(".services-card-holder");
const cloudImage = document.getElementById("cloudImage");

function updateSunOpacity() {
  if (
    servicesCardHolder.scrollLeft >=
    servicesCardHolder.scrollWidth - servicesCardHolder.clientWidth - 1
  ) {
    sunImage.style.opacity = 0.5;
    sunImage.style.animation = "none";
    sunImage.disabled = true;
  } else {
    sunImage.style.opacity = 1;

    sunImage.disabled = false;
  }
}

function updateCloudImageState() {
  console.log(servicesCardHolder.scrollLeft);
  if (servicesCardHolder.scrollLeft - 1 <= 0) {
    cloudImage.style.opacity = 0.5;
    cloudImage.style.animation = "none";
    cloudImage.disabled = true;
  } else {
    cloudImage.style.opacity = 1;

    cloudImage.disabled = false;
  }
}

sunImage.addEventListener("click", () => {
  if (!sunImage.disabled) {
    servicesCardHolder.scrollBy({
      top: 0,
      left: 350,
      behavior: "smooth",
    });
    sunImage.style.animation = "rotate 1s linear";

    sunImage.addEventListener(
      "animationend",
      () => {
        sunImage.style.animation = "bounce 2s infinite";
        cloudImage.style.animation = "pulse 2s infinite";
      },
      { once: true }
    ); // The { once: true } option ensures that the event listener is removed after it's triggered once.
  } else {
    sunImage.style.animation = "none";
  }
});

cloudImage.addEventListener("click", () => {
  if (!cloudImage.disabled) {
    servicesCardHolder.scrollBy({
      top: 0,
      left: -350,
      behavior: "smooth",
    });
    cloudImage.style.animation = "moveRightLeft 1s linear";
    sunImage.style.animation = "bounce 2s infinite";
    cloudImage.addEventListener(
      "animationend",
      () => {
        cloudImage.style.animation = "pulse 2s infinite";
      },
      { once: true }
    ); // The { once: true } option ensures that the event listener is removed after it's triggered once.
  } else {
    cloudImage.style.animation = "none";
  }
});

window.addEventListener("load", () => {
  updateCloudImageState();
  updateSunOpacity();
});

servicesCardHolder.addEventListener("scroll", () => {
  updateCloudImageState();
  updateSunOpacity();
});
