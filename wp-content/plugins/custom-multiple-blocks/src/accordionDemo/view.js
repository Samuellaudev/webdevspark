
import React from 'react';
import ReactDOM from 'react-dom';
import AccordionDemo from "./component/AccordionDemo.js";

const initializeApp = () => {
	const divsToUpdate = document.querySelectorAll(".AccordionDemo")

	divsToUpdate.forEach((div) => {
		const preElement = div.querySelector('pre');
		if (preElement) {
			const data = JSON.parse(preElement.innerHTML)
			const root = ReactDOM.createRoot(div);

			root.render(<AccordionDemo { ...data } />);
		}
	})
}

initializeApp()
