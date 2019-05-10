@extends('layouts.app')

@section('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>
        
        var angX = 0;
        var angY = 0;
        
        $('.boton').on('click', function() {
            switch ($(this).attr("id")) {
                case "arriba":
                    angX = angX + 90;
                    break;
                case "abajo":
                    angX = angX - 90;
                    break;
                case "derecha":
                    angY = angY + 90;
                    break;
                case "izquierda":
                    angY = angY - 90;
                    break;
            }
            
            $('.cube').attr('style', 'transform: rotateX(' + angX + 'deg) rotateY(' + angY + 'deg);')
        });
        
    </script>

@endsection

@section('content')

    <div class="content">
        
        <div class = "row">
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <div class="col-section form-group col-sm-3">
                    
                <section class="container">
                    
                    <div class="cube">
                        
                        <figure class="back"></figure>
                        <figure class="left"></figure>
                        <figure class="bottom"></figure>
                        <figure class="front"></figure>
                        <figure class="right"></figure>
                        <figure class="top"></figure>
                        
                    </div>
                    
                </section>
            
            </div>
            
            <section class="botones">
                    
                <div class="boton" id="arriba">▲</div>
                <div class="boton" id="abajo">▼</div>
                <div class="boton" id="izquierda">◄</div>
                <div class="boton" id="derecha">►</div>
                    
            </section>
            
        </div>
        
    </div>

@endsection