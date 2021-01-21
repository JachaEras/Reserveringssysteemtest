const oudproductButton = document.querySelector("#oudproduct")
const oudproductSection = document.querySelector("#oudproductsection")

oudproductButton.addEventListener("click", function(){
    oudproductSection.scrollIntoView({behaviour:'smooth'});
})
const verbeteringButton = document.querySelector("#verbetering")
const verbeteringSection = document.querySelector("#verbeteringsection")

verbeteringButton.addEventListener("click", function(){
    verbeteringSection.scrollIntoView({behaviour:'smooth'});
})

const filmpjeButton = document.querySelector("#filmpje")
const filmSection = document.querySelector("#filmsection")

filmpjeButton.addEventListener("click", function(){
    filmSection.scrollIntoView({behaviour:'smooth'});
})