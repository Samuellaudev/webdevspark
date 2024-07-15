import './frontend.scss'
import React from 'react';
import ReactDOM from 'react-dom';

const Quiz = (data) => {
  const { question, answers, correctAnswer } = data;

  return (
    <div className="paying-attention-frontend">
      <p>{ question }</p>
      <ul>
        { answers.map(answer => {
          return <li>{ answer }</li>
        }) }
      </ul>
    </div>
  )
}

const divsToUpdate = document.querySelectorAll(".paying-attention-update-me")

// Use ReactDOM.createRoot for React 18
divsToUpdate.forEach((div) => {
  const data = JSON.parse(div.querySelector('pre').innerHTML)
  const root = ReactDOM.createRoot(div);

  root.render(<Quiz {...data} />);
})
