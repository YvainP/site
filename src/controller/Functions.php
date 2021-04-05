<?php

namespace website\controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\UploadedFile;

class Functions {

    //recupère les données des champs d'un formulaire
    public static function getFilteredPost(ServerRequestInterface $request, string $field) {
        $fields = $request->getParsedBodyParam($field, null);

        if($fields === null) return null;
        if(is_array($fields)) {
            foreach ($fields as $field => $value) {
                $fields[$field] = $value;
            }
            return $fields;
        }
        return $fields;
    }
}
