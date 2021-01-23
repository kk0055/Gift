<?php
 
namespace App\Services;
 
use Illuminate\Http\Request;
 
class SaveImagesServices
{
 
    public static function saveImages($request, $string){
 
    //get filename 
    $filenameWithExt = $request->file($string)->getClientOriginalName();
    
    //get just the filenmae
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    
    //get extension
    $extension = $request->file($string)->getClientOriginalExtension();
 
    // create new filename
    $filenameToStore = $filename.'_'.time().'.'.$extension;
 
    //upload image
    $path = $request->file($string)->storeAs('public/storage/image', $filenameToStore);
 
    return $filenameToStore;
 
    }
 
}