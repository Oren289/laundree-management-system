const tableBody = document.querySelector("#tbody");

changeColorAdmin();

function changeColorAdmin() {
  const tableRow = tableBody.childNodes;
  tableRow.forEach((row) => {
    const proses = row.childNodes[7];
    const status = row.childNodes[8];

    if (proses.children[0].innerText === "on process") {
      proses.children[0].classList.remove("bg-success");
      proses.children[0].classList.remove("bg-warning");
      proses.children[0].classList.add("bg-warning");
    } else if (proses.children[0].innerText === "done") {
      proses.children[0].classList.remove("bg-success");
      proses.children[0].classList.remove("bg-warning");
      proses.children[0].classList.add("bg-success");
    }

    if (status.children[0].innerText === "not returned") {
      status.children[0].classList.remove("bg-success");
      status.children[0].classList.remove("bg-warning");
      status.children[0].classList.add("bg-warning");
    } else if (status.children[0].innerText === "returned") {
      status.children[0].classList.remove("bg-success");
      status.children[0].classList.remove("bg-warning");
      status.children[0].classList.add("bg-success");
    }
  });
}
