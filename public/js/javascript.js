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


function loading() {
    const loading = document.getElementById('loader');
    loading.style.display = 'flex';
}

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

const editBtn = document.querySelectorAll('.editForm');

editBtn.forEach(editBtn => {
    editBtn.addEventListener('click', () => {
        const row = editBtn.closest('tr');
        const editConfirm = row.querySelector('.editConfirm');
        if(editConfirm){
            editConfirm.style.display = 'inline';
        }

        editBtn.style.display = 'none';

        const nilai = row.querySelectorAll('.edit-input');

        nilai.forEach(input => {
            input.removeAttribute('disabled');
        });
    });
});

const editKategori = document.querySelectorAll('.editKategori');

editKategori.forEach(editKategori => {
    editKategori.addEventListener('click', () => {
        const form = editKategori.closest('form');
        const editConfirm = form.querySelector('.editConfirm');
        if(editConfirm){
            editConfirm.style.display = 'inline';
        }

        editKategori.style.display = 'none';

        const nilai = form.querySelectorAll('.edit-input');

        nilai.forEach(input => {
            input.removeAttribute('disabled');
        });
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


