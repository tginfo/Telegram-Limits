var isRtl = document.documentElement.getAttribute("dir") === "rtl";

function position(init) {
    var res = document.getElementById("results");
        
    var max = 0;
    var gap = parseInt(getComputedStyle(res).fontSize, 10);
    var wid = Math.max(450, ((res.clientWidth - gap) / 3) - gap);
    var fits = Math.floor((res.clientWidth + gap) / (wid + gap)) - 1;
    if (fits > 3) fits = 3;

    var cur = -1;
    [].slice.call(res.children)
        .forEach(function (el) {

            el.style.width = "";
            el.style.top = "";
            el.style.left = "";
            el.style.right = "";
            el.style.position = "";
            el.style.margin = "";
            res.style.marginTop = "";
            res.style.height = ""
        });



    if (fits <= 1 || matchMedia("print").matches) return;
    
    if (init === true) res.style.opacity = 0;

    var map = [];
    var margin = (res.clientWidth - ((wid + gap) * (fits + 1)));
    for (var index = 0; index <= fits; index++) {
        map[index] = [];
    }


    [].slice.call(res.children)
        .forEach(function (el) {
            cur++;
            if (cur > fits) cur = 0;

            const al = map.map(function (col) {
                var last = col[col.length - 1];

                if (!last) return 0;
                return last.offsetTop + last.clientHeight;
            });

            var min = Math.min.apply(null, al);
            cur = al.findIndex(function (e) {
                return e === min;
            });

            var lasted = map[cur][map[cur].length - 1];

            el.style.position = "absolute";
            el.style.width = wid + "px";
            el.style.margin = "0";
            el.style[(isRtl ? 'right' : 'left')] = margin + cur * (wid + gap) + "px";
            el.style.top = (lasted ? (lasted.offsetTop + lasted.clientHeight) + gap : 0) + "px";
            map[cur].push(el);

            if (el.offsetTop + el.clientHeight > max) max = el.offsetTop + el.clientHeight
        });


    res.style.height = max + gap + "px";
    res.style.marginTop = "2.5em";

    setTimeout(function() {res.style.opacity = 1;}, 0);
}

var res = document.getElementById("results");
var list = [].slice.call(res.children)
var reg = list
    .map(function (e) {
        return [].slice.call(e.querySelectorAll(".item"))
    })

function uc(s) {
    return s.toUpperCase().replace(/Ё/, "Е")
}

function run(init) {
    var s = uc(document.getElementById("search").value.trim());


    list.forEach(function (e, ind) {
        var se = 0;
        var seA = 0;
        var c = e.querySelector(".card");
        var h = e.querySelector(".header .name");

        if (uc(h.innerText).indexOf(s) !== -1) {
            se = 1;
            seA = 1;
        }

        reg[ind]
            .forEach(function (i) {
                var l = i.querySelector(".content");

                if (seA || uc(l.innerText).indexOf(s) !== -1 || s.length === 0) {
                    se = 1;
                    c.appendChild(i)
                }
                else try {
                    c.removeChild(i);
                } catch (e) {

                }
            })

        if (!se) try {
            res.removeChild(e);
        } catch (e) {

        }
        else res.appendChild(e);
    })

    position(init);
}
window.addEventListener("load", function () {
    position();
}, false);

document.getElementById("search").addEventListener("keyup", run, false);
window.addEventListener("resize", position, false);

function langSwitch(el) {
    var e = document.getElementById("langlist");
    e.style.display = "block"
    e.style.bottom = el.offsetTop + "px";
    e.style.left = el.offsetLeft + "px"

    function cl() {
        e.style.display = "";
        document.removeEventListener("click", cl, false);
        window.removeEventListener("resize", cl, false);
    }

    setTimeout(function () {
        document.addEventListener("click", cl, false);
        window.addEventListener("resize", cl, false);
    }, 0);

    return false
}

run(true);
