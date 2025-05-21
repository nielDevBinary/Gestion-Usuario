<?php

namespace App\Http\Services\user;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

/**
 * UserService
 * Servicio que gestiona crud relacionado con el model user
 */
class UserService
{    
    /**
     * getAll
     * obtiene todos los usuarios paginados 
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        $query = User::select('id', 'name', 'email');
        return $query->paginate(User::PAGINATE);
    }
    
    /**
     * Busca un user por su ID
     *
     * @param  mixed $id ID del usuario a buscar
     * @return User retorna el usuario encontrado o lanza una excepcion
     */
    public function find(int $id): User
    {
        return User::findOrFail($id);
    }
    
    /**
     * crea un nuevo usuario
     * 
     * 
     * @param  mixed $data
     * @return User usuario recien creado
     */
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    /**
     * Actualiza los datos de un usuario
     *
     * @param  mixed $id ID dek usuario a actualizar 
     * @param  mixed $data 
     * @return bool true si es correcta la actualizacion, false caso contrario
     */
    public function update(int $id, array $data): bool
    {
        return User::where('id', $id)->update($data);
    }
    
    /**
     * Elimina un usuario por su ID
     *
     * @param  mixed $id ID del usuario a eliminar
     * @return bool true si la eliminacion fue exitosa, false caso contrario
     */
    public function delete(int $id): bool
    {
        return User::where('id', $id)->delete();
    }
}

?>