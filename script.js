document.addEventListener("DOMContentLoaded", function () {
    let slideIndex = 0;
    const slides = document.querySelectorAll(".carousel-slide");
    const totalSlides = slides.length;

    function showSlide(index) {
        if (index >= totalSlides) {
            slideIndex = 0;
        } else if (index < 0) {
            slideIndex = totalSlides - 1;
        } else {
            slideIndex = index;
        }
        document.querySelector(".carousel-container").style.transform = `translateX(-${slideIndex * 100}%)`;
    }

    window.moveSlide = function (direction) {
        showSlide(slideIndex + direction);
    };

    setInterval(() => {
        showSlide(slideIndex + 1);
    }, 4000);
});
