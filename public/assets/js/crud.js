
// Function to open the modal for adding or editing
function openModal(action, employeeId) {
    const modal = document.getElementById('exampleModal');
    const form = document.getElementById('employeeForm');

    if (action === 'add') {
        form.action = '<?= base_url('dashboard / store') ?>';
        modal.querySelector('.modal-title').innerText = 'Add Employee';
    } else if (action === 'edit') {
        form.action = '<?= base_url('dashboard / update') ?>/' + employeeId;
        modal.querySelector('.modal-title').innerText = 'Edit Employee';
        // You can populate the form fields with existing data if needed
        // Here, you can use AJAX to fetch employee data and populate the form fields
    }

    modal.show();
}

