const selectCreate = document.querySelector('#select-table-create');
const selectUpdate = document.querySelector('#select-table-update');
const selectDelete = document.querySelector('#select-table-delete');
const selectRead = document.querySelector('#select-table-read');

selectCreate.addEventListener('change', (event) => {
    choice(event);
})
selectUpdate.addEventListener('change', (event) => {
    choice(event);
})
selectDelete.addEventListener('change', (event) => {
    choice(event);
})
selectRead.addEventListener('change', (event) => {
    choice(event);
})

function choice(param) {
    switch(param.target.value) {
        case 'books':
            prompt('books');
            break;
        case 'customers':
            prompt('cusmoters');
            break;
        case 'books_rentals':
            //
            break;
        case 'requests_to_suppliers':
            //
            break;
        case 'suppliers':
            //
            break;
        case 'libraries':
            //
            break;
    }
}