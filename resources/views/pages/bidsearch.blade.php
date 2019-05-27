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
            xhr.send();
        }
    </script>
    </head>
    <body>

        {{ csrf_field() }}
        <table class="form-group">
            <tr>
                <td style="width:60%"> <input class="form-control" type="text" name="searchterm" id="searchterm" placeholder="Nombre o descripción"
                    oninput="search(document.getElementById('searchterm').value, 
                                        document.getElementById('family').value,
                                        document.getElementById('minimumPrice').value,
                                        document.getElementById('maximumPrice').value);"></td>
                <td style="width:10%"> <select class="form-control" type="select" name="family" id="family" placeholder="Familia"
                    onchange="search(document.getElementById('searchterm').value, 
                                        document.getElementById('family').value,
                                        document.getElementById('minimumPrice').value,
                                        document.getElementById('maximumPrice').value);"> 
                    <?php
                    foreach ($families as $family) {
                        echo ("<option value=\"".$family->id."\">".$family->nombre."</option>");
                    }
                    ?>
                </select></td>
                <td style="width:10%"> <input class="form-control" type="number" name="minimumPrice" id="minimumPrice" placeholder="Precio mínimo"
                    oninput="search(document.getElementById('searchterm').value, 
                                        document.getElementById('family').value,
                                        document.getElementById('minimumPrice').value,
                                        document.getElementById('maximumPrice').value);"></td>
                <td style="width:10%"> <input class="form-control" type="number" name="maximumPrice" id="maximumPrice" placeholder="Precio máximo"
                    oninput="search(document.getElementById('searchterm').value, 
                                        document.getElementById('family').value,
                                        document.getElementById('minimumPrice').value,
                                        document.getElementById('maximumPrice').value);"></td>    
                <td style="width:10%"><img src="{{asset('images/search.png')}}" style="max-width:50px" class="col-md-3" style="top:0; right:0; position:absolute;"> </td>
                

            </tr>
        </table>

        <div id="searchResult">
            <h4> Introduzca algún dato para buscar. </h4>
        </div>
        @endsection

