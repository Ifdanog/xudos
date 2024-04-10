var storeModal = document.getElementById('storesForm');
var modalBtn = document.getElementById('addStores');
var closeBtns = document.getElementsByClassName('closeBtn');

modalBtn.addEventListener('click', function() {
    openModal(storeModal);
});

for (var i = 0; i < closeBtns.length; i++) {
    closeBtns[i].addEventListener('click', function() {
        closeModal(storeModal);
    });
}

window.addEventListener('click', function(e) {
    if (e.target === storeModal) {
        closeModal(storeModal);
    }
});

var cashierModal = document.getElementById('cashierForm');
var cashierModalBtn = document.getElementById('addCashier');

cashierModalBtn.addEventListener('click', function() {
    openModal(cashierModal);
});

cashierCloseBtn.addEventListener('click', function() {
    closeModal(cashierModal);
});

window.addEventListener('click', function(e) {
    if (e.target === cashierModal) {
        closeModal(cashierModal);
    }
});


function openModal(modal) {
    modal.style.display = 'block';
}

function closeModal(modal) {
    modal.style.display = 'none';
}

