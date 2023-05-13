<?php
// Include config file
require_once "config.php";

// Check if form was submitted
if (isset($_GET['doc_url'])) {
    // Get form data
    $doc = $_GET["doc_url"];
    $date = "2023-05-03T21:09";

    // Insert data into database
    $sql = "INSERT INTO archive_imp (id_imp, id_user, action_type, doc, date) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        $action_type = 'tirage';
        $id_doc = 0;
        $id_user = 1;

        mysqli_stmt_bind_param($stmt, "iisss", $id_doc, $id_user, $action_type, $doc, $date);
        if (mysqli_stmt_execute($stmt)) {
            echo "Data inserted successfully";
            header("location: admin.php");
            exit;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Data</title>
</head>
<body>
    <h2>Insert Data into archive_imp Table</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Document Name:</label>
        <input type="text" name="doc" required><br><br>
        <label>Date:</label>
        <input type="datetime-local" name="date" required><br><br>
        <input type="submit" value="Insert Data">
        <button onclick="downloadFile()">
            submit
        </button>
        
    </form>

    <script>
                function downloadFile(url) {
                    // const anchor = document.createElement('a');
                    // anchor.setAttribute('href', url);
                    // anchor.setAttribute('download', '');
                    // anchor.style.display = 'none';
                    // document.body.appendChild(anchor);
                    // anchor.click();
                    // document.body.removeChild(anchor);
                    // Set the URL parameter to the document URL
                    const newUrl = window.location.href.split('?')[0] + `?doc_url=dooc___name`;
                    window.location.href = newUrl;
                }
            </script>

</body>
</html>