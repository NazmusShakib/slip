<?php

namespace App\Http\Controllers;

use Chumper\Zipper\Facades\Zipper;
use App\Scormvar;
use ZipArchive;
use File;
use Validator;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function uploadSCORMZipFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zip' => 'required'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

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
            @unlink($zipFilePath);
            $request->session()->flash('msg', 'Extraction Failed!');
            return redirect()->back();
        }

        if (!File::glob($extractToThisPath . '/imsmanifest.xml') && !File::glob($extractToThisPath . '/metadata.xml')) {
            File::cleanDirectory($extractToThisPath, true);
            rmdir($extractToThisPath);
            return redirect()->back()->with('msg', 'This isNot a SCORM file.');
        }

        return redirect()->route('get.content', $lessonFolderName);
    }

    public function getContent($lessonFolderName)
    {
        return view('scorm.rte', compact('lessonFolderName'));
    }

    public function getValue(Request $request)
    {
        $safeVarName = $request->varname;

        $varValue = Scormvar::where('varName', $safeVarName)
            ->select('varValue')
            ->first();

        // return value to the calling program
        print $varValue;
    }

    public function setValue(Request $request)
    {
        $safeVarName = $request->varname;
        $safeVarValue = $request->varvalue;

        // Remove previous data.
        $deletedRows = Scormvar::where('varName', $safeVarName)->delete();

        $saveData = new Scormvar();
        $saveData->varName = $safeVarName;
        $saveData->varValue = $safeVarValue;
        $saveData->save();

        // return value to the calling program
        print "true";
    }


    public function getScormApiJs()
    {
        return view('scorm/api');
    }

    private function unZip($zipFilePath, $extractToThisPath)
    {
        $zip = new ZipArchive();
        $res = $zip->open($zipFilePath);
        if ($res === TRUE) {
            $zip->extractTo($extractToThisPath);
            $zip->close();
            return true;
        }
        return false;
    }


    public function searchFile(/*$dir, $searchPattern*/)
    {
        $dir = public_path() . '/unzipCourse/lesson';
        $searchPattern = '/*.xml';


        $log_files = File::glob($dir . $searchPattern);

        echo "<pre>";
        print_r($log_files);
        echo "</pre>";
        exit();

        if ($log_files === false) {
            echo 'nai ra vi';
        }
    }


    // Test functions


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
