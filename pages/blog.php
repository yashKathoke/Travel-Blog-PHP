<?php
session_start();
include '../php/db_connection.php';

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$post_query = "SELECT * FROM posts WHERE id = ?";
$stmt = $pdo->prepare($post_query);
$stmt->execute([$post_id]);
$post = $stmt->fetch();

$comments_query = "SELECT c.comment, u.username, c.date
                   FROM comments c 
                   JOIN users u ON c.user_id = u.id 
                   WHERE c.post_id = ? 
                   ORDER BY c.date DESC";
$stmt = $pdo->prepare($comments_query);
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Post</title>
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <link rel="stylesheet" href="../css/logButton.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .blog {
            position: relative;
            margin-top: 30px;
            top: 4rem;
            margin-bottom: 30px;
        }
        .blog-post {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .blog-image {
            border-radius: 15px 15px 0 0;
            object-fit: cover;
            height: 400px;
        }
        .blog-content {
            padding: 2rem;
        }
        .blog-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 1rem;
        }
        .blog-date {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .blog-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #495057;
        }
    </style>
</head>
<body>

    <div class="fixed-button-container">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/assignment/php/logout.php" class="btn btn-danger">Logout</a>
        <?php else: ?>
            <a href="/assignment/pages/login.php" class="btn btn-primary">Login</a>
        <?php endif; ?>
    </div>
    <div class="button-container">
        <a href="/assignment">
            <button class="button">
                <svg class="icon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2zM568 868H456V664h112v204zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z"></path>
                </svg>
                <span>Home</span>
            </button>
        </a>
        <a href="/assignment/pages/editor.php">
            <button class="button">
                <svg class="icon" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M880.4 204.8L819.2 143.6c-26.4-26.4-69.3-26.4-95.6 0L643.3 224.1 799.9 380.7 880.4 300.2c26.4-26.3 26.4-69.2 0-95.4zM592.9 274.5l-467.2 467c-7.4 7.4-12.8 16.8-15.6 27l-35.2 140.6c-4.4 17.6 11.1 33.1 28.7 28.7l140.5-35.3c10.2-2.6 19.6-8 27-15.6l467.2-467.2-145.4-145.2z"></path>
                </svg>
                <span>Write Post</span>
            </button>
        </a>
    </div>

    <div class="container mt-5 mb-5 blog">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="blog-post">
                    <img src="" alt="Blog post image" class="img-fluid w-100 blog-image" />
                    <div class="blog-content">
                        <h1 class="blog-title"></h1>
                        <p class="blog-date"></p>
                        <div class="blog-text"></div>
                    </div>
                </article>

                <div class="like-dislike-section">
                    <button id="like-btn" class="btn btn-outline-success" disabled>👍 Like (<span id="like-count"><?php echo $post['likes']; ?></span>)</button>
                    <button id="dislike-btn" class="btn btn-outline-danger" disabled>👎 Dislike (<span id="dislike-count"><?php echo $post['dislikes']; ?></span>)</button>
                </div>

                <div class="comments-section mt-5 mb-2">
                    <h3>Comments</h3>
                    <?php if (count($comments) > 0): ?>
                    <div class="list-group">
                        <?php foreach ($comments as $comment): ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo htmlspecialchars($comment['username']); ?></h5>
                                <small><?php echo date('F j, Y, g:i a', strtotime($comment['date'])); ?></small>
                            </div>
                            <p class="mb-1"><?php echo htmlspecialchars($comment['comment']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p>No comments yet. Be the first to comment!</p>
                    <?php endif; ?>
                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                <form action="/assignment/php/submit_comment.php" method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Leave a comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
                <?php else: ?>
                <p class="mt-4">Please <a href="/assignment/pages/login.php">login</a> to leave a comment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="footer bg-dark text-light py-4 position-relative top-3rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left">
                    <p class="mb-0">&copy; 2024 Travel Buddy. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-light">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#" class="text-light">Terms of Service</a></li>
                        <li class="list-inline-item"><a href="#" class="text-light">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="social-media text-center mt-3">
                <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function () {
            function getUrlParameter(name) {
                const params = new URLSearchParams(window.location.search);
                return params.get(name) || "";
            }

            const postId = getUrlParameter("id");

            function formatDate(dateStr) {
                const date = new Date(dateStr);
                const options = { year: "numeric", month: "long", day: "numeric" };
                return date.toLocaleDateString(undefined, options) + " • 5 min read";
            }

            function loadPost() {
                $.ajax({
                    url: "/assignment/php/get_posts.php",
                    type: "GET",
                    dataType: "json",
                    success: function (posts) {
                        const post = posts.find((p) => p.id == postId);
                        if (post) {
                            document.title = post.title;
                            $(".blog-title").text(post.title);
                            $(".blog-date").text(formatDate(post.date));
                            $(".blog-text").text(post.content);
                            $(".blog-image").attr("src", `../public/images/${post.image}`);
                        } else {
                            $(".blog-content").html("<p>Post not found.</p>");
                        }
                    },
                    error: function () {
                        $(".blog-content").html("<p>Error loading post.</p>");
                    },
                });
            }

            loadPost();
        });
    </script>

    <script>
        $(document).ready(function() {
            let likeClicked = false;
            let dislikeClicked = false;

            <?php if (isset($_SESSION['user_id'])): ?>
            $('#like-btn, #dislike-btn').prop('disabled', false);
            <?php endif; ?>

            $('#like-btn').on('click', function() {
                if (likeClicked) {
                    handleLikeDislike('undo_like');
                    likeClicked = false;
                } else {
                    handleLikeDislike('like');
                    likeClicked = true;
                    dislikeClicked = false;
                }
            });

            $('#dislike-btn').on('click', function() {
                if (dislikeClicked) {
                    handleLikeDislike('undo_dislike');
                    dislikeClicked = false;
                } else {
                    handleLikeDislike('dislike');
                    dislikeClicked = true;
                    likeClicked = false;
                }
            });

            function handleLikeDislike(action) {
                const postId = "<?php echo $post_id; ?>";

                $.ajax({
                    url: '/assignment/php/like_dislike.php',
                    type: 'POST',
                    data: {
                        post_id: postId,
                        action: action
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#like-count').text(response.likes);
                            $('#dislike-count').text(response.dislikes);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Error while processing your request.');
                    }
                });
            }
        });
    </script>
</body>
</html>
