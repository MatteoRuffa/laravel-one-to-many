import "./bootstrap";
import "~resources/scss/app.scss";

// import "~bootstrap-icons/font/bootstrap-icons.scss";

import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);

const deleteSubmitButtons = document.querySelectorAll(".delete-button");

deleteSubmitButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault();

        const dataTitle = button.getAttribute("data-item-title");

        const modal = document.getElementById("deleteModal");

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const modalItemTitle = modal.querySelector("#modal-item-title");
        
        modalItemTitle.textContent = dataTitle;

        const buttonDelete = modal.querySelector("button.btn-danger");

        buttonDelete.addEventListener("click", () => {
            button.parentElement.submit();
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const modalInfo = new bootstrap.Modal(document.getElementById('staticBackdropInfo'));

    document.querySelectorAll('.open-modal-info').forEach(function(button) {
        button.addEventListener('click', function(event) {
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const created = this.getAttribute('data-created');
            const categoryName = this.getAttribute('data-categoryName'); 
            const categories = this.getAttribute('data-categories');

            document.getElementById('modalTitleInfo').innerHTML = `<strong>Title:</strong> ${title}`;
            document.getElementById('modalDescriptionInfo').innerHTML = `<strong>Description:</strong> ${description || categories}`;
            document.getElementById('modalCreatedInfo').innerHTML = `<strong>Created at:</strong> ${created}`;
            document.getElementById('modalCategoriesInfo').innerHTML = `<strong>Category:</strong> ${categories}`;

            modalInfo.show();
        });
    });
});




const image = document.getElementById("uploadImage");

//se esiste nella pagina
if (image) {
    image.addEventListener("change", () => {
        //console.log(image.files[0]);
        //prendo l'elemento ing dove voglio la preview
        const preview = document.getElementById("uploadPreview");

        //creo nuoco oggetto file reader
        const oFReader = new FileReader();

        //uso il metodo readAsDataURL dell'oggetto creato per leggere il file
        oFReader.readAsDataURL(image.files[0]);

        //al termine della lettura del file
        oFReader.onload = function (event) {
            //metto nel src della preview l'immagine
            preview.src = event.target.result;
        };
    });
}



