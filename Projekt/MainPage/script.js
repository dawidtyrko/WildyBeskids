
let navbar = document.getElementById("navbar");
let sticky = navbar.offsetTop;
window.onscroll = function () {scrollFunc()};
function scrollFunc(){
    if(window.scrollY >= sticky){
        navbar.classList.add("sticky");
    }
    else{
        navbar.classList.remove("sticky");
    }
};


