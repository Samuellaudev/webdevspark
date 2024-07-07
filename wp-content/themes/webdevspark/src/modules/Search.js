class Search {
  // 1. Describe and initiate our object
  constructor() {
    this.openButtons = document.querySelectorAll(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay .search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.events();
  }

  // 2. events
  events() {
    this.openButtons.forEach(btn => {
      btn.addEventListener("click", () => this.openOverlay());
    })
    this.closeButton.addEventListener("click", () => this.closeOverlay());
  }

  // 3. methods
  openOverlay() {
    this.searchOverlay.classList.add('search-overlay--active');
  }

  closeOverlay() {
    this.searchOverlay.classList.remove('search-overlay--active');
  }
}

export default Search