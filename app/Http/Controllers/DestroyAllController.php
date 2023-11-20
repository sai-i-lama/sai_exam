<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Answer;

class DestroyAllController extends Controller
{
    public function AllUsersDestroy()
    {
      User::where('role', '!=', 'A')->getQuery()->delete();
      // User::where('role', '!=', 'A')->truncate();
      return back()->with('deleted', 'Tous les utilisateurs ont été supprimés');
    }

    public function AllAnswersDestroy() {
      Answer::truncate();
      return back()->with('deleted', 'Toutes les feuilles de reponses ont été supprimés');
    }

}
