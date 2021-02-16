<?="<?php

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;
use DB;
use App\Exceptions\ValidationException;

class CrudController extends Controller
{

    protected \$baseBloc;
    protected \$moduleName = '';
    private \$result;

    public function index(Request \$request)
    {
        try {
            // \$this->baseBloc->request->validateIndex();
            \$this->result = \$this->baseBloc->index(\$request->all());


            return \$this->success('Succesfull Retrieved Data', \$this->result);
        } catch (\Throwable \$th) {
            return \$this->error(\$th, ['message' => 'Error Processing ' . \$this->moduleName . ' Request']);
        }
    }

    public function store(Request \$request)
    {
        DB::beginTransaction();
        try {

            // \$this->baseBloc->request->validateStore();
            \$this->result = \$this->baseBloc->store(\$request->all());

            DB::commit();
            return \$this->success('Succesfull Insert Data', \$this->result);
        } catch (ValidationException \$ex) {
            DB::rollBack();
            return \$this->error(\$th);
        } catch (\Throwable \$th) {
            DB::rollBack();
            return \$this->error(\$th, ['message' => '' . \$this->moduleName . ' not created']);
        }
    }


    public function show(\$id)
    {
        try {
            //\$this->baseBloc->request->validateShow();
            \$this->result = \$this->baseBloc->show(\$id);

            return \$this->success('Succesfull Retrieved Data', \$this->result);
        } catch (\Throwable \$th) {
            return \$this->error(\$th, ['message' => 'Unable to retrieved ' . \$this->moduleName . '']);
        }
    }

    public function update(Request \$request, \$id)
    {
        DB::beginTransaction();
        try {
            //\$this->baseBloc->request->validateUpdate();
            \$this->result = \$this->baseBloc->update(\$id, \$request->all());

            DB::commit();
            return \$this->success('Succesfull Update Data', \$this->result);
        } catch (\Throwable \$th) {
            DB::rollback();
            return \$this->error(\$th, ['message' => 'Unable to update ' . \$this->moduleName . '']);
        }
    }

    public function destroy(\$id)
    {
        DB::beginTransaction();
        try {
            //\$this->baseBloc->request->validateDestroy();
            \$this->result = \$this->baseBloc->destroy(\$id);

            DB::commit();
            return \$this->success('Succesfull Delete Data', \$this->result);
        } catch (\Throwable \$th) {
            DB::rollback();
            return \$this->error(\$th, ['message' => 'Unable to delete ' . \$this->moduleName . '']);
        }
    }
}
"
?>