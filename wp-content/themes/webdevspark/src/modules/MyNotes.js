import axios from "axios";

class MyNotes {
  constructor() {
    this.deleteNoteButton = document.querySelectorAll(".delete-note");
    this.editNoteButton = document.querySelectorAll(".edit-note");
    this.updateNoteButton = document.querySelectorAll(".update-note");
    this.createNoteButton = document.querySelector(".submit-note");
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
    if (this.updateNoteButton) {
      this.updateNoteButton.forEach(btn => {
        btn.addEventListener('click', (e) => this.updateNote(e))
      })
    }
    this.createNoteButton.addEventListener('click', (e) => this.createNote(e))
  }

  async deleteNote(e) {
    const thisNote = e.target.closest('li');
    const noteId = thisNote.getAttribute('data-id')
    const url = `${ siteConfig.root_url }/wp-json/wp/v2/note/${ noteId }`;

    try {
      const response = await axios.delete(url, {
        headers: {
          'Content-Type': 'application/json',
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
      await axios.post(url, updatePostData, {
        headers: {
          'Content-Type': 'application/json',
          'X-WP-Nonce': siteConfig.nonce
        }
      })

      this.makeNoteReadOnly(thisNote)

    } catch (error) {
      console.log(error);
    }
  }

  async createNote(e) {
    const url = `${ siteConfig.root_url }/wp-json/wp/v2/note/`;

    const newPostData = {
      title: document.querySelector('.new-note-title').value,
      content: document.querySelector('.new-note-body').value,
      status: 'publish'
    }

    try {
      const response = await axios.post(url, newPostData, {
        headers: {
          'Content-Type': 'application/json',
          'X-WP-Nonce': siteConfig.nonce
        }
      })

      if (response.status === 201) {
        const newListItem = document.createElement('li');
        newListItem.textContent = 'test';

        // Insert new list item at beginning
        const notesList = document.getElementById('my-notes');
        notesList.insertBefore(newListItem, notesList.firstChild);
        newListItem.style.display = 'none';
        setTimeout(() => {
          newListItem.style.display = 'block';
        }, 0);
      }
    } catch (error) {
      console.log(error);
    }
  }
}

export default MyNotes