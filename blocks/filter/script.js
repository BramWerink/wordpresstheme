document.querySelector('.filter').addEventListener('click', function(e) {
    if (e.target.classList.contains('item')) {
        console.log('clicked');
    }
});
