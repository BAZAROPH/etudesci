const select = document.querySelector('.search-select');
select.addEventListener('change', ()=>{
    window.location.href = `${select.getAttribute('link')}/${select.value}`;
})

const searchInput = document.querySelector('.search-input');
const searchButton = document.querySelector('.search-button');

searchButton.addEventListener('click', ()=>{
    window.location.href = `${select.getAttribute('link')}/${searchInput.value}`;
})
