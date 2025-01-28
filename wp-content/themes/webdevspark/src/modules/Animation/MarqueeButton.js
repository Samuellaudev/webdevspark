import { animate } from "motion";

// Marquee text content
function MarqueeText() {
  return `
    <span class="text-white text-md md:text-lg font-medium px-4">Let's explore 💻</span>
    <span class="text-white text-md md:text-lg font-medium px-4">Let's explore 💻</span>
    <span class="text-white text-md md:text-lg font-medium px-4">Let's explore 💻</span>
  `;
}

// Function to create the Marquee button
export function MarqueeButton(selector, redirect) {
  const button = document.querySelector(selector);
  if (!button) return;

  // Create marquee containers
  const marquee1 = document.createElement('div');
  marquee1.classList.add('flex', 'whitespace-nowrap');
  marquee1.innerHTML = MarqueeText();
  button.appendChild(marquee1);

  const marquee2 = document.createElement('div');
  marquee2.classList.add('flex', 'whitespace-nowrap', 'absolute');
  marquee2.innerHTML = MarqueeText();
  button.appendChild(marquee2);

  // Add animation to the marquee elements
  animate(marquee1, { x: ['0%', '-100%'] }, {
    repeat: Infinity,
    duration: 15,
    easing: 'linear',
  });

  animate(marquee2, { x: ['100%', '0%'] }, {
    repeat: Infinity,
    duration: 15,
    easing: 'linear',
  });

  // Add event listener to the button for navigation
  button.addEventListener('click', () => {
    window.location.href = redirect;
  });
}
