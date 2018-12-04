<?php
namespace X\Service\Youtube\Test\Service;
use PHPUnit\Framework\TestCase;
use X\Service\Goku\Project;
use X\Service\Goku\Service;
class ProjectTest extends TestCase {
    public function test_trigger() {
        $project = Service::getService()->getProject('test');
        $project->trigger('event-001', array('id'=>'1231344', 'name'=>'测试事件'));
    }
}