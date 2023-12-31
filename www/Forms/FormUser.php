<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class FormUser extends AForm {

    protected $method = "POST";

    public function getConfig($row=[]): array
    {
        $group = [];

        $group['firstname'] = $this->getElements(
            [ "title" => "Firstname" ],
            [
                "type"=>"text",
                "placeholder"=>"Firstname",
                "min"=>2,
                "max"=>60,
                "value"=> ($row)?trim($row[0]['firstname']):'',
                "required" => "required",
                "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
            ]
        );

        $group['lastname'] = $this->getElements(
            [ "title" => "Lastname" ],
            [
                "type"=>"text",
                "placeholder"=>"Lastname",
                "min"=>2,
                "max"=>120,
                "value"=> ($row)?trim($row[0]['lastname']):'',
                "required" => "required",
                "error"=>"Votre nom doit faire entre 2 et 120 caractères"
            ]
        );

        $group['email'] = $this->getElements(
            [
                "id" => "email",
                "title" => "Email"
            ],
            [
                "type"=>"email",
                "placeholder"=>"Email",
                "required" => "required",
                "value"=> ($row)?trim($row[0]['email']):'',
                "error"=>"Le format de votre email est incorrect"
            ]
        );

        if(!$row){
            $group['pwd'] = $this->getElements(
                [
                    "id" => "password",
                    "title" => "Password"
                ],
                [
                    "type"=>"password",
                    "placeholder"=>"Password",
                    "required" => "required",
                    "value"=> '',
                    "error"=>"Votre mot de passe est incorrect"
                ]
            );
        }

        $roles = [
            [
                'value' => 'admin',
                'title' => 'Admin', // full role
                'selected' => ''
            ],
            [
                'value' => 'blogger',
                'title' => 'Blogger', // add and edit role
                'selected' => 'selected'
            ],
            [
                'value' => 'guest',
                'title' => 'Guest', // view role
                'selected' => ''
            ]
        ];

        $option = [];
        foreach ($roles as $key => $value) {
            $selected = '';
            if($row){
                if(trim($value['value']) == trim($row[0]['role'])){
                    $selected = 'selected';
                }
            }
            $option[$key]['value'] = $value['value'];
            $option[$key]['title'] = $value['title'];
            $option[$key]['selected'] = ($row) ? $selected : $value['selected'];
        }

        $group['role'] = $this->getElements(
            [
                "id" => "role",
                "title" => "Role",
                "col"=>4,
            ],
            [
                "type" => "select",
                "options" => $option,
                "error" => "Parents incorrect"
            ]
        );

        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "submit"=>"save",
                "cancel"=>"index"
            ],
            "groups" => $group
        ];
    }
}