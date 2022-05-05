<?php

namespace App\Domain\MyList\Actions;

use App\Domain\MyList\Models\MyList;

class CreateMyListAction
{
    public function execute(string $title): MyList 
    {
        // $myList = MyList::create([
        //     'title' => $title,
        // ]);
        $myList = new MyList;
        $myList->title = $title;
        $myList->save();
        return $myList;
    }
}
