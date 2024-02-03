const form = document.getElementById("signupForm");
const nameInput = document.getElementById("name");
const surnameInput = document.getElementById("surname");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirm-password");
const nameError = document.getElementById("nameError");
const surnameError = document.getElementById("surnameError");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");
const confirmPasswordError = document.getElementById("confirm-passwordError");

form.addEventListener("submit", async function (event) {
  console.log("Form submitted!");
  let isValid = true;
  nameError.textContent = "";
  surnameError.textContent = "";

  emailError.textContent = "";
  passwordError.textContent = "";
  confirmPasswordError.textContent = "";

  if (nameInput.value === "") {
    isValid = false;
    nameInput.classList.add("error");
    nameError.textContent = "Name is required";
  } else {
    nameInput.classList.remove("error");
  }

  if (surnameInput.value === "") {
    isValid = false;
    surnameInput.classList.add("error");
    surnameError.textContent = "Surname is required";
  } else {
    surnameInput.classList.remove("error");
  }

  if (emailInput.value === "") {
    isValid = false;
    emailInput.classList.add("error");
    emailError.textContent = "Email is required";
  } else {
    emailInput.classList.remove("error");
  }

  // Validate password
  if (passwordInput.value === "") {
    isValid = false;
    passwordInput.classList.add("error");
    passwordError.textContent = "Password is required";
  } else if (passwordInput.value.length < 6) {
    isValid = false;
    passwordInput.classList.add("error");
    passwordError.textContent = "Password must be at least 6 characters long";
  } else if (passwordInput.value.length > 6) {
    const passwordRegex =
      /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
    if (!passwordRegex.test(passwordInput.value)) {
      isValid = false;
      passwordInput.classList.add("error");
      passwordError.textContent =
        "Password must contain a symbol, a number, and a capital letter";
    } else {
      passwordInput.classList.remove("error");
    }
  } else {
    passwordInput.classList.remove("error");
  }
  if (confirmPasswordInput.value === "") {
    isValid = false;
    confirmPasswordInput.classList.add("error");
    confirmPasswordError.textContent = "Please confirm your password";
  } else if (confirmPasswordInput.value !== passwordInput.value) {
    isValid = false;
    confirmPasswordInput.classList.add("error");
    confirmPasswordError.textContent = "Passwords do not match";
  } else {
    confirmPasswordInput.classList.remove("error");
  }

  if (!isValid) {
    event.preventDefault();
  }
});
