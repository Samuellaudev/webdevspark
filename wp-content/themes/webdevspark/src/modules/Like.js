class Like {
  constructor() {
    if (document.querySelector('.like-box')) {
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
      this.deleteLike()
    } else {
      this.createLike()
    }
  }

  deleteLike() {
    alert('Delete like');
  }

  createLike() {
    alert('Create like');
  }
}

export default Like