import axios from "axios";

class MyNotes {
  constructor() {
    this.deleteNoteButton = document.querySelectorAll(".delete-note");
    this.editNoteButton = document.querySelectorAll(".edit-note");
    this.events();
  }

  events() {
    if (this.deleteNoteButton) {
      this.deleteNoteButton.forEach(btn => {
        btn.addEventListener('click', (e) => this.deleteNote(e))
      });
    }
    if (this.editNoteButton) {
      this.editNoteButton.forEach(btn => {
        btn.addEventListener('click', (e) => this.editNote(e))
      })
    }
  }

  async deleteNote(e) {
    const thisNote = e.target.closest('li');
    const noteId = thisNote.getAttribute('data-id')
    const url = `${ siteConfig.root_url }/wp-json/wp/v2/note/${ noteId }`;

    try {
      const response = await axios.delete(url, {
        headers: {
          'X-WP-Nonce': siteConfig.nonce
        }
      })

      // Add fade-out animation and remove note after delay
      thisNote.style.height = `${ thisNote.offsetHeight }px`;
      setTimeout(function () {
        thisNote.classList.add("fade-out")
      }, 50)
      setTimeout(function () {
        thisNote.remove()
      }, 500)
    } catch (error) {
      console.log(error);
    }
  }

  async editNote(e) {
    const thisNote = e.target.closest('li');
    thisNote.querySelectorAll('.note-title-field, .note-body-field')
      .forEach(field => {
        field.removeAttribute('readonly')
        field.classList.add('note-active-field')
      })

    const updateButton = thisNote.querySelector('.update-note')
    updateButton.classList.add('update-note--visible')
  }
}

export default MyNotes