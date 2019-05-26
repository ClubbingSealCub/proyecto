<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Búsqueda </title>
    <script type="text/javascript">
        function search(terms, family, minPrice, maxPrice) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    document.getElementById('searchResult').innerHTML = this.responseText;
                }
            };
            xhr.open("GET", "search", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var attributes = "_token={{ csrf_token() }}" + 
                            "&searchterm=" + terms + 
                            "&family=" + family +
                            "&minimumPrice=" + minPrice +
                            "&maximumPrice=" + maxPrice;
            xhr.send(attributes);
        }
    </script>
    </head>
    <body>

        {{ csrf_field() }}
        <table width="70%">
            <tr>
                <td> <input type="text" name="searchterm" id="searchterm" placeholder="Búsqueda"></td>
                <td> <select type="select" name="family" id="family" placeholder="Familia"> 
                    <?php
                    foreach ($families as $family) {
                        echo ("<option value=\"".$family."\">".$family."</option>");
                    }
                    ?>
                </select></td>
                <td> <input type="number" name="minimumPrice" id="minimumPrice" placeholder="Precio mínimo"></td>
                <td> <input type="number" name="maximumPrice" id="maximumPrice" placeholder="Precio máximo"></td>    
                <td> <input type="submit" name="search" value="Búsqueda" 
                    onclick="search(document.getElementById('searchterm').value, 
                                        document.getElementById('family').value,
                                        document.getElementById('minimumPrice').value,
                                        document.getElementById('maximumPrice').value);"> </td>
            </tr>
        </table>

        <div id="searchResult"></div>
    </body>
</html>
