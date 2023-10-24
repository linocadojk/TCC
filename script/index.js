
document.addEventListener("DOMContentLoaded", function () {
   const prevButton = document.querySelector(".carousel-prev");
   const nextButton = document.querySelector(".carousel-next");
   const slideContainer = document.querySelector(".carousel-slide");
   const indicators = document.querySelectorAll(".indicator"); // Select all indicators

   let currentIndex = 0;

   function handlePrevButtonClick() {
       if (currentIndex > 0) {
           currentIndex--;
       } else {
           currentIndex = 2;
       }
       updateCarousel();
       updateIndicators(); // Update indicators
   }

   function handleNextButtonClick() {
       const totalSlides = document.querySelectorAll(".carousel-item").length;
       if (currentIndex < totalSlides - 1) {
           currentIndex++;
       } else {
           currentIndex = 0;
       }
       updateCarousel();
       updateIndicators(); // Update indicators
   }

   function updateCarousel() {
       const itemWidth = document.querySelector(".carousel-item").clientWidth;
       slideContainer.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
   }

   function updateIndicators() {
       // Remove the 'active' class from all indicators
       indicators.forEach((indicator) => {
           indicator.classList.remove("active");
       });

       // Add the 'active' class to the indicator corresponding to the current slide
       indicators[currentIndex].classList.add("active");
   }

   // Initial update of indicators
   updateIndicators();

   // Event listeners for prev and next buttons
   prevButton.addEventListener("click", handlePrevButtonClick);
   nextButton.addEventListener("click", handleNextButtonClick);
});
