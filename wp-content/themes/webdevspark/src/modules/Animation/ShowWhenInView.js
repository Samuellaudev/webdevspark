import { animate, inView } from "motion";

export function showWhenInView(selector, delay = 0, initialY = '30px', margin = '-100px') {
  inView(selector, (element, enterInfo) => {
    element.style.opacity = 0;
    element.style.transform = `translateY(${ initialY })`;

    const animation = animate(
      element,
      { opacity: 1, y: [100, 0] },
      {
        delay,
        duration: 1,
        easing: [0.17, 0.55, 0.55, 1],
      }
    );
  }, { margin });
}
