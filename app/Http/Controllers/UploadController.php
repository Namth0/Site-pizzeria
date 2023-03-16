<?php

namespace App\Http\Controllers;
use App\Models\Pizza;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function storageUploadForm(Request $request, $id)
    {
        $u = Pizza::find($id);
        if($u != null)
        {
            return view('admin.uploadJPG')-> with('u',$u);
        }
        $request->session()->flash("error", "Impossible de cibler l'élément");
        return redirect("/home");
    }

    public function storageUpload(Request $request,$id){

            $u = Pizza::find($id);

            if($u !=null){

        $request->validate([
        'fichier' => 'required|mimes:png|max:2048'
        ]);
        $path = $request->file('fichier')->storeAs('uploads','f' . $id . '.png');
        $request->session()->flash("etat", 'succes');
        return redirect("/home");
    }
    $request->session()->flash("error", "Impossible de cibler l'élément");
    return redirect("/home");

    }

        
}
