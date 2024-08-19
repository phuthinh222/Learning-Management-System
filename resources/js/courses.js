// import "tinymce";
// document.addEventListener("DOMContentLoaded", function () {
//     if (document.getElementById("quill-editor-area")) {
//         var editor = new Quill("#quill-editor", {
//             theme: "snow",
//             modules: {
//                 toolbar: [
//                     ["bold", "italic", "underline", "strike"],
//                     ["code"],
//                     ["blockquote", "list", "bullet"],
//                     ["link", "image", "video"],
//                     ["alignLeft", "alignCenter", "alignRight", "alignJustify"],
//                     ["clean"],
//                 ],
//             },
//         });
//         var initialContent = document.getElementById("quill-editor-area").value;
//         editor.root.innerHTML = initialContent;
//         editor.on("text-change", function () {
//             document.getElementById("quill-editor-area").value =
//                 editor.root.innerHTML;
//         });

//         document
//             .getElementById("quill-editor-area")
//             .addEventListener("input", function () {
//                 editor.root.innerHTML = this.value;
//             });
//     }
// });

tinymce.init({
    selector: "textarea#editor_area",
    plugins: "link image lists table code",
    toolbar:
        "undo redo | formatselect | bold italic | link image | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code",
    menubar: false,
    height: 400,
    statusbar: false,
});
