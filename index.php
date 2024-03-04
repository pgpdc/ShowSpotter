<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="Styles/ShowTimes.css">
</head>
<body>
    <h1>ShowSpotter</h>
    <h2>Choose a theater: </h2>
    <div class="theater">
        <h1>
            <select id="theater-dropdown">
                <option value="Indiana">Indiana</option>
                <option value="testing">Testing</option>
                <option value="option3">Option 3</option>
                <option value="option4">Option 4</option>
            </select>
            <button type="button" id="myButton" onclick="changeTheater()">Submit</button>
            <script>
                var web = "ShowTimes.php?theater=indiana";
                //Default set to Indiana;
                document.getElementById('theater-dropdown').addEventListener('change', function() {
                    if (this.value == "Indiana") {
                        web = "ShowTimes.php?theater=indiana";
                    }
                    else if (this.value == "testing") {
                        web = "ShowTimes.php?theater=testing";
                    }
                    else {
                        alert('Waiting for database');
                    }
                });
                function changeTheater() {
                    <?php echo"window.location.href=web";
                    ?>
                };
            </script>
        </h1>

</body>
</html>