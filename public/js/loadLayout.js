// async function loadPartial(id, file) {
//   try {
//     const res = await fetch(file);
//     const html = await res.text();
//     document.getElementById(id).innerHTML = html;
//   } catch (err) {
//     console.error("Lỗi khi load file: " + file, err);
//   }
// }

// window.addEventListener("DOMContentLoaded", () => {
//   loadPartial("header", "header.html");
//   loadPartial("footer", "footer.html");
// });