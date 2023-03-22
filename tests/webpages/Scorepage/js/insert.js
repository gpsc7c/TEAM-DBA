let mysql = require('mysql');
let con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "12345",
    database: "javatpoint"
});
con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    let sql = "INSERT INTO employees (id, name, age, city) VALUES ('1', 'Ajeet Kumar', '27', 'Allahabad')";
    con.query(sql, function (err, result) {
        if (err) throw err;
        console.log("1 record inserted");
    });}