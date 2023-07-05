<?php
namespace App\Repositories;

use App\Models\User;

class userImpplement implements UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function update($id, $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id)
    {
      
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([$user=>"data deleted successfully"]);
        }
        return false;
    }
}
