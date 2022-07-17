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
    element.setAttribute('class', 'btn btn-info');
    element.setAttribute('onclick', 'change(this.parentElement)');
    element.innerText = 'Edit';
}