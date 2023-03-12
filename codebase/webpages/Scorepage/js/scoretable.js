function addNewRow(tableID) {

    var table = document.getElementById(tableID);

    var row = document.createElement('tr');
    var data = document.createElement('td');
    var tbx = document.createElement('input');
    tbx.setAttribute('type', 'text');

    data.appendChild(tbx);

    row.appendChild(data);
    table.appendChild(row);

}