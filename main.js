//adding hovered class to selected list item
let list = document.querySelectorAll(".admin-navigation li");

function activeLink(){
    list.forEach((item)=>{
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

//Admin menu toggle
let toggle = document.querySelector(".admin-toggle");
let navigation = document.querySelector(".admin-navigation");
let main = document.querySelector(".admin-main");

toggle.onclick = function(){
    navigation.classList.toggle("active");
    main.classList.toggle("active");
}


