const requestTbody = document.querySelector(".requestTbody");

changeColorRequest();

function changeColorRequest() {
  const tableRow = requestTbody.childNodes;
  tableRow.forEach((row) => {
    const status = row.childNodes[5];
    console.log(status);

    if (status.children[0].innerText === "belum selesai") {
      status.children[0].classList.remove("bg-success");
      status.children[0].classList.remove("bg-warning");
      status.children[0].classList.add("bg-warning");
    } else if (status.children[0].innerText === "selesai") {
      status.children[0].classList.remove("bg-success");
      status.children[0].classList.remove("bg-warning");
      status.children[0].classList.add("bg-success");
    }
  });
}
