<?php

namespace App\Domain\MyList\Actions;

use App\Domain\MyList\Models\MyList;

class PutMyListAction
{
    public function execute(int $id, string $title): MyList
    {
        $myList = MyList::find($id);
        $myList->title = $title;
        $myList->save();
        return $myList;   
    }
}
