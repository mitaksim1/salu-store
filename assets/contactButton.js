let contactButton = document.querySelector('#contactButton');
console.log(contactButton);

let contactForm = document.querySelector('#contactForm');

contactButton.addEventListener('click', function() {
    let formShow = contactForm.classList.add('show');

    if (formShow.classlist === 'show') {
        contactForm.style.display = 'initial';
    }
});   
