$(document).ready(() => {
    $('#create-user-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        const form = $(this);
        const formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            success: () => {
                // On success, close the modal
                $('#createUserModal').modal('hide');
                // Reset the form if needed
                form[0].reset();
                // Remove previous error classes and messages
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                location.reload();
            },
            error: (xhr) => {
                // On error, keep the modal open and display validation errors
                const errors = xhr.responseJSON.errors;

                // Remove previous error classes and messages
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Display new errors
                $.each(errors, (field, messages) => {
                    const inputField = $(`[name="${field}"]`);
                    inputField.addClass('is-invalid');
                    inputField.after(`<div class="invalid-feedback">${messages.join('<br>')}</div>`);
                });

                // Keep the modal open on error
                $('#createUserModal').modal('show');
            }
        });
    });
});
