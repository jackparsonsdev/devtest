<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Breckenridge practical developer test</title>
        <meta name="description" content="A developer test featuring cute cat pictures from unsplash.">
        <meta name="author" content="Jack Parsons">
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <h1>Breckenridge Web Developer test</h1>
        </header>
        <main>
            <div id="grid"></div>
        </main>
        <script>            
            jQuery(document).ready(function($) {
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    dataType: 'html',
                    data: {
                        query: 'cats',
                        per_page: 12,
                        pages: 1
                    },
                    success: function(htmlResp) {
                        $('#grid').html(htmlResp);
                    }
                })
            });            
        </script>
    </body>
</html>