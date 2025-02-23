// script.js
document.addEventListener("DOMContentLoaded", () => {
    const searchBox = document.getElementById("searchBox");
    const articlesSection = document.getElementById("articles");

    function fetchArticles() {
        fetch('fetch_articles.php')
            .then(response => response.json())
            .then(articles => displayArticles(articles))
            .catch(error => console.error('Error fetching articles:', error));
    }

    function displayArticles(filteredArticles) {
        articlesSection.innerHTML = "";
        filteredArticles.forEach(article => {
            const articleDiv = document.createElement("div");
            articleDiv.classList.add("article");
            articleDiv.innerHTML = `
                <h2><a href="article.php?id=${article.id}">${article.title}</a></h2>
                <p>${article.content.substring(0, 100)}...</p>
            `;
            articlesSection.appendChild(articleDiv);
        });
    }

    searchBox.addEventListener("input", () => {
        const searchTerm = searchBox.value.toLowerCase();
        fetch('fetch_articles.php')
            .then(response => response.json())
            .then(articles => {
                const filteredArticles = articles.filter(article => 
                    article.title.toLowerCase().includes(searchTerm) ||
                    article.content.toLowerCase().includes(searchTerm)
                );
                displayArticles(filteredArticles);
            })
            .catch(error => console.error('Error filtering articles:', error));
    });

    fetchArticles();
});
