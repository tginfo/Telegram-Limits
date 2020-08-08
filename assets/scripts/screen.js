var viewport = document.getElementById('viewport');
var orV = viewport.getAttribute('content');
var r = function () {
    if (window.innerWidth >= 1000 && window.innerHeight / window.innerWidth > .8) {
        viewport.setAttribute("content", "width=1000");
        document.documentElement.style.setProperty('--base-size', '2vmin');
    } else {
        viewport.setAttribute("content", orV);
        document.documentElement.style.setProperty('--base-size', '');
    }
};
window.addEventListener("resize", r);
r();
