export function setupNavigationConfirmation() {
    let isFormSubmitting = false;

    window.addEventListener('beforeunload', function (e) {
        if (!isFormSubmitting) {
            const confirmationMessage = 'Bạn có chắc chắn muốn rời khỏi trang này? Thay đổi của bạn sẽ không được lưu.';
            e.returnValue = confirmationMessage; 
            return confirmationMessage;
        }
    });
    
    const forms = document.querySelectorAll('form');
    forms.forEach((form) => {
        form.addEventListener('submit', function () {
            isFormSubmitting = true;
        });
    });
}

