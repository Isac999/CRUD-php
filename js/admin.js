let url_atual = window.location.search.split('&')[0];
if (url_atual) {
    let targetName = url_atual.split('=')[1];
    const targetEl = document.querySelector('#'+targetName);
    targetEl.style.backgroundColor = 'rgb(8 8 8 / 39%)';
    targetEl.style.borderRadius = '3px';
} else {
    const targetEl = document.querySelector('#books');
    targetEl.style.backgroundColor = 'rgb(8 8 8 / 39%)';
    targetEl.style.borderRadius = '3px';
}

function change(element) {
    const parent = element.parentElement;
    const childrenTarget = parent.childNodes;
    childrenTarget.forEach((item) => {
        let content = item.innerText;
        if (item.className != 'no-replace') {
            item.innerHTML = "<input type='text' class='form-control' placeholder='Type here' value='"+content+"'>";
        } else {
            const newBtnWarning = element.firstChild;
            newBtnWarning.setAttribute('class', 'btn btn-warning');
            newBtnWarning.setAttribute('onclick', 'undoChange(this)');
            newBtnWarning.innerText = 'Change';
        }
    })
}

function del(id, parente) {
    let confirmation = confirm("Tem certeza que deseja excluir o registro: " +id +" ?");
    if (confirmation) {
        const tr = parente.parentElement;
        tr.remove();

        const body = {
            "id": id
        }
        let request = new XMLHttpRequest();
        request.open("POST", "http://127.0.0.1/CRUD/admin/delete.php", true);
        request.setRequestHeader("Content-Type", "application/json");
        request.send(JSON.stringify(body)); 
    
        request.onload = function() {
            console.log(this.responseText);
        }
        return request.responseText;
    }
}

function createBtn(len) {
    const scrollingElement = (document.scrollingElement || document.body);
    scrollingElement.scrollTop = scrollingElement.scrollHeight;

    const tbody = document.querySelector('tbody');
    const tr = document.createElement("tr");
    tbody.appendChild(tr);
    
    const last = tbody.lastChild; //tr
    for (let cont = 0; cont < len; cont++) {
        if (cont === 0) {
            let lastId = document.querySelectorAll('tbody tr td:first-of-type');
            lastId = lastId[lastId.length - 1];
            lastId = parseInt(lastId.innerText);

            let td = document.createElement("td");
            let input = document.createElement("input");
            input.setAttribute('type', 'text');
            input.setAttribute('class', 'form-control');
            input.setAttribute('placeholder', 'Type here');
            input.setAttribute('value', lastId + 1);
            last.appendChild(td);
            last.lastChild.appendChild(input);
        } else {
            let td = document.createElement("td");
            let input = document.createElement("input");
            input.setAttribute('type', 'text');
            input.setAttribute('class', 'form-control');
            input.setAttribute('placeholder', 'Type here')
            last.appendChild(td);
            last.lastChild.appendChild(input);
        }
    }
    let td = document.createElement("td");
    td.setAttribute('class', 'no-replace');
    let button = document.createElement("button");
    button.setAttribute('class', 'btn btn-primary');
    button.setAttribute('type','submit');
    button.setAttribute('onclick', 'undoBtn(this.parentElement)');
    button.innerText = 'Create';
    last.appendChild(td);
    last.lastChild.appendChild(button);
}

function undoBtn(parent) {
    let listValues = []
    const masterNode = parent.parentElement;
    const arrayNodes = masterNode.childNodes;
    arrayNodes.forEach((item) => {
        if (item.lastChild.className != "btn btn-primary") {
            let value = item.lastChild.value;
            listValues.push(value);
            item.innerHTML = value;
        } else {
            item.lastChild.className = "btn btn-info";
            item.lastChild.innerText = "Edit";
            item.lastChild.setAttribute('onclick', 'change(this.parentElement)');
            const newDelete = document.createElement('button');
            newDelete.setAttribute('class', 'btn btn-danger ml-1');
            newDelete.setAttribute('onclick', 'del(this.id, this.parentElement)');
            newDelete.innerText = "Delete";
            item.appendChild(newDelete);
        }
    })
    const tableName = document.querySelector('tbody tr td:last-of-type button').id;
    createData(tableName, listValues);
}

function undoChange(element) {
    let listValues = [];
    element.setAttribute('class', 'btn btn-info');
    element.setAttribute('onclick', 'change(this.parentElement)');
    element.innerText = 'Edit';
    const parentTd = element.parentElement;
    const parentTr = parentTd.parentElement;
    const childrens = parentTr.childNodes;
    childrens.forEach((item) => {
        let inputTarget = item.firstChild.value;
        if (item.className != 'no-replace') {
            listValues.push(inputTarget);
            item.innerHTML = inputTarget;
        }
    })
    update(element.id, listValues);
}

function update(tableName, listValues) {
    const body = { 
        "table" : tableName, 
        "arrayValues" : listValues
    }
    let request = new XMLHttpRequest();
    request.open("POST", "http://127.0.0.1/CRUD/admin/crud/Update.php", true);
    request.setRequestHeader("Content-Type", "application/json");
    request.send(JSON.stringify(body)); 

    request.onload = function() {
        console.log(this.responseText);
    }
    return request.responseText;
}

function createData(tableName, listValues) {
    const body = { 
        "table" : tableName, 
        "arrayValues" : listValues
    }
    let request = new XMLHttpRequest();
    request.open("POST", "http://127.0.0.1/CRUD/admin/crud/Insert.php", true);
    request.setRequestHeader("Content-Type", "application/json");
    request.send(JSON.stringify(body)); 

    request.onload = function() {
        console.log(this.responseText);
    }
    return request.responseText;
}