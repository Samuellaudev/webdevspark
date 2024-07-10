import axios from "axios";

class MyNotes {
  constructor() {
    this.deleteNoteButton = document.querySelectorAll(".delete-note");
    this.events();
  }

  events() {
    this.deleteNoteButton.forEach(btn => {
      btn.addEventListener("click", () => this.deleteNote())
    })
  }

  deleteNote() {
    alert('are you sure you want to delete?')
  }
}

export default MyNotes