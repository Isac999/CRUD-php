function change(element) {
    const parent = element.parentElement;
    const childrenTarget = parent.childNodes;
    childrenTarget.forEach((item) => {
        let content = item.innerText;
        if (item.className != 'no-replace') {
            item.innerHTML = "<input type='text' class='form-control' value='"+content+"'>";
        } else {
            const newBtnWarning = element.firstChild;
            newBtnWarning.setAttribute('class', 'btn btn-warning');
            newBtnWarning.setAttribute('onclick', 'undoChange(this)');
            newBtnWarning.innerText = 'Change';
        }
    })
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
    request.open("POST", "http://127.0.0.1/CRUD/admin/update.php", true);
    request.setRequestHeader("Content-Type", "application/json");
    request.send(JSON.stringify(body)); 

    request.onload = function() {
        console.log(this.responseText);
    }
    return request.responseText;
}