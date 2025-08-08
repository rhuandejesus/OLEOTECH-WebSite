class MobileNavbar {
    constructor(mobileMenu, nav, navLinks) {
      this.mobileMenu = document.querySelector(mobileMenu);
      this.nav = document.querySelector(nav);
      this.navLinks = document.querySelectorAll(navLinks);
      this.activeClass = "active";
  
      this.handleClick = this.handleClick.bind(this);
    }
  
    animateLinks() {
      this.navLinks.forEach((link, index) => {
        link.style.animation
          ? (link.style.animation = "")
          : (link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`);
      });
    }
  
    handleClick() {
      this.nav.classList.toggle(this.activeClass);
      this.animateLinks();
    }
  
    addClickEvent() {
      this.mobileMenu.addEventListener("click", this.handleClick);
    }
  
    init() {
      if (this.mobileMenu) {
        this.addClickEvent();
      }
      return this;
    }
  }
  
  const mobileNavbar = new MobileNavbar(
    ".mobile-menu",
    ".nav",
    ".nav-links li"
  );
  mobileNavbar.init();
  
 let count = 1;
 document.getElementById("radio1").checked = true;
  setInterval(function() {
  }, 5000);

  function nextImage() {
    count++;
    if (count > 2) {
      count = 1;
    }
    document.getElementById("radio" + count).checked = true;
  }