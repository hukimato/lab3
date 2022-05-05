<?php

namespace App\Domain\MyList\Actions;

use App\Domain\MyList\Models\MyList;

class DeleteMyListAction
{
    public function execute(int $myListId)
    {
        $myList = MyList::find($myListId);
        if($myList != null) 
        {
            $myList->delete();
            return true;
        }
        else
        {
            return false;
        }
    }
}
