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
    const data = {
      likeId: currentLikeBox.getAttribute('data-like')
    }

    try {
      const response = await axios.delete(url, { data })

      if (response.data === 'The like was deleted successfully') {
        currentLikeBox.setAttribute('data-exists', 'no');

        const likeCountElement = currentLikeBox.querySelector('.like-count');
        let likeCount = parseInt(likeCountElement.innerHTML, 10)

        likeCount--
        likeCountElement.innerHTML = likeCount

        currentLikeBox.setAttribute('data-like', '')
      }
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

      if (response.data !== "Only logged in users can create a like.") { 
        currentLikeBox.setAttribute('data-exists', 'yes');

        const likeCountElement = currentLikeBox.querySelector('.like-count');
        let likeCount = parseInt(likeCountElement.innerHTML, 10)

        likeCount++
        likeCountElement.innerHTML = likeCount

        currentLikeBox.setAttribute('data-like', response.data.like_id)
      }
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