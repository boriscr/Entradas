<x-body.body :title="'Eventos'" :meta_descripcion="'Compra tus entradas para los mejores eventos en línea. Encuentra conciertos, obras de teatro, festivales y mucho más con nuestras promociones exclusivas y un proceso de compra fácil y seguro. ¡No te pierdas los eventos más esperados!'">
    <x-nav.nav />
@if(session('good'))
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            Swal.fire(@json(session('good')))
        })
    </script>
@elseif(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded',function(){
            Swal.fire(@json(session('error')))
        })
    </script>
@endif
    @if (isset($eventos))
        <div class="box-contenedor-evento">
            @foreach ($eventos as $eventos)
                <x-card.card-evento :eventos="$eventos" />
            @endforeach
        </div>
    @else
        <div class="box-sin-entradas">
            <img src="https://68.media.tumblr.com/2bcd5f1584814fb90fb001cf5519a27f/tumblr_oqqshj6MUC1vjxr9zo1_500.gif"
                alt="">
            <p>¡Ups! No hay eventos disponibles en este momento.</p>
            <p>Por favor, vuelva más tarde. ¡Gracias por su paciencia!</p>
        </div>
    @endif
    
</x-body.body>
