<?php
/**
 * *************************************************************************
 *  Copyright (C) 2018 - 2018
 *
 *  This project is a extension of https://github.com/zammad/zammad-api-client-php
 *  Anyone is free to use or update.
 *
 * Developer Ahmad Sajid <ahmad@bongobd.com>
 *
 *  *************************************************************************
 */

/**
 * Created by PhpStorm.
 * User: Ahmad Sajid
 * Date: 3/15/2018
 * Time: 12:56 PM
 */

namespace ahmadsajid1989\ZammadApiBundle\Service;

use ZammadAPIClient\Client;
use ZammadAPIClient\ResourceType;

/**
 * Class ZammadApi
 * @package ahmadsajid1989\ZammadApiBundle\Service
 */
class ZammadApi
{
    /**
     * @var $client Client
     */
    protected $client;
    /**
     * @var $url
     */
    protected $url;

    /**
     * @var $username
     */
    protected $username;

    /**
     * @var $password
     */
    protected $password;

    /**
     * @var $debug
     */
    protected $debug;

    /**
     * @var $ticket
     */
    protected $ticket;

    /**
     * ZammadApi constructor.
     * @param $url
     * @param $username
     * @param $password
     * @param $debug
     */
    public function __construct($url, $username, $password, $debug)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->debug = $debug;
    }

    /**
     * @return Client
     */
    protected function client(){

           $this->client = new Client([
                'url'      => $this->url,
                'username' => $this->username,
                'password' => $this->password,
                'debug'    => false
            ]);


        return $this->client;


    }

    /**
     * @param $id
     * @return $this|bool
     */
    public function getTicket($id){



        $ticket = $this->ticket = $this->client()->resource(ResourceType::TICKET)->get($id);

        if($this->ticket)

            return $this;

        if ($ticket->hasError() ) {

            return $ticket->getError();
        }

        return false;
    }

    public function getTicketByZammadId($id){

        $ticket = $this->ticket = $this->client()->resource(ResourceType::TICKET)->get($id);
        $response = array();
        $response ['ticket'] = $ticket;
        $response ['article_details'] = $ticket->getTicketArticles();
        if($this->ticket)
            return $response;

        if ($ticket->hasError() ) {
            return $ticket->getError();
        }

        return false;
    }

    public function searchTicketByTitle($search){

        $this->ticket = $this->client()->resource(ResourceType::TICKET)->search("title:".$search);

        if(is_array($this->ticket))

            return $this;

        else
            return false;

    }

    public function searchTicketByCustomerId($search){

        $this->ticket = $this->client()->resource(ResourceType::TICKET)->search("customer_id:".$search);

        if(is_array($this->ticket))

            return $this;

        else
            return false;
    }

    public function searchUserByBongoId($search){

        $user = $this->client()->resource(ResourceType::USER)->search("bongoid:".$search);
        if(is_array($user))

            return $user;

        else
            return false;
    }

    public function createUser($user_info=array()){

        $user = $this->client()->resource( ResourceType::USER );
        $user->setValue('login',$user_info['login']);
        $user->setValue('email',$user_info['email']);
        $user->setValue('phone',$user_info['phone']);
        $user->setValue('active',$user_info['active']);
        $user->setValue('password',$user_info['password']);
        $user->setValue('firstname',$user_info['firstname']);
        $user->setValue('lastname',$user_info['lastname']);
        $response = $user->save();
        if ($response->getError()==null){
            return $response;
        }else{
            return $response->getError();
        }
    }

    public function createTicket($ticket_info=array()){

        $ticket = $this->client()->resource( ResourceType::TICKET );
        $ticket->setValue( 'title', $ticket_info['title'] );
        $ticket->setValue( 'customer_id',$ticket_info['customer_id']);
        $ticket->setValue( 'article',$ticket_info['article']);
        $ticket->setValue( 'group_id',$ticket_info['group_id']);
        $response = $ticket->save();
        if ($response->getError()==null){
            return $response;
        }else{
            return $response->getError();
        }

    }


}