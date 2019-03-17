<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IncidentControllerTest extends WebTestCase {
    
    public function testListIncidents() {

        $client = static::createClient();

        $client->xmlHttpRequest("GET", "/incidents", []);

        $response = $client->getResponse();

        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(isset($content->data));
        $this->assertTrue(empty($content->errors));
    }

    public function testSuccessfullNewIncident() {

        $client = static::createClient();

        $client->xmlHttpRequest("POST", "/incidents", [
            "title" => "DDoS Attack",
            "description" => "A DDoS attack occurred just now.",
            "criticity" => "high",
            "type" => "ddos-attack"
        ]);

        $response = $client->getResponse();

        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(isset($content->data));
        $this->assertTrue(empty($content->errors));
    }

    public function testFailedNewIncident() {

        $client = static::createClient();

        $client->xmlHttpRequest("POST", "/incidents", [
            "title" => "D",
            "description" => "",
            "type" => "ddos-attacc"
        ]);

        $response = $client->getResponse();

        $content = json_decode($response->getContent());

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertTrue(empty($content->data));
        $this->assertTrue(!empty($content->errors));
    }

    public function testNotFoundIncident() {

        $client = static::createClient();

        $client->xmlHttpRequest("GET", "/incidents/-1");

        $response = $client->getResponse();

        $content = json_decode($response->getContent());

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertTrue(empty($content->data));
        $this->assertTrue(empty($content->errors));
    }

    public function testSuccessfullUpdateIncident() {

        $client = static::createClient();

        $client->xmlHttpRequest("PUT", "/incidents/1", [
            "title" => "DDoS Attack Updated",
            "description" => "A update occurred on DDoS attack that occurred just now.",
            "criticity" => "medium",
            "type" => "ddos-attack",
            "status" => "closed"
        ]);

        $response = $client->getResponse();

        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(isset($content->data));
        $this->assertTrue(empty($content->errors));
    }

    // public function testSuccessfullDeleteIncident() {

    //     $client = static::createClient();

    //     $client->xmlHttpRequest("DELETE", "/incidents/1");

    //     $response = $client->getResponse();

    //     $content = json_decode($response->getContent());

    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertTrue(empty($content->data));
    //     $this->assertTrue(empty($content->errors));
    // }
}