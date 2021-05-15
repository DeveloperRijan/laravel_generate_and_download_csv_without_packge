<?php
//for laravel / row PHP
    $data = [
        "id"=>"9965", 
        "title"=>"This is product title", 
        "category"=>"fashion", 
        "description"=>"This is test product description", 
        "image"=>"http://mysite.com/123.jpeg", 
        "type"=>"physical", 
        "sku"=>"sp-201"
    ];

	$fileName = date('d-m-Y')."-products";
    $headers = array(
		"Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName.csv",
        "Pragma" => "public",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    $columns = array('ID', 'Title', 'Category', 'Description', 'Image', 'Product Type', 'SKU');

    $file = NULL;
    $callback = function() use ($data, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($data as $content) {
            fputcsv($file, array(
                $content['id'], 
                $content['title'], 
                $content["category"], 
                $content["description"], 
                $content["image"], 
                $content["type"], 
                $content["sku"]
            ));
        }
        fclose($file);
    };


    //for Laravel
    //return Response::stream($callback, 200, $headers);