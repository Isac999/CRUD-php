const selectCreate = document.querySelector('#select-table-create');
const selectUpdate = document.querySelector('#select-table-update');
const formDelete = document.querySelector('#delete-form');

formDelete.addEventListener('submit', (event) => {
    let confirmation = confirm('Tem certeza que deseja remover do Banco de Dados?');
    if (!confirmation) {
        event.preventDefault();
    }
})
selectCreate.addEventListener('change', (event) => {
    choice(event);
})
selectUpdate.addEventListener('change', (event) => {
    choice(event);
})

function choice(param) {
    const fieldset = param.target.parentElement;
    const form = fieldset.querySelector('form');

    switch(param.target.value) {
        case 'books':
            if (param.target.id == 'select-table-create') {
                form.innerHTML = createBooks;
                break;
            } else {
                form.innerHTML = updateBooks;
                break;
            }
        case 'customers':
            if (param.target.id == 'select-table-create') {
                form.innerHTML = createCustomers;
                break;
            } else {
                form.innerHTML = updateCustomers;
                break;
            }
        case 'books_rentals':
            if (param.target.id == 'select-table-create') {
                form.innerHTML = createBooksRentals;
                break;
            } else {
                form.innerHTML = updateBooksRentals;
                break;
            }     
        case 'requests_to_suppliers':
            if (param.target.id === 'select-table-create') {
                form.innerHTML = createRequestsToSuppliers;
                break 
            } else {
                form.innerHTML = updateRequestsToSuppliers;
                break;
            }
        case 'suppliers':
            if (param.target.id === 'select-table-create') {
                form.innerHTML = createSuppliers;
                break 
            } else {
                form.innerHTML = updateSuppliers;
                break;
            }
        case 'libraries':
            if (param.target.id === 'select-table-create') {
                form.innerHTML = createLibrary;
                break 
            } else {
                form.innerHTML = updateLibrary;
                break;
            }
        default:
            confirm('Default');
            break;
    }
}
var createBooks = `
    <label for="name">Name: </label>
    <input type="text" name="name" placeholder="Type here"> <br>
    <label for="genre">Genre: </label>
    <input type="text" name="genre" placeholder="Type here"> <br>
    <label for="author">Author: </label>
    <input type="text" name="author" placeholder="Type here"> <br>
    <label for="library_id">Library id: </label>
    <input type="number" name="library_id" placeholder="Type here"> <br>
    <input type="text" name="option" value="books" class="option-class" hidden>
    <input type="submit" value="send">
`
var createCustomers = `
    <label for="name">Name: </label>
    <input type="text" name="name" placeholder="Type here"> <br>
    <label for="birth">Birth: </label>
    <input type="date" name="birth" placeholder="Type here"> <br>
    <label for="city">City: </label>
    <input type="text" name="city" placeholder="Type here"> <br>
    <input type="text" name="option" value="customers" class="option-class" hidden>
    <input type="submit" value="send">
`
var createBooksRentals = `
    <label for="bookId">Book id: </label>
    <input type="number" name="bookId" placeholder="Type here"> <br>
    <label for="customerId">Customer id: </label>
    <input type="text" name="customerId" placeholder="Type here"> <br>
    <label for="date">Date: </label>
    <input type="date" name="date" placeholder="Type here"> <br>
    <input type="text" name="option" value="books_rentals" class="option-class" hidden>
    <input type="submit" value="send">

`
var createRequestsToSuppliers = `
    <label for="bookId">Book id: </label>
    <input type="number" name="bookId" placeholder="Type here"> <br>
    <label for="requestDate">Request date: </label>
    <input type="date" name="requestDate" placeholder="Type here"> <br>
    <label for="deliveryConfirmation">Delivery confirmation: </label>
    <input type="checkbox" name="deliveryConfirmation"> <br>
    <label for="corporateId">Corporate id: </label>
    <input type="number" name="corporateId" placeholder="Type here"> <br>
    <input type="text" name="option" value="requests_to_suppliers" class="option-class" hidden>
    <input type="submit" value="send">
`
var createSuppliers = `
    <label for="corporateName">Corporate name: </label>
    <input type="text" name="corporateName" placeholder="Type here"> <br>
    <label for="localization">Localization: </label>
    <input type="text" name="localization" placeholder="Type here"> <br>
    <input type="text" name="option" value="suppliers" class="option-class" hidden>
    <input type="submit" value="send">
`
var createLibrary = `
    <label for="localization">Localization: </label>
    <input type="text" name="localization" placeholder="Type here"> <br>
    <input type="text" name="option" value="library" class="option-class" hidden>
    <input type="submit" value="send">
`
var updateBooks = `
    <div>
        <label for="id-target">Id: </label>
        <input type="number" name="id-target" placeholder="Id target" required> <br>
        <label for="select-opt"> Attribute you want to change: </label>
        <select name="select-opt" id="select-css">
            <option value="name">Name</option>
            <option value="genre">Genre</option>
            <option value="author">Author</option>
            <option value="library_id">Library id</option>
        </select> <br>
        <label for="new-value" required>Enter the new value: </label> 
        <input type="text" name="new-value" placeholder="new attribute value"> <br>
    </div>
    <input type="text" name="option" value="books" class="option-class" hidden>
    <input type="submit" value="change">
`
var updateCustomers = `
    <div>
        <label for="id-target">Client id: </label>
        <input type="number" name="id-target" placeholder="Id target" required> <br>
        <label for="select-opt"> Attribute you want to change: </label>
        <select name="select-opt" id="select-css">
            <option value="name">Name</option>
            <option value="birth">Birth</option>
            <option value="city">City</option>
        </select> <br>
        <label for="new-value" required>Enter the new value: </label> 
        <input type="text" name="new-value" placeholder="new attribute value"> <br>
    </div>
    <input type="text" name="option" value="customers" class="option-class" hidden>
    <input type="submit" value="change">
`
var updateBooksRentals = `
    <div>
        <label for="id-target">Id: </label>
        <input type="number" name="id-target" placeholder="Id target" required> <br>
        <label for="select-opt"> Attribute you want to change: </label>
        <select name="select-opt" id="select-css">
            <option value="bookName">Book name</option>
            <option value="bookId">Book id</option>
            <option value="customerId">Customer id</option>
            <option value="date">Date</option>
        </select> <br>
        <label for="new-value" required>Enter the new value: </label> 
        <input type="text" name="new-value" placeholder="new attribute value"> <br>
    </div>
    <input type="text" name="option" value="booksRentals" class="option-class" hidden>
    <input type="submit" value="change">
`
var updateRequestsToSuppliers = `
    <div>
        <label for="id-target">Id request: </label>
        <input type="number" name="id-target" placeholder="Id target" required> <br>
        <label for="select-opt"> Attribute you want to change: </label>
        <select name="select-opt" id="select-css">
            <option value="bookId">Book id</option>
            <option value="requestDate">Request date</option>
            <option value="deliveryConfirmation">Delivery confirmation</option>
            <option value="corporateId">Corporate Id</option>
        </select> <br>
        <label for="new-value" required>Enter the new value: </label> 
        <input type="text" name="new-value" placeholder="new attribute value"> <br>
    </div>
    <input type="text" name="option" value="requestsToSuppliers" class="option-class" hidden>
    <input type="submit" value="change">
`
var updateSuppliers = `
    <div>
        <label for="id-target">Id supplier: </label>
        <input type="number" name="id-target" placeholder="Id target" required> <br>
        <label for="select-opt"> Attribute you want to change: </label>
        <select name="select-opt" id="select-css">
            <option value="corporateName">Corporate name</option>
            <option value="localization">Localization</option>
        </select> <br>
        <label for="new-value" required>Enter the new value: </label> 
        <input type="text" name="new-value" placeholder="new attribute value"> <br>
    </div>
    <input type="text" name="option" value="suppliers" class="option-class" hidden>
    <input type="submit" value="change">
`
var updateLibrary = `
    <div>
        <label for="id-target">Library id: </label>
        <input type="number" name="id-target" placeholder="Id target" required> <br>
        <label for="select-opt"> Attribute you want to change: </label>
        <select name="select-opt" id="select-css">
            <option value="localization">Localization</option>
        </select> <br>
        <label for="new-value" required>Enter the new value: </label> 
        <input type="text" name="new-value" placeholder="new attribute value"> <br>
    </div>
    <input type="text" name="option" value="library" class="option-class" hidden>
    <input type="submit" value="change">
`