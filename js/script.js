var select1 = document.querySelector('.select1');
var select2 = document.querySelector('.select2');
var select3 = document.querySelector('.select3');
function toggleSelects() {
    let index = select1.selectedIndex;
    console.log(select1[index].text);
    if (select1[index].text === "2eme cycle") {
    select2.classList.add("hide");
    select3.classList.remove("hide");
    }else if (select1[index].text === "1er cycle") {
        select3.classList.add("hide");
        select2.classList.remove("hide");
    }
}