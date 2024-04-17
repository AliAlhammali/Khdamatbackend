<?php

namespace App\KhadamatTeck\Base;

use App\KhadamatTeck\Base\Http\HttpStatus;
use App\KhadamatTeck\Base\Http\KhadamatTeckRequest;
use App\KhadamatTeck\PmsProviders\Mappers\PmsProviderDTOMapper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

abstract class Service implements ServiceInterface
{
    private array $errors = [];

    public function __construct(protected Repository $repository)
    {
        $this->repository = $repository;
    }

    public function minimalListWithFilter(
        array $listFields = ['id', 'title'],
        array $with = [],
        array $where = []
    ): \Illuminate\Database\Eloquent\Collection|array
    {

        $query = $this->repository->getModel()->select($listFields)->limit(request('limit', 250));
        if (!empty($with)) {
            $query = $query->with($with);
        }
        if (!empty($where)) {
            $query = $query->where($where);
        }
        if (!empty($with) && !empty($where)) {
            $query = $query->with($with)->where($where);
        }
        return QueryBuilder::for(
            $query
        )
            ->allowedFilters($this->repository->getModel()->getAllowedFilters())
            ->get();
    }


    public function list(KhadamatTeckRequest $request): Response|JsonResponse
    {
        $queryBuilder = QueryBuilder::for(
            $this->repository->getModel(),
            $request
        )
            ->allowedFields($this->repository->getModel()::getAllowedFields())
            ->allowedFilters($this->repository->getModel()::getAllowedFilters())
            ->allowedIncludes($this->repository->getModel()::getAllowedIncludes())
            ->defaultSort($this->repository->getModel()::getDefaultSort())
            ->with($this->repository->getModel()::getDefaultIncludedRelations())
            ->with($this->repository->getModel()::getDefaultIncludedRelationsCount());
        if (request('returnMinimumData', false)) {
            $queryBuilder->select($this->repository->getModel()::getMinimumSelectFields());
        } else {
            $queryBuilder->select(getQueryFieldsList($this->repository->getModel()));

        }
        $this->repository = $this->repository->setModel(
            $queryBuilder->getSubject()
        );

        if ($request->has('listing') and $request->get('listing') == 1) {
            return $this->response()
                ->setData(
                    $this->mapper::fromCollection($this->repository->all())
                )
                ->setStatusCode(HttpStatus::HTTP_OK);
        }
        $data = $this->mapper::fromPaginator(
            $this->repository->paginate($request->get('perPage', 20))
        );
        return $this->response()
            ->setData($data['items'])
            ->setMeta($data['meta'])
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function create(KhadamatTeckRequest $request): Response|JsonResponse
    {
        return $this->response()
            ->setData(
                $this->mapper::fromModel(
                    $this->repository->create($request->all())
                )
            )
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function show(KhadamatTeckRequest $request, string $id): Response|JsonResponse
    {
        $queryBuilder = $this->repository->getModel()::where('id', $id);
        $queryBuilder->select(getQueryFieldsList($this->repository->getModel(), false));
        return $this->response()
            ->setData($this->mapper::fromModel($queryBuilder->first()))
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function update(KhadamatTeckRequest $request, string $id): Response|JsonResponse
    {
        return $this->response()
            ->setData(
                $this->mapper::fromModel(
                    $this->repository->update($request->all(), $id)
                )
            )
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function delete(KhadamatTeckRequest $request, string $id): Response|JsonResponse
    {
        $this->repository->delete($id);
        return $this->response()
            ->setData([
                'message' => 'Deleted successfully',
            ])
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    protected function response($statusCode = HttpStatus::HTTP_OK): Response|JsonResponse
    {
        return (new Response($statusCode))
            ->setErrors($this->getErrors());
    }

    public function setResponse($data)
    {
        return $this->response()->setData($data)->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function setErrorResponse($message = "", $status = HttpStatus::HTTP_ERROR)
    {
        return $this->response()->setErrors(['message' => $message])->setMessage($message)->setStatusCode($status)->json();
    }

    public function setSuccessResponse($message = "", $status = HttpStatus::HTTP_OK)
    {
        return $this->response()->setErrors(['message' => $message])->setMessage($message)->setStatusCode($status)->json();
    }

    public function setPaginateResponse(LengthAwarePaginator $paginator)
    {
        return $this->response()
            ->setData($paginator->items())
            ->setMeta([
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
                'path' => $paginator->path(),
                'totalCount' => count($paginator->items()),
                'perPage' => $paginator->perPage(),
                'total' => $paginator->total(),
            ])
            ->setStatusCode(HttpStatus::HTTP_OK);
    }

    public function tryAndResponse(callable $func): Response|JsonResponse
    {
        try {
            DB::beginTransaction();
            $result = $func();
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function setMessageResponse($message, $status = HttpStatus::HTTP_ERROR)
    {
        return $this->response()
            ->setData(['message' => $message])
            ->setMessage($message)
            ->setStatusCode($status)->json();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->errors[] = $error;
    }

    public function readApiResponse($data)
    {
        if ($data['status_code'] == HttpStatus::HTTP_OK) {
            return $this->setResponse($data['data'])->setMeta($data['meta'] ?? null);
        } elseif (isset($data['errors']) && $data['status_code'] == HttpStatus::HTTP_VALIDATION_ERROR) {
            return $this->response()->setErrors($data['errors'])->setStatusCode($data['status_code'])->json();
        } elseif (isset($data['errors']) && $data['status_code'] == HttpStatus::HTTP_ERROR) {
            return $this->response()->setErrors($data['errors'])->setStatusCode($data['status_code'])->json();
        } else {
            return $this->response()->setData($data)->setStatusCode($data['status_code'])->json();
        }

    }


    /**
     * method send this data (request && Mapper && Model(ex : (new Model) ) && $select column )
     * work with database pms only
     *
     * @param KhadamatTeckRequest $request
     * @param $dtoMapper
     * @param $model
     * @param array $select
     * @param string $connection
     * @return Response|JsonResponse
     */
    public function pmsList(KhadamatTeckRequest $request, $dtoMapper, $model, array $select = ['*'], string $connection = 'pms'): Response|JsonResponse
    {
        $query = $model->setConnection($connection)->select($select);

        $queryBuilder = QueryBuilder::for($query)->allowedFilters($model::getAllowedFilters())
            ->allowedFilters($model::getAllowedFilters())
            ->allowedIncludes($model::getAllowedIncludes())
            ->defaultSort($model::getDefaultSort());//->with( $model::getDefaultIncludedRelations())


        if (request('returnMinimumData', false)) {
            $queryBuilder->select($model::getMinimumSelectFields());
        }


        if ($request->has('listing') and $request->get('listing') == 1) {
            return $this->response()
                ->setData(
                    $dtoMapper::fromCollection($queryBuilder->get())
                )
                ->setStatusCode(HttpStatus::HTTP_OK);
        }

        $data = $dtoMapper::fromPaginator(
            $queryBuilder->paginate($request->get('perPage', 20))
        );

        return $this->setResponse($data['items'])->setMeta($data['meta'])->setStatusCode(HttpStatus::HTTP_OK);
    }
}
