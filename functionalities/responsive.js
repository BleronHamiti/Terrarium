const menuIcon = document.getElementById("menu");
const closeIcon = document.getElementById("close");
const menuList = document.getElementById("side-bar");
const menuItems = document.querySelectorAll("li");

menuIcon.addEventListener("click", () => {
  menuList.classList.add("show");
  closeIcon.classList.add("visible");
});
closeIcon.addEventListener("click", () => {
  menuList.classList.remove("show");
  closeIcon.classList.remove("visible");
});
menuItems.forEach(function (item) {
  item.addEventListener("click", () => {
    menuList.classList.remove("show");
    closeIcon.classList.remove("visible");
  });
});
