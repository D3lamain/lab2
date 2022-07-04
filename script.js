function LookData() {
    if("savedData" in localStorage) {
        document.getElementById("savedContent").innerHTML = decodeURI(localStorage.getItem("savedData"));

        localStorage.setItem("savedData", document.getElementById("content").innerHTML); // в локалстор должны

    }
    else {
        document.getElementById("savedContent").innerHTML = "No saved content";

    }
}
function SaveData() {
    localStorage.setItem("savedData", document.getElementById("content").innerHTML);
}