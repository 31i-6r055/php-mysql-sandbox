window.addEventListener('scroll', function() {
    const header = document.querySelector('.page-title');
    if (window.scrollY > 5) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('submit-popup');
    if (popup) {
        setTimeout(() => {
            popup.classList.add('hiding');
            setTimeout(() => {
                popup.style.display = 'none';
            }, 600);
        }, 4000);
    }
});