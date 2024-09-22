document.addEventListener('DOMContentLoaded', function () {
    // Variables
    let roleChanges = {};

    // Mostrar el botón de "Guardar cambios" al cambiar rol
    document.querySelectorAll('.role-select').forEach(select => {
        select.addEventListener('change', function () {
            const userId = this.getAttribute('data-id');
            const newRole = this.value;
            roleChanges[userId] = newRole;
            document.getElementById('saveRoleChanges').style.display = 'block';
        });
    });

    // Guardar los cambios de rol
    document.getElementById('saveRoleChanges').addEventListener('click', function () {
        for (let userId in roleChanges) {
            fetch(`admin/usuarios/${userId}/cambiar-rol`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ rol: roleChanges[userId] })
            })
            .then(response => response.json())
            .then(data => {
                alert('Rol actualizado correctamente.');
                document.getElementById('saveRoleChanges').style.display = 'none';
                location.reload();  // Recargar la página para ver los cambios
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Función para abrir modal de edición con datos del usuario
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const row = document.querySelector(`tr[data-id="${userId}"]`);
            document.getElementById('editUserId').value = userId;
            document.getElementById('editName').value = row.children[0].textContent.trim();
            document.getElementById('editEmail').value = row.children[1].textContent.trim();
            document.getElementById('editTelefono').value = row.children[2].textContent.trim();
            document.getElementById('editRegion').value = row.children[3].textContent.trim();
        });
    });

    // Guardar los cambios del modal de edición
    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const userId = document.getElementById('editUserId').value;
        const formData = new FormData(this);

        fetch(`/usuarios/${userId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert('Usuario actualizado correctamente.');
            location.reload();  // Recargar la página para ver los cambios
        })
        .catch(error => console.error('Error:', error));
    });

    // Función para búsqueda de usuarios
    document.getElementById('searchUser').addEventListener('keyup', function () {
        const searchValue = this.value.toLowerCase();
        document.querySelectorAll('#userTable tr').forEach(row => {
            const name = row.children[0].textContent.toLowerCase();
            const email = row.children[1].textContent.toLowerCase();
            if (name.includes(searchValue) || email.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Función para resetear búsqueda
    document.getElementById('btnResetSearch').addEventListener('click', function () {
        document.getElementById('searchUser').value = '';
        document.querySelectorAll('#userTable tr').forEach(row => {
            row.style.display = '';
        });
    });
});
