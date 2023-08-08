<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <script src="https://kit.fontawesome.com/ed04ec62b5.js"></script>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/dashboard.css">

</head>

<body>
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Super7tech</a>
        <p class="col-md-3 col-lg-2 me-0 px-3 fs-6 text-white my-auto float-right"> <?php echo $userName ?></p>

    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Dashboard
                                </a>
                            </li>

                        </ul>

                        <hr class="my-3">

                        <ul class="nav">

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="/logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Sign out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="height: 100vh;">
                <div class="card mt-4">
                    <div class="card-title">
                        <?php include(APPPATH . 'Views/errors/message/_notifications.php'); ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Position</th>
                                        <th>Create Date</th>
                                        <th>
                                            <button type="button" class="btn btn-success btn-sm" onclick="openModal('add', '')">Add</button>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employees as $employee) : ?>
                                        <tr>
                                            <th scope="row"><?= esc($employee['id']) ?></th>
                                            <td><?= esc($employee['first_name']) ?></td>
                                            <td><?= esc($employee['last_name']) ?></td>
                                            <td><?= esc($employee['position']) ?></td>
                                            <td><?= esc($employee['create_date']) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="openModal('edit', <?= $employee['id'] ?>)">Edit</button>
                                                <a href="<?= base_url('dashboard/delete/' . $employee['id']) ?>" class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <form id="employeeForm" method="post" action="">

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-material">
                                        <div class="form-group form-default form-static-label">
                                            <label class="float-label">First name</label>
                                            <input type="text" name="first_name" class="form-control" placeholder="Enter First name">

                                        </div>
                                        <div class="form-group form-default form-static-label">
                                            <label class="float-label">Last name</label>
                                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last name">

                                        </div>
                                        <?php if ($userRole === 'Manager') : ?>
                                            <div class="form-group form-default form-static-label">
                                                <label class="float-label">Position</label>
                                                <select name="position" class="form-control">
                                                    <option value="">Select Position</option>
                                                    <!-- <option value="Manager">Manager</option> -->
                                                    <option value="Web Developer">Web Developer</option>
                                                    <option value="Web Designer">Web Designer</option>
                                                </select>
                                            </div>
                                        <?php elseif ($userRole === 'Web Developer') : ?>
                                            <input type="hidden" name="position" value="Web Developer">
                                        <?php elseif ($userRole === 'Web Designer') : ?>
                                            <input type="hidden" name="position" value="Web Designer">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function openModal(action, employeeId) {
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            const form = document.getElementById('employeeForm');

            if (action === 'add') {
                form.action = '<?= base_url('dashboard/store') ?>';
                modal._element.querySelector('.modal-title').innerText = 'Add Employee';
            } else if (action === 'edit') {
                form.action = '<?= base_url('dashboard/update') ?>/' + employeeId;
                modal._element.querySelector('.modal-title').innerText = 'Edit Employee';
                fetch('<?= base_url('dashboard/get_employee') ?>/' + employeeId)
                    .then(response => response.json())
                    .then(data => {
                        form.querySelector('[name="first_name"]').value = data.first_name;
                        form.querySelector('[name="last_name"]').value = data.last_name;
                        form.querySelector('[name="position"]').value = data.position;
                    })
                    .catch(error => console.error('Error fetching employee data:', error));
            }
            modal.show();
        }
    </script>


</body>

</html>