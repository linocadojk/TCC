
document.addEventListener("DOMContentLoaded", function () {
   const prevButton = document.querySelector(".carousel-prev");
   const nextButton = document.querySelector(".carousel-next");
   const slideContainer = document.querySelector(".carousel-slide");

   let currentIndex = 0;

   prevButton.addEventListener("click", () => {
      if (currentIndex > 0) {
         currentIndex--;
         updateCarousel();
      }
      else {
         currentIndex = 2;
         updateCarousel();
      }

   });

   nextButton.addEventListener("click", () => {
      const totalSlides = document.querySelectorAll(".carousel-item").length;
      if (currentIndex < 2) {
         currentIndex++;
         updateCarousel();
      }
      else {
         currentIndex = 0;
         updateCarousel();
      }
   });

   function updateCarousel() {
      const itemWidth = document.querySelector(".carousel-item").clientWidth;
      slideContainer.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
   }
});
