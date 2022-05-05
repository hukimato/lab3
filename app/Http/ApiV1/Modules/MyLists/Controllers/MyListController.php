<?php

namespace App\Http\ApiV1\Modules\MyLists\Controllers;

use App\Domain\MyList\Actions\ListMyListAction;
use App\Domain\MyList\Actions\CreateMyListAction;
use App\Domain\MyList\Actions\GetMyListAction;
use App\Domain\MyList\Actions\PatchMyListAction;
use App\Domain\MyList\Actions\PutMyListAction;
use App\Domain\MyList\Actions\DeleteMyListAction;

use App\Domain\MyList\Models\MyList;

use App\Http\ApiV1\Modules\MyLists\Requests\CreateMyListRequest;
use App\Http\ApiV1\Modules\MyLists\Requests\DeleteMyListRequest;
use App\Http\ApiV1\Modules\MyLists\Requests\GetMyListRequest;
use App\Http\ApiV1\Modules\MyLists\Requests\ListMyListRequest;
use App\Http\ApiV1\Modules\MyLists\Requests\PatchMyListRequest;
use App\Http\ApiV1\Modules\MyLists\Requests\PutMyListRequest;

use App\Http\ApiV1\Modules\MyLists\Resources\MyListCollection;
use App\Http\ApiV1\Modules\MyLists\Resources\MyListResource;

use App\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;

class MyListController
{
    public function list(ListMyListRequest $request,
    ListMyListAction $action
    )   {
        $skip = $request->input('skip');
        $take = $request->input('take');
        if($skip === null || $take === null){
            return new MyListCollection($action->execute(0, 0));
        }
        return (new MyListCollection($action->execute($skip, $take)))->response()->setStatusCode(200);
    }
    
    public function create(CreateMyListRequest $request,
    CreateMyListAction $action
    )   {
        $requestArray = $request->validated();
        $title = $requestArray['title'];
        return (new MyListResource($action->execute($title)))->additional(
            [
                'errors' => [
                    
                ],
                'meta' => [

                ]
            ]
        )->response()->setStatusCode(200);
    }

    public function get(int $id
    )   {
        $myList = MyList::find($id);
        if ($myList == null){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "MyList with id {$id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        else {
            return (new MyListResource($myList))->additional(
                [
                    'errors' => [
                        
                    ],
                    'meta' => [
    
                    ]
                ]
            )->response()->setStatusCode(200);
        }
        
    }

    public function put(int $id, 
                        PutMyListRequest $request,
                        PutMyListAction $action
    )   {
        if(MyList::find($id)==null){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "MyList with id {$id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        $requestArray = $request->validated();
        
        $title = $requestArray['title'];
        return (new MyListResource($action->execute($id, $title)))->additional(
            [
                'errors' => [
                    
                ],
                'meta' => [

                ]
            ]
        )->response()->setStatusCode(200);
    }

    public function patch(  int $id, 
                            PatchMyListRequest $request,
                            PatchMyListAction $action
    )   {
        if(MyList::find($id)==null){
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "MyList with id {$id} not found."
                ],
                'meta' => ''
            ], 400);
        }
        $requestArray = $request->validated();
        
        $title = $requestArray['title'];
        return (new MyListResource($action->execute($id, $title)))->additional(
            [
                'errors' => [
                    
                ],
                'meta' => [

                ]
            ]
        )->response()->setStatusCode(200);
    }

    public function delete(int $id, DeleteMyListAction $action
    )   {
        $seccess = $action->execute($id);
        if ($seccess)
        {
            return response()->json([
                'data' => '',
                'errors' => '',
                'meta' => [
                    'success' => 'Deleted'
                ]
            ], 200);
        }
        else 
        {
            return response()->json([
                'data' => '',
                'errors' => [
                    'code' => 'NotFoundResource',
                    'message' => "MyList with id {$id} not found."
                ],
                'meta' => ''
            ], 400);
        }
    }
}
