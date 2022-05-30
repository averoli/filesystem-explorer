const urlSearch = '../php/search.php';
// const keyword = document.getElementById('keyword');
// keyword.addEventListener("change", getSearch());

const getSearch = async () => {
    console.log("Getting seach");
    const response = await fetch(urlSearch);
    // const posts = await response.json();
    // return posts;
  }