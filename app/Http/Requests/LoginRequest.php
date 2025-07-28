<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function getCredentials(){
        $username = $this->get('username');
        if ($this->isEmail($username)){
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        } 
        return $this->only('username', 'password');
        // Si es un email, retorna las credenciales con el email, si no es un email, retorna las credenciales con el username
    }
    
    public function isEmail($value){
        $factory = $this->container->make(ValidationFactory::class);
        // Utiliza el contenedor de servicios para obtener una instancia del validador
        return !$factory->make(['username' => $value], ['username' => 'email'])->fails();
        // make espera 2 parámetros: los datos a validar y las reglas de validación
        // si falla la validación, significa que el valor no es un email
    }
}
