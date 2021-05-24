<?="<?php

namespace App\Contracts\Utilities;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
/**
 *
 */
trait FileUpload
{
    private \$file;

    public function uploadFile(UploadedFile \$uploadedFile, \$folder = null, \$disk = 'public')
    {
        // \$name = !is_null(\$filename) ? \$filename : Str::random(25);
        \$file = \$uploadedFile->getClientOriginalName();
        \$fileName = pathinfo(\$file,PATHINFO_FILENAME);

        \$this->file['path'] = \$uploadedFile->storeAs(\$folder, \$fileName . '.' . \$uploadedFile->getClientOriginalExtension(), \$disk);
        \$this->file['name'] = \$fileName;

        // \$this->file = \$uploadedFile->storeAs(\$folder, \$name . '.' . \$uploadedFile->getClientOriginalExtension(), \$disk);

        return \$this->file;
    }
}
"
?>
