import "../../styles/pages/articles.scss";

document.addEventListener("DOMContentLoaded", () => {
  // // Article

  // Variables
  let timeout = null;
  const title = document.querySelector("#article_title");
  let slug = document.querySelector(".article-slug");
  const uploadedArea = document.querySelector(".uploaded-area");

  // Event
  title.addEventListener("keyup", function (event) {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      let data = event.target.value;
      slug.value = generateSlug(data);
      console.log(" 1 :" + slug.value);
    }, 1000);
  });

  /*
   * Crédit: https://gist.github.com/codeguy/6684588
   */
  const generateSlug = (str) => {
    str = str.replace(/^\s+|\s+$/g, ""); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaaeeeeiiiioooouuuunc------";

    for (var i = 0, l = from.length; i < l; i++) {
      str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
    }

    str = str
      .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
      .replace(/\s+/g, "-") // collapse whitespace and replace by -
      .replace(/-+/g, "-"); // collapse dashes

    return str;
  };

  const upload = `<div class="upload-content hidden">
                    <div class="upload-thumbnail">
                      <img id="upload-thumbnail-img" />
                    </div>
                    <div class="upload-details flex-fill">
                      <p>Titre</p>
                      <small>taille</small>
                    </div>
                  </div>`;
  uploadedArea.insertAdjacentHTML("afterend", upload);

  uploadedArea.addEventListener("change", (e) => {
    let fileInput = e.target.files;
    let fileUpload = e.target.value;
    let reader = new FileReader();

    if (fileUpload != "") {
      if (fileInput && fileInput[0]) {
        document.querySelector(".upload-content").classList.remove("hidden");
        reader.onload = (el) => {
          document.getElementById("upload-thumbnail-img").src = el.target.result;
          document.querySelector(".upload-details p").innerHTML = fileInput[0].name;
          document.querySelector(".upload-details small").innerHTML =
            (fileInput[0].size / 1024).toFixed(1) + " KB";
        };
        reader.readAsDataURL(fileInput[0]);
      }
    }
  });
});
