@extends('layouts.app')


@section('content')
    <script type="text/javascript">
        function search(terms, family, minPrice, maxPrice) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    document.getElementById('searchResult').innerHTML = this.responseText;
                }
            };
            var attributes = "_token={{ csrf_token() }}" + 
                            "&searchterm=" + terms + 
                            "&family=" + family +
                            "&minimumPrice=" + minPrice +
                            "&maximumPrice=" + maxPrice;
            xhr.open("GET", "search?" + attributes, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            xhr.send(attributes);
        }
    </script>
    </head>
    <body>

        {{ csrf_field() }}
        <table class="form-group">
            <tr>
                <td> <input class="form-control" type="text" name="searchterm" id="searchterm" placeholder="Búsqueda"></td>
                <td> <select class="form-control" type="select" name="family" id="family" placeholder="Familia"> 
                    <?php
                    foreach ($families as $family) {
                        echo ("<option value=\"".$family->id."\">".$family->nombre."</option>");
                    }
                    ?>
                </select></td>
                <td> <input class="form-control" type="number" name="minimumPrice" id="minimumPrice" placeholder="Precio mínimo"></td>
                <td> <input class="form-control" type="number" name="maximumPrice" id="maximumPrice" placeholder="Precio máximo"></td>    
                <td> <input class="btn btn-primary" type="submit" name="search" value="Búsqueda" 
                    onclick="search(document.getElementById('searchterm').value, 
                                        document.getElementById('family').value,
                                        document.getElementById('minimumPrice').value,
                                        document.getElementById('maximumPrice').value);"> </td>
            </tr>
        </table>

        <div id="searchResult"></div>
        @endsection

