import './frontend.scss'
import React from 'react';
import ReactDOM from 'react-dom';

const Quiz = () => {
  return (
    <div className="paying-attention-frontend">hello from react</div>
  )
}

const divsToUpdate = document.querySelectorAll(".paying-attention-update-me")

// Use ReactDOM.createRoot for React 18
divsToUpdate.forEach((div) => {
  const root = ReactDOM.createRoot(div);
  root.render(<Quiz />);
})
