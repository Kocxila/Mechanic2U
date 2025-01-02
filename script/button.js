

var button = document.getElementById("return-to-top");

window.addEventListener("scroll", function () {
  if (window.pageYOffset > 300) {
    button.style.display = "block";
  } else {
    button.style.display = "none";
  }
});

button.addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});