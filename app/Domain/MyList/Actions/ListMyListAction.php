<?php

namespace App\Domain\MyList\Actions;

use App\Domain\MyList\Models\MyList;
use Illuminate\Support\Facades\DB;

class ListMyListAction
{
    public function execute(int $skip, int $take)
    {
        $myList = MyList::all();

        if($skip > 0 && $take > 0){
            $myList = MyList::skip($skip)->take($take)->get();
        }

        return $myList; 
    }
}
