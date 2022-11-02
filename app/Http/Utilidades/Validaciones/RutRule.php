<?php
    namespace App\Http\Utilidades\Validaciones;

    use Illuminate\Contracts\Validation\Rule;
    use App\Http\Utilidades\Validaciones\Rut;

   class RutRule implements Rule{
       private $rut;

       public function __construct(Rut $rut){
           $this->rut = $rut;
       }

       public function passes($attribute, $value){
           return $this->rut->check($value);
       }

       public function message(){
           return 'El Rut no es válido.';
       }
   }