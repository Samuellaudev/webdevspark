import axios from "axios";

class Like {
  constructor() {
    if (document.querySelector('.like-box')) {
      axios.defaults.headers.common['X-WP-Nonce'] = siteConfig.nonce
      axios.defaults.headers.common['Content-Type'] = 'application/json'
      this.likeBox = document.querySelector('.like-box');

      this.events();
    }
  }

  events() { 
    this.likeBox.addEventListener('click', (e) => this.clickDispatcher(e))
  }

  clickDispatcher(e) {
    const currentLikeBox = e.target.closest('.like-box');

    if (currentLikeBox.getAttribute('data-exists') === 'yes') {
      this.deleteLike(currentLikeBox)
    } else {
      this.createLike(currentLikeBox)
    }
  }

  async deleteLike(currentLikeBox) {
    const url = `${ siteConfig.root_url }/wp-json/university/v1/manageLike`

    try {
      const response = await axios.delete(url)
      console.log('delete', response)
    } catch (error) {
      console.log(error);
    }
  }

  async createLike(currentLikeBox) {
    const url = `${ siteConfig.root_url }/wp-json/university/v1/manageLike`
    const data = {
      professorId: currentLikeBox.getAttribute('data-professor'),
    }

    try {
      const response = await axios.post(url, data)

    } catch (error) {
      if (error.response) {
        console.log('Server responded with:', error.response.data);
      } else if (error.request) {
        console.log('No response received:', error.request);
      } else {
        console.log('Request setup error:', error.message);
      }
      console.log('Axios error:', error);
    }
  }
}

export default Like