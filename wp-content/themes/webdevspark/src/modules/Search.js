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
    if (this.closeButton) {
      this.closeButton.addEventListener("click", () => this.closeOverlay());
    }
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
          <li class='hover:cursor-pointer hover:text-primary-500'>
            <a href="${ item.permalink }">${ item.title }</a>
            ${ item.postType === 'post' ? `by ${ item.authorName }` : '' }
          </li>
        `).join('') }
      </ul>
    `}

    displayProjects(projects) {
      return `
        ${ projects.map(project => `
          <div class="project-summary">
            <div class='project-summary__content p-2 -translate-x-2 -translate-y-2 border-2 border-transparent hover:border-black hover:translate-x-0.5 hover:translate-y-0.5 rounded-md duration-200'>
              <h5 class="project-summary__title headline headline--small-plus pt-4 pb-0 px-0 text-black cursor-pointer">
                <a href="${ project.permalink }" class="hover:text-primary-500 no-underline">${ project.title }</a>
              </h5>
              <p class="flex flex-col mt-0 pt-0">
                ${ project.description }
                <a href="${ project.permalink }" class="nu gray cursor-pointer">Read more</a>
              </p>
            </div>
          </div>
        `).join('') }
      `
    }
    

  async getResults() {
    const searchValue = this.searchField.value.trim();
    const url = `${ siteConfig.root_url }/wp-json/university/v1/search?term=${ searchValue }`;

    try {
      const response = await axios.get(url)
      const results = response.data
      const { generalInfo, languages, projects } = results

      this.resultsDiv.innerHTML = `
      <div class='row'>
        <div class='one-third'>
          <h2 class="search-overlay__section-title">General Information</h2>
          ${ generalInfo.length ? this.displayResults(generalInfo) : '<p>No general information matches that search.</p>' }
        </div>
        <div class='one-third'>
          <h2 class="search-overlay__section-title">Languages</h2>
          ${ languages.length ? this.displayResults(languages) : '<p>No languages matches that search.</p>' }
        </div>
        <div class='one-third'>
          <h2 class="search-overlay__section-title">Projects</h2>
          ${ projects.length ? this.displayProjects(projects) : '<p>No projects matches that search.</p>' }
        </div>
      </div>
    `;
    } catch (error) {
      console.log(error);
      this.resultsDiv.innerHTML = '<p>Something went wrong. Please try again later.</p>';
    }
  }
}

export default Search