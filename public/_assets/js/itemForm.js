const formEntry = document.querySelector('.form-entry');
const keyEntry = formEntry.querySelector('.entry');

const form = document.querySelector('.form');
const editBtn = document.querySelector('.edit');
const check = document.querySelector('.data');
const checkboxs = document.querySelectorAll('.checkbox');
const hapusBtn = document.getElementById('hapus');
const formCari = document.querySelector('.form-cari');
const cariBtn = document.getElementById('cari');
const carikey = document.getElementById('keyword-cari');

keyEntry.addEventListener('change', ()=> {
    formEntry.submit()
})


var array = []

checkboxs.forEach((ck, i) => {
    ck.addEventListener('click', () => {
        array.push(ck.value)
        check.value = array
    })
});

editBtn.addEventListener('click', function() {
    form.action = "/barang/edit";
});

hapusBtn.addEventListener('click', function() {
    form.method = "POST";
    form.action = "/barang/hapus";
});


cariBtn.addEventListener('click', function() {
    form.action = "/barang/cari";
});

carikey.addEventListener('keyup', function() {
   const xhr = new XMLHttpRequest();

   xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.responseText)
    }
   };

   xhr.open('get', 'ajax/cari.php?keyword=' + carikey.value);
   xhr.send();
});

