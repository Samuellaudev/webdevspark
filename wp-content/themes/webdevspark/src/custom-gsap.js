document.addEventListener("DOMContentLoaded", (e) => {
  const gsapAnimation = (e) => {
    gsap.fromTo(".card-left",
      { rotate: 5 },
      {
        rotate: -45,
        transformOrigin: "bottom left",
        ease: "power2.inOut",
        scrollTrigger: {
          trigger: ".cards-section",
          start: "top 75%",
          end: "bottom 45%",
          scrub: true,
        }
      });

    gsap.fromTo(".card-right",
      { rotate: -5 },
      {
        rotate: 45,
        transformOrigin: "bottom right",
        ease: "power2.inOut",
        scrollTrigger: {
          trigger: ".cards-section",
          start: "top 100%",
          end: "bottom 0%",
          scrub: true
        }
      });

    gsap.from(".card-center",
      {
        rotate: -5,
        scrollTrigger: {
          trigger: ".cards-section",
          start: "top 100%",
          end: "bottom top",
          scrub: true,
        }
      }
    );
  }

  window.addEventListener("load", gsapAnimation(), false);
});
