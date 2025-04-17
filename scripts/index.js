function toggleColor () {
    const svg = document.getElementById("nav-stripes");
        svg.addEventListener("click", function(event) {
            event.preventDefault();
            event.stopPropagation();

                if(svg.classList.contains("color-1")) {
                    svg.classList.remove("color-1");
                    svg.classList.add("color-2");
                } else {
                    svg.classList.remove("color-2");
                    svg.classList.add("color-1");
                }
        });
}

function expandLeftNavbar () {
    const nav = document.getElementById("left-nav");
    const stripes = document.getElementById("nav-stripes");

    stripes.addEventListener("click", function() {
        
        if(svg.classList.contains("color-1")) {
            nav.style.width
        }
    });

}
document.addEventListener("DOMContentLoaded", toggleColor);