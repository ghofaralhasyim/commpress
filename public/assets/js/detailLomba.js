const univ = document.getElementById('univ');
const nim = document.getElementById('nimInput');
univ.addEventListener('input', function (evt) {
    if (this.value.toLowerCase() == 'universitas multimedia nusantara') {
        nim.classList.toggle('d-none');
    } else {
        nim.classList.add('d-none');
    }
});