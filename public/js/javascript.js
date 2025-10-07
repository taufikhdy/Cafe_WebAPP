function showPassword() {
    const input = document.getElementById('password');
    var icon = document.getElementById('eye');
    if (input.type === 'password'){
        input.type = 'text';
        icon.classList.replace('ri-eye-off-line', 'ri-eye-line');
    } else {
        input.type = 'password';
        icon.classList.replace('ri-eye-line', 'ri-eye-off-line');
    }
};

const btnSidebar = document.getElementById('btnside');
const btnClose = document.getElementById('btn-close');
const sidebar = document.getElementById('sidebar');

btnSidebar.addEventListener('click', () => {
    sidebar.classList.add('on');
});

btnClose.addEventListener('click', () => {
    sidebar.classList.remove('on');
});

const options = document.querySelectorAll('.option');

options.forEach(option => {
    option.addEventListener('click', () => {
        // ambil button dalam form yang sama
        const form = option.closest('form');
        const btnCheck = form.querySelector('.option-btn');
        btnCheck.classList.add('active');
    });
});

const btnMenu = document.getElementById('menuSwitch');
const btnCate = document.getElementById('cateSwitch');
const formMenu = document.getElementById('menuForm');
const formCate = document.getElementById('cateForm');

btnMenu.addEventListener('click', ()=> {
    formMenu.classList.toggle('on');
    formCate.classList.toggle('on');
})

btnCate.addEventListener('click', ()=> {
    formMenu.classList.toggle('on');
    formCate.classList.toggle('on');
})


