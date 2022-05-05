<?php

namespace App\Domain\MyList\Actions;

use App\Domain\MyList\Models\MyList;

class GetMyListAction
{
    public function execute(int $myListId, array $fields): MyList
    {
        $myList = MyList::findOrFail($myListId);
        return $myList;   
    }
}