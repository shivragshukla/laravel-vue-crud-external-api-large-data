<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\PropertyRepositoryInterface;
use App\Http\Resources\PropertyResource;
use App\Models\PropertyType;
use App\Models\Property;
use Image;

class PropertyRepository implements PropertyRepositoryInterface 
{
    public function getAllProperties() 
    {
        return new PropertyResource(Property::paginate(10));
    }

    public function getAllTypes() 
    {
        return PropertyType::all();
    }

    public function getPropertyById($propertyId) 
    {
        return new PropertyResource(Property::findOrFail($propertyId));
    }

    public function deleteProperty($propertyId) 
    {
        try {
            Property::destroy($propertyId);
            return ['status'=>'success'];
        } catch (ModelNotFoundException $e) {
            return ['status'=>'error'];
        }
    }

    public function createProperty(array $propertyDetails) 
    {

        $data = collect($propertyDetails)->reject(function ($value, $key) {
            return $key === 'image';
        })->toArray();

        //image upload
        if ($propertyDetails['image']) {
            $file_name = $this->upload($propertyDetails['image']);
            $data['image_full'] = config('app.url') . '/uploads/' . $file_name;
            $data['image_thumbnail'] = config('app.url') . '/thumbnail/' . $file_name;
        }

        return Property::create($data);
    }

    public function updateProperty($propertyId, array $newDetails) 
    {

        try {

            $data = collect($newDetails)->reject(function ($value, $key) {
                return $key === 'image';
            })->toArray();

            //image upload
            if ($newDetails['image']) {
                $file_name = $this->upload($newDetails['image']);
                $data['image_full'] = config('app.url') . '/uploads/' . $file_name;
                $data['image_thumbnail'] = config('app.url') . '/thumbnail/' . $file_name;
            }

            return Property::where('uuid', $propertyId)->update($data);
        } catch (ModelNotFoundException $e) {
            return ['status'=>'error'];
        }
    }

    private function upload($file)
    {
        $file_name = time().'.'.$file->getClientOriginalExtension();

        // stored in thumbnail
        $destinationPath = public_path('/thumbnail');
        $imgFile = Image::make($file->getRealPath());

        $imgFile->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file_name);

        // stored in full image
        $destinationPath = public_path('/uploads');
        //$destinationPath = '/images/uploads';
        $file->move($destinationPath, $file_name);

        return $file_name;

    }

}
