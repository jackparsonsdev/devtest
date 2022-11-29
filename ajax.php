<?php
    require_once('inc/unsplash-api.php');

    if( isset( $_POST['query'] ) ){

        // Set query terms
        $queryTerm = $_POST['query'];
        $per_page = $_POST['per_page'];
        $pages = $_POST['pages'];

        // Create request and return html
        ob_clean();
        $newRequest = new UnsplashPublicAPI( $queryTerm, $per_page, $pages);
        $newRequest->results();
        echo $newRequest->html;
        exit();

    } else  {
        echo '<h2>Invalid request</h2>';
    }
?>