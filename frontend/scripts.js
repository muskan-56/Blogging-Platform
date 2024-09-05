document.addEventListener("DOMContentLoaded", () => {
  const postId = getParameterByName("id");
  if (postId) {
    fetchPost(postId);
    fetchComments(postId);
    document.getElementById("post_id").value = postId;
  } else {
    fetchPosts();
  }
});

function fetchPosts() {
  fetch("http://localhost/Bloging_Website/backend/get_posts.php")
    .then((response) => response.json())
    .then((posts) => {
      const postsContainer = document.getElementById("posts");
      postsContainer.innerHTML = "";
      posts.forEach((post) => {
        const postElement = document.createElement("div");
        postElement.classList.add("post");
        postElement.innerHTML = `
                    <h3>${post.title}</h3>
                    <p>${post.content.substring(0, 100)}...</p>
                    <a href="post.html?id=${post.id}">Read More</a>
                `;
        postsContainer.appendChild(postElement);
      });
    });
}

function fetchPost(postId) {
  fetch(`http://localhost/Bloging_Website/backend/get_post.php?id=${postId}`)
    .then((response) => response.json())
    .then((post) => {
      const postContainer = document.getElementById("post");
      postContainer.innerHTML = `
                <h2>${post.title}</h2>
                <p>${post.content}</p>
            `;
    });
}

function fetchComments(postId) {
  fetch(
    `http://localhost/Bloging_Website/backend/get_comments.php?post_id=${postId}`
  )
    .then((response) => response.json())
    .then((comments) => {
      const commentsContainer = document.getElementById("comments");
      commentsContainer.innerHTML = "";
      comments.forEach((comment) => {
        const commentElement = document.createElement("div");
        commentElement.classList.add("comment");
        commentElement.innerHTML = `
                    <p>${comment.content}</p>
                    <small>By user ${comment.username} on ${new Date(
          comment.created_at
        ).toLocaleString()}</small>
                `;
        commentsContainer.appendChild(commentElement);
      });
    });
}

function getParameterByName(name, url = window.location.href) {
  name = name.replace(/[\[\]]/g, "\\$&");
  const regex = new RegExp(`[?&]${name}(=([^&#]*)|&|#|$)`),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
