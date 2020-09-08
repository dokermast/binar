<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Binar;

class BinarController extends Controller
{
    public function main()
    {
        $binars = Binar::all();

        return view('main', compact('binars'));
    }

    public function add()
    {
        $level_limit = 5;
//        $unavailabled_parents_ids = $this->getUnavailableParents();
        $unavailabled_parents_ids = $this->getUnParents();
        $parents = Binar::where('level', '<', $level_limit)->get();
        $parents = $parents->except($unavailabled_parents_ids);

        return view('add-form', compact('parents'));
    }


    public function save(Request $request)
    {
        $input = $request->except('_token');

        $node = new Binar();
        $parent_id = (int)$input['parent_id'];
        $position = (int)$input['position'];
        $parent_node = Binar::find($parent_id);

        $level = $parent_node->level + 1;

        if ($level > 5){
            return redirect(route('main'))->withErrors('Level should be less then 5');
        }

        $node->parent_id = $parent_id;
        $node->position = $position;
        $node->level = $level;

        $node->save();
        $node->path = $parent_node->path . '.' . $node->id;
        $node->update();

        return redirect(route('main'));
    }


    /**
     * @return array
     *
     * return binars ids has two children
     */
    public function getUnavailableParents()
    {
        $binars = Binar::all();
        $parent_ar = [];

        foreach( $binars as $item) {

            if (!in_array($item->parent_id, array_keys($parent_ar ))) {
                $parent_ar += [$item->parent_id => 1];
            } elseif (in_array($item->parent_id,array_keys($parent_ar ))) {
                foreach ($parent_ar as $key=>$val) {
                    if ( $key == $item->parent_id) {
                        $parent_ar[$key] = $val + 1;
                    }
                }
            }
        }
        $unavailable_parents = [];
        foreach ($parent_ar as $key => $val) {
            if ( $val == 2 ) {
                $unavailable_parents[] = $key;
            }
        }

        return $unavailable_parents;
    }


    public function getRelatives($id)
    {
        $binar = Binar::find($id);
        $path = $binar->path;
        $upRelatives_ids = explode('.', $path);
        array_pop($upRelatives_ids);
        $upRelatives = Binar::find($upRelatives_ids);
        $subRelatives = Binar::where('path', 'like', '%' . $id . '%')
                                ->get();

        $relatives = $upRelatives->merge($subRelatives);

        return view('relatives', compact('relatives'), ['id' => $id ]);
    }


    /**
     * @param $id
     * @return false|string
     * return availabled binar positions
     */
    public function getAvailablePosition($id){

        $binars = Binar::where('parent_id', '=', $id)->get();
        $positions = [];
        if(count($binars) == 1  ) {
            foreach ($binars as $item) {
                $positions = $binars[0]->position == Binar::LEFT ? [['value' => Binar::RIGHT, 'label' => "Right"]] : [['value' => Binar::LEFT , 'label' => "Left"]];
            }
        } elseif (count($binars) == 0) {
            $positions = [
                ['value' => Binar::LEFT , 'label' => "Left"],
                ['value' => Binar::RIGHT, 'label' => "Right"]
            ];
        }

        return json_encode($positions);
    }

    public function getUnParents()
    {
        $binars = DB::table('binars')
            ->select('parent_id')
            ->groupBy('parent_id')
            ->havingRaw('SUM(position) > 2')
            ->get();

        $ids = [];
        foreach ($binars as $item){
           $ids[] = ((array)$item)['parent_id'];
        }

        return $ids;
    }
}
