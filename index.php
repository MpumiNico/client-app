<?php
//connect database
$pdo = new
PDO('mysql:host=localhost;dbname=clients','','');
$pdo->setAtrribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//new client creation
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $client_code =  $_POST['client_code'];
    $linked_contacts =  $_POST['linked_contacts'];

    if(!empty($name) && !empty($client_code)) {
        $stmt = $pdo->prepare('INSERT INTO clients(name,client_code,linked_contacts) VALUES (?,?,?)');
        $stmt->execute([$name,$client_code,$linked_contacts]);
    }
}

//fetch clients ordered by name
$stmt = $pdo->query('SELECT * FROM clients ORDER BY name ASC');
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Client Management</title>
</head>
<body>
<div class="container mt-5">
    <h1>Client</h1>
    <!--New client form-->
    <form method = "POST" class = "mb-4">
        <div class = "mb-3">
            <label for = "name" class = "form-label">Client Name</label>
            <input type = "text" class = "form-control" id = "name" name = "name" required>
</div>
<div class = "mb-3">
<label for = "client_code" class = "form-label">Client Code</label>
            <input type = "text" class = "form-control" id = "client_code" name = "client_code" required>
</div>
<div class = "mb-3">
<label for = "linked_contacts" class = "form-label">No of Linked Contacts</label>
            <input type = "number" class = "form-control" id = "linked_contacts" name = "linked_contacts" required>
</div>

<button type = "submit" class = "btn btn-primary">Add Client</button>
</form>

<!--List Of Client-->
<?php if(count($clients) > 0): ?>
    <table class = "table table-striped">
        <thread>
            <tr>
                <th scope = "col" class = "text-start">Name</th>
                <th scope = "col" class = "text-start">Client Code</th>
                <th scope = "col" class = "text-start">No. of Linked Contacts</th>
</tr>
</thread>
<tbody>
    <?php foreach ($clients as $client):?>
        <tr>
            <td class = "text-start"><?=htmlspecialchars($client['name']);?></td>
            <td class = "text-start"><?=htmlspecialchars($client['client_code']);?></td>
            <td class = "text-start"><?=htmlspecialchars($client['linked_contacts']);?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <?php else:?> 
        <p>No client(s) found.</p>
        <?php endif; ?>
    </div>
</body>
</html>