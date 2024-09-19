$(document).ready(function() {

    let posts = []

    function loadPosts() {
        $.ajax({
            url: '/assignment/php/get_posts.php',
            type: 'GET',
            dataType: 'json',
            success: (data) => {
                posts = data;
                displayPosts();
            }
        });
    }

    const displayPosts = () => {
        
        $('.post-previews').empty();
    
        if (posts == null || posts.length === 0) {
            $('.post-previews').append(`
                <div class="alert alert-light" role="alert">
                    <b>No Posts Available !!!</b> 
                    ${`But You are open to Share your experiences. <a class="write" href="assignment/pages/editor.php"> Start Now</a>`}
                </div>
            `);
        } else {
            posts.forEach(post => {
                // showing only 100 characters
                const truncatedContent = post.content.length > 100 
                    ? post.content.substring(0, 100) + '...' 
                    : post.content;
    
                // blog preview
                const postHtml = `
                    <div class="card mb-4 post-preview">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="post-image-container" style="background-image: url('./public/images/${post.image}')"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title post-title">${post.title}</h5>
                                    <p class="card-text post-meta">${formatDate(post.date)}</p>
                                    <p class="card-text post-excerpt">${truncatedContent}</p>
                                    <a href="/assignment/pages/blog.html?id=${post.id}" class="read-more">Read more →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
    
                
                $('.post-previews').append(postHtml);
            });
        }
    }
    

    const formatDate = (dateStr) => {
        // Formating the date
        const date = new Date(dateStr);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString(undefined, options) + ' • 5 min read';
    }

    loadPosts();

});
