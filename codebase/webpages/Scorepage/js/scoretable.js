const totalRows = 100 //Constant to ensure knowledge of what the iterator is attempting to reach
function addNewRow(tableID, rank, name, points, frac) {

    let table = document.getElementById(tableID);           //gets the table by name, only one table in this case
    let row = document.createElement('tr');         //creates a new table row
    let dataRank = document.createElement('td');    //creates a new table division for player rank
    let dataName = document.createElement('td');    //creates a new table division for player name
    let dataPoints = document.createElement('td');  //creates a new table division for player score (or time)
    let dataFrac = document.createElement('td');    //creates a new table division for generated fraction str

    //This sequence sets the rank, name, and points value to the entries from the database
    dataRank.innerText = rank;
    dataName.innerText = name;
    dataPoints.innerText = points;
    dataFrac.innerText = frac;

    //this sequence adds the new row to the table, appending each part of the data as a column
    //and then the row into the table
    row.appendChild(dataRank);
    row.appendChild(dataName);
    row.appendChild(dataPoints);
    row.appendChild(dataFrac);
    table.appendChild(row);

}
//auto-fires the row function on page load
window.onload = function() {
    rowPopulator("scoreboard");
}
//pulls the information from the database and iterates over it
//the values are currently placeholder
function rowPopulator(tableID) {
    for(let i = 0; i < totalRows; i++){
        let rank = i;
        let name = "ALAN";
        let points = i * 1000;
        let frac = 0.0102
        addNewRow(tableID, rank, name, points, frac);
    }
}