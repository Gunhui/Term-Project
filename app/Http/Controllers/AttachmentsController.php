<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Attachment;
use App\Board;

class AttachmentsController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request) {
    	$attachment = null;
    	\Log::debug('AttachmentsController store', ['stpe'=>1]);
    	if($request->hasFile('file')) {
    		$file = $request->file('file');
    		$filename = /*str_random().*/filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
    		$bytes = $file->getSize();
            $user = \Auth::user();
            $path = public_path('files') . DIRECTORY_SEPARATOR .  $user->id;
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $file->move($path, $filename);      
            
    		$payload = [
    				'filename'=>$filename,
    				'bytes'=> $bytes,
    				'mime'=>$file->getClientMimeType()
    			];			
			$attachment =  Attachment::create($payload);
    	}
    	\Log::debug('AttachmentsController store', ['stpe'=>7]);
    	return response()->json($attachment, 200);
    }

    public function destroy(Request $request, $id) {
        $filename =  $request->filename;
        $attachment = Attachment::find($id);
        $attachment->deleteAttachedFile($filename);
        $attachment->delete();
        $user = \Auth::user();
        /*
        $path = public_path('files') . DIRECTORY_SEPARATOR .  $user->id . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        */
        return $filename;  
    }
}