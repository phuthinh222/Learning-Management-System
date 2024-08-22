import "tinymce";

document.addEventListener("DOMContentLoaded", () => {
    tinymce.init({
        selector: "textarea#editor_area",
        plugins: "lists link image fullscreen table help",
        toolbar:
            "undo redo | blocks | " +
            "bold italic backcolor | alignleft aligncenter " +
            "alignright alignjustify | bullist numlist outdent indent | " +
            "removeformat | help",
        menubar: false,
        height: 600,
        statusbar: false,
    });
});
