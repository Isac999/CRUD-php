function change(element) {
    const parent = element.parentElement;
    const childrenTarget = parent.childNodes;
    childrenTarget.forEach((item) => {
        let content = item.innerText;
        if (item.className != 'no-replace') {
            item.innerHTML = "<input type='text' class='form-control' value='"+content+"'>";
        } else {
            element.firstChild.setAttribute('class', 'btn btn-warning');
            element.firstChild.innerText = 'Change';
        }
    })
}