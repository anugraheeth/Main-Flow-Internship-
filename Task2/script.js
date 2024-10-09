const drops  = document.querySelectorAll('.drop')

drops.forEach(drop => {
    const select = drop.querySelector('.select')
    const caret = drop.querySelector('.caret')
    const menu = drop.querySelector('.menu')
    const options = drop.querySelector('.menu li')
    const selected = drop.querySelector('.selected')


    select.addEventListener('click',() => {
        select.classList.toggle('select-clicked')
        caret.classList.toggle('caret-rotate')
        menu.classList.toggle('menu-open')
    })

})


function shopbuds() {
    window.location.href = 'solobuds.html'
}

function shopsolo() {
    window.location.href = 'solo4.html'
}