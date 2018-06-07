<div class="panel-body">
		<div class="row">	
			<div id="mensaje_error" style="width: 100%;"></div>
		</div>
	<div class="row">

		{!! Form::hidden('IdJuguete', $juguete->IdJuguete, array('id' => 'IdJuguete'))!!}
		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('NumeroReferencia', 'NumeroReferencia:') !!}
			{!! Form::text('NumeroReferencia', $juguete->NumeroReferencia, array('id' => 'NumeroReferencia', 'class' => 'form-control', 'placeholder' => 'Numero de Referencia')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('NombreJuguete', 'NombreJuguete:') !!}
			{!! Form::text('NombreJuguete', $juguete->NombreJuguete, array('id' => 'NombreJuguete', 'class' => 'form-control', 'placeholder' => 'Nombre del juguete')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('Dimensiones', 'Dimensiones :') !!}
			{!! Form::text('Dimensiones', $juguete->Dimensiones, array('id' => 'Dimensiones', 'class' => 'form-control', 'placeholder' => 'Dimensiones del juguete')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('EdadInicial', 'EdadInicial:') !!}
			{!! Form::text('EdadInicial', $juguete->EdadInicial, array('id' => 'EdadInicial', 'class' => 'form-control num-entero', 'placeholder' => 'Edad Inicial')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('EdadFinal', 'EdadFinal:') !!}
			{!! Form::text('EdadFinal', $juguete->EdadFinal, array('id' => 'EdadFinal', 'class' => 'form-control num-entero', 'placeholder' => 'Edad Final')) !!}			
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('IdGenero', 'genero:') !!}
			 {!! Form::select('IdGenero',$genero ,$juguete->IdGenero, array('id' => 'IdGenero','class'=>'form-control' )) !!}
			{{-- {!! Form::text('IdGenero', $juguete->IdGenero, array('id' => 'IdGenero', 'class' => 'form-control num-entero', 'placeholder' => 'genero del juguete')) !!}		 --}}	
		</div>

		<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
			{!! Form::label('cantidad', 'cantidad:') !!}
			{!! Form::text('cantidad', $juguete->cantidad, array('id' => 'cantidad', 'class' => 'form-control num-entero', 'placeholder' => 'cantidad')) !!}			
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {!! Form::label('descripcion', 'Descripción:',['class'=>'col-lg-12 col-md-12 col-sm-12 col-xs-12' ,'style'=>'margin-top: 1%;'])  !!}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {!! Form::textarea('descripcion',$juguete->descripcion,['id'=>'descripcion','class'=>'form-control','required', 'placeholder' => 'Descripción del cargo','rows'=>'3','maxlength'=>'200',
                    'onkeyup' => "validarLongitud('descripcion','200','1')",'onkeydown' => "validarLongitud('descripcion','200','1')"]) !!}
           
                 <p class="text-center" style="padding:1%;">Caracteres <span class="badge badge-secondary" name="c_descripcion" id="c_descripcion">{{strlen($juguete->descripcion)}}</span> de 200</p>     
            </div> 
        </div>   

	</div>
	
</div>