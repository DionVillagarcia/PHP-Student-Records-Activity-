/* =========================
   PARALLAX
========================= */

const sky = document.querySelector(".sky");
const mountains = document.querySelector(".mountains");
const trees = document.querySelector(".trees");

let targetScroll = 0;
let currentScroll = 0;


/* =========================
   CHECK REDUCED MOTION
========================= */

const prefersReducedMotion =
    window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;


/* =========================
   GET SCROLL POSITION
========================= */

window.addEventListener("scroll", () => {

    targetScroll = window.scrollY;

});


/* =========================
   PARALLAX ANIMATION
========================= */

function animateParallax() {

    if (!prefersReducedMotion) {

        /*
            Smoothly move currentScroll
            toward targetScroll.
        */

        currentScroll +=
            (targetScroll - currentScroll) * 0.08;


        /*
            Different layers move
            at different speeds.
        */

        sky.style.transform =
            `translateY(${currentScroll * 0.05}px)`;


        mountains.style.transform =
            `translateY(${currentScroll * 0.20}px)`;


        trees.style.transform =
            `translateY(${currentScroll * 0.40}px)`;

    }


    requestAnimationFrame(
        animateParallax
    );
}


/* Start animation */

animateParallax();