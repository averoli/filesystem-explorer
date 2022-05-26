const folder = document.getElementById("folderName");

let folderName = folder.addEventListener("change", function(e){
console.log(e.target.value);
   
})




const createNewFolder = document
  .getElementById("createNewFolder")
  .addEventListener("click", function () {
    const folderList = document.getElementById("folderList");
    const newFolder = document.createElement("li");

   
    newFolder.textContent = "123";
    folderList.append(newFolder);
  });
