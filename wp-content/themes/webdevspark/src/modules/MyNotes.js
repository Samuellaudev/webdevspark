import axios from "axios";

class MyNotes {
  constructor() {
    if (document.querySelector("#my-notes")) {
      axios.defaults.headers.common['X-WP-Nonce'] = siteConfig.nonce
      axios.defaults.headers.common['Content-Type'] = 'application/json'
      this.myNotes = document.querySelector("#my-notes")
      this.createNoteButton = document.querySelector(".submit-note");

      this.events()
    }
  }

  events() {
    this.myNotes.addEventListener('click', (e) => {
      if (e.target.classList.contains('delete-note')) this.deleteNote.bind(this)(e)
      if (e.target.classList.contains('edit-note')) this.editNote.bind(this)(e)
      if (e.target.classList.contains('update-note')) this.updateNote.bind(this)(e)
    })

    this.createNoteButton.addEventListener('click', (e) => this.createNote(e))
  }

  async deleteNote(e) {
    const thisNote = e.target.closest('li');
    const noteId = thisNote.getAttribute('data-id')
    const url = `${ siteConfig.root_url }/wp-json/wp/v2/note/${ noteId }`;

    try {
      await axios.delete(url)

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

  editNote(e) {
    const thisNote = e.target.closest('li');
    const noteState = thisNote.getAttribute('data-state')

    if (noteState === 'editable') {
      this.makeNoteReadOnly(thisNote)
    } else {
      this.makeNoteEditable(thisNote)
    }
  }

  makeNoteReadOnly(thisNote) {
    const editNoteBtn = thisNote.querySelector('.edit-note')
    editNoteBtn.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i> Edit'

    this.toggleNoteFields(thisNote, true)

    const updateButton = thisNote.querySelector('.update-note')
    updateButton.classList.remove('update-note--visible')

    thisNote.dataset.state = 'cancel'
  }

  makeNoteEditable(thisNote) {
    const editNoteBtn = thisNote.querySelector('.edit-note')
    editNoteBtn.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i> Cancel'

    this.toggleNoteFields(thisNote, false)

    const updateButton = thisNote.querySelector('.update-note')
    updateButton.classList.add('update-note--visible')

    thisNote.dataset.state = 'editable'
  }

  // Helper to toggle note fields' readonly state
  toggleNoteFields(thisNote, isReadOnly) {
    const fields = thisNote.querySelectorAll('.note-title-field, .note-body-field');
    fields.forEach(field => {
      field.toggleAttribute('readonly', isReadOnly);
      field.classList.toggle('note-active-field', !isReadOnly);
    });
  }

  async updateNote(e) {
    const thisNote = e.target.closest('li');
    const noteId = thisNote.getAttribute('data-id')
    const url = `${ siteConfig.root_url }/wp-json/wp/v2/note/${ noteId }`;

    const updatePostData = {
      title: thisNote.querySelector('.note-title-field').value,
      content: thisNote.querySelector('.note-body-field').value
    }

    try {
      await axios.post(url, updatePostData)

      this.makeNoteReadOnly(thisNote)

    } catch (error) {
      console.log(error);
    }
  }

  async createNote() {
    const url = `${ siteConfig.root_url }/wp-json/wp/v2/note/`;

    const newPostData = {
      title: document.querySelector('.new-note-title').value,
      content: document.querySelector('.new-note-body').value,
      status: 'publish'
    }

    try {
      const response = await axios.post(url, newPostData)

      if (response.status === 201) {
        const { id, title, content } = response.data
        const postHtml = `
        <li data-id="${id}" class="fade-in-calc">
          <input readonly class='note-title-field' value="${ title?.raw}">
          <span class="edit-note">
            <i class="fa fa-pencil" aria-hidden="true"></i> Edit
          </span>
          <span class="delete-note">
            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
          </span>
          <textarea readonly name="" id="" cols="30" rows="10" class='note-body-field'>
            ${content?.raw}
          </textarea>
          <span class="update-note btn btn--blue btn--small">
            <i class="fa fa-arrow-right" aria-hidden="true"></i> Save
          </span>
        </li>`

        document.querySelector('#my-notes').insertAdjacentHTML('afterbegin', postHtml)
        document.querySelector('.new-note-title').value = ''
        document.querySelector('.new-note-body').value = ''

        let finalHeight // browser needs a specific height to transition to, you can't transition to 'auto' height
        let newlyCreated = document.querySelector("#my-notes li")

        // give the browser 30 milliseconds to have the invisible element added to the DOM before moving on
        setTimeout(function () {
          finalHeight = `${newlyCreated.offsetHeight}px`
          newlyCreated.style.height = "0px"
        }, 30)

        // give the browser another 20 milliseconds to count the height of the invisible element before moving on
        setTimeout(function () {
          newlyCreated.classList.remove("fade-in-calc")
          newlyCreated.style.height = finalHeight
        }, 50)

        // wait the duration of the CSS transition before removing the hardcoded calculated height from the element so that our design is responsive once again
        setTimeout(function () {
          newlyCreated.style.removeProperty("height")
        }, 450)
      }
    } catch (error) {
      console.log(error);
    }
  }
}

export default MyNotes