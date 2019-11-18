const slider = document.querySelector('.slider');
const sliderImages = document.querySelectorAll('.slider img');


//Buttons
const prevBtn = document.querySelector('#prevBtn');
const nextBtn = document.querySelector('#nextBtn');

//Counter
let counter = 1;
const size = sliderImages[0].clientWidth;

slider.style.transform = 'translateX(' + (-size * counter) + 'px)';

//Button listeners

nextBtn.addEventListener('click', ()=>{

	slider.style.transition = "transform 0.4s ease-in-out";
	counter++;
	slider.style.transform = 'translateX(' + (-size * counter) + 'px)';
});

prevBtn.addEventListener('click', ()=>{
	slider.style.transition = "transform 0.4s ease-in-out";
	counter--;
	slider.style.transform = 'translateX(' + (-size * counter) + 'px)';
});

slider.addEventListener('transitionend', ()=>{
	if(sliderImages[counter].id === 'lastClone') {
		slider.style.transition = "none";
		counter = sliderImages.length - 2;
		slider.style.transform = 'translateX(' + (-size * counter) + 'px)';

	}
	if(sliderImages[counter].id === 'lastClone') {
		slider.style.transition = "none";
		counter = sliderImages.length - counter;
		slider.style.transform = 'translateX(' + (-size * counter) + 'px)';

	}
});