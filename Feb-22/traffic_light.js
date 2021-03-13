document.addEventListener("DOMContentLoaded", start())

function start() {
    document.querySelector(".light-1").classList.add("red")
    document.querySelector(".light-2").classList.remove("yellow")
    setTimeout(red_yellow, 5000)
}

function red_yellow() {
    document.querySelector(".light-2").classList.add("yellow")
    setTimeout(green, 2000)
}

function green() {
    document.querySelector(".light-1").classList.remove("red")
    document.querySelector(".light-2").classList.remove("yellow")
    document.querySelector(".light-3").classList.add("green")
    setTimeout(red, 2000)
}

function red() {
    document.querySelector(".light-3").classList.remove("green")
    document.querySelector(".light-2").classList.add("yellow")
    setTimeout(start, 2000)
}