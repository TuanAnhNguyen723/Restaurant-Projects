// MENU
const divtoShow = 'nav .menu';
const divPopup = document.querySelector(divtoShow)
const divTrigger = document.querySelector('.m-trigger')

divTrigger.addEventListener('click', () => {
    setTimeout(() => {
        if (!divPopup.classList.contains('show')) {
            divPopup.classList.add('show');
            document.body.classList.add('menu-visible')
        }
    }, 250);
})

// automatically close by click
document.addEventListener('click', (e) => {
    const isClosest = e.target.closest(divtoShow);

    if(!isClosest && divPopup.classList.contains('show')) {
        divPopup.classList.remove('show')
        document.body.classList.remove('menu-visible');
    }
})