<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/28/17
 * Time: 5:56 PM
 */

//the namespace respects the directory structure


return [

    //domain name
    'Manager' => [
        'entities'=>[ //domain entities

            'Manager' => [
                'generate_crud' => true,  //if true create routes contorller and "service domain as entry point"
                'table' => 'manger',
                'fields'=>[
                    [
                        'pk' => true,
                        'name'=>'manager_id',
                        'column'=>'manager_id',
                        'type'=>'integer',
                        'length'=>'10',
                    ],
                    [
                        'name'=>'name',
                        'column'=>'manager_name',
                        'type'=>'string' ,
                        'length'=>'255',
                        'unique'=>'true',
                        'nullable'=>'false',
                        'options' => [
                            'default'=>'JOAO',
                        ]
                    ],
                    [
                        'name'=>'weight',
                        'column'=>'manager_weight',
                        'type'=>'decimal',
                        'scale'=>'5',
                        'precision'=>'2',
                        'unique'=>'true',
                        'options' => [
                            'default'=>'10.25',
                        ]
                    ]
                ]
            ],

            'Offer' => [
                'generate_crud' => true,
                'table' => 'offer',
                'fields'=>[
                    [
                        'pk' => true,
                        'name'=>'offer_id',
                        'column'=>'offer_id',
                        'type'=>'integer',
                        'length'=>'10',
                    ],
                    [
                        'name'=>'offer_name',
                        'column'=>'offer_name',
                        'type'=>'string' ,
                        'length'=>'255',
                        'unique'=>'true',
                        'nullable'=>'false'
                    ],
                    [
                        'name'=>'offer_weight',
                        'column'=>'offer_weight',
                        'type'=>'decimal',
                        'scale'=>'5',
                        'precision'=>'2'
                    ],
                    [
                        'name'=>'offer_sharp',
                        'column'=>'offer_sharp',
                        'type'=>'integer',
                        'scale'=>'5',
                        'precision'=>'2',
                        'options' => [
                            'default'=>'35',
                        ]
                    ]
                ]
            ],
            //end entities definition
        ]
    ],

    //domain name
    'Customer' => [
        'entities'=>[ //domain entities

            'Customer' => [
                'generate_crud' => true,
                'table' => 'customer',
                'fields'=>[
                    [
                        'pk' => true,
                        'name'=>'customer_id',
                        'column'=>'customer_id',
                        'type'=>'integer',
                        'length'=>'10',
                    ],
                    [
                        'name'=>'customer_name',
                        'column'=>'customer_name',
                        'type'=>'string' ,
                        'length'=>'255',
                        'unique'=>'true',
                        'nullable'=>'true'
                    ],
                    [
                        'name'=>'customer_weight',
                        'column'=>'customer_weight',
                        'type'=>'decimal',
                        'scale'=>'5',
                        'precision'=>'2'
                    ]
                ]
            ],

            'Order' => [
                'generate_crud' => true,
                'table' => 'order',
                'fields'=>[
                    [
                        'pk' => true,
                        'name'=>'order_id',
                        'column'=>'order_id',
                        'type'=>'integer',
                        'length'=>'10',
                    ],
                    [
                        'name'=>'order_name',
                        'column'=>'order_name',
                        'type'=>'string',
                        'length'=>'255',
                        'unique'=>'true',
                        'nullable'=>'false'
                    ],
                    [
                        'name'=>'order_weight',
                        'column'=>'order_weight',
                        'type'=>'decimal',
                        'scale'=>'5',
                        'precision'=>'2'
                    ]
                ]
            ],
            //end entities definition
        ]
    ],

    //end Domains definition
];