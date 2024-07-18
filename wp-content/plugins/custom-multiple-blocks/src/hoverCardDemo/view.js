
import React from 'react';
import ReactDOM from 'react-dom';
import HoverCardDemo from "./component/HoverCardDemo.js";

const initializeApp = () => {
	const divsToUpdate = document.querySelectorAll(".HoverCardDemo")

	divsToUpdate.forEach((div) => {
		const preElement = div.querySelector('pre');
		if (preElement) {
			const data = JSON.parse(preElement.innerHTML)
			const root = ReactDOM.createRoot(div);

			root.render(<HoverCardDemo { ...data} />);
		}
	})
}

initializeApp()
