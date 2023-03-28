<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1 id="description">Welcome to the users panel</h1>

<!-- HTML form -->
<form method="GET" action="/admin/users" class="form-">
    <div class="row">
        <div class="col">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" class="form-control form-text">
        </div>

        <div class="col">
            <label for="filter">Filter:</label>
            <select id="filter" name="filter" class="form-control form-select">
                <option value="">-- Select Role --</option>
                <option value="3">Super-Admin</option>
                <option value="2">Admin</option>
                <option value="1">User</option>
            </select>
        </div>

        <div class="col">
            <label for="sort">Sort:</label>
            <select id="sort" name="sort" class="form-control form-select">
                <option value="">-- Select Column --</option>
                <option value="name ASC">Name (A-Z)</option>
                <option value="name DESC">Name (Z-A)</option>
                <option value="email ASC">Email (A-Z)</option>
                <option value="email DESC">Email (Z-A)</option>
                <option value="created_at ASC">Created (A-Z)</option>
                <option value="created_at DESC">Created (Z-A)</option>
            </select>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>


<table class="table table-striped" aria-describedby="description">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th scope="col">Role</th>
        <th scope="col">Email</th>
        <th scope="col">Created At</th>
        <th scope="col"><a href="/admin/users/create" class="btn btn-success" role="button">Create User</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($model as $user) {
        ?>

        <tr>
            <th scope="row"><?php echo $user->getId() ?></th>
            <td><?php echo $user->getName() ?></td>
            <td><?php echo $user->getRoleId() ?></td>
            <td><?php echo $user->getEmail() ?></td>
            <td><?php echo $user->getCreatedAt() ?></td>
            <td>
                <a href="/admin/users/update/<?php echo $user->getId() ?>" class="btn btn-warning">Update User</a>
                <a href="/admin/users/delete/<?php echo $user->getId() ?>" class="btn btn-danger">Delete User</a>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item <?= !isset($_GET['p']) || $_GET['p'] == 0 ? 'disabled' : '' ?>">
            <a class="page-link" href="/admin/users?p=<?= isset($_GET['p']) ? ($_GET['p'] - 1) : 0 ?>">Previous</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="/admin/users?p=<?= isset($_GET['p']) ? ($_GET['p'] + 1) : 1 ?>">Next</a>
        </li>
    </ul>
</nav>
