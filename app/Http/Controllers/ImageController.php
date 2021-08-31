<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //
    protected function showJobImage($filename)
    {
       //check image exist or not
       $exists = Storage::disk('public')->exists('job/'.$filename);
       
       if($exists) {
          
          //get content of image
          $content = Storage::get('public/job/'.$filename);
          
          //get mime type of image
          $mime = Storage::mimeType('public/job/'.$filename);
          //prepare response with image content and response code
          $response = Response::make($content, 200);
          //set header 
          $response->head
}
