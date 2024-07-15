import './frontend.scss'
import React, { useState } from 'react';
import ReactDOM from 'react-dom';

const Quiz = ({ question, answers, correctAnswer }) => {
  const [isCorrect, setIsCorrect] = useState(null);

  const handleAnswer = (index) => {
    setIsCorrect(index === correctAnswer);
  }

  return (
    <div className="paying-attention-frontend">
      <p>{ question }</p>
      <ul>
        { answers.map((answer, index) => (
          <li key={ index } onClick={ () => handleAnswer(index) }>
            { answer }
          </li>
        )) }
      </ul>
      { isCorrect === true ? (
        <div className="correct-message correct-message--visible">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" className="bi bi-emoji-smile" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
            <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5" />
          </svg>
          <p>That's correct!</p>
        </div>
      ) : null }
      { isCorrect === false ? (
        <div className="incorrect-message incorrect-message--visible">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" className="bi bi-emoji-frown" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
            <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.5 3.5 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.5 4.5 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5" />
          </svg>
          <p>Sorry, try again</p>
        </div>
      ) : null }
    </div>
  )
}

const divsToUpdate = document.querySelectorAll(".paying-attention-update-me")

// Use ReactDOM.createRoot for React 18
divsToUpdate.forEach((div) => {
  const data = JSON.parse(div.querySelector('pre').innerHTML)
  const root = ReactDOM.createRoot(div);

  root.render(<Quiz { ...data } />);
})
