<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use App\Repositories\userImpplement;
use Illuminate\Http\Request;

class RepoController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userget()
    {
        $users = $this->userRepository->getAll();
       return response()->json(['users'=>$users]);
        // return view('users.index', compact('users'));
    }
    public function delete($id)
    {
        
       $this->userRepository->delete($id); 
    }
    public function update(Request $request,$id)
    {
        
        $data = $request->all();
        $result = $this->userRepository->update($id, $data);
        return response()->json(['users'=>$result]);

    }
    public function create(Request $request)
    {
        $data = $request->all();
        $result = $this->userRepository->create($data);
    }

    
}
