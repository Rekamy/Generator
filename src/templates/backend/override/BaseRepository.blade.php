<?= "<?php

namespace App\Contracts\Overrides;

use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityCreating;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

/**
 * Class BaseRepository
 * @package Prettus\Repository\Eloquent
 * @author Anderson Andrade <contato@andersonandra.de>
 */
abstract class BaseRepository extends PrettusBaseRepository
{
    /**
     * Save a new entity in repository
     *
     * @throws ValidatorException
     *
     * @param array \$attributes
     *
     * @return mixed
     */
    public function createWithRelation(array \$attributes)
    {
        if (!is_null(\$this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            if (\$this->versionCompare(\$this->app->version(), \"5.2.*\", \">\")) {
                \$attributes = \$this->model->newInstance()->forceFill(\$attributes)->makeVisible(\$this->model->getHidden())->toArray();
            } else {
                \$model = \$this->model->newInstance()->forceFill(\$attributes);
                \$model->makeVisible(\$this->model->getHidden());
                \$attributes = \$model->toArray();
            }

            \$this->validator->with(\$attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        event(new RepositoryEntityCreating(\$this, \$attributes));

        \$model = \$this->model->newInstance(\$attributes);
        \$model->save();
        \$hasRelations = (count(\$attributes) !== count(\$attributes, COUNT_RECURSIVE));
        if (\$hasRelations) {

            \$relations = \$this->getRelationship(\$model);

            \$hasOne = \$relations->where('type', ['HasOne', 'BelongsTo'])->pluck('name');
            \$hasOne->each(fn (\$relation) => \$model->{\$relation}()->create(\$attributes[\$relation]));

            \$belongsTo = \$relations->whereIn('type', ['BelongsToMany', 'HasMany'])->pluck('name');
            \$belongsTo->each(fn (\$relation) => \$model->{\$relation} = \$model->{\$relation}()->createMany(\$attributes[\$relation]));
        }

        \$this->resetModel();

        event(new RepositoryEntityCreated(\$this, \$model));

        return \$this->parserResult(\$model);
    }


    public function getRelationship(\$model)
    {
        \$reflector = new \ReflectionClass(\$model);

        \$relationGroup = ['HasOne', 'HasMany', 'BelongsTo', 'BelongsToMany', 'MorphToMany', 'MorphTo'];
        // \$relationGroup = ['HasOne'];

        \$relations = [];
        \$classNamespace = \"" . "Illuminate\Database\Eloquent\Relations\\" . "\\\";
        foreach (\$reflector->getMethods() as \$key => \$reflectionMethod) {

            \$returnType = \$reflectionMethod->getReturnType();
            if (!\$returnType) continue;

            \$inScope = in_array(class_basename(\$returnType->getName()), \$relationGroup);
            if (!\$inScope) continue;
            \$relations[] = [
                'name' => \$reflectionMethod->name,
                'type' => str_replace(\$classNamespace, '', \$reflectionMethod->getReturnType()->getName()),
            ];
        }

        return collect(\$relations);
    }

    // /**
    //  * Update a entity in repository by id
    //  *
    //  * @throws ValidatorException
    //  *
    //  * @param array \$attributes
    //  * @param       \$id
    //  *
    //  * @return mixed
    //  */
    // public function update(array \$attributes, \$id)
    // {
    //     \$this->applyScope();

    //     if (!is_null(\$this->validator)) {
    //         // we should pass data that has been casts by the model
    //         // to make sure data type are same because validator may need to use
    //         // this data to compare with data that fetch from database.
    //         \$model = \$this->model->newInstance();
    //         \$model->setRawAttributes([]);
    //         \$model->setAppends([]);
    //         if (\$this->versionCompare(\$this->app->version(), \"5.2.*\", \">\")) {
    //             \$attributes = \$model->forceFill(\$attributes)->makeVisible(\$this->model->getHidden())->toArray();
    //         } else {
    //             \$model->forceFill(\$attributes);
    //             \$model->makeVisible(\$this->model->getHidden());
    //             \$attributes = \$model->toArray();
    //         }

    //         \$this->validator->with(\$attributes)->setId(\$id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
    //     }

    //     \$temporarySkipPresenter = \$this->skipPresenter;

    //     \$this->skipPresenter(true);

    //     \$model = \$this->model->findOrFail(\$id);

    //     event(new RepositoryEntityUpdating(\$this, \$model));

    //     \$model->fill(\$attributes);
    //     \$model->save();

    //     \$this->skipPresenter(\$temporarySkipPresenter);
    //     \$this->resetModel();

    //     event(new RepositoryEntityUpdated(\$this, \$model));

    //     return \$this->parserResult(\$model);
    // }

}
"?>