/**
 * Import motion from the CDN.
 * CDN: https://cdn.jsdelivr.net/npm/motion@12.0.6/+esm
 */

import { showWhenInView } from "./Animation/ShowWhenInView";
import { MarqueeButton } from "./Animation/MarqueeButton";

class Animations {
  /**
   * Constructor to initialize animations.
   */
  constructor() {
    this.initializeAnimations();
  }

  /**
   * Initialize all animations on the page.
   */
  initializeAnimations() {
    showWhenInView(".revealOnScrollOnce", 0.3, "50px", "-50px");
    MarqueeButton(".marquee-button", '/projects');
  }
}

export default Animations;
