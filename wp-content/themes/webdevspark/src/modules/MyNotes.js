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

  async deleteNote() {
    const url = `${ siteConfig.root_url }/wp-json/wp/v2/note/110`;

    try {
      const response = await axios.delete(url, {
        headers: {
          'X-WP-Nonce': siteConfig.nonce
        }
      })

      console.log('response', response.data);
    } catch (error) {
      console.log(error);
    }
  }
}

export default MyNotes