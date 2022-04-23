var acc = document.getElementsByClassName("clickable");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
      
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.parentElement.classList.toggle("opened");

  });
} 