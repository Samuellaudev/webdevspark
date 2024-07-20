
import React from 'react';
import ReactDOM from 'react-dom';
import NavigationMenuDemo from "./component/NavigationMenuDemo.js";

const initializeApp = () => {
	const divsToUpdate = document.querySelectorAll(".NavigationMenuDemo")

	divsToUpdate.forEach((div) => {
		const preElement = div.querySelector('pre');
		if (preElement) {
			const data = JSON.parse(preElement.innerHTML)
			const root = ReactDOM.createRoot(div);

			root.render(<NavigationMenuDemo { ...data } />);
		}
	})
}

initializeApp()
