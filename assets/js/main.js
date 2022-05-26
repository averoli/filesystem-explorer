const treeListPath = "http://localhost/filesystem-explorer/assets/root";

const response = fetch(treeListPath).then(function(response) {
    return response.blob();
  });
console.log(response);
const folderList = document.getElementById("folder-list");
const treeItem = document.getElementById("treeItem");
treeItem.addEventListener("click", () => {

    // const response = fetch(treeList);
    // const data = response.json();
    // console.log(data);
    
    // folderList.innerHTML = '';


    let cardContainer = document.getElementById("card-container");
    let template = document.getElementById("cardTemplate");
    let cardPost = template.cloneNode(true);
    let cardIMG = document.getElementById("cardIMG");
    let cardTitle = document.getElementById("cardTitle");
    let cardComments = document.getElementById("cardComments");
    let modalButton = document.getElementById("modalButton");
    let editBtn = document.getElementById("editBtn");
    let deleteBtn = document.getElementById("deleteBtn");

})