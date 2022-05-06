<?php

namespace App\Domain\MyList\Actions;

use App\Domain\MyList\Models\MyList;

class PatchMyListAction
{
    public function execute(int $myListId, string $title): MyList
    {
        $myList = MyList::find($myListId);
        if($myList == null)
        {
            return null;
        }
        $myList->title = $title;
        $myList->save();
        return $myList;   
    }
}
