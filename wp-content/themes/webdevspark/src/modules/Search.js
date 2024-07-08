class Search {
  // 1. Describe and initiate our object
  constructor() {
    this.openButtons = document.querySelectorAll(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay .search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.events();

    // Related to keypress events
    this.isOverlayOpen = false;
  }

  // 2. events
  events() {
    this.openButtons.forEach(btn => {
      btn.addEventListener("click", () => this.openOverlay());
    })
    this.closeButton.addEventListener("click", () => this.closeOverlay());
    document.addEventListener('keydown', e => this.keyPressDispatcher(e))
  }

  // 3. methods
  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
    document.body.classList.add('body-no-scroll');
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
    document.body.classList.remove('body-no-scroll');
  }

  keyPressDispatcher(e) {
    const { keyCode } = e

    if (keyCode === 83 && !this.isOverlayOpen && document.activeElement.tagName !== "INPUT" && document.activeElement.tagName !== "TEXTAREA") {
      this.openOverlay();
      this.isOverlayOpen = true;
    }

    if (keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
      this.isOverlayOpen = false;
    }
  }
}

export default Search