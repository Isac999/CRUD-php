const selectCreate = document.querySelector('#select-table-create');
const selectUpdate = document.querySelector('#select-table-update');

selectCreate.addEventListener('change', (event) => {
    choice(event);
})
selectUpdate.addEventListener('change', (event) => {
    choice(event);
})
var createBooks = `
    <label for="id">Id: </label>
    <input type="number" name="id" placeholder="Type here" required> <br>
    <label for="name">Name: </label>
    <input type="text" name="name" placeholder="Type here"> <br>
    <label for="genre">Genre: </label>
    <input type="text" name="genre" placeholder="Type here"> <br>
    <label for="author">Author: </label>
    <input type="text" name="author" placeholder="Type here"> <br>
    <label for="library_id">Library id: </label>
    <input type="number" name="library_id" placeholder="Type here"> <br>
    <input type="submit" value="send">
`
var createCustomers = `
    <label for="id">Id: </label>
    <input type="number" name="id" placeholder="Type here" required> <br>
    <label for="name">Name: </label>
    <input type="text" name="name" placeholder="Type here"> <br>
    <label for="birth">Birth: </label>
    <input type="date" name="birth" placeholder="Type here"> <br>
    <label for="city">City: </label>
    <input type="text" name="city" placeholder="Type here"> <br>
    <input type="submit" value="send">
`
var createBooksRentals = `
    <label for="id">Id: </label>
    <input type="number" name="id" placeholder="Type here" required> <br>
    <label for="bookName">Book name: </label>
    <input type="text" name="bookName" placeholder="Type here"> <br>
    <label for="customerId">Customer id: </label>
    <input type="text" name="customerId" placeholder="Type here"> <br>
    <label for="date">Date: </label>
    <input type="date" name="date" placeholder="Type here"> <br>
    <input type="submit" value="send">

`
var createRequestsToSuppliers = `
    <label for="bookId">Book id: </label>
    <input type="number" name="bookId" placeholder="Type here"> <br>
    <label for="requestDate">Request date: </label>
    <input type="date" name="requestDate" placeholder="Type here"> <br>
    <label for="deliveryConfirmation">Delivery confirmation: </label>
    <input type="boolean" name="deliveryConfirmation" placeholder="Type here"> <br>
    <label for="corporateId">Corporate id: </label>
    <input type="checkbox" name="corporateId" placeholder="Type here"> <br>
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
    <input type="submit" value="change">
`

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
            break;
        case 'libraries':
            break;
        default:
            console.log('Valor Defualt');
            break;
    }
}