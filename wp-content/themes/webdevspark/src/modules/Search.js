import axios from 'axios';

class Search {
  // 1. Describe and initiate our object
  constructor() {
    this.addSearchHTML();

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
  addSearchHTML() {
    document.body.insertAdjacentHTML('beforeend', `
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" id="search-term" placeholder="What are you looking for?">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>
      </div>
      `)
  }

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

    // Key 'S'
    if (keyCode === 83 && !this.isOverlayOpen && document.activeElement.tagName !== "INPUT" && document.activeElement.tagName !== "TEXTAREA") {
      this.openOverlay();
      this.isOverlayOpen = true;

      setTimeout(() => this.focusSearchField(), 300);
    }

    // Key 'Esc'
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

  displayResults(results) {
    return `
        <ul class="link-list min-list">
          ${ results.map(item => `
            <li>
              <a href="${ item.link }">${ item.title.rendered }</a>
            </li>
          `).join('') }
        </ul>
      `
  }

  async getResults() {
    const searchValue = this.searchField.value.trim();
    const pagesUrl = `${ siteConfig.root_url }/wp-json/wp/v2/pages?search=${ searchValue }`;
    const postsUrl = `${ siteConfig.root_url }/wp-json/wp/v2/posts?search=${ searchValue }`;

    try {
      const [pagesResponse, postsResponse] = await Promise.all([
        axios.get(pagesUrl),
        axios.get(postsUrl),
      ])

      const pages = pagesResponse.data
      const posts = postsResponse.data
      const combinedResults = [...pages, ...posts];

      this.resultsDiv.innerHTML = `
      <h2 class="search-overlay__section-title">General Information</h2>
      ${ combinedResults.length ? this.displayResults(combinedResults) : '<p>No results found</p>' }
    `;
    } catch (error) {
      console.log(error);
    }
  }
}

export default Search