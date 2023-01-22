<?= <<<SCRIPT
<?php

namespace {$context->config->setup->backend->base_controller->namespace};

use App\Exceptions\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success(\$message = "Success", \$data = null)
    {
        return response()->json([
            'message' => \$message,
            'data' => \$data
        ], 200);
    }

    public function apiDoc()
    {
        return redirect('/api/documentation');
    }

    public function web()
    {
        return redirect('/{$context->config->template->frontend_path}/');
    }
}
SCRIPT;
?>
