var isRtl = document.documentElement.getAttribute("dir") === "rtl";

function position() {
    var res = document.getElementById("results");
        
    var max = 0;
    var gap = parseInt(getComputedStyle(res).fontSize, 10);
    var fits = 1;
	
	var fit3CandWid = (res.clientWidth - gap * 2) / 3;
	var fit2CandWid = (res.clientWidth - gap * 1) / 2;
	var wid;

		if (fit3CandWid >= 450) {
				fits = 3;	
				wid = fit3CandWid;
		} else if (fit2CandWid >= 450) {
				fits = 2;
				wid = fit2CandWid;
		}

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

    if (fits <= 1 || matchMedia("print").matches || window.innerWidth <= 1000) return;

    var map = [];
    var margin = (res.clientWidth - ((wid + gap) * fits - gap));
    for (var index = 0; index < fits; index++) {
        map[index] = [];
    }

    [].slice.call(res.children)
        .forEach(function (el) {
            cur++;
            if (cur >= fits) cur = 0;

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


    if (res.childNodes.length > 0) {
        res.style.height = max + gap + "px";
        res.style.marginTop = "2.5em";
    } else {
        res.style.height = "";
        res.style.marginTop = "";
    }

    setTimeout(function() {document.querySelector("main>.content").classList.remove("hide");}, 0);
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

var wordSplitPattern;
try {
    new RegExp('\\p{L}', 'u');
    wordSplitPattern = /[^\p{L}\p{N}]+/u;
} catch (e) {
    wordSplitPattern = /[\s\-.,;:!?()[\]{}'"\/\\|@#$%^&*+=<>~`]+/;
}

function matchesSearch(text, searchWords) {
    if (searchWords.length === 0) return true;
    var ucText = uc(text);
    return searchWords.every(function(word) {
        return ucText.indexOf(word) !== -1;
    });
}

function run() {
    var s = uc(document.getElementById("search").value.trim());
    var searchWords = s.split(wordSplitPattern).filter(function(w) { return w.length > 0; });


    res.innerText = '';
    list.forEach(function (e, ind) {
        var se = 0;
        var seA = 0;
        var c = e.querySelector(".card");
        var h = e.querySelector(".header .name");

        if (matchesSearch(h.innerText, searchWords)) {
            se = 1;
            seA = 1;
        }

        reg[ind]
            .forEach(function (i) {
                var l = i.querySelector(".content");

                if (seA || matchesSearch(l.innerText, searchWords) || searchWords.length === 0) {
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

    position();
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

run();
