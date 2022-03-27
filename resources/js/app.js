require('./bootstrap');

import ScrollReveal from 'scrollreveal';

ScrollReveal().reveal(".post",{
    origin:"top",
    distance:"50px",
    duration:1000,
})

new VenoBox({
    selector: ".venobox"
});
