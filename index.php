<?php
include "./asset/header.php";

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});


function validation($data) {
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);

    return $data;
}





?>

<div class="box">
    <div class="item">
        <div class="row">
            <?php my_form(); ?>
        </div>
    </div> <!-- Item 1 END -->

    <div class="item">
        <div class="row">
            <?php my_table(); ?>
        </div>
    </div>
</div>


<?php


function my_table() {

    $std = new Student;

?>
<a href="http://localhost/crud/">Back to Home</a>
<table class="border" style="margin-top: 20px;">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>

    <?php
        $i = 0;
        foreach ($std->GetData() as $data) {
            $i++;
        ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data['name']; ?></td>
        <td><?php echo $data['email']; ?></td>
        <td>
            <a href="index.php?action=update&id=<?php echo $data['id'] ?>">Edit</a> ||
            <a href="index.php?action=delete&id=<?php echo $data['id'] ?>"
                onclick="return confirm('Are you sure you want to delete data?')">Delete</a>
        </td>
    </tr>
    <?php

        }

        ?>

</table>
<?php

}


function my_form() {

    $std = new Student;

    if (isset($_POST['insert_submit'])) {
        $name = validation($_POST['name']);
        $email = validation($_POST['email']);

        $std->InsertData($name, $email);
        echo "<p>Data Insert Successfully..</p><br>";
    }

    if (isset($_POST['update_submit'])) {
        $id = $_POST['id'];
        $name = validation($_POST['name']);
        $email = validation($_POST['email']);

        $std->UpdateData($id, $name, $email);
        echo "<p>Data Update Successfully..</p><br>";
    }

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        $std->DeleteData($id);
    }


    if (isset($_GET['action']) && $_GET['action'] == 'update') {
        $id = $_GET['id'];
        $result = $std->getDataById($id);

    ?>

<form action="" method="POST">
    <h3>Update Form</h3>
    <table>
        <input type="hidden" value="<?php echo $result['id']; ?>" name="id">
        <tr>
            <td>Name</td>
            <td><input type="text" value="<?php echo $result['name']; ?>" name="name" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" value="<?php echo $result['email']; ?>" name="email" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="update_submit" value="SUBMIT"></td>
        </tr>
    </table>
</form>

<?php
    } else {
    ?>

<form action="" method="POST">
    <h3>Insert Form</h3>
    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="insert_submit" value="SUBMIT"></td>
        </tr>
    </table>
</form>

<?php
    }
}






include "./asset/footer.php";