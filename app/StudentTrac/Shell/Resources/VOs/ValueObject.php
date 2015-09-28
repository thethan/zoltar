<?php

namespace App\StudentTrac\Shell\Resources\VOs;

class ValueObject
{

    public $status, $errors;


    function __construct($className, $classObj, $resBody, $status, $errors) {


            // $object to test against.
            $data = (array)$resBody;
            $data['errors'] = $errors;
            $data['status'] = $status;

            foreach($data as $key => $val) {

                if(property_exists($this,$key)){
                    $this->$key = $val;
                }
            }
            if(is_array($resBody)) {
                if(array_key_exists($className,$resBody)){

                    $this->$className = $resBody[$className];
                } else {
                    $this->$className = $resBody;
                }

            }


        }

    }

