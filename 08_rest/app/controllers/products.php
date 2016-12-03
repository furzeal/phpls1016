<?php
namespace Shop;

class products
{
    //GET /users
    public function index()
    {
        echo 1;
        $data = \Shop\Models\Product::all();
        if (!empty($data)) {
            http_response_code(200);
            echo json_decode($data);
        }
    }

    //GET /users/1
    public function show($id)
    {
        $data = \Shop\Models\Product::find($id);
        if (!empty($data)) {
            http_response_code(200);
//            echo json_decode($data);
            $data['category'] = $data->category->name;
//            echo "<pre>";
//            print_r($data['category']);
            echo($data);
        }
    }

    //PUT /users/1
    public function edit($id)
    {

    }

    //POST /users
    public function store()
    {

    }

    //DELETE /users/1
    public function destroy($id)
    {

    }
}