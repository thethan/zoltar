<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1 class="title">Welcome View</h1>
            </div>
            @can('edit_forum')
                <h3>Edit Forum</h3>
            @endcan

            @can('edit_application')
                <h3>Manage Applications</h3>
            @endcan

            @can('editor')
                <h3>Editor</h3>
            @endcan

        </div>
    </body>
</html>
