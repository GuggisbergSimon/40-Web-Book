<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>BBBOOOKKK</title>

</head>
<body>
<!-- todo OPTIONAL make list of existing categories and choice to add new category, use list as input type (autocomplete)-->
<h1>Add a book</h1>
<form method="post" action="addingBook.php" enctype="multipart/form-data">
    <p>
        <label for="title">Title : </label>
        <input type="text" id="title" name="title">
    </p>
    <p>
        <label for="category">Category : </label>
        <select id="category" name="category">
            <option value="Choose" selected>Choisir</option>
            <option value="book">Book</option>
            <option value="comic">Comic</option>
            <option value="manga">Manga</option>
        </select>
    </p>
    <p>
        <label for="numberPages">Number of pages : </label>
        <input type="number" id="numberPages" name="numberPages" min="1">
    </p>
    <p>
        <label for="authorName">Author's name : </label>
        <input type="text" id="authorName" name="authorName">
    </p>
    <p>
        <label for="authorSurname">Author's surname : </label>
        <input type="text" id="authorSurname" name="authorSurname">
    </p>
    <p>
        <label for="editor">Editor : </label>
        <input type="text" id="editor" name="editor">
    </p>
    <p>
        <label for="year">Year : </label>
        <input type="number" id="year" name="year" max="2020">
    </p>
    <p>
        <label for="picture">Picture :</label>
        <input type="file" name="picture" id="picture">
    </p>
    <p>
        <label for="excerpt">Excerpt : </label>
        <input type="file" name="excerpt" id="excerpt">
    </p>
    <p>
        <label for="summary">Summary : </label>
        <textarea id="summary" name="summary" rows="4" cols="50" maxlength="200" placeholder="Write a short summary for the book"></textarea>
    </p>
    <p>
        <input type="submit" name="btnSubmit" value="Add book" />
    </p>
</form>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>