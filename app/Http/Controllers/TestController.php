<?php

namespace App\Http\Controllers;

use Chumper\Zipper\Facades\Zipper;
use App\Scormvar;
use ZipArchive;
use File;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function uploadSCORMZipFile(Request $request)
    {
        $file = $request->file('zip');

        $request->file('zip')->move(
            public_path() . '/tempZip/', $file->getClientOriginalName()
        );
        $zipFilePath = public_path() . '/tempZip/' . $file->getClientOriginalName();

        // Make unzip files directory
        $lessonFolderName = rand(111111, 999999);
        $extractToThisPath = public_path() . '/unzipCourse/' . $lessonFolderName;
        if (!file_exists($extractToThisPath)) {
            mkdir($extractToThisPath, 0777, true);
        }

        if ($this->unZip($zipFilePath, $extractToThisPath)) {
            @unlink($zipFilePath);
            $request->session()->flash('msg', 'Files Extracted Successfully!');
        } else {
            $request->session()->flash('msg', 'Extraction Failed!');
        }

        return redirect()->route('get.content', $lessonFolderName);
    }

    public function getContent($lessonFolderName)
    {
        return view('scorm.rte', compact('lessonFolderName'));
    }

    private function unZip($zipFilePath, $extractToThisPath)
    {
        //$zipFilePath = public_path().'\testZip\test.zip';
        //$extractToThisPath = public_path() . '\testZipExtract';
        File::cleanDirectory($extractToThisPath, true);

        $zip = new ZipArchive();
        $res = $zip->open($zipFilePath);

        if ($res === TRUE) {
            $zip->extractTo($extractToThisPath);
            $zip->close();
            return true;
        } else {
            return false;
        }
    }


    public function downloadZip()
    {
        $files = glob(public_path('js/*'));
        Zipper::make('mydir/mytest3.zip')->add($files);

        return response()->download(public_path('mydir/mytest3.zip'));
    }

    public function showUploadFile(Request $request)
    {
        $file = $request->file('zip');

        //Display File Name
        echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';

        //Display File Extension
        echo 'File Extension: ' . $file->getClientOriginalExtension();
        echo '<br>';

        //Display File Real Path
        echo 'File Real Path: ' . $file->getRealPath();
        echo '<br>';

        //Display File Size
        echo 'File Size: ' . $file->getSize();
        echo '<br>';

        //Display File Mime Type
        echo 'File Mime Type: ' . $file->getMimeType();

        //Move Uploaded File
        //$destinationPath = 'uploads';
        //$file->move($destinationPath,$file->getClientOriginalName());
    }

}
