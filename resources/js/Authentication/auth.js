export function setupNavigationConfirmation() {
    window.addEventListener('beforeunload', (event) => {
        event.preventDefault();
        event.returnValue = ''; 
        if (confirm("Bạn có chắc chắn muốn rời khỏi trang này không?")) {
            window.location.href = '/login'; 
        }
    });
}
