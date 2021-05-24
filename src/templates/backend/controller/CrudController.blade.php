<?="<?php

namespace " . $context->namespace['crud_controller'] . ";

use Illuminate\Http\Request;
use DB;

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
            throw \$th;
        }
    }

    public function store(Request \$request)
    {
        DB::beginTransaction();
        try {

            \$this->baseBloc->request->validateStore();
            \$this->result = \$this->baseBloc->store(\$request->all());

            DB::commit();
            return \$this->success('Succesfull Insert Data', \$this->result);
        } catch (\Throwable \$th) {
            DB::rollBack();
            throw \$th;
        }
    }


    public function show(\$id)
    {
        try {
            //\$this->baseBloc->request->validateShow();
            \$this->result = \$this->baseBloc->show(\$id);

            return \$this->success('Succesfull Retrieved Data', \$this->result);
        } catch (\Throwable \$th) {
            throw \$th;
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
            throw \$th;
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
            throw \$th;
        }
    }
}
"
?>