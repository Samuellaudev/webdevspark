import axios from 'axios';

class Search {
  // 1. Describe and initiate our object
  constructor() {
    // To be uncommented after modification
    // this.addSearchHTML();

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
          <li>
            <a href="${ item.permalink }">${ item.title }</a>
            ${ item.postType === 'post' ? `by ${ item.authorName }` : '' }
          </li>
        `).join('') }
      </ul>
    `}

  displayProfessors(professors) { 
    return `
      <ul class='professor-cards'>
        ${ professors.map(professor => `
          <li class="professor-card__list-item">
            <a class="professor-card" href="${professor.permalink}">
              <img class="professor-card__image" src="${professor.image}" alt="">
              <span class="professor-card__name">${professor.title}</span>
            </a>
          </li>
        `).join('') }
      </ul>
    `}

  displayEvents(events) {
    return `
      ${ events.map(event => `
        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="${event.permalink}">
            <span class="event-summary__month">${event.month}</span>
            <span class="event-summary__day">${event.date}</span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny">
              <a href="${event.permalink}">${event.title}</a>
            </h5>
            <p>
              ${event.description}
              <a href="${event.permalink}" class="nu gray">Read more</a>
            </p>
          </div>
        </div>
      `)}
    `
  }

  async getResults() {
    const searchValue = this.searchField.value.trim();
    const url =`${siteConfig.root_url}/wp-json/university/v1/search?term=${searchValue}`;

    try {
      const response = await axios.get(url)
      const results = response.data
      const { generalInfo, programs, professors, events } = results

      this.resultsDiv.innerHTML = `
      <div class='row'>
        <div class='one-third'>
          <h2 class="search-overlay__section-title">General Information</h2>
          ${ generalInfo.length ? this.displayResults(generalInfo) : '<p>No general information matches that search.</p>' }
        </div>
        <div class='one-third'>
          <h2 class="search-overlay__section-title">Programs</h2>
          ${ programs.length ? this.displayResults(programs) : '<p>No programs matches that search.</p>' }
        </div>
        <div class='one-third'>
          <h2 class="search-overlay__section-title">Professors</h2>
          ${ professors.length ? this.displayProfessors(professors) : '<p>No professors matches that search.</p>' }
        </div>
        <div class='one-third'>
          <h2 class="search-overlay__section-title">Events</h2>
          ${ events.length ? this.displayEvents(events) : '<p>No events matches that search.</p>' }
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