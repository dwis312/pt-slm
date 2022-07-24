// show scroll up

const scrollUp = document.getElementById('scroll-up');
window.addEventListener('scroll', function() {
    if(scrollY >= 560) {
        scrollUp.classList.add('show-scroll');
    } else {
        scrollUp.classList.remove('show-scroll');
    }
});
