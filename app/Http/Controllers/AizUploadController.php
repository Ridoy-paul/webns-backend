<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Response;
use Auth;
use Storage;
use Intervention\Image\Laravel\Facades\Image;
use enshrined\svgSanitize\Sanitizer;
use Illuminate\Support\Facades\File;

class AizUploadController extends Controller
{
    public function index(Request $request)
    {

        $all_uploads =  Upload::query();

        //$all_uploads = (auth()->user()->user_type == 'seller') ? Upload::where('usersuper_id', auth()->user()->id) : Upload::query();
        $search = null;
        $sort_by = null;

        if ($request->search != null) {
            $search = $request->search;
            $all_uploads->where('file_original_name', 'like', '%' . $request->search . '%');
        }

        $sort_by = $request->sort;
        switch ($request->sort) {
            case 'newest':
                $all_uploads->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $all_uploads->orderBy('created_at', 'asc');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size', 'asc');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }

        $all_uploads = $all_uploads->paginate(60)->appends(request()->query());

        return view('backend.uploaded_files.index', compact('all_uploads', 'search', 'sort_by'));

        //return (auth()->user()->user_type == 'seller') ? view('seller.uploads.index', compact('all_uploads', 'search', 'sort_by')) : view('backend.uploaded_files.index', compact('all_uploads', 'search', 'sort_by'));
    }

    public function create()
    {
        return view('backend.uploaded_files.create');
        /*
        return (auth()->user()->user_type == 'seller')
            ? view('seller.uploads.create')
            : view('backend.uploaded_files.create');
        */
    }


    public function show_uploader(Request $request)
    {
        return view('uploader.aiz-uploader');
    }

    public function upload(Request $request)
    {
        // return 'd';
        $type = array(
            "jpg" => "image",
            "jpeg" => "image",
            "png" => "image",
            "svg" => "image",
            "webp" => "image",
            "gif" => "image",
            "mp4" => "video",
            "mpg" => "video",
            "mpeg" => "video",
            "webm" => "video",
            "ogg" => "video",
            "avi" => "video",
            "mov" => "video",
            "flv" => "video",
            "swf" => "video",
            "mkv" => "video",
            "wmv" => "video",
            "wma" => "audio",
            "aac" => "audio",
            "wav" => "audio",
            "mp3" => "audio",
            "zip" => "archive",
            "rar" => "archive",
            "7z" => "archive",
            "doc" => "document",
            "txt" => "document",
            "docx" => "document",
            "pdf" => "document",
            "csv" => "document",
            "xml" => "document",
            "ods" => "document",
            "xlr" => "document",
            "xls" => "document",
            "xlsx" => "document"
        );

        if ($request->hasFile('aiz_file')) {
            $upload = new Upload;
            $extension = strtolower($request->file('aiz_file')->getClientOriginalExtension());
            
            if (isset($type[$extension])) {
                $arr = explode('.', $request->file('aiz_file')->getClientOriginalName());
                $upload->file_original_name = implode('.', array_slice($arr, 0, -1));

                /*
                if($extension == 'svg') {
                    $sanitizer = new Sanitizer();
                    $dirtySVG = file_get_contents($request->file('aiz_file')->getRealPath());
                    $cleanSVG = $sanitizer->sanitize($dirtySVG);
                    file_put_contents($request->file('aiz_file')->getRealPath(), $cleanSVG);
                }
                */

                $path = $request->file('aiz_file')->store('uploads/all', 'local');
                $size = $request->file('aiz_file')->getSize();

                $storedFilePath = asset($path);
            
                if (!File::exists(public_path($path))) {
                    return response()->json(['success' => false, 'message' => 'File could not be stored'], 500);
                }

                /*

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $file_mime = finfo_file($finfo, $storedFilePath);
                finfo_close($finfo);

                if ($type[$extension] == 'image' && get_setting('disable_image_optimization') != 1) {
                    try {
                        $img = Image::make($request->file('aiz_file')->getRealPath())->encode();
                        $height = $img->height();
                        $width = $img->width();
                        if ($width > $height && $width > 1500) {
                            $img->resize(1500, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } elseif ($height > 1500) {
                            $img->resize(null, 800, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        $img->save(base_path('public/') . $path);
                        clearstatcache();
                        $size = $img->filesize();
                    } catch (\Exception $e) {
                        //dd($e);
                    }
                }

                if (env('FILESYSTEM_DRIVER') != 'local') {
                    Storage::disk(env('FILESYSTEM_DRIVER'))->put(
                        $path,
                        file_get_contents($storedFilePath),
                        [
                            'visibility' => 'public',
                            'ContentType' => $extension == 'svg' ? 'image/svg+xml' : $file_mime
                        ]
                    );
                    if ($arr[0] != 'updates') {
                        unlink($storedFilePath);
                    }
                }
                */

                $upload->extension = $extension;
                $upload->file_name = $path;
                $upload->usersuper_id = 0; // Set to appropriate user ID if available
                $upload->type = $type[$upload->extension];
                $upload->file_size = $size;
                $upload->save();

                return response()->json(['success' => true, 'message' => 'File uploaded successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid file type'], 400);
            }
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
    }


    public function get_uploaded_files(Request $request)
    {
        $uploads = Upload::where('usersuper_id', 0);
        if ($request->search != null) {
            $uploads->where('file_original_name', 'like', '%' . $request->search . '%');
        }
        if ($request->sort != null) {
            switch ($request->sort) {
                case 'newest':
                    $uploads->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $uploads->orderBy('created_at', 'asc');
                    break;
                case 'smallest':
                    $uploads->orderBy('file_size', 'asc');
                    break;
                case 'largest':
                    $uploads->orderBy('file_size', 'desc');
                    break;
                default:
                    $uploads->orderBy('created_at', 'desc');
                    break;
            }
        }
        return $uploads->paginate(60)->appends(request()->query());
    }

    public function destroy($id)
    {
        if(Auth::user()->type == 'admin' || Auth::user()->type == 'admin_helper') {
            $upload = Upload::findOrFail($id);
            try {
                if (env('FILESYSTEM_DRIVER') != 'local') {
                    Storage::disk(env('FILESYSTEM_DRIVER'))->delete($upload->file_name);
                    if (file_exists(public_path() . '/' . $upload->file_name)) {
                        unlink(public_path() . '/' . $upload->file_name);
                    }
                } else {
                    unlink(public_path() . '/' . $upload->file_name);
                }
                $upload->delete();
                //flash(translate('File deleted successfully'))->success();
            } catch (\Exception $e) {
                $upload->delete();
                //flash(translate('File deleted successfully'))->success();
            }
            return back();
        } else {
            //flash(translate("You don't have permission for deleting this!"))->error();
            return back();
        }
        
        /*
        if (auth()->user()->user_type == 'admin' && $upload->usersuper_id != auth()->user()->id) {
            flash(translate("You don't have permission for deleting this!"))->error();
            return back();
        }
        */
    }

    public function bulk_uploaded_files_delete(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $filesuper_id) {
                $this->destroy($filesuper_id);
            }
            return 1;
        } else {
            return 0;
        }
    }

