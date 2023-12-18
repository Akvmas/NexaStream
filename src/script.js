function toggleCategories() {
    var categoryDiv = document.getElementById("category-selection");
    if (categoryDiv.style.display === "none") {
        categoryDiv.style.display = "block";
        categoryDiv.style.position = "absolute";
    } else {
        categoryDiv.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", function() {
    const searchForm = document.getElementById("search-form");

    searchForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire par défaut

        const selectedCategory = document.querySelector("select[name='categorie']").value;
        const searchTerm = document.querySelector(".search-input").value;

        // Effectuer une requête AJAX pour récupérer les vidéos
        fetch(`get_videos.php?categorie=${selectedCategory}&search=${searchTerm}`)
            .then(response => response.text())
            .then(data => {
                // Mettre à jour la partie vidéo-container avec le contenu reçu
                document.querySelector(".video-container").innerHTML = data;
            });
    });
});

