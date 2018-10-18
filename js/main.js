var header = document.querySelector("header");
var input = document.getElementById("searchbar");
var tools = document.querySelectorAll(".case");
window.addEventListener("scroll", () => {
    if (window.scrollY >= 440) {
        header.classList.add("transparent");
        input.classList.add("transparent");
        document.querySelector("h1").classList.add("transparent");
    } else {
        header.classList.remove("transparent");
        input.classList.remove("transparent");
        document.querySelector("h1").classList.remove("transparent");
    }
}
);

var allTags = document.querySelectorAll(".tag-list li");

input.addEventListener("focus", () => {
    input.placeholder = "bah c'est bien ici";
    TweenMax.to(document.querySelector("header label"), 0.3, {opacity:0},() => {
        document.querySelector("header label").style.display = "none";
    }); 
});
input.addEventListener("focusout", () => {
    input.placeholder = "Tu cherche un truc... ?";
    TweenMax.to(document.querySelector("header label"), 0.3, {opacity:1},() => {
        document.querySelector("header label").style.display = "none";
    }); 
});

document.querySelector("header h1").addEventListener("click", () => {
    input.value = "",
    searchByTag();
});


allTags.forEach(element => {
    element.addEventListener("click", () => {
        input.value = element.innerHTML;
        searchByTag();
    });
});


function searchByTag() {
    var filter = input.value.toUpperCase();
    for (var i = 0; i < tools.length; i++) {
        var display = false;
        var tags = tools[i].querySelectorAll(".tag-list");
        var title = tools[i].querySelector("h2");
        var desc = tools[i].querySelector("p");

        if (title.innerHTML.toUpperCase().indexOf(filter) > -1) {
            display = true;
        }
        if (desc.innerHTML.toUpperCase().indexOf(filter) > -1) {
            display = true;
        }

        if (!display) {
            for (let j = 0; j < tags.length; j++) {
                if (tags[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    display = true;
                    j = tools[i].length;
                }
            }
        }
        if (display) {
            TweenMax.to(tools[i],0.3,{opacity:1, display:""});
        } else {
            TweenMax.to(tools[i],0.3,{opacity:0, display:"none"});
        }
    }
}