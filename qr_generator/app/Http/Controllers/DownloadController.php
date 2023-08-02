<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function __invoke(Request $request, string $folder, string $file)
    {
        return response()->download(Storage::disk('public')->path(sprintf('%s/%s', $folder, $file)));
    }
}
