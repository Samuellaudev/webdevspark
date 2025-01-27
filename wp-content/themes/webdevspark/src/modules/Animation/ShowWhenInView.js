import { animate, inView } from "https://cdn.jsdelivr.net/npm/motion@12.0.6/+esm";

export function showWhenInView(selector, delay = 0, initialY = '30px', margin = '-100px', once = true) {
  inView(selector, (element) => {
    element.style.opacity = 0;
    element.style.transform = `translateY(${ initialY })`;

    animate(
      element,
      { opacity: 1, y: [100, 0] },
      {
        delay,
        duration: 1,
        easing: [0.17, 0.55, 0.55, 1],
      }
    );

    if (once) {
      return (leaveInfo) => animation.stop()
    } else {
      return () => animate(element, { opacity: 0, y: 100 })
    }
  }, { margin });
}
