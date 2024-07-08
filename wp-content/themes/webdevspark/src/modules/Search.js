import axios from 'axios';

class Search {
  // 1. Describe and initiate our object
  constructor() {
    this.openButtons = document.querySelectorAll(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay .search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");

    // Related to keypress events
    this.isOverlayOpen = false;

    // Related to typing events
    this.searchField = document.querySelector('#search-term');
    this.typingTimer = null;
    this.resultsDiv = document.querySelector('#search-overlay__results');
    this.isSpinnerVisible = false;
    this.previousValue;

    this.events();
  }

  // 2. events
  events() {
    this.openButtons.forEach(btn => {
      btn.addEventListener("click", () => this.openOverlay());
    })
    this.closeButton.addEventListener("click", () => this.closeOverlay());
    document.addEventListener('keydown', e => this.keyPressDispatcher(e))
    if (this.searchField) {
      this.searchField.addEventListener('keyup', () => this.typingLogic());
    }
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

      setTimeout(() => this.focusSearchField(), 300);
    }

    if (keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
      this.isOverlayOpen = false;
      this.searchField.value = '';
      this.resultsDiv.innerHTML = '';
    }
  }

  focusSearchField() {
    if (this.isOverlayOpen && this.searchField) {
      this.searchField.focus();
    }
  }

  typingLogic() {
    if (this.searchField.value !== this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.showSpinner();
        }

        this.typingTimer = setTimeout(() => this.getResults(), 500);
      } else {
        this.clearResults();
      }
    }

    this.previousValue = this.searchField.value;
  }

  showSpinner() {
    this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
    this.isSpinnerVisible = true;
  }

  clearResults() {
    this.resultsDiv.innerHTML = '';
    this.isSpinnerVisible = false;
  }

  async getResults() {
    const searchValue = this.searchField.value;
    const url = `http://webdevspark.local/wp-json/wp/v2/posts?search=${searchValue}`;
    
    try {
      const response = await axios.get(url);
      const results = response.data;
      console.log(results);
    } catch (error) {
      console.log(error);
    }
  }
}

export default Search