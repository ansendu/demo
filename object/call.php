<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2017��04��21��
 * Time: 13:51
 *
 * __call() ��������ʹ��
 * Person��ί��PersonWriter���writer����
 */

class Person {

    /** @var PersonWriter */
    protected $writer;

    public function __construct(PersonWriter $writer)
    {
        $this->writer = $writer;
    }

    public function __call($method, $args)
    {
        // check method exist
        if (method_exists($this->writer, $method)) {
            $this->writer->$method($args);
        } else {
            echo 'method ' . $method . ' is not exist';
        }
    }

    public function __destruct()
    {
        echo PHP_EOL . 'object will be destruct';
    }

}

class PersonWriter {

    public function write($messages)
    {
        $messages = is_array($messages) ? implode(' ', $messages) : $messages;
        echo 'person writer has run, msg is ' . $messages;
    }

}

$args = isset($argv[1]) ? $argv[1] : '__call() test';
$person = new Person(new PersonWriter());
$person->write($args);