    public function get_preview_files(Request $request)
    {
        $ids = explode(',', $request->ids);
        //return $ids;
        $files = Upload::whereIn('file_name', $ids)->get();
        $new_file_array = [];
        foreach ($files as $file) {
            $file['file_name'] = my_asset($file->file_name);
            if ($file->external_link) {
                $file['file_name'] = $file->external_link;
            }
            $new_file_array[] = $file;
        }
        // dd($new_file_array);
        return $new_file_array;
        // return $files;
    }

    public function all_file()
    {
        $uploads = Upload::all();
        foreach ($uploads as $upload) {
            try {
                if (env('FILESYSTEM_DRIVER') != 'local') {
                    Storage::disk(env('FILESYSTEM_DRIVER'))->delete($upload->file_name);
                    if (file_exists(public_path() . '/' . $upload->file_name)) {
                        unlink(public_path() . '/' . $upload->file_name);
                    }
                } else {
                    unlink(public_path() . '/' . $upload->file_name);
                }
                $upload->delete();
                //flash(translate('File deleted successfully'))->success();
            } catch (\Exception $e) {
                $upload->delete();
                //flash(translate('File deleted successfully'))->success();
            }
        }

        Upload::query()->truncate();

        return back();
    }

    //Download project attachment
    public function attachment_download($id)
    {
        $project_attachment = Upload::find($id);
        try {
            $file_path = public_path($project_attachment->file_name);
            return Response::download($file_path);
        } catch (\Exception $e) {
            //flash(translate('File does not exist!'))->error();
            return back();
        }
    }
    //Download project attachment
    public function file_info(Request $request)
    {
        $file = Upload::findOrFail($request['id']);

        return (auth()->user()->user_type == 'seller')
            ? view('seller.uploads.info', compact('file'))
            : view('backend.uploaded_files.info', compact('file'));
    }
}
