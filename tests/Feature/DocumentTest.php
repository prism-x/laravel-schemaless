<?php

namespace PrismX\Schemaless\Tests\Feature;

use PrismX\Schemaless\Tests\SampleDocument;
use PrismX\Schemaless\Tests\TestCase;

class DocumentTest extends TestCase
{
    protected $testModel;

    public function setUp(): void
    {
        parent::setUp();

        $this->testModel = SampleDocument::create([
            'title' => 'Hello, world!',
        ]);

        SampleDocument::create([
            'title'  => 'Olá, Mundo!',
            'locale' => 'pt',
        ]);
    }

    /** @test can convert to json while saving */
    public function can_convert_attributes_to_json_while_saving()
    {
        $this->assertEquals($this->testModel->getOriginal('_attributes'), '{"title":"Hello, world!","content":[],"options":5}');
    }

    /** @test Can retrieve json attributes as model attributes */
    public function can_retrieve_json_attributes_as_model_attributes()
    {
        $this->assertEquals($this->testModel->title, 'Hello, world!');
    }

    /** @test unset attributes revert to default */
    public function unset_attributes_revert_to_default()
    {
        $this->assertEquals($this->testModel->content, []);
    }

    /** @test can use fetch scope */
    public function can_use_fetch_scope()
    {
        $this->assertEquals(SampleDocument::fetch()->title, 'Hello, world!');
    }

    /** @test can fetch different locales */
    public function can_fetch_different_locales()
    {
        $this->assertEquals(SampleDocument::fetch('pt')->title, 'Olá, Mundo!');
    }
}
