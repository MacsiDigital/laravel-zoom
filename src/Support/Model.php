<?php

namespace MacsiDigital\Zoom\Support;

use Exception;
use Illuminate\Support\Collection;
use MacsiDigital\Zoom\Facades\Zoom;

abstract class Model
{
    protected $attributes = [];
    protected $createAttributes = [];
    protected $updateAttributes = [];
    protected $queryAttributes = [];
    protected $relationships = [];
    protected $queries = [];
    protected $methods = [];

    public $response;

    const ENDPOINT = '';
    const NODE_NAME = '';
    const KEY_FIELD = '';

    protected $client;

    public function __construct()
    {
        $this->client = Zoom::getClient();
    }

    /**
     * Get the resource uri of the class (Contacts) etc.
     *
     * @return string
     */
    public static function getEndpoint()
    {
        return static::ENDPOINT;
    }

    /**
     * Get the root node name.  Just the unqualified classname.
     *
     * @return string
     */
    public static function getRootNodeName()
    {
        return static::NODE_NAME;
    }

    /**
     * Get the response model.
     *
     * @return response object
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the unique key field.
     *
     * @return string
     */
    public static function getKey()
    {
        return static::KEY_FIELD;
    }

    /**
     * Get the object unique ID.
     *
     * @return string
     */
    public function getID()
    {
        $index = $this->getKey();

        return $this->$index;
    }

    public function hasID()
    {
        $index = $this->getKey();
        if ($this->$index != '') {
            return true;
        }

        return false;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (! $key) {
            return;
        }
        if ($this->attributeExists($key)) {
            return $this->getAttributeValue($key);
        }
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        return $this->getAttributeFromArray($key);
    }

    /**
     * Get an attribute from the $attributes array.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getAttributeFromArray($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if ($this->attributeExists($key)) {
            if ($this->isRelationshipAttribute($key)) {
                $class = new $this->relationships[$key];
                if (is_array($value) && in_array($class->getKey(), $value)) {
                    $class->fill($value);
                    $this->attributes[$key] = $class;
                } else if(is_array($value)){
                    foreach ($value as $index => $class) {
                        $new_class = new $this->relationships[$key];
                        $new_class->fill($class);
                        $this->attributes[$key][$index] = $new_class;
                    }
                } else {
                    $this->attributes[$key] = $value;    
                }
            } else {
                $this->attributes[$key] = $value;
            }
        }

        return $this;
    }

    public function attributeExists($key)
    {
        return array_key_exists($key, $this->attributes);
    }

    public function isRelationshipAttribute($key)
    {
        return array_key_exists($key, $this->relationships);
    }

    public function unsetAttribute($key)
    {
        $this->setAttribute($key, '');

        return $this;
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determine if an attribute or relation exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->attributeExists($key);
    }

    /**
     * Unset an attribute on the model.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        return $this->unsetAttribute($key);
    }

    public function make($attributes)
    {
        $model = new static;
        $model->fill($attributes);

        return $model;
    }

    public function create($attributes)
    {
        $model = static::make($attributes);
        $model->save();

        return $model;
    }

    public function fill($attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->$attribute = $value;
        }

        return $this;
    }

    public function update($attributes)
    {
        $this->fill($attributes)->save();

        return $this;
    }

    public function save()
    {
        if ($this->hasID()) {
            if (in_array('put', $this->methods) || in_array('patch', $this->methods)) {
                $this->response = $this->response = $this->client->patch("{$this->getEndpoint()}/{$this->getID()}", $this->updateAttributes());
                if ($this->response->getStatusCode() == '204') {
                    return $this;
                } else {
                    throw new Exception('Status Code '.$this->response->getStatusCode());
                }
            }
        } else {
            if (in_array('post', $this->methods)) {
                $this->response = $this->client->post($this->getEndpoint(), $this->createAttributes());
                if ($this->response->getStatusCode() == '201') {
                    $this->fill($this->response->getBody());

                    return $this;
                } else {
                    throw new Exception('Status Code '.$this->response->getStatusCode());
                }
            }
        }
    }

    public function where($key, $operator, $value = '')
    {
        if (in_array($key, $this->queryAttributes)) {
            if ($value == '') {
                $value = $operator;
                $operator = '=';
            }
            $this->queries[$key] = ['key' => $key, 'operator' => $operator, 'value' => $value];
        }

        return $this;
    }

    public function getQueryString()
    {
        $query_string = '';
        if ($this->queries != []) {
            $query_string .= '?';
            $i = 1;
            foreach ($this->queries as $query) {
                if ($i > 1) {
                    $query_string .= '&';
                }
                $query_string .= $query['key'].$query['operator'].urlencode($query['value']);
                $i++;
            }
        }

        return $query_string;
    }

    public function first()
    {
        return $this->get()->first();
    }

    public function get()
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get($this->getEndpoint().$this->getQueryString());
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getBody());
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    public function all()
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get($this->getEndpoint());
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getBody());
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    public function find($id)
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get($this->getEndpoint().'/'.$id);
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getBody())->first();
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    public function delete($id = '')
    {
        if ($id == '') {
            $id = $this->getID();
        }
        if (in_array('delete', $this->methods)) {
            $this->response = $this->client->delete($this->getEndpoint().'/'.$id);
            if ($this->response->getStatusCode() == '204') {
                return $this->response->getStatusCode();
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    protected function collect($response)
    {
        $items = [];
        if (isset($response[strtolower($this->getEndpoint())])) {
            foreach ($response[strtolower($this->getEndpoint())] as $item) {
                $items[] = static::make($item);
            }
        } else {
            $items[] = static::make($response);
        }

        return new Collection($items);
    }

    public function createAttributes()
    {
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            if (in_array($key, $this->createAttributes)) {
                if (is_object($value)) {
                    $attributes[$key] = $value->createAttributes();
                } else {
                    if ($value != '') {
                        $attributes[$key] = $value;
                    }
                }
            }
        }

        return $attributes;
    }

    public function updateAttributes()
    {
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            if (in_array($key, $this->updateAttributes)) {
                if (is_object($value)) {
                    $attributes[$key] = $value->updateAttributes();
                } else {
                    if ($value != '') {
                        $attributes[$key] = $value;
                    }
                }
            }
        }

        return $attributes;
    }
}
