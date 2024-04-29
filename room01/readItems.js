var mysql = import('mysql');

    var con = mysql.createConnection({
                host: "localhost",
                user: "root",
                password: "",
                database: "indiana"
    });

con.connect(function(err) {
  if (err) throw err;
  //Select all customers and return the result object:
  con.query("SELECT * FROM ordereditems", function (err, result, fields) {
    if (err) throw err;
    console.log(result);
  });
});