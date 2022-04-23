
function showMenu() {
  
    var menu = document.getElementById("menu-elements");

    menu.classList.remove('none-ul');
  
    if (menu.classList) { 
      menu.classList.toggle("hide-menu");
    } else {
      var classes = menu.className.split(" ");
      var i = classes.indexOf("hide-menu");
  
      if (i >= 0) 
        classes.splice(i, 1);
      else 
        classes.push("hide-menu");
        menu.className = classes.join(" "); 
    }
    

    var hamburger = document.getElementById("hamburger");

    if (hamburger.classList) { 
        hamburger.classList.toggle("hamburger-active");
      } else {
        var classes = hamburger.className.split(" ");
        var i = classes.indexOf("hamburger-active");
    
        if (i >= 0) 
          classes.splice(i, 1);
        else 
          classes.push("hamburger-active");
          hamburger.className = classes.join(" "); 
      }


      if (hamburger.classList) { 
        hamburger.classList.toggle("hamburger-normal");
      } else {
        var classes = hamburger.className.split(" ");
        var i = classes.indexOf("hamburger-normal");
    
        if (i >= 0) 
          classes.splice(i, 1);
        else 
          classes.push("hamburger-normal");
          hamburger.className = classes.join(" "); 
      }

      if (menu.classList) { 
        menu.classList.toggle("active-ul");
      } else {
        var classes = menu.className.split(" ");
        var i = classes.indexOf("active-ul");
    
        if (i >= 0) 
          classes.splice(i, 1);
        else 
          classes.push("active-ul");
          menu.className = classes.join(" "); 
      }
  }
