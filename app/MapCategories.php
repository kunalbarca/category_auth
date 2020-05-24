<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categories;
use DB;

class MapCategories extends Model
{
    protected $table = 'map_categories';
    protected $hidden = [];
    protected $guarded = [];

    public static function categoryDetails($id){
        $categories = DB::table('categories as cat')
                        ->leftJoin('map_categories as mappedCat', 'cat.id', '=', 'mappedCat.categoryId')
                        ->where('cat.id', $id)
                        ->select('cat.id as id', 'cat.name as name' ,'cat.isActive as status', 'cat.sortOrder as sortOrder', 'mappedCat.parentCategoryId as parent')->first();
        return $categories;
    }

    public static function allCategories(){
        $data = Categories::orderBy('sortOrder')->paginate(3);
        
        $parentCategoryName = '';
        $categoryIds = Categories::pluck('id');
        foreach($categoryIds as $key => $ids){
            $categoryDetails[$key] = self::categoryDetails($ids);
            if($categoryDetails[$key]->parent != 0){
                $categoryDetails[$key]->parentName = self::getParentName($categoryDetails[$key]->parent, $parentCategoryName);
            }else{
                $categoryDetails[$key]->parentName = '';
            }
            foreach($data as $datas){
                if($datas['id'] == $ids){
                    $datas['parentName'] = $categoryDetails[$key]->parentName;
                }
            }
        }
        
        return $data;
    }

    public static function getParentName($id, $parentCategoryName){
        $parentName = Categories::where('id', $id)->first();
        $parentCategoryName = $parentName->name . '--->' . $parentCategoryName;
        $parentCheck = self::categoryDetails($parentName->id);
        if($parentCheck->parent != 0){
            $parentCategoryName = self::getParentName($parentCheck->parent, $parentCategoryName);
        }
        return $parentCategoryName;
    }

    public static function menus(){
        $parent = DB::table('categories as cat')
                            ->leftJoin('map_categories as mappedCat', 'cat.id', '=', 'mappedCat.categoryId')
                            ->where('mappedCat.parentCategoryId', 0)
                            ->where('cat.isActive', 1)
                            ->select('cat.id as id', 'cat.name as name')
                            ->get()
                            ->toArray();
        foreach($parent as $key => $data){
            $child = self::addChild($data->id);
            $parent[$key]->children = $child;
        }
        return $parent;
    }

    public static function addChild($id){
        $child = self::getChildDetails($id);
        if(!empty($child)){
            foreach($child as $index => $data){
                $children[$index]['childId'] = $data->childId;
                $children[$index]['childName'] = $data->childName;
                $nChild = self::addChild($data->childId);
                $children[$index]['children'] = $nChild;
            }
            return $children;
        }else{
            return $child;
        }
    }

    public static function getChildDetails($id){
        $childDetails = DB::table('categories as cat')
                        ->leftJoin('map_categories as mappedCat', 'cat.id', '=', 'mappedCat.categoryId')
                        ->where('mappedCat.parentCategoryId', $id)
                        ->where('cat.isActive', 1)
                        ->select('cat.id as childId', 'cat.name as childName')
                        ->get()
                        ->toArray();
        return $childDetails;
    }
}
