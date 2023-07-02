<?php

declare(strict_types=1);

namespace Tests\Unit\Application;

use Exception;
use Frete\Core\Application\Action;
use Frete\Core\Application\{ActionFactory, IActionFactory};
use Tests\TestCase;
use Tests\Unit\Application\Stubs\{ActionStub, ActionsEnumStub};

class ActionFactoryTest extends TestCase
{
    protected ActionFactory $sut;
    protected ActionsEnumStub $actions;

    public function setUp(): void
    {
        parent::setUp();
        $this->sut = $this->createSut();
    }

    public function testConstructorSuccessWithCorrectlyData()
    {
        $this->assertInstanceOf(ActionFactory::class, $this->sut);
    }

    public function testConstructorErrorWithIncorrectlyData()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('an enum instance is expected.');
        new ActionFactory(stdClass::class);
    }

    public function testCheckExistsAction()
    {
        $this->assertEquals(true, $this->sut->exists('stubed'));
        $this->assertEquals(false, $this->sut->exists('NOT stubed'));
    }

    public function testCreateActionSuccessWithExistsAction()
    {
        $action = $this->sut->create('stubed');
        $this->assertInstanceOf(ActionStub::class, $action);
        $this->assertInstanceOf(Action::class, $action);
    }

    public function testCreateActionErrorWithNotExistsAction()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('there is no NOT stubed action on the enum');
        $this->sut = $this->createSut();
        $this->sut->create('NOT stubed');
    }

    private function createSut()
    {
        return new ActionFactory(ActionsEnumStub::class);
    }
}
