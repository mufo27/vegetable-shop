<?php

require_once('../../config/condb.inc.php');
require_once('../../config/util.php');

$db = new Database();
$util = new Util();

if (isset($_POST['add'])) {

    $phone      =   $util->testInput($_POST['phone']);
    $user       =   $util->testInput($_POST['user']);
    $pass       =   $util->testInput($_POST['pass']);
    $status     =   $util->testInput($_POST['status']);
    $pkname     =   $util->testInput($_POST['pkname']);
    $fname      =   $util->testInput($_POST['fname']);
    $lname      =   $util->testInput($_POST['lname']);
    $email      =   $util->testInput($_POST['email']);
    $address    =   $util->testInput($_POST['address']);

    if ($db->insert($phone, $user, $pass, $status, $pkname, $fname, $lname, $email, $address)) {

        echo $util->showMessage("success", "User inserted successfully!");
    } else {

        echo $util->showMessage("danger", "Something went wrong!");
    }
}

if (isset($_GET['read'])) {

    $users = $db->read();

    $output = '';

    if ($users) {

        foreach ($users as $row) {

            $output .= '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['pkname'] . '</td>
                            <td>' . $row['fname'] . '</td>
                            <td>' . $row['lname'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['address'] . '</td>
                            <td>' . $row['user'] . '</td>
                            <td>' . $row['pass'] . '</td>
                            <td>
                                <a href="#" id="' . $row['id'] . '" class="btn btn-success btn-sm rounded-pull py-0 editlink" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</a>
                                <a href="#" id="' . $row['id'] . '" class="btn btn-danger btn-sm rounded-pull py-0 deletelink">Delete</a>
                            </td>
                </tr>';
        }

        echo $output;
    } else {

        echo '<tr>
                <td colspan="6">No users found in the Database</td>
            </tr>';
    }
}

if (isset($_GET['edit'])) {

    $id = $_GET['id'];

    $user = $db->readOne($id);

    echo json_encode($user);
}

if (isset($_POST['update'])) {

    $id         =   $util->testInput($_POST['id']);
    $phone      =   $util->testInput($_POST['phone']);
    $user       =   $util->testInput($_POST['user']);
    $pass       =   $util->testInput($_POST['pass']);
    $status     =   $util->testInput($_POST['status']);
    $pkname     =   $util->testInput($_POST['pkname']);
    $fname      =   $util->testInput($_POST['fname']);
    $lname      =   $util->testInput($_POST['lname']);
    $email      =   $util->testInput($_POST['email']);
    $address    =   $util->testInput($_POST['address']);

    if ($db->update($id, $phone, $user, $pass, $status, $pkname, $fname, $lname, $email, $address)) {

        echo $util->showMessage("success", "User updated successfully!");
    } else {

        echo $util->showMessage("danger", "Something went wrong!");
    }
}

if (isset($_GET['delete'])) {

    $id = $_GET['id'];

    if ($db->delete($id)) {

        echo $util->showMessage("info", "User deleted successfully!");
    } else {

        echo $util->showMessage("danger", "Something went wrong!");
    }
}
