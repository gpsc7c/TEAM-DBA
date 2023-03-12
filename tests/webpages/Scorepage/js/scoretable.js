const totalRows = 100
function addNewRow(tableID, rank, name, points) {

    let table = document.getElementById(tableID);

    let row = document.createElement('tr');
    let dataRank = document.createElement('td');
    let dataName = document.createElement('td');
    let dataPoints = document.createElement('td');

    dataRank.innerText = rank;
    dataName.innerText = name;
    dataPoints.innerText = points;

    row.appendChild(dataRank);
    row.appendChild(dataName);
    row.appendChild(dataPoints);
    table.appendChild(row);

}
window.onload = function() {
    rowPopulator("scoreboard");
}
function rowPopulator(tableID) {
    for(let i = 0; i < 100; i++){
        let rank = i;
        let name = "ALAN";
        let points = i * 1000;
        addNewRow(tableID, rank, name, points);
    }
}