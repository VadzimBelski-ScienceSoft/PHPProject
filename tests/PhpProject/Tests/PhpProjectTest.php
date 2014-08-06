<?php
/**
 * This file is part of PHPProject - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPProject is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPProject/contributors.
 *
 * @copyright   2010-2014 PHPProject contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 * @link        https://github.com/PHPOffice/PHPProject
 */

namespace PhpOffice\PhpProject\Tests;

use PhpOffice\PhpProject\PhpProject;
use PhpOffice\PhpProject\DocumentInformations;
use PhpOffice\PhpProject\DocumentProperties;

/**
 * Test class for Task
 */
class PhpProjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Register
     */
    public function testConstruct()
    {
        $object = new PhpProject();

        $this->assertInstanceOf('PhpOffice\\PhpProject\\DocumentProperties', $object->getProperties());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\DocumentInformations', $object->getInformations());
    }
    
    public function testGetSetInformations()
    {
        $object = new PhpProject();
        $oInformations = new DocumentInformations();

        $this->assertInstanceOf('PhpOffice\\PhpProject\\DocumentInformations', $object->getInformations());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\PhpProject', $object->setInformations($oInformations));
        $this->assertInstanceOf('PhpOffice\\PhpProject\\DocumentInformations', $object->getInformations());
    }
    
    public function testGetSetProperties()
    {
        $object = new PhpProject();
        $oProperties = new DocumentProperties();

        $this->assertInstanceOf('PhpOffice\\PhpProject\\DocumentProperties', $object->getProperties());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\PhpProject', $object->setProperties($oProperties));
        $this->assertInstanceOf('PhpOffice\\PhpProject\\DocumentProperties', $object->getProperties());
    }
    
    public function testResource()
    {
        $object = new PhpProject();

        // Start
        $this->assertEquals(0, $object->getResourceCount());
        $this->assertCount(0, $object->getAllResources());
        $this->assertInternalType('array', $object->getAllResources());
        $this->assertNull($object->getActiveResource());
        // Add a resource
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Resource', $object->createResource());
        $this->assertEquals(1, $object->getResourceCount());
        $this->assertCount(1, $object->getAllResources());
        $this->assertInternalType('array', $object->getAllResources());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Resource', $object->getActiveResource());
        // Get Resource
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Resource', $object->getResource());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Resource', $object->getResource(0));
    }
    
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Resource index is out of bounds.
     */
    public function testResourceException()
    {
        $object = new PhpProject();
        $object->getResource();
    }
    
    public function testTask()
    {
        $object = new PhpProject();
    
        // Start
        $this->assertEquals(0, $object->getTaskCount());
        $this->assertNull($object->getActiveTaskIndex());
        $this->assertCount(0, $object->getAllTasks());
        $this->assertInternalType('array', $object->getAllTasks());
        $this->assertNull($object->getActiveTask());
        // Add a task
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->createTask());
        $this->assertEquals(1, $object->getTaskCount());
        $this->assertCount(1, $object->getAllTasks());
        $this->assertEquals(0, $object->getActiveTaskIndex());
        $this->assertInternalType('array', $object->getAllTasks());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->getActiveTask());
        // Add a task
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->createTask());
        $this->assertEquals(2, $object->getTaskCount());
        $this->assertCount(2, $object->getAllTasks());
        $this->assertEquals(1, $object->getActiveTaskIndex());
        $this->assertInternalType('array', $object->getAllTasks());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->getActiveTask());
        // Get Task
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->getTask());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->getTask(0));
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->getTask(1));
        // Active Task
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->setActiveTaskIndex(0));
        $this->assertEquals(0, $object->getActiveTaskIndex());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->setActiveTaskIndex(1));
        $this->assertEquals(1, $object->getActiveTaskIndex());
        // Remove Task
        $object->removeTaskByIndex(0);
        $this->assertEquals(1, $object->getTaskCount());
        $this->assertCount(1, $object->getAllTasks());
        $this->assertEquals(0, $object->getActiveTaskIndex());
        $this->assertInternalType('array', $object->getAllTasks());
        $this->assertInstanceOf('PhpOffice\\PhpProject\\Task', $object->getActiveTask());
    }
    
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Task index is out of bounds.
     */
    public function testTaskException()
    {
        $object = new PhpProject();
        $object->getTask();
    }
    
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Task index is out of bounds.
     */
    public function testTaskRemoveException()
    {
        $object = new PhpProject();
        $object->removeTaskByIndex();
    }
    
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Active task index is out of bounds.
     */
    public function testTaskSetActiveException()
    {
        $object = new PhpProject();
        $object->setActiveTaskIndex(10);
    }
}
