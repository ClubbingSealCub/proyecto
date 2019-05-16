<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $fields[0]->id}}</title>

    </head>
    <body>
        <h1>Subasta número: {{ $fields[0]->id}}</h1>
        <p>Artículo: {{ $item_data[0]->nombre }}</p>
        <p>Pertenece a la familia: {{ $family_data[0]->nombre }}</p>
        <p>Vendedor: {{ $user_data[0]->name}} ({{ $user_data[0]->email}})</p>
        <?php
            if(Auth::id() === $user_data[0]->id) {
                echo("<p>La última puja en su subasta es de: </p>".$fields[0]->precio."€");
                echo("<p>Queda aún...<p>");
                echo("<p id=demo></p>");
            } else {
                if(count($bid_data)>0) {
                    echo("<p>Tus pujas en esta subasta:</p>");
                    echo("<ul>");
                    foreach ($bid_data as $bid) {
                        echo("<li> Puja número: ".$bid->id.", en ".$bid->created_at." por valor de ".$bid->valor."</li>");
                        $highestbid = $bid->valor;
                    }
                    echo("</ul>");
                    if($highestbid === $bid->valor) {
                        echo("<p>La puja es tuya! Sólo tiene que aguantar..."."<p>");
                    } else {
                        echo("<p>Has perdido la puja!<p>");
                        echo("<a href="{{ url('pages/bid_on_auction'.$fields[0]->id) }}">Pujar!</a>");
                        echo("<p>Queda aún...<p>");
                        echo("<p id=demo></p>")

                    }
                } else {
                    echo("<a href="{{ url('pages/bid_on_auction'.$fields[0]->id) }}">Pujar!</a>");
                    echo("<p>Queda aún...<p>");
                    echo("<p id=demo></p>")
                }
            }
        ?>
        <p>Añadido en: {{ $fields[0]->created_at }}</p>
    </body>
</html>

<script type="text/javascript">
var countdownDate = "<?php echo $fields[0]->ends_at ?>";
var x = setInterval(function() {
    // Get today's date and time
    var now = new Date().getTime();
    
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>